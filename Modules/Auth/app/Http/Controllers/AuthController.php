<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Auth\Services\AuthService;
use Modules\Auth\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(
        protected AuthService $authService
    ) {}

    public function login(LoginRequest $request)
    {
        return response()->success(
            data: $this->authService->login(
                $request->validated()
            ),
            message: 'Login successful.'
        );
    }
}
