<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;

Route::apiResource('produk', ProdukController::class);
