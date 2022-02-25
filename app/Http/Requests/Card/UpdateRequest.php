<?php

namespace App\Http\Requests\Card;

use Carbon\Carbon;
use Illuminate\Http\Request;

class UpdateRequest
{
    public function data()
    {
        $data = request()->all();
        if (isset($data['date'])) {
            $data['date']=Carbon::parse($data['date']);
        }
        
        return $data;
    }
}