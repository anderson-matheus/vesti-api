<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Observers\ProductImageObserver;
use App\Observers\ProductObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    public function boot()
    {
        Product::observe(ProductObserver::class);
        ProductImage::observe(ProductImageObserver::class);
    }
}
