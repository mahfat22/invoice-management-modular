<?php

declare(strict_types=1);

/**
 * Intelephense-only stubs for dynamic macros.
 *
 * This file is not autoloaded by Composer. It's only here to make the IDE aware
 * of methods added at runtime via `Response::macro(...)`.
 */

namespace Illuminate\Contracts\Routing {
    use Illuminate\Http\JsonResponse;

    if (false) {
        interface ResponseFactory
        {
            public function success(
                mixed $data = null,
                ?string $message = null,
                int $status = 200,
                array $meta = []
            ): JsonResponse;
        }
    }
}

