<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Services\MidtransQrisService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function __construct(private readonly MidtransQrisService $midtrans)
    {
    }

    public function index(SearchRequest $request)
    {
        $keyword = $request->input('search');

        $penjualan = Penjualan::with('user')
            ->when($keyword, function ($query) use ($keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('penjualan.index', compact('penjualan'));
    }


    public function create(SearchRequest $request)
    {
        $sale = Penjualan::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'status' => 'OPEN'
            ],
            [
                'total_pembayaran' => 0,
                'metode_pembayaran' => 'CASH'
            ]
        );


        $keyword = $request->input('search');


        $products = Produk::when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', '%' . $keyword . '%');
            })
            ->orderBy('nama')
            ->get();


        $mode = 'create';


        return view('penjualan.pos', compact(
            'sale',
            'products',
            'mode'
        ));
    }


    public function destroy(Penjualan $penjualan)
    {
        $this->ensureCanAccess($penjualan);

        if ($penjualan->status !== 'OPEN') {
            return redirect()
                ->route('penjualan.index')
                ->with('error', 'Transaksi sudah selesai tidak bisa dibatalkan');
        }


        DB::transaction(function () use ($penjualan) {

            foreach ($penjualan->itemPenjualan as $item) {
                $item->produk->increment(
                    'stok',
                    $item->kuantitas
                );
            }


            $penjualan->itemPenjualan()->delete();
            $penjualan->delete();

        });


        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil dibatalkan');
    }



    public function update(Request $request, Penjualan $penjualan)
    {
        $this->ensureCanAccess($penjualan);

        $request->validate([
            'payment_method' => 'required|in:CASH,TRANSFER,QRIS',
            'status' => 'required|in:OPEN,COMPLETED',
            'uang_dibayar' => 'nullable|integer|min:0',
        ]);


        if ($penjualan->status !== 'OPEN') {
            return back()->with(
                'errors',
                'Transaksi sudah diproses'
            );
        }


        if ($penjualan->itemPenjualan()->count() === 0) {
            return back()->with(
                'errors',
                'Keranjang masih kosong'
            );
        }


        $total = $penjualan
            ->itemPenjualan()
            ->sum('subtotal');

        $uangDibayar = $request->filled('uang_dibayar')
            ? (int) $request->uang_dibayar
            : null;

        if (
            $request->payment_method === 'CASH'
            && $request->status === 'COMPLETED'
            && ($uangDibayar === null || $uangDibayar < $total)
        ) {
            return back()
                ->withInput()
                ->with('error', 'Uang dibayar harus sama dengan atau lebih besar dari total pembayaran.');
        }

        $kembalian = $request->payment_method === 'CASH' && $uangDibayar !== null
            ? max(0, $uangDibayar - $total)
            : 0;


        $penjualan->update([
            'metode_pembayaran' => $request->payment_method,
            'total_pembayaran' => $total,
            'uang_dibayar' => $request->payment_method === 'CASH' ? $uangDibayar : $total,
            'kembalian' => $kembalian,
        ]);

        // QRIS tetap OPEN sampai penyedia pembayaran mengonfirmasi uang masuk.
        if ($request->payment_method == 'QRIS') {
            if ($request->status === 'OPEN') {
                $penjualan->update(['payment_status' => 'UNPAID']);

                return redirect()
                    ->route('penjualan.index')
                    ->with('success', 'Transaksi QRIS berhasil disimpan sebagai OPEN');
            }

            if ($this->midtrans->enabled()) {
                try {
                    $penjualan->loadMissing('user');
                    $charge = $this->midtrans->createCharge($penjualan);

                    $penjualan->update([
                        'status' => 'OPEN',
                        'payment_status' => $charge['payment_status'],
                        'gateway_provider' => 'MIDTRANS',
                        'gateway_order_id' => $charge['order_id'],
                        'gateway_transaction_id' => $charge['transaction_id'],
                        'payment_qr_url' => $charge['qr_url'],
                        'payment_expired_at' => $charge['expired_at'],
                        'paid_at' => null,
                        'gateway_payload' => $charge['payload'],
                    ]);
                } catch (\Throwable $exception) {
                    report($exception);

                    return back()->with('error', 'QRIS Midtrans gagal dibuat: ' . $exception->getMessage());
                }
            } else {
                $penjualan->update([
                    'status' => 'OPEN',
                    'payment_status' => 'DEMO_PENDING',
                    'gateway_provider' => 'DEMO',
                    'payment_qr_url' => null,
                    'payment_expired_at' => null,
                ]);
            }

            return redirect()
                ->route('penjualan.qris', $penjualan->id);
        }

        // CASH dan TRANSFER mengikuti tombol OPEN/COMPLETED.
        $penjualan->update([
            'status' => $request->status,
            'payment_status' => $request->status === 'COMPLETED' ? 'PAID' : 'UNPAID',
            'gateway_provider' => null,
            'gateway_order_id' => null,
            'gateway_transaction_id' => null,
            'payment_qr_url' => null,
            'payment_expired_at' => null,
            'paid_at' => $request->status === 'COMPLETED' ? now() : null,
            'gateway_payload' => null,
        ]);

        if ($request->status == 'OPEN') {
            return redirect()
                ->route('penjualan.index')
                ->with('success', 'Transaksi berhasil disimpan sebagai OPEN');
        }

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil diselesaikan');
    }



    public function edit(Penjualan $penjualan)
    {
        $this->ensureCanAccess($penjualan);

        $sale = $penjualan;


        if ($sale->status === 'COMPLETED') {

            return redirect()
                ->route('penjualan.index')
                ->with(
                    'errors',
                    'Transaksi sudah selesai dan tidak dapat diedit'
                );
        }


        $sale->load('itemPenjualan');


        $products = Produk::orderBy('nama')->get();


        $mode = 'edit';


        return view('penjualan.pos', compact(
            'sale',
            'products',
            'mode'
        ));
    }



    public function show(Penjualan $penjualan)
    {
        $penjualan->load([
            'user',
            'itemPenjualan.produk'
        ]);


        return view(
            'penjualan.detail',
            compact('penjualan')
        );
    }



    public function cetak($id)
    {
        $penjualan = Penjualan::with([
            'user',
            'itemPenjualan.produk'
        ])
        ->findOrFail($id);


        return view(
            'penjualan.cetak',
            compact('penjualan')
        );
    }



    // =========================
    // QRIS
    // =========================

    public function qris($id)
    {
        $penjualan = Penjualan::with([
            'user',
            'itemPenjualan.produk'
        ])
        ->findOrFail($id);

        $this->ensureCanAccess($penjualan);


        return view(
            'penjualan.qris',
            compact('penjualan')
        );
    }



    public function konfirmasiBayar($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $this->ensureCanAccess($penjualan);

        if ($this->midtrans->enabled()) {
            return back()->with('error', 'Pembayaran Midtrans hanya dapat dikonfirmasi otomatis oleh notifikasi resmi.');
        }

        $penjualan->update([
            'status' => 'COMPLETED',
            'payment_status' => 'DEMO_PAID',
            'paid_at' => now(),
        ]);

        return redirect()
            ->route('penjualan.cetak', $penjualan->id)
            ->with('success', 'Pembayaran QRIS demo berhasil');
    }

    public function paymentStatus(Penjualan $penjualan)
    {
        $this->ensureCanAccess($penjualan);

        return response()->json([
            'status' => $penjualan->payment_status,
            'paid' => $penjualan->status === 'COMPLETED' && $penjualan->payment_status === 'PAID',
            'redirect_url' => route('penjualan.cetak', $penjualan->id),
        ]);
    }

    private function ensureCanAccess(Penjualan $penjualan): void
    {
        $user = Auth::user();
        $isAdmin = strtolower((string) optional($user->role)->name) === 'admin';
        $isKasir = strtolower((string) optional($user->role)->name) === 'kasir';

        abort_unless($isAdmin || $isKasir, 403);
    }
}
