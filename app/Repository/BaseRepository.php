<?php

namespace App\Repository;

interface BaseRepository
{
    public function all();

    public function find($id);

    public function create($request);

    public function update($id, $att, $input);

    public function delete($id);

    public function findByFields($fields, $value, $att, $columns);

    public function paginate($num);

    public function deleteWhere(array $where);
}
