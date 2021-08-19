<?php

namespace App\Observers;

use App\Models\ProductImage;
use App\Repositories\HistoryRepository;
use Illuminate\Support\Facades\Auth;

class ProductImageObserver
{
    private $historyRepository;

    public function __construct()
    {
        $this->historyRepository = new HistoryRepository();
    }

    public function created(ProductImage $productImage)
    {
        $this->historyRepository->store(
            [
                'entity' => 'product_images',
                'action' => 'CREATED',
                'user_id' => Auth::user()->id,
                'data' => $productImage,
            ]
        );
    }

    /**
     * Handle the ProductImage "updated" event.
     *
     * @param  \App\Models\ProductImage  $productImage
     * @return void
     */
    public function updated(ProductImage $productImage)
    {
        //
    }

    /**
     * Handle the ProductImage "deleted" event.
     *
     * @param  \App\Models\ProductImage  $productImage
     * @return void
     */
    public function deleted(ProductImage $productImage)
    {
        //
    }

    /**
     * Handle the ProductImage "restored" event.
     *
     * @param  \App\Models\ProductImage  $productImage
     * @return void
     */
    public function restored(ProductImage $productImage)
    {
        //
    }

    /**
     * Handle the ProductImage "force deleted" event.
     *
     * @param  \App\Models\ProductImage  $productImage
     * @return void
     */
    public function forceDeleted(ProductImage $productImage)
    {
        //
    }
}
