<?php

namespace Tests\Feature;

use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemTest extends TestCase
{
    use RefreshDatabase;

    private function items($count = 1)
    {
        for ($i=1; $i <= $count; $i++) { 
            Item::create([
                'name' => 'Item '.$i,
                'position' => 1
            ]);
        }

        return Item::all();
    }

    public function testListItem()
    {
        $user = $this->user();
        $this->actingAs($user);
        $items = $this->items(5);
        $response = $this->get(route('item.index'));
        $response->assertStatus(200);
        $response->assertViewIs('component.render.item');
    }

    public function testCreateItem()
    {
        $user = $this->user();
        $this->actingAs($user);
        $response = $this->post(route('item.store'), ['name' => 'Item Create']);
        $response->assertStatus(200);
        $response->assertViewIs('component.item');
    }

    public function testUpdateItem()
    {
        $user = $this->user();
        $this->actingAs($user);
        $item = $this->items(1);
        $response = $this->put(route('item.update', $item[0]->id), ['name' => 'Item Update']);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'item'=>[
                'id',
                'name',
                'position'
            ]
        ]);
    }

    public function testDeleteItem()
    {
        $user = $this->user();
        $this->actingAs($user);
        $item = $this->items(1);
        $response = $this->delete(route('item.destroy', $item[0]->id));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'item'=>[]
        ]);
    }
}
