<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan MitraMart POS</title>
    <style>
        @page { margin: 28px; }
        body { font-family: DejaVu Sans, sans-serif; color: #1e293b; font-size: 11px; }
        h1 { margin: 0; color: #0A2540; font-size: 22px; }
        .meta { margin: 5px 0 18px; color: #64748b; }
        .cards { width: 100%; margin-bottom: 16px; border-collapse: separate; border-spacing: 6px; }
        .cards td { width: 33%; padding: 10px; border: 1px solid #dbeafe; background: #eff6ff; }
        .label { color: #64748b; font-size: 9px; text-transform: uppercase; }
        .value { margin-top: 4px; color: #0A2540; font-size: 15px; font-weight: bold; }
        table.data { width: 100%; border-collapse: collapse; }
        .data th { padding: 8px; background: #0A2540; color: white; text-align: left; }
        .data td { padding: 7px 8px; border-bottom: 1px solid #e2e8f0; }
        .right { text-align: right !important; }
        .center { text-align: center !important; }
        .footer { margin-top: 14px; font-size: 9px; color: #64748b; }
    </style>
</head>
<body>
    <h1>Laporan Penjualan MitraMart POS</h1>
    <div class="meta">Periode: {{ $periode }} | Dibuat: {{ $generatedAt->format('d-m-Y H:i:s') }} | Kode referensi: {{ $verificationCode }}</div>

    <table class="cards">
        <tr>
            <td><div class="label">Total Pendapatan</div><div class="value">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div></td>
            <td><div class="label">Jumlah Transaksi</div><div class="value">{{ number_format($totalTransaksi) }}</div></td>
            <td><div class="label">Produk Terjual</div><div class="value">{{ number_format($totalProdukTerjual) }} pcs</div></td>
        </tr>
    </table>

    <table class="data">
        <thead><tr><th>ID</th><th>Tanggal</th><th>Kasir</th><th>Metode</th><th class="center">Item</th><th class="right">Total</th></tr></thead>
        <tbody>
            @forelse($penjualan as $transaksi)
                <tr>
                    <td>#{{ $transaksi->id }}</td>
                    <td>{{ $transaksi->created_at->format('d-m-Y H:i') }}</td>
                    <td>{{ optional($transaksi->user)->name ?? '-' }}</td>
                    <td>{{ $transaksi->metode_pembayaran }}</td>
                    <td class="center">{{ $transaksi->itemPenjualan->sum('kuantitas') }}</td>
                    <td class="right">Rp {{ number_format($transaksi->total_pembayaran, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr><td colspan="6" class="center">Tidak ada data pada periode ini.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="footer">Hanya transaksi COMPLETED yang dihitung. Kode referensi dapat dicocokkan dengan halaman laporan dan file Excel.</div>
</body>
</html>
