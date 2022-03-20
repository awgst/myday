<?php

namespace Tests\Feature;

use App\Models\Card;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CardTest extends TestCase
{
    use RefreshDatabase;

    private function cards($count = 1)
    {
        $item = Item::create(['name'=>'Item 1', 'position'=>1])->first();
        for ($i=1; $i <= $count; $i++) { 
            $item->cards()->create(['name'=>'Card '.$i, 'position'=>$i]);
        }

        return Card::all();
    }

    public function testListCard()
    {
        $user = $this->user();
        $this->actingAs($user);
        $cards = $this->cards(5);
        $response = $this->get(route('item.show', 1));
        $response->assertStatus(200);
    }

    public function testCreateCard()
    {
        $user = $this->user();
        $this->actingAs($user);
        $response = $this->post(route('card.store'), ['name' => 'Card Create', 'item_id' => 1]);
        $response->assertStatus(200);
        $response->assertViewIs('component.card');
    }

    public function testUpdateCard()
    {
        $user = $this->user();
        $this->actingAs($user);
        $card = $this->cards(1);
        $response = $this->put(route('card.update', $card[0]->id), ['name' => 'Card Update']);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'card'=>[
                'id',
                'item_id',
                'name',
                'position'
            ]
        ]);
    }

    public function testDeleteCard()
    {
        $user = $this->user();
        $this->actingAs($user);
        $card = $this->cards(1);
        $response = $this->delete(route('card.destroy', $card[0]->id));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'card'=>[]
        ]);
    }
}
