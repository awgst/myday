<?php

namespace App\Http\Requests\Item;

use Illuminate\Http\Request;

class StoreRequest
{
    public function data()
    {
        return [
            'name' => request()->name ?? 'To Do'
        ];
    }
}
