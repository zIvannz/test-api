<?php

namespace App\Repositories;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function index()
    {
        return $this->model->query();
    }

    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $model = $this->model->findOrFail($id);
        $model->update($data);
        return $model;
    }

    public function delete($id)
    {
        $user = $this->model->findOrFail($id);
        return $user->delete();
    }
}
