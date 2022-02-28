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
                    if (!in_array($card, array_column($response, 'value'))) {
                        $response[] = ['id'=>$value->id, 'value'=>$card, 'category'=>$value->item];
                    }
                }
            }
        }
        // dd($response);
        // $all = DB::table(
        //                 DB::raw('
        //                     users
        //                     full join items on items.user_id=users.id
        //                     full join cards on cards.item_id=items.id
        //                     full join tasks on tasks.card_id=cards.id
        //                 ')
        //             )
        //             ->where(function ($query) use($search){
        //                 return $query->where('items.name', 'ilike', '%'.$search.'%')
        //                             ->orWhere('cards.name', 'ilike', '%'.$search.'%')
        //                             ->orWhere('tasks.name', 'ilike', '%'.$search.'%');
        //             })
        //             ->select([
        //                 'tasks.name as task',
        //                 'cards.name as card', 
        //                 'items.name as item',
        //                 'items.id'
        //             ])
        //             ->get()
        //             ->toArray();
        // $response = [];
        // foreach ($all as $value) {
        //     if ($value->card) {
        //         if (!in_array('• '.$value->card, array_column($response, 'value'))) {
        //             $response[] = ['id'=>$value->id, 'value'=>'• '.$value->card, 'category'=>'# '.$value->item];
        //         }
        //     }
        //     if ($value->task) {
        //         if (!in_array('- '.$value->task, array_column($response, 'value'))) {
        //             $response[] = ['id'=>$value->id, 'value'=>'- '.$value->task, 'category'=>'# '.$value->card.' in '.$value->item];
        //         }
        //     }
        // }
        return response()->json($response);
    }
}
