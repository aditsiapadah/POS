<?php

namespace App\Http\Controllers;

use App\Models\ItemPenjualan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItemPenjualanController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'penjualan_id' => 'required|exists:penjualan,id',
        'produk_id' => 'required|exists:produk,id',
        'kuantitas' => 'required|integer|min:1'
    ]);

    DB::transaction(function () use ($request) {

        $sale = Penjualan::whereKey($request->penjualan_id)
            ->where('status', 'OPEN')
            ->firstOrFail();

        abort_unless(
            in_array(strtolower((string) optional(Auth::user()->role)->name), ['admin', 'kasir'], true),
            403
        );

        $product = Produk::lockForUpdate()->findOrFail($request->produk_id);

        if ($product->stok < $request->kuantitas) {
            return redirect()->route('penjualan.create')
                ->with('errors', 'Stok produk tidak mencukupi');
        }

        $product->decrement('stok', $request->kuantitas);

        $item = ItemPenjualan::where('penjualan_id', $sale->id)
            ->where('produk_id', $product->id)
            ->lockForUpdate()
            ->first();

        if ($item) {
            $item->kuantitas += $request->kuantitas;
        } else {
            $item = new ItemPenjualan([
                'penjualan_id' => $sale->id,
                'produk_id' => $product->id,
                'kuantitas' => $request->kuantitas,
                'harga_satuan' => $product->harga_jual,
            ]);
        }

        $item->subtotal = $item->kuantitas * $item->harga_satuan;
        $item->save();

        $sale->update([
            'total_pembayaran' => $sale->itemPenjualan()->sum('subtotal')
        ]);
    });

    return back();
}

    public function update(Request $request, ItemPenjualan $itempenjualan)
{
    $request->validate([
        'kuantitas' => 'required|integer|min:1'
    ]);

    DB::transaction(function () use ($request, $itempenjualan) {

        abort_unless($itempenjualan->penjualan->status === 'OPEN', 403);

        $produk = $itempenjualan->produk()->lockForUpdate()->first();

        $selisih = $request->kuantitas - $itempenjualan->kuantitas;

        // Jika qty bertambah
        if ($selisih > 0) {
            if ($produk->stok < $selisih) {
                return redirect()->route('penjualan.create')
                    ->with('errors', 'Stok tidak mencukupi');
            }

            $produk->decrement('stok', $selisih);
        }

        // Jika qty berkurang
        if ($selisih < 0) {
            $produk->increment('stok', abs($selisih));
        }

        $itempenjualan->update([
            'kuantitas' => $request->kuantitas,
            'subtotal'  => $request->kuantitas * $itempenjualan->harga_satuan,
        ]);

        $itempenjualan->penjualan->update([
            'total_pembayaran' => $itempenjualan->penjualan
                ->itemPenjualan()
                ->sum('subtotal')
        ]);
    });

    return back();
}

    public function destroy(ItemPenjualan $itempenjualan)
    {
        $this->authorize('delete', $itempenjualan);

        DB::transaction(function () use ($itempenjualan) {

            $produk = $itempenjualan->produk;
            $sale = $itempenjualan->penjualan;

            // 🔼 Kembalikan stok
            $produk->increment('stok', $itempenjualan->kuantitas);

            // ❌ Hapus item
            $itempenjualan->delete();

            // 🔵 Update total penjualan
            $sale->update([
                'total_pembayaran' => $sale->itemPenjualan()->sum('subtotal')
            ]);
        });

        return back();
    }
}
