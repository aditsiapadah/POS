<?php

namespace App\Services;

use App\Models\Penjualan;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use RuntimeException;

class MidtransQrisService
{
    public function enabled(): bool
    {
        return (bool) config('services.midtrans.enabled');
    }

    /**
     * Membuat QRIS dinamis. Gunakan Sandbox sebelum mengaktifkan Production.
     *
     * @throws RequestException
     */
    public function createCharge(Penjualan $penjualan): array
    {
        $serverKey = (string) config('services.midtrans.server_key');

        if ($serverKey === '') {
            throw new RuntimeException('MIDTRANS_SERVER_KEY belum diisi. Gunakan kunci Sandbox terlebih dahulu.');
        }

        $orderId = 'POS-' . $penjualan->id . '-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(4));
        $expiryMinutes = (int) config('services.midtrans.expiry_minutes', 15);

        $response = Http::asJson()
            ->acceptJson()
            ->withBasicAuth($serverKey, '')
            ->timeout(20)
            ->retry(2, 500)
            ->post($this->baseUrl() . '/v2/charge', [
                'payment_type' => 'qris',
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => (int) $penjualan->total_pembayaran,
                ],
                'customer_details' => [
                    'first_name' => optional($penjualan->user)->name ?? 'Pelanggan POS',
                    'email' => optional($penjualan->user)->email,
                ],
                'custom_expiry' => [
                    'order_time' => now()->format('Y-m-d H:i:s O'),
                    'expiry_duration' => $expiryMinutes,
                    'unit' => 'minute',
                ],
            ])
            ->throw()
            ->json();

        $qrAction = collect($response['actions'] ?? [])->firstWhere('name', 'generate-qr-code');
        $qrUrl = $qrAction['url'] ?? null;

        if (!$qrUrl) {
            throw new RuntimeException('Penyedia pembayaran tidak mengirimkan QRIS. Silakan coba lagi.');
        }

        return [
            'order_id' => $response['order_id'] ?? $orderId,
            'transaction_id' => $response['transaction_id'] ?? null,
            'payment_status' => strtoupper($response['transaction_status'] ?? 'PENDING'),
            'qr_url' => $qrUrl,
            'expired_at' => now()->addMinutes($expiryMinutes),
            'payload' => $response,
        ];
    }

    public function validSignature(array $payload): bool
    {
        $serverKey = (string) config('services.midtrans.server_key');
        $received = (string) ($payload['signature_key'] ?? '');

        if ($serverKey === '' || $received === '') {
            return false;
        }

        $expected = hash('sha512',
            ($payload['order_id'] ?? '') .
            ($payload['status_code'] ?? '') .
            ($payload['gross_amount'] ?? '') .
            $serverKey
        );

        return hash_equals($expected, $received);
    }

    private function baseUrl(): string
    {
        return config('services.midtrans.is_production')
            ? 'https://api.midtrans.com'
            : 'https://api.sandbox.midtrans.com';
    }
}
