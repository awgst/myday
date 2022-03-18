<?php

namespace App\Repositories;

use App\Models\Item;
use App\Repositories\Interfaces\WithOrdering;
use App\Traits\WithOrdering as TraitsWithOrdering;
use Illuminate\Support\Facades\DB;

class ItemRepository extends BaseRepository implements WithOrdering
{
    use TraitsWithOrdering;
    public function __construct(Item $item)
    {
        parent::__construct($item);
    }
}