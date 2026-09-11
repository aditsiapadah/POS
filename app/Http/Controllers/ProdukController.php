<?php

namespace App\Http\Controllers;

use App\Models\ItemPenjualan;
use App\Models\Produk;
use App\Models\JenisProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $produk = Produk::with('jenisProduk')
            ->when($search, function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhereHas('jenisProduk', function ($q) use ($search) {
                        $q->where('nama', 'like', '%' . $search . '%');
                    });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('produk.index', compact('produk'));
    }

    public function create()
    {
        $this->ensureAdmin();
        $jenisProduks = JenisProduk::latest()->get();

        return view('produk.create', compact('jenisProduks'));
    }

    public function store(Request $request)
    {
        $this->ensureAdmin();

        $request->validate([
            'jenis_produk_id'  => 'required|exists:jenis_produk,id',
            'nama'             => 'required|string|max:255',
            'foto'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'harga_beli'       => 'required|numeric|min:0',
            'harga_jual'       => 'required|numeric|min:0',
            'stok'             => 'required|integer|min:0',
        ]);

        $foto = null;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('produk', 'public');
        }

        Produk::create([
            'user_id'          => Auth::id(),
            'jenis_produk_id'  => $request->jenis_produk_id,
            'nama'             => $request->nama,
            'foto'             => $foto,
            'harga_beli'       => $request->harga_beli,
            'harga_jual'       => $request->harga_jual,
            'stok'             => $request->stok,
        ]);

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Produk $produk)
    {
        $produk->load('jenisProduk');

        return view('produk.show', compact('produk'));
    }

    public function edit(Produk $produk)
    {
        $this->ensureAdmin();
        $jenisProduks = JenisProduk::latest()->get();

        return view('produk.edit', compact('produk', 'jenisProduks'));
    }

    public function update(Request $request, Produk $produk)
    {
        $this->ensureAdmin();

        $request->validate([
            'jenis_produk_id'  => 'required|exists:jenis_produk,id',
            'nama'             => 'required|string|max:255',
            'foto'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'harga_beli'       => 'required|numeric|min:0',
            'harga_jual'       => 'required|numeric|min:0',
            'stok'             => 'required|integer|min:0',
        ]);

        if ($request->hasFile('foto')) {

            if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
                Storage::disk('public')->delete($produk->foto);
            }

            $produk->foto = $request->file('foto')->store('produk', 'public');
        }

        $produk->user_id = $produk->user_id ?? Auth::id();
        $produk->jenis_produk_id = $request->jenis_produk_id;
        $produk->nama = $request->nama;
        $produk->harga_beli = $request->harga_beli;
        $produk->harga_jual = $request->harga_jual;
        $produk->stok = $request->stok;

        $produk->save();

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        $this->ensureAdmin();

        $digunakan = ItemPenjualan::where('produk_id', $produk->id)->exists();

        if ($digunakan) {
            return redirect()
                ->route('produk.index')
                ->with('error', 'Produk sedang digunakan pada transaksi dan tidak dapat dihapus.');
        }

        if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
            Storage::disk('public')->delete($produk->foto);
        }

        $produk->delete();

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    private function ensureAdmin(): void
    {
        abort_unless(
            strtolower((string) optional(Auth::user()->role)->name) === 'admin',
            403
        );
    }
}
