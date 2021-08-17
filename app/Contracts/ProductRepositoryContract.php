<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface ProductRepositoryContract
{
    
    public function getAll(int $limit): Collection;

}
