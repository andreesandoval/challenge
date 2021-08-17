<?php

namespace App\Events;

use App\DataTransferObjects\RecentlyViewedProductDTO;

class RecentlyViewedProductSavedEvent extends Event
{
    public $recentlyViewedProductDTO;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(RecentlyViewedProductDTO $recentlyViewedProductDTO)
    {
        $this->recentlyViewedProductDTO = $recentlyViewedProductDTO;
    }
}
