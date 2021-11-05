<?php

namespace App\Repositories\I;

interface IBase
{

    public function makeModel();

    public function paginate($perPage, $columns = ['*']);

    public function allQuery($search = [], $skip = null, $limit = null);

    public function all($search = [], $skip = null, $limit = null, $columns = ['*']);

    public function create($input);

    public function find($id, $columns = ['*']);

    public function update($input, $id);

    public function delete($id);

}
