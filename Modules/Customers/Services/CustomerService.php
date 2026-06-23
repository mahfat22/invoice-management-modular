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
}
