<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {

            $table->string('nama_aplikasi')
                  ->nullable()
                  ->after('logo');

            $table->string('versi_aplikasi')
                  ->nullable()
                  ->after('nama_aplikasi');

            $table->text('deskripsi_aplikasi')
                  ->nullable()
                  ->after('versi_aplikasi');

            $table->string('developer')
                  ->nullable()
                  ->after('deskripsi_aplikasi');

        });
    }


    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {

            $table->dropColumn([
                'nama_aplikasi',
                'versi_aplikasi',
                'deskripsi_aplikasi',
                'developer'
            ]);

        });
    }

};