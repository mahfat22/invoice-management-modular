<?php

namespace Modules\Customers\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Customers\Services\CustomerService;

class CustomersController extends Controller
{
    public function __construct(
        protected CustomerService $customerService
    ) {}

    public function select()
    {
        return response()->success(
            data: $this->customerService->getCustomersForSelect()
        );
    }
}
