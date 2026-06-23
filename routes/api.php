<?php

use Illuminate\Support\Facades\Route;
use Modules\Invoices\Http\Controllers\InvoicesController;

Route::prefix('v1')->group(function () {
    Route::apiResource('invoices', InvoicesController::class)
        ->only(['store', 'show']) ;
});
