<?php

namespace App\Http\Controllers;

use App\Http\Requests\Item\StoreRequest;
use App\Repositories\BaseRepository;
use App\Repositories\ItemRepository;
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
        return view('component.item', $request->data());
    }
}
