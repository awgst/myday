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

    public function __construct(CardRepository $card)
    {
        $this->card = $card;
    }

    public function store(Request $request)
    {
        try {
            $card = $this->card->store(['item_id'=>$request->item_id]);
        } catch (Exception $e) {
            return panic($e->getMessage());
        }
        
        return view('component.card', ['id'=>$card->id, 'tasks'=>null]);
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $card = $this->card->update($id, $request->data());
        } catch (Exception $e) {
            return panic($e->getMessage());
        }

        return response()->json(['card'=>$card], 200);
    }

    public function destroy($id)
    {
        try {
            $card = $this->card->destroy($id);
        } catch (Exception $e) {
            return panic($e->getMessage());
        }

        return response()->json(['card'=>$card], 200);
    }

    public function ordering(Request $request)
    {
        try {
            $this->card->ordering($request->all()['data'], 'cards');
        } catch (Exception $e) {
            return panic($e->getMessage());
        }

        return response()->json(['message'=>'Success'], 200);
    }
}
