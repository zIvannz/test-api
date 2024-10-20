<?php

namespace App\Services;

use App\Repositories\Order\OrderRepositoryInterface;

class OrderService extends BaseService
{

    public function __construct(OrderRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


}
