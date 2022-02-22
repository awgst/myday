<?php

namespace App\Http\Controllers;

use App\Repositories\CardRepository;
use App\Repositories\ItemRepository;
use Illuminate\Http\Request;

class CardController extends Controller
{
    private $card;
    private $item;

    public function __construct(CardRepository $card, ItemRepository $item)
    {
        $this->card = $card;
        $this->item = $item;
    }
}
