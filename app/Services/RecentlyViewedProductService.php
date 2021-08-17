<?php

namespace App\Services;

use App\Contracts\ProductRepositoryContract;
use App\Contracts\RecentlyViewedProductRepositoryContract;
use App\DataTransferObjects\ProductDTO;
use App\Events\RecentlyViewedProductSavedEvent;
use Illuminate\Support\Collection;

class RecentlyViewedProductService
{

    private $recentlyViewedProductRepository;
    private $productRepository;

    public function __construct(
        RecentlyViewedProductRepositoryContract $recentlyViewedProductRepository,
        ProductRepositoryContract $productRepository
    ) {
        $this->recentlyViewedProductRepository = $recentlyViewedProductRepository;
        $this->productRepository = $productRepository;
    }

    public function getByUserId(int $userId): Collection
    {
        $recentlyViewedProducts = $this->recentlyViewedProductRepository->getByUserId($userId);

        if ($recentlyViewedProducts->isEmpty()) {
            return $this->productRepository->getAll(100);
        }

        return $recentlyViewedProducts;
    }

    public function save(array $data): ProductDTO
    {
        $recentlyViewedProduct = $this->recentlyViewedProductRepository->save($data);        

        event(new RecentlyViewedProductSavedEvent($recentlyViewedProduct));

        return $recentlyViewedProduct->getProduct();
    }

    public function delete($userId, $productId)
    {
        return $this->recentlyViewedProductRepository->deleteByUserIdAndProductId($userId, $productId);
    }
}
