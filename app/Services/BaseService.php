<?php

namespace App\Services;

use App\Repositories\UserRepositoryInterface;

class BaseService
{
    protected $repository;

    public function index()
    {
        return $this->repository->index();
    }

    public function getById($id)
    {
        return $this->repository->getById($id);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
