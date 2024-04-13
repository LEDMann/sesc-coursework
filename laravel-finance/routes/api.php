<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OAuthController;
use App\Http\Controllers\InvoiceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(InvoiceController::class)->group(function () {
    Route::post('/invoice/create', 'createInvoice')->name('createInvoice');
    Route::post('/invoice/soap/create', 'createInvoiceSOAP')->name('createInvoiceSOAP');
});//->middleware('web');