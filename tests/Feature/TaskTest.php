<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    private function tasks($count = 1)
    {
        for ($i=1; $i <= $count; $i++) { 
            Task::create(['name'=>'Task '.$i, 'position'=>$i]);
        }

        return Task::all();
    }

    public function testCreateTask()
    {
        $user = $this->user();
        $this->actingAs($user);
        $response = $this->post(route('task.store'), ['name' => 'Task Create', 'card_id' => 1]);
        $response->assertStatus(200);
        $response->assertViewIs('component.task');
    }

    public function testUpdateTask()
    {
        $user = $this->user();
        $this->actingAs($user);
        $task = $this->tasks(1);
        $response = $this->put(route('task.update', $task[0]->id), ['name' => 'Task Update']);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'task'=>[
                'id',
                'card_id',
                'name',
                'position'
            ]
        ]);
    }

    public function testDeleteTask()
    {
        $user = $this->user();
        $this->actingAs($user);
        $task = $this->tasks(1);
        $response = $this->delete(route('task.destroy', $task[0]->id));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'task'=>[]
        ]);
    }
}
