<?php

namespace App\Repositories\Common;

use App\Repositories\BaseRepository;
use App\Repositories\RepositoryInterface;

class ServiceRepository extends BaseRepository implements RepositoryInterface
{
    /**
     * @param $customer_id
     * @return mixed
     */
    public function listByCustomerId($customer_id)
    {
        return $this->model->where('customer_id', $customer_id)->get();
    }
}
