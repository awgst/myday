<?php

namespace App\Http\Requests\Item;

use Illuminate\Http\Request;

class StoreRequest
{
    public function data()
    {
        return [
            'isActive' => false,
            'name' => request()->name ?? 'To Do',
            'count' => 0
        ];
    }
}
