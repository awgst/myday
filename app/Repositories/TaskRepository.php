<?php

namespace App\Repositories;

use App\Models\Task;
use App\Repositories\Interfaces\WithOrdering;
use App\Traits\WithOrdering as TraitsWithOrdering;

class TaskRepository extends BaseRepository implements WithOrdering
{
    use TraitsWithOrdering;
    public function __construct(Task $task)
    {
        parent::__construct($task);
    }
}