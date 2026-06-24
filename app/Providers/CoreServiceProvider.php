<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Response::macro('success', function (
            mixed $data = null,
            ?string $message = null,
            int $status = 200,
            array $meta = []
        ): JsonResponse {

            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $data,
                'meta' => $meta,
                'errors' => [],
            ], $status);
        });

        Response::macro('error', function (
            string $message,
            int $status = 400,
            array $errors = []
        ): JsonResponse {

            return response()->json([
                'success' => false,
                'message' => $message,
                'data' => null,
                'meta' => [],
                'errors' => $errors,
            ], $status);
        });

        Response::macro('paginated', function (
            LengthAwarePaginator $paginator,
            mixed $data,
            ?string $message = null
        ): JsonResponse {

            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $data,
                'meta' => [
                    'pagination' => [
                        'current_page' => $paginator->currentPage(),
                        'last_page' => $paginator->lastPage(),
                        'per_page' => $paginator->perPage(),
                        'total' => $paginator->total(),
                    ],
                ],
                'errors' => [],
            ]);
        });


        Response::macro('created', function (
            mixed $data = null,
            ?string $message = 'Created successfully'
        ) {

            return response()->success(
                data: $data,
                message: $message,
                status: 201,
            );
        });
    }
}
