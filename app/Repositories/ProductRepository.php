<?php

namespace App\Repositories;

use App\Models\Product;
use App\Contracts\ProductRepositoryContract;
use App\Mappers\ProductMapper;
use Illuminate\Support\Collection;

class ProductRepository implements ProductRepositoryContract
{

    public function getAll(int $limit): Collection
    {
        $products = Product::orderBy('id', 'DESC')->limit($limit)->get();
        
        return ProductMapper::map($products->toArray());
    }
}
