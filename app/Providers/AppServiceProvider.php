<?php

namespace App\Providers;

use App\Services\Payments\AbstractPaymentGateway;
use App\Services\Payments\PaymentGateway1;
use App\Services\Payments\PaymentGateway2;
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
        if (request()->has('merchant_id')) {
            $this->app->bind(AbstractPaymentGateway::class, PaymentGateway1::class);
        } else {
            $this->app->bind(AbstractPaymentGateway::class, PaymentGateway2::class);
        }
    }
}
