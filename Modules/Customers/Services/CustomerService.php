<?php

namespace Modules\Customers\Services;

use Modules\Customers\Repositories\CustomerRepositoryInterface;

class CustomerService
{
    public function __construct(
        protected CustomerRepositoryInterface $customerRepository
    ) {}

    public function getCustomersForSelect()
    {
        return $this->customerRepository->getForSelect();
    }

    public function create(array $data)
    {
        return $this->customerRepository->create($data);
    }

    public function paginate()
    {
        return $this->customerRepository->paginate(
            perPage: request('per_page', 15),
            search: request('search')
        );
    }
}
