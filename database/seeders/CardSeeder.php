<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = Item::all();
        foreach ($items as $item) {
            for ($i=1; $i <= 5; $i++) { 
                $item->cards()->create([
                    'name' => 'Test Card '.$i,
                    'position' => $i
                ]);
            }
        }
    }
}
