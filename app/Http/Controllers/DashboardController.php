<?php

namespace App\Http\Controllers;

use App\Services\LaporanPenjualanService;
use App\Services\MonitoringStokService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Produk;
use App\Models\Penjualan;

class DashboardController extends Controller
{
    public function __construct(
        protected LaporanPenjualanService $laporanService,
        protected MonitoringStokService $stokService
    ) {}

    public function index()
    {
        $ringkasan = $this->laporanService->ringkasanHariIni();

        // Data Penjualan 7 Hari Terakhir
        $label7Hari = [];
        $data7Hari = [];

        for ($i = 6; $i >= 0; $i--) {

            $tanggal = Carbon::today()->subDays($i);

            $label7Hari[] = $tanggal->translatedFormat('d M');

            $total = DB::table('penjualan')
                ->whereDate('created_at', $tanggal)
                ->sum('total_pembayaran');

            $data7Hari[] = $total;

            $stokRendah = Produk::where('stok', '<=', 5)
                ->where('stok', '>', 0)
                ->get();

            $stokHabis = Produk::where('stok', 0)->get();

            $transaksiOpen = Penjualan::where('status', 'OPEN')->count();

            $totalNotif =
                $stokRendah->count()
                + $stokHabis->count()
                + $transaksiOpen;
        }

        return view('dashboard', [

            'tanggalHariIni'   => Carbon::now(),
            'ringkasan'        => (object) $ringkasan,
            'produkTerlaris'   => $this->laporanService->produkTerlarisHariIni(),
            'produkStokRendah' => $this->stokService->produkStokRendah(),
            'produkStokHabis'  => $this->stokService->produkStokHabis(),

            'label7Hari'       => $label7Hari,
            'data7Hari'        => $data7Hari,

            // Notifikasi
            'stokRendah'       => $stokRendah,
            'stokHabis'        => $stokHabis,
            'transaksiOpen'    => $transaksiOpen,
            'totalNotif'       => $totalNotif,

        ]);
    }
}