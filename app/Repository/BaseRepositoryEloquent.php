<?php

namespace App\Repository;

use Illuminate\Container\Container as App;
use App\Repository\BaseRepository;

abstract class BaseRepositoryEloquent implements BaseRepository
{

    protected $model;
    protected $app;

    public function __construct()
    {
        $this->app = app(App::class);
        $this->makeModel();
    }

    public function makeModel()
    {
        $model       = $this->app->make($this->model());
        $this->model = $model;
        return $this->model;
    }

    abstract public function model();

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create($input)
    {
        return $this->model->create($input);
    }

    public function update($id, $input, $att = 'id')
    {
        return $this->model->where($att, $id)->update($input);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function findByFields($fields, $value = null, $columns = ['*'])
    {
        return $this->model->where($fields, $value)->get($columns);
    }
}
