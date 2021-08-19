<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CategoryRepository
{
    private $category;

    public function __construct($category = null)
    {
        $this->category = $category ?? new Category();
    }

    public function store(array $data)
    {
        $category = $this->category;
        $category->name = $data['name'];
        $category->slug = Str::slug($data['name'], '-');
        $category->save();
        return $category;
    }
}