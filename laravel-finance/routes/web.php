<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\OAuthController;
use App\Http\Controllers\InvoiceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(InvoiceController::class)->group(function () {
    Route::post('/invoice/pay', 'pay')->name('pay');
    Route::get('/invoices/user', 'listOwned')->name('invoice.list.user');
    Route::get('/invoices/migrate', 'migrate')->name('invoice.migrate');
})->middleware('web');


Route::controller(OAuthController::class)->group(function () {
    Route::get('/redirect', 'redirect')->name('redirect');
    Route::get('/callback', 'callback')->name('callback');
});