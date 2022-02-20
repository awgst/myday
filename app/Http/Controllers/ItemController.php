<?php

namespace App\Http\Controllers;

use App\Http\Requests\Item\StoreRequest;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    //

    public function store(StoreRequest $request)
    {
        return view('component.item', $request->data());
    }
}
