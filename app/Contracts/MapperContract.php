<?php

namespace App\Contracts;

use App\DataTransferObjects\ProductDTO;
use Illuminate\Support\Collection;

interface MapperContract
{
    public static function mapOne(array $item);

    public static function map(array $data): Collection;
}
