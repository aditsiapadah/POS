<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penjualan', function (Blueprint $table) {
            $table->string('payment_status', 30)->default('UNPAID')->after('status')->index();
            $table->string('gateway_provider', 30)->nullable()->after('payment_status');
            $table->string('gateway_order_id', 191)->nullable()->unique()->after('gateway_provider');
            $table->string('gateway_transaction_id', 191)->nullable()->after('gateway_order_id');
            $table->text('payment_qr_url')->nullable()->after('gateway_transaction_id');
            $table->timestamp('payment_expired_at')->nullable()->after('payment_qr_url');
            $table->timestamp('paid_at')->nullable()->after('payment_expired_at');
            $table->json('gateway_payload')->nullable()->after('paid_at');
        });

        DB::table('penjualan')
            ->where('status', 'COMPLETED')
            ->update([
                'payment_status' => 'PAID',
                'paid_at' => DB::raw('updated_at'),
            ]);
    }

    public function down(): void
    {
        Schema::table('penjualan', function (Blueprint $table) {
            $table->dropUnique(['gateway_order_id']);
            $table->dropColumn([
                'payment_status',
                'gateway_provider',
                'gateway_order_id',
                'gateway_transaction_id',
                'payment_qr_url',
                'payment_expired_at',
                'paid_at',
                'gateway_payload',
            ]);
        });
    }
};
