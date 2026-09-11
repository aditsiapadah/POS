<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->foreignId('jenis_produk_id')
                ->nullable()
                ->after('nama')
                ->constrained('jenis_produk')
                ->nullOnDelete();
        });

        /*
        |--------------------------------------------------------------------------
        | Pindahkan jenis produk lama jika ada
        |--------------------------------------------------------------------------
        | Pada database baru, tabel produk masih kosong sehingga bagian ini
        | tidak akan membuat data jenis produk otomatis.
        */

        $existingTypes = DB::table('produk')
            ->whereNotNull('jenis_produk')
            ->distinct()
            ->pluck('jenis_produk');

        foreach ($existingTypes as $nama) {
            DB::table('jenis_produk')->insertOrIgnore([
                'nama'       => $nama,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $jenisMap = DB::table('jenis_produk')->pluck('id', 'nama');

        foreach (DB::table('produk')->whereNotNull('jenis_produk')->get() as $produk) {
            $jenisProdukId = $jenisMap[$produk->jenis_produk] ?? null;

            if ($jenisProdukId) {
                DB::table('produk')
                    ->where('id', $produk->id)
                    ->update([
                        'jenis_produk_id' => $jenisProdukId,
                    ]);
            }
        }

        Schema::table('produk', function (Blueprint $table) {
            $table->dropColumn('jenis_produk');
        });
    }

    public function down(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->string('jenis_produk')
                ->nullable()
                ->after('nama');
        });

        foreach (DB::table('produk')->whereNotNull('jenis_produk_id')->get() as $produk) {
            $nama = DB::table('jenis_produk')
                ->where('id', $produk->jenis_produk_id)
                ->value('nama');

            if ($nama) {
                DB::table('produk')
                    ->where('id', $produk->id)
                    ->update([
                        'jenis_produk' => $nama,
                    ]);
            }
        }

        Schema::table('produk', function (Blueprint $table) {
            $table->dropForeign(['jenis_produk_id']);
            $table->dropColumn('jenis_produk_id');
        });
    }
};