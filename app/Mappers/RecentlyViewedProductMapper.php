<?php

namespace App\Mappers;

use App\Contracts\MapperContract;
use App\DataTransferObjects\ProductDTO;
use App\DataTransferObjects\RecentlyViewedProductDTO;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class RecentlyViewedProductMapper implements MapperContract
{

    public static function mapOne(array $item): RecentlyViewedProductDTO
    {
        $productDTO = (new ProductDTO())
            ->setId(Arr::get($item, 'product.id', ''))
            ->setName(Arr::get($item, 'product.name', ''))
            ->setDescription(Arr::get($item, 'product.description', ''));

        return (new RecentlyViewedProductDTO())
            ->setId(Arr::get($item, 'id', ''))
            ->setUserId(Arr::get($item, 'user_id', ''))
            ->setProduct($productDTO)
            ->setViewedAt(Arr::get($item, 'viewed_at', ''));
    }

    public static function map(array $data): Collection
    {
        $mappedData = [];
        foreach ($data as $item) {
            $mappedData[] = self::mapOne($item);
        }

        return collect($mappedData);
    }
}
