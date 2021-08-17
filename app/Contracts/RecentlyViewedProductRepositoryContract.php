<?php

namespace App\Contracts;

use App\DataTransferObjects\RecentlyViewedProductDTO;
use Illuminate\Support\Collection;

interface RecentlyViewedProductRepositoryContract
{

    public function getByUserId(int $userId, $limit = 100): Collection;

    public function save(array $data): RecentlyViewedProductDTO;

    public function deleteByUserIdAndProductId(int $userId, int $productId);

    public function deleteOldByUserId(int $userId, string $oldestElementId);
}
