<?php

namespace Modules\Customers\Repositories;

use Modules\Customers\Models\Customer;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function getForSelect()
    {
        return Customer::query()
            ->select([
                'id',
                'name',
            ])
            ->orderBy('name')
            ->get();
    }
}
