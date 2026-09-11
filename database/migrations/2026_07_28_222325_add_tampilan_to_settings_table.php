<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('bahasa')->default('id')->after('logo');
            $table->string('mata_uang')->default('IDR')->after('bahasa');
            $table->unsignedInteger('per_page')->default(10)->after('mata_uang');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['bahasa', 'mata_uang', 'per_page']);
        });
    }
};