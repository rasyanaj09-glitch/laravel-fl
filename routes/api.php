<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;

// Route::get('/user', function (Request $request) {
    // return $request->user();
// })->middleware('auth:sanctum');
Route::get('/test',function(){
 return response()->json([
    'massage' => 'api bhsl'
 ]);
});
Route::apiResource('produk',ProdukController::class);

