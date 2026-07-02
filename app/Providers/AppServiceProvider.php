<?php

namespace App\Providers;

use App\Core\KTBootstrap;
use App\Models\Permohonan;
use App\Models\SejarahPermohonan;
use App\Models\SejarahTuntutan;
use App\Models\Tuntutan;
use App\Observers\AuditTrailObserver;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Update defaultStringLength
        Builder::defaultStringLength(191);

        Permohonan::observe(AuditTrailObserver::class);
        SejarahPermohonan::observe(AuditTrailObserver::class);
        SejarahTuntutan::observe(AuditTrailObserver::class);
        Tuntutan::observe(AuditTrailObserver::class);

        KTBootstrap::init();
    }
}
