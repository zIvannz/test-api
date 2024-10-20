<?php

namespace App\Repositories;

interface BaseRepositoryInterface
{
    public function index();
    public function getById(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}
