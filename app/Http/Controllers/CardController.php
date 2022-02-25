<?php

namespace App\Http\Controllers;

use App\Http\Requests\Card\UpdateRequest;
use App\Repositories\CardRepository;
use App\Repositories\ItemRepository;
use Exception;
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

    public function store(Request $request)
    {
        try {
            $card = $this->card->store(['item_id'=>$request->item_id]);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
        
        return view('component.card', ['id'=>$card->id]);
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $card = $this->card->update($id, $request->data());
        } catch (Exception $e) {
            dd($e->getMessage());
        }

        return response()->json(['card'=>$card], 200);
    }
}
