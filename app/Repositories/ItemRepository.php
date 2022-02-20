<?php

namespace App\Repositories;

use App\Models\Item;

class ItemRepository extends BaseRepository
{
    public function __construct(Item $item)
    {
        parent::__construct($item);
    }
}