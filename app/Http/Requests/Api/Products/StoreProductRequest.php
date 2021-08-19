<?php

namespace App\Http\Requests\Api\Products;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:3|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'description' => 'required',
            'size' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'quantity' => 'required|integer',
            'images' => 'required|array|max:3',
            'images.*' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ];
    }
}
