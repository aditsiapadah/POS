<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f1f5f9;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: #0f172a;
            padding: 40px 16px;
            -webkit-font-smoothing: antialiased;
        }

        /* =========================
           STRUK
        ========================== */
        .struk {
            width: 360px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 50px -12px rgba(15, 23, 42, 0.18);
        }

        /* =========================
           HEADER
        ========================== */
        .header {
            background: #0f172a;
            color: white;
            text-align: center;
            padding: 26px 22px 22px;
            position: relative;
        }

        .header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #38bdf8, #818cf8, #c084fc);
        }

        .header h1 {
            font-size: 21px;
            font-weight: 700;
            letter-spacing: 0.4px;
            margin-bottom: 4px;
        }

        .header p {
            font-size: 12.5px;
            color: #94a3b8;
            font-weight: 500;
        }

        /* =========================
           CONTENT
        ========================== */
        .content {
            padding: 22px;
        }

        /* =========================
           TRANSACTION INFO
        ========================== */
        .transaction-info {
            background: #f8fafc;
            border-radius: 14px;
            padding: 14px 16px;
            border: 1px solid #e2e8f0;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12.5px;
            padding: 6.5px 0;
        }

        .info-row:not(:last-child) {
            border-bottom: 1px dashed #e2e8f0;
        }

        .info-label {
            color: #64748b;
            font-weight: 500;
        }

        .info-value {
            color: #0f172a;
            font-weight: 600;
            text-align: right;
        }

        /* =========================
           DIVIDER
        ========================== */
        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #cbd5e1, transparent);
            margin: 20px 0;
        }

        /* =========================
           ITEMS HEADER
        ========================== */
        .items-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .items-title strong {
            font-size: 13px;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: 0.2px;
        }

        .items-title span {
            font-size: 11px;
            font-weight: 600;
            color: #64748b;
            background: #f1f5f9;
            padding: 3px 10px;
            border-radius: 20px;
        }

        /* =========================
           ITEMS
        ========================== */
        .item {
            padding: 12px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .item:last-child {
            border-bottom: none;
        }

        .item-top {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 3px;
        }

        .product-name {
            color: #0f172a;
            max-width: 200px;
            line-height: 1.35;
        }

        .item-subtotal {
            color: #0f172a;
            white-space: nowrap;
            font-weight: 700;
        }

        .item-bottom {
            display: flex;
            justify-content: space-between;
            font-size: 11.5px;
            color: #64748b;
            font-weight: 500;
        }

        /* =========================
           TOTAL
        ========================== */
        .total-box {
            margin-top: 18px;
            background: #0f172a;
            color: white;
            border-radius: 14px;
            padding: 16px 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .total-label {
            font-size: 11px;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-weight: 600;
            margin-bottom: 3px;
        }

        .total-text {
            font-size: 18px;
            font-weight: 700;
            letter-spacing: -0.3px;
        }

        /* =========================
           PAYMENT
        ========================== */
        .payment-box {
            margin-top: 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 14px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
        }

        .payment-label {
            font-size: 12px;
            color: #64748b;
            font-weight: 500;
        }

        .badge {
            background: #0f172a;
            color: white;
            padding: 5px 13px;
            border-radius: 20px;
            font-size: 11.5px;
            font-weight: 600;
            letter-spacing: 0.2px;
        }

        /* =========================
           FOOTER
        ========================== */
        .footer {
            text-align: center;
            margin-top: 24px;
            padding-top: 18px;
            border-top: 1px dashed #e2e8f0;
            color: #64748b;
            font-size: 12px;
            line-height: 1.6;
        }

        .footer strong {
            display: block;
            color: #0f172a;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 3px;
        }

        .footer-brand {
            margin-top: 10px;
            font-size: 10.5px;
            color: #94a3b8;
            font-weight: 500;
            letter-spacing: 0.6px;
        }

        /* =========================
           BUTTON
        ========================== */
        .btn-area {
            text-align: center;
            margin-top: 28px;
        }

        .btn-print {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: #0f172a;
            color: white;
            border: none;
            padding: 13px 26px;
            border-radius: 12px;
            cursor: pointer;
            font-size: 13.5px;
            font-weight: 600;
            font-family: inherit;
            box-shadow: 0 8px 20px -6px rgba(15, 23, 42, 0.35);
            transition: all 0.2s ease;
        }

        .btn-print:hover {
            background: #1e293b;
            transform: translateY(-1px);
            box-shadow: 0 12px 24px -6px rgba(15, 23, 42, 0.4);
        }

        .print-icon {
            width: 16px;
            height: 16px;
        }

        /* =========================
           PRINT STYLES
        ========================== */
        @media print {
            @page {
                size: 80mm auto;
                margin: 0;
            }

            html, body {
                width: 80mm;
                margin: 0;
                padding: 0;
                background: white;
            }

            body {
                font-family: Arial, Helvetica, sans-serif;
            }

            .struk {
                width: 80mm;
                margin: 0;
                border-radius: 0;
                box-shadow: none;
                overflow: visible;
            }

            .header {
                border-radius: 0;
                padding: 16px 12px 14px;
            }

            .header::after {
                height: 2px;
            }

            .header h1 {
                font-size: 17px;
            }

            .header p {
                font-size: 11px;
            }

            .content {
                padding: 14px 12px;
            }

            .transaction-info {
                padding: 10px 12px;
                border-radius: 8px;
            }

            .info-row {
                font-size: 11.5px;
                padding: 4.5px 0;
            }

            .items-title strong {
                font-size: 12px;
            }

            .item {
                padding: 9px 0;
            }

            .item-top {
                font-size: 12px;
            }

            .item-bottom {
                font-size: 11px;
            }

            .total-box {
                border-radius: 8px;
                padding: 12px 14px;
            }

            .total-text {
                font-size: 16px;
            }

            .payment-box {
                border-radius: 8px;
                padding: 10px 12px;
            }

            .badge {
                font-size: 11px;
                padding: 4px 10px;
            }

            .footer {
                margin-top: 16px;
                padding-top: 12px;
            }

            .footer strong {
                font-size: 13px;
            }

            .btn-area {
                display: none !important;
            }
        }
    </style>
</head>

<body>

<div class="struk">

    <!-- HEADER -->
    <div class="header">
        <h1>MITRAMART</h1>
        <p>Sistem Point Of Sale</p>
    </div>

    <!-- CONTENT -->
    <div class="content">

        <!-- INFORMASI TRANSAKSI -->
        <div class="transaction-info">
            <div class="info-row">
                <span class="info-label">No. Transaksi</span>
                <span class="info-value">#{{ str_pad($penjualan->id, 5, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Tanggal</span>
                <span class="info-value">{{ $penjualan->created_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Kasir</span>
                <span class="info-value">{{ $penjualan->user->name ?? '-' }}</span>
            </div>
        </div>

        <div class="divider"></div>

        <!-- DAFTAR PRODUK -->
        <div class="items-title">
            <strong>Detail Pembelian</strong>
            <span>{{ $penjualan->itemPenjualan->count() }} Item</span>
        </div>

        @foreach($penjualan->itemPenjualan as $item)
            <div class="item">
                <div class="item-top">
                    <span class="product-name">{{ $item->produk->nama }}</span>
                    <span class="item-subtotal">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="item-bottom">
                    <span>{{ $item->kuantitas }} × Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</span>
                    <span>Subtotal</span>
                </div>
            </div>
        @endforeach

        <!-- TOTAL -->
        <div class="total-box">
            <div>
                <div class="total-label">Total Pembayaran</div>
                <div class="total-text">Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}</div>
            </div>
        </div>

        <!-- PEMBAYARAN -->
        <div class="payment-box">
            <span class="payment-label">Metode Pembayaran</span>
            <span class="badge">{{ $penjualan->metode_pembayaran }}</span>
        </div>

        @if($penjualan->metode_pembayaran === 'CASH')
        <div class="payment-box">
            <span class="payment-label">Uang Dibayar</span>
            <strong>Rp {{ number_format($penjualan->uang_dibayar ?? $penjualan->total_pembayaran, 0, ',', '.') }}</strong>
        </div>
        <div class="payment-box">
            <span class="payment-label">Kembalian</span>
            <strong>Rp {{ number_format($penjualan->kembalian ?? 0, 0, ',', '.') }}</strong>
        </div>
        @endif

        <!-- FOOTER -->
        <div class="footer">
            <strong>Terima Kasih</strong>
            Atas kunjungan dan kepercayaan Anda.
            <div class="footer-brand">MITRAMART • POINT OF SALE</div>
        </div>

    </div>
</div>

<!-- BUTTON -->
<div class="btn-area">
    <button class="btn-print" onclick="window.print()">
        <svg class="print-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="6 9 6 2 18 2 18 9"></polyline>
            <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
            <rect x="6" y="14" width="12" height="8"></rect>
        </svg>
        Cetak Struk
    </button>
</div>

</body>
</html>
