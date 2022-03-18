<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait WithOrdering
{
    public function ordering(array $data, string $table)
    {
        if (!empty($data)) {
            $conditional = "";
            if (isset($data[0]) || array_key_exists(0, $data)) {
                unset($data[0]);
            }
            foreach ($data as $key => $value) {
                $conditional .= ' when '.$value.' then '.$key; 
            }
            DB::update(DB::raw('UPDATE '.$table.' SET position = (CASE id '.$conditional.' END) WHERE id IN ('.implode(',', $data).')'));
        }
    }
}