<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductRepository
{
    private $product;

    public function __construct($product = null)
    {
        $this->product = $product ?? new Product();
    }

    public function store(array $data)
    {
        $product = $this->product;
        $product->name = $data['name'];
        $product->category_id = $data['category_id'];
        $product->price = $data['price'];
        $product->description = $data['description'];
        $product->size = $data['size'];
        $product->quantity = $data['quantity'];
        $product->save();

        $paths = [];
        foreach ($data['images'] as $image) {
            $product->images()->create([
                'product_id' => $product->id,
                'path' => Storage::disk('public')->putFile('products', $image),
            ]);
        }
        $product->load('images');
        $product->refresh();

        return $product;
    }
}
