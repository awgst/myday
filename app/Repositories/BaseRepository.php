<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function fetch($with=null, int $paginate=null)
    {
        $model = $this->model;
        
        if ($with) {
            $model = $model->with($with);
        }

        if ($paginate) {
            return $model->paginate($paginate);
        } else {
            return $model->get();
        }
    }

    public function find($id, $with=null)
    {
        $model = $this->model;
        
        if ($with) {
            $model = $model->with($with);
        }

        return $model->find($id);
    }

    public function findOrFail($id, $with=null)
    {
        $model = $this->model;
        
        if ($with) {
            $model = $model->with($with);
        }

        return $model->findOrFail($id);
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        return $this->find($id)->update($data);
    }

    public function destroy($id)
    {
        return $this->find($id)->delete();
    }

    public function model($model=null)
    {
        if ($model) {
            $this->model = $model;
            return $this;
        } else {
            return $this->model;
        }
    }
}