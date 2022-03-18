<?php

namespace App\Repositories;

use App\Models\Card;
use App\Repositories\Interfaces\WithOrdering;
use App\Traits\WithOrdering as TraitsWithOrdering;

class CardRepository extends BaseRepository implements WithOrdering
{
    use TraitsWithOrdering;
    public function __construct(Card $card)
    {
        parent::__construct($card);
    }
}