<?php

namespace App\Repositories;

use App\Models\RecentlyViewedProduct;
use App\Contracts\RecentlyViewedProductRepositoryContract;
use App\DataTransferObjects\ProductDTO;
use App\DataTransferObjects\RecentlyViewedProductDTO;
use App\Mappers\RecentlyViewedProductMapper;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Date;

class RecentlyViewedProductRepository implements RecentlyViewedProductRepositoryContract
{

    public function getByUserId(int $userId, $limit = 100): Collection
    {
        $recentlyViewedProducts = RecentlyViewedProduct::whereUserId($userId)
            ->with('product')
            ->orderBy('viewed_at', 'DESC')
            ->limit($limit)
            ->get();

        return RecentlyViewedProductMapper::map($recentlyViewedProducts->toArray());
    }

    public function save(array $data): RecentlyViewedProductDTO
    {
        $userId = Arr::get($data, 'user_id');
        $productId = Arr::get($data, 'product_id');
        $viewedAt = Date::now();

        $recentlyViewedProduct = RecentlyViewedProduct::firstOrNew([
            'user_id' => $userId,
            'product_id' => $productId
        ]);
        $recentlyViewedProduct->viewed_at = $viewedAt;
        $recentlyViewedProduct->save();

        $productDTO = (new ProductDTO())
            ->setId($recentlyViewedProduct->product->id)
            ->setName($recentlyViewedProduct->product->name)
            ->setDescription($recentlyViewedProduct->product->description);

        return (new RecentlyViewedProductDTO())
            ->setId($recentlyViewedProduct->id)
            ->setUserId($userId)
            ->setProduct($productDTO)
            ->setViewedAt($viewedAt);
    }

    public function deleteByUserIdAndProductId(int $userId, int $productId)
    {
        RecentlyViewedProduct::whereUserId($userId)->whereProductId($productId)->delete();
    }

    public function deleteOldByUserId(int $userId, string $oldestElementId)
    {
        RecentlyViewedProduct::whereUserId($userId)->where('id', '=<', $oldestElementId)->delete();
    }
}
