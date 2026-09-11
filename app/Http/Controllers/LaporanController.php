<?php

namespace App\Http\Controllers;

use App\Exports\LaporanPenjualanExport;
use App\Http\Requests\LaporanFilterRequest;
use App\Models\User;
use App\Services\AuditLogger;
use App\Services\LaporanFilterService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function __construct(private readonly LaporanFilterService $laporanService)
    {
    }

    public function index(LaporanFilterRequest $request)
    {
        $data = $this->laporanService->build(Auth::user(), $request->validated());
        $data['kasirList'] = User::with('role')->orderBy('name')->get();

        return view('laporan.index', $data);
    }

    public function exportPdf(LaporanFilterRequest $request)
    {
        $data = $this->laporanService->build(Auth::user(), $request->validated());
        $filename = 'laporan-penjualan-' . now()->format('Ymd-His') . '.pdf';

        app(AuditLogger::class)->record(
            'EXPORT',
            'Laporan',
            'Mengekspor laporan PDF dengan kode referensi ' . $data['verificationCode'] . '.',
            null,
            [],
            ['filters' => $request->validated(), 'verification_code' => $data['verificationCode']]
        );

        return Pdf::loadView('laporan.pdf', $data)
            ->setPaper('a4', 'landscape')
            ->download($filename);
    }

    public function exportExcel(LaporanFilterRequest $request)
    {
        $data = $this->laporanService->build(Auth::user(), $request->validated());
        $filename = 'laporan-penjualan-' . now()->format('Ymd-His') . '.xlsx';

        app(AuditLogger::class)->record(
            'EXPORT',
            'Laporan',
            'Mengekspor laporan Excel dengan kode referensi ' . $data['verificationCode'] . '.',
            null,
            [],
            ['filters' => $request->validated(), 'verification_code' => $data['verificationCode']]
        );

        return Excel::download(new LaporanPenjualanExport($data), $filename);
    }
}
