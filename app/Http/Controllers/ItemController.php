<?php

namespace App\Http\Controllers;

use App\Http\Requests\Item\StoreRequest;
use App\Http\Requests\Item\UpdateRequest;
use App\Repositories\BaseRepository;
use App\Repositories\ItemRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    private $item;

    public function __construct(ItemRepository $item)
    {
        $this->item = $item;    
    }

    public function index()
    {
        try {
            $itemModel = $this->item->model();
            $items = $itemModel->with([
                                    'cards'=>function($query){
                                        return $query->latest();
                                    },
                                    'cards.tasks'
                                ])->withCount('cards as cards_count')
                                ->where('user_id', Auth::user()->id)
                                ->orderBy('position', 'asc')
                                ->get();
        } catch (Exception $e) {
            return panic($e->getMessage());
        }
        return view('component.render.item', ['items' => $items]);
    }

    public function show($id)
    {
        try {
            $item = $this->item->findOrFail($id, [
                'cards'=>function($query){
                    return $query->latest();
                },
                'cards.tasks'
            ]);
            $cards = view('component.render.cards', ['cards'=>$item->cards])->render();
        } catch (Exception $e) {
            return panic($e->getMessage());
        }
        return view('layouts.content', compact('item', 'cards'));
    }

    public function store(StoreRequest $request)
    {
        try {
            $item = $this->item->store($request->data());
        } catch (Exception $e) {
            return panic($e->getMessage());
        }
        return view('component.item', [
            'id' => $item->id ?? 0,
            'name' => $item->name ?? '',
        ]);
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $item = $this->item->update($id, $request->data());
        } catch (Exception $e) {
            return panic($e->getMessage());
        }

        return response()->json(['item'=>$item], 200);
    }

    public function destroy($id)
    {
        try {
            $item = $this->item->destroy($id);
        } catch (Exception $e) {
            return panic($e->getMessage());
        }

        return response()->json(['item'=>$item], 200);
    }

    public function ordering(Request $request)
    {
        try {
            $this->item->ordering($request->all()['data']);
        } catch (Exception $e) {
            return panic($e->getMessage());
        }

        return response()->json(['message'=>'Success'], 200);
    }
}
