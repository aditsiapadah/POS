<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $lainnyaId = DB::table('jenis_produk')->where('nama', 'Lainnya')->value('id');

        if (!$lainnyaId) {
            return;
        }

        $fallbackId = DB::table('jenis_produk')
            ->where('nama', '!=', 'Lainnya')
            ->orderBy('id')
            ->value('id');

        if ($fallbackId) {
            DB::table('produk')
                ->where('jenis_produk_id', $lainnyaId)
                ->update(['jenis_produk_id' => $fallbackId]);
        }

        DB::table('jenis_produk')->where('id', $lainnyaId)->delete();
    }

    public function down(): void
    {
        DB::table('jenis_produk')->insertOrIgnore([
            'nama'       => 'Lainnya',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
};
