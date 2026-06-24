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

    public function create(array $data): Customer
    {
        return Customer::create($data);
    }

    public function paginate(
        int $perPage = 15,
        ?string $search = null
    ) {
        return Customer::query()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%") ;
            })
            ->latest()
            ->paginate($perPage);
    }
}
