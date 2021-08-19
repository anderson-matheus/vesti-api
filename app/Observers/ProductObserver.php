<?php

namespace App\Observers;

use App\Models\Product;
use App\Repositories\HistoryRepository;
use Illuminate\Support\Facades\Auth;

class ProductObserver
{
    private $historyRepository;

    public function __construct()
    {
        $this->historyRepository = new HistoryRepository();
    }

    public function created(Product $product)
    {
        $this->historyRepository->store(
            [
                'entity' => 'products',
                'action' => 'CREATED',
                'user_id' => Auth::user()->id,
                'data' => $product,
            ]
        );
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        //
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
}
