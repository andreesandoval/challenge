<?php

namespace App\Listeners;

use App\Contracts\RecentlyViewedProductRepositoryContract;
use App\Events\RecentlyViewedProductSavedEvent;

class CleanRecentlyViewedProductsListener
{
    private $recentlyViewedProductRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(RecentlyViewedProductRepositoryContract $recentlyViewedProductRepository)
    {
        $this->recentlyViewedProductRepository = $recentlyViewedProductRepository;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ExampleEvent  $event
     * @return void
     */
    public function handle(RecentlyViewedProductSavedEvent $event)
    {
        $userId = $event->recentlyViewedProductDTO->getUserId();
        $products = $this->recentlyViewedProductRepository->getByUserId($userId, 101);
        if ($products->count() > 100) {
            $this->recentlyViewedProductRepository->deleteOldByUserId($userId, $products->last()->getId());
        }
    }
}
