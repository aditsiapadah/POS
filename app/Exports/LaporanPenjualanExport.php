<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanPenjualanExport implements FromArray, ShouldAutoSize, WithStyles
{
    public function __construct(private readonly array $data)
    {
    }

    public function array(): array
    {
        $rows = [
            ['LAPORAN PENJUALAN MITRAMART POS'],
            ['Periode', $this->data['periode']],
            ['Dibuat', $this->data['generatedAt']->format('d-m-Y H:i:s')],
            ['Kode Referensi', $this->data['verificationCode']],
            ['Total Transaksi', $this->data['totalTransaksi']],
            ['Total Pendapatan', $this->data['totalPendapatan']],
            [],
            ['ID', 'Tanggal', 'Kasir', 'Metode', 'Jumlah Item', 'Total'],
        ];

        foreach ($this->data['penjualan'] as $transaksi) {
            $rows[] = [
                $transaksi->id,
                $transaksi->created_at->format('d-m-Y H:i'),
                optional($transaksi->user)->name ?? '-',
                $transaksi->metode_pembayaran,
                $transaksi->itemPenjualan->sum('kuantitas'),
                $transaksi->total_pembayaran,
            ];
        }

        return $rows;
    }

    public function styles(Worksheet $sheet): array
    {
        $sheet->mergeCells('A1:F1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A8:F8')->getFont()->setBold(true);
        $sheet->getStyle('F9:F' . max(9, $sheet->getHighestRow()))
            ->getNumberFormat()
            ->setFormatCode('"Rp" #,##0');

        return [];
    }
}
