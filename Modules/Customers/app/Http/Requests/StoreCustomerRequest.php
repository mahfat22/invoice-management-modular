<?php

namespace Modules\Customers\Http\Requests; 
use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric', 'string', 'max:20'],
            'address' => ['nullable', 'string'],
        ];
    }
}
