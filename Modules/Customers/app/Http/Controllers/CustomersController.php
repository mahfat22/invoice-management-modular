<?php

namespace Modules\Customers\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\Modules\Customers\Transformers\CustomerResource;
use Modules\Customers\Http\Requests\StoreCustomerRequest;
use Modules\Customers\Services\CustomerService;

class CustomersController extends Controller
{
    public function __construct(
        protected CustomerService $customerService
    ) {}

    public function index()
    {
        $customers = $this->customerService->paginate() ;
        
        return response()->paginated(
            paginator: $customers,
            data: CustomerResource::collection(
                $customers
            )
        );
    }

    public function store( StoreCustomerRequest $request)
    {
        $customer = $this->customerService->create(
            $request->validated()
        );

        return response()->success(
            message: 'تم إنشاء العميل بنجاح',
            data: new CustomerResource($customer)
        );
    }

    public function select()
    {
        return response()->success(
            data: $this->customerService->getCustomersForSelect()
        );
    }
}
