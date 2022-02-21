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
        $items = $this->item->fetch(null, 10);
        return view('component.render.item', ['items' => $items]);
    }

    public function store(StoreRequest $request)
    {
        try {
            $this->item->store(['test'=>'ok']);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
        return view('component.item', $request->data());
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
}
