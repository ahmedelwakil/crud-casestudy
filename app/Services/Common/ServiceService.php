<?php

namespace App\Services\Common;

use App\Repositories\Common\CustomerRepository;
use App\Repositories\Common\ServiceRepository;
use App\Repositories\RepositoryInterface;
use App\Services\BaseService;
use App\Services\ServiceInterface;

/**
 * @property ServiceRepository $repository
 */
class ServiceService extends BaseService implements ServiceInterface
{
    protected $customerRepository;

    public function __construct(RepositoryInterface $repository, CustomerRepository $customerRepository)
    {
        parent::__construct($repository);
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param int $customer_id
     * @return mixed
     */
    public function listByCustomerId(int $customer_id)
    {
        $customer = $this->customerRepository->find($customer_id);
        return $this->repository->listByCustomerId($customer->id);
    }

    /**
     * @param int $customer_id
     * @param array $data
     * @return mixed
     */
    public function attach(int $customer_id, array $data)
    {
        $customer = $this->customerRepository->find($customer_id);
        return $this->repository->create(array_merge($data, ['customer_id' => $customer->id]));
    }
}
