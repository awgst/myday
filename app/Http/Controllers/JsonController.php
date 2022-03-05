<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JsonController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->all()['term'];
        $all = DB::table('users')
                    ->rightJoin('items', 'items.user_id', 'users.id')
                    ->rightJoin('cards', 'cards.item_id', 'items.id')
                    ->where(function ($query) use($search){
                        return $query->where('items.name', 'ilike', '%'.$search.'%')
                                    ->orWhere('cards.name', 'ilike', '%'.$search.'%');
                    })
                    ->select([
                        DB::raw('array_to_json(array_agg(cards.name)) as card'),
                        'items.name as item',
                        'items.id'
                    ])
                    ->groupBy('items.id')
                    ->get();
        $all = $all->map(function($item){
            $item->card = json_decode($item->card);
            return $item;
        });
        $response = [];
        foreach ($all as $value) {
            foreach ($value->card as $card) {
                if ($card) {
                    $response[] = ['id'=>$value->id, 'value'=>$card, 'category'=>$value->item];
                }
            }
        }
        return response()->json($response);
    }
}
