<?php
namespace App\Repository;

use Illuminate\Container\Container as App;
use App\Repository\BaseRepository;

abstract class BaseRepositoryEloquent implements BaseRepository
{

    protected $model;

    public function __construct()
    {
        $this->app = app(App::class);
        $this->makeModel();
    }

    abstract public function model();

    public function makeModel(){
        $model = $this->app->make($this->model());
        return $this->model = $model;
    }

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

    public function update($id, $att = 'id', $input)
    {
        return $this->model->where($att, $id)->update($input);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}
