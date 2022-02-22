<?php

namespace App\Http\Controllers;

use App\Http\Requests\Item\StoreRequest;
use App\Http\Requests\Item\UpdateRequest;
use App\Repositories\BaseRepository;
use App\Repositories\ItemRepository;
use Exception;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    private $item;

    public function __construct(ItemRepository $item)
    {
        $this->item = $item;    
    }

    public function index()
    {
        $items = $this->item->fetch();
        return view('component.render.item', ['items' => $items]);
    }

    public function show($id)
    {
        $item = $this->item->findOrFail($id);
        $cards = [];
        return view('layouts.content', compact('item', 'cards'));
    }

    public function store(StoreRequest $request)
    {
        try {
            $item = $this->item->store($request->data());
        } catch (Exception $e) {
            dd($e->getMessage());
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
            dd($e->getMessage());
        }

        return response()->json(['item'=>$item], 200);
    }

    public function destroy($id)
    {
        try {
            $item = $this->item->destroy($id);
        } catch (Exception $e) {
            dd($e->getMessage());
        }

        return response()->json(['item'=>$item], 200);
    }
}
