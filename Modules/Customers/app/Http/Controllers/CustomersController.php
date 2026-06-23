<?php

namespace Modules\Customers\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Customers\Http\Requests\StoreCustomerRequest;
use Modules\Customers\Services\CustomerService;

class CustomersController extends Controller
{
    public function __construct(
        protected CustomerService $customerService
    ) {}

    public function index()
    {
        return response()->success(
            data: $this->customerService->paginate()
        );
    }

    public function store( StoreCustomerRequest $request)
    {
        $customer = $this->customerService->create(
            $request->validated()
        );

        return response()->success(
            message: 'Customer created successfully.',
            data: $customer
        );
    }

    public function select()
    {
        return response()->success(
            data: $this->customerService->getCustomersForSelect()
        );
    }
}
