<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Services\AuditLogger;
use App\Services\MidtransQrisService;
use Illuminate\Http\Request;

class MidtransNotificationController extends Controller
{
    public function __invoke(Request $request, MidtransQrisService $midtrans)
    {
        $payload = $request->all();

        if (!$midtrans->validSignature($payload)) {
            return response()->json(['message' => 'Signature tidak valid.'], 403);
        }

        $penjualan = Penjualan::where('gateway_order_id', $payload['order_id'] ?? null)->first();

        if (!$penjualan) {
            return response()->json(['message' => 'Transaksi tidak ditemukan.'], 404);
        }

        if ((int) round((float) ($payload['gross_amount'] ?? 0)) !== (int) $penjualan->total_pembayaran) {
            return response()->json(['message' => 'Nominal pembayaran tidak cocok.'], 422);
        }

        $status = strtolower((string) ($payload['transaction_status'] ?? 'pending'));
        $fraudStatus = strtolower((string) ($payload['fraud_status'] ?? 'accept'));
        $paid = in_array($status, ['settlement', 'capture'], true) && $fraudStatus === 'accept';

        $paymentStatus = match ($status) {
            'settlement', 'capture' => $paid ? 'PAID' : 'CHALLENGE',
            'expire' => 'EXPIRED',
            'cancel' => 'CANCELED',
            'deny' => 'DENIED',
            default => 'PENDING',
        };

        // Notifikasi dapat datang lebih dari sekali atau tidak berurutan.
        // Status PAID tidak boleh kembali menjadi PENDING/EXPIRED.
        if ($penjualan->payment_status === 'PAID' && !$paid) {
            return response()->json(['message' => 'Notifikasi lama diabaikan.']);
        }

        $penjualan->update([
            'gateway_transaction_id' => $payload['transaction_id'] ?? $penjualan->gateway_transaction_id,
            'payment_status' => $paymentStatus,
            'status' => $paid ? 'COMPLETED' : $penjualan->status,
            'paid_at' => $paid ? ($penjualan->paid_at ?? now()) : $penjualan->paid_at,
            'gateway_payload' => $payload,
        ]);

        app(AuditLogger::class)->record(
            'PAYMENT',
            'Pembayaran',
            'Notifikasi Midtrans untuk transaksi #' . $penjualan->id . ': ' . $paymentStatus . '.',
            $penjualan,
            [],
            ['payment_status' => $paymentStatus]
        );

        return response()->json(['message' => 'Notifikasi diterima.']);
    }
}
