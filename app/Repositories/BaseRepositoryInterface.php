<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function fetch($with=null, int $paginate, array $orderBy=['id'=>'asc']);
    public function find($id, $with=null);
    public function findOrFail($id, $with=null);
    public function store(array $data);
    public function update($id, array $data);
    public function destroy($id);
    public function model(Model $model=null);
}