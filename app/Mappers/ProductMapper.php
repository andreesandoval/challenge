<?php

namespace App\Mappers;

use App\Contracts\MapperContract;
use App\DataTransferObjects\ProductDTO;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class ProductMapper implements MapperContract
{

    public static function mapOne(array $item): ProductDTO
    {
        return (new ProductDTO())
            ->setId(Arr::get($item, 'id', ''))
            ->setName(Arr::get($item, 'name', ''))
            ->setDescription(Arr::get($item, 'description', ''));
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
