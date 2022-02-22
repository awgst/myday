<?php

namespace App\Repositories;

use App\Models\Card;

class CardRepository extends BaseRepository
{
    public function __construct(Card $card)
    {
        parent::__construct($card);
    }
}