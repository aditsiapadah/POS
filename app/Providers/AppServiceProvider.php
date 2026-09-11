<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Produk;
use App\Models\Penjualan;
use App\Models\ItemPenjualan;

use App\Policies\DashboardPolicy;
use App\Policies\ProdukPolicy;
use App\Policies\PenjualPolicy;
use App\Policies\ItemPenjualanPolicy;

class AppServiceProvider extends AuthServiceProvider
{
    /**
     * The policy mappings.
     */
    protected $policies = [
        User::class           => DashboardPolicy::class,
        Produk::class         => ProdukPolicy::class,
        Penjualan::class      => PenjualPolicy::class,
        ItemPenjualan::class  => ItemPenjualanPolicy::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Carbon::setLocale('id');

        $this->registerPolicies();

        View::composer('*', function ($view) {

            // Produk stok rendah (1-5)
            $stokRendah = Produk::whereBetween('stok', [1, 5])
                ->orderBy('stok')
                ->latest('updated_at')
                ->take(5)
                ->get();

            // Produk habis
            $stokHabis = Produk::where('stok', 0)
                ->latest('updated_at')
                ->take(5)
                ->get();

            // Jumlah transaksi OPEN
            $transaksiOpen = Penjualan::where('status', 'OPEN')->count();

            // Total badge notifikasi
            $totalNotif =
                $stokRendah->count()
                + $stokHabis->count()
                + ($transaksiOpen > 0 ? 1 : 0);

            $view->with([
                'stokRendah'    => $stokRendah,
                'stokHabis'     => $stokHabis,
                'transaksiOpen' => $transaksiOpen,
                'totalNotif'    => $totalNotif,
            ]);
        });
    }
}