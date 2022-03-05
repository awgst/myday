<?php

namespace App\Repositories;

use App\Models\Item;
use Illuminate\Support\Facades\DB;

class ItemRepository extends BaseRepository
{
    public function __construct(Item $item)
    {
        parent::__construct($item);
    }

    public function ordering(array $data)
    {
        if (!empty($data)) {
            $conditional = "";
            if (isset($data[0]) || array_key_exists(0, $data)) {
                unset($data[0]);
            }
            foreach ($data as $key => $value) {
                $conditional .= ' when '.$value.' then '.$key; 
            }
            DB::update(DB::raw('UPDATE items SET position = (CASE id '.$conditional.' END) WHERE id IN ('.implode(',', $data).')'));
        }
    }
}