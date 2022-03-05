<?php

namespace Database\Seeders;

use App\Models\Card;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cards = Card::all();

        foreach ($cards as $card) {
            for ($i=1; $i <= 5; $i++) { 
                $card->tasks()->create([
                    'name' => 'Test Task '.$i
                ]);
            }
        }
    }
}
