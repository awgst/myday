<?php

namespace App\Repositories\Interfaces;

interface WithOrdering
{
    public function ordering(array $data, string $table);
}