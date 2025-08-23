<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\Ruang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('main', function ($view) {
            $idJurusan = Auth::user()->id_jurusan;
            $ruang = Ruang::where('id_Jurusan', $idJurusan)->get();
            $view->with('ruang', $ruang);
            Carbon::setLocale('id');
        });
    }
}
