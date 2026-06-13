<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('vendor.pagination.flowbite');
        Paginator::defaultSimpleView('vendor.pagination.simple-flowbite');

        view()->composer('*', function ($view) {
            if (auth()->check()) {
                static $cancelledRentals = null;
                static $checked = false;

                if (!$checked) {
                    $cancelledRentals = \App\Models\Rental::where('id_user', auth()->id())
                        ->where('status_rental', 'Dibatalkan')
                        ->where('notifikasi_pembatalan', true)
                        ->get();

                    if ($cancelledRentals->isNotEmpty()) {
                        // Mark as notified in database
                        \App\Models\Rental::whereIn('kode_rental', $cancelledRentals->pluck('kode_rental'))
                            ->update(['notifikasi_pembatalan' => false]);
                    }
                    $checked = true;
                }

                if ($cancelledRentals && $cancelledRentals->isNotEmpty()) {
                    $view->with('cancelledRentals', $cancelledRentals);
                }
            }
        });
    }
}
