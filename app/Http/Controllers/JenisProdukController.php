<?php

namespace App\Http\Controllers;

use App\Models\JenisProduk;
use Illuminate\Http\Request;

class JenisProdukController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $jenisProduks = JenisProduk::withCount('produk')
            ->when($search, function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('jenis-produk.index', compact('jenisProduks'));
    }

    public function create()
    {
        $this->ensureAdmin();

        return view('jenis-produk.create');
    }

    public function store(Request $request)
    {
        $this->ensureAdmin();

        $request->validate([
            'nama' => 'required|string|max:255|unique:jenis_produk,nama',
        ]);

        JenisProduk::create([
            'nama' => $request->nama,
        ]);

        return redirect()
            ->route('jenis-produk.index')
            ->with('success', 'Jenis produk berhasil ditambahkan.');
    }

    public function edit(JenisProduk $jenisProduk)
    {
        $this->ensureAdmin();

        return view('jenis-produk.edit', compact('jenisProduk'));
    }

    public function update(Request $request, JenisProduk $jenisProduk)
    {
        $this->ensureAdmin();

        $request->validate([
            'nama' => 'required|string|max:255|unique:jenis_produk,nama,' . $jenisProduk->id,
        ]);

        $jenisProduk->update([
            'nama' => $request->nama,
        ]);

        return redirect()
            ->route('jenis-produk.index')
            ->with('success', 'Jenis produk berhasil diperbarui.');
    }

    public function destroy(JenisProduk $jenisProduk)
    {
        $this->ensureAdmin();

        if ($jenisProduk->produk()->exists()) {
            return redirect()
                ->route('jenis-produk.index')
                ->with('error', 'Jenis produk tidak dapat dihapus karena masih digunakan oleh produk.');
        }

        $jenisProduk->delete();

        return redirect()
            ->route('jenis-produk.index')
            ->with('success', 'Jenis produk berhasil dihapus.');
    }

    private function ensureAdmin(): void
    {
        abort_unless(
            strtolower((string) optional(auth()->user()->role)->name) === 'admin',
            403,
            'Hanya Admin yang dapat mengubah data jenis produk.'
        );
    }
}
