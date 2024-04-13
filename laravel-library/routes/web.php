<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OAuthController;
use App\Http\Controllers\BookController;
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
})->middleware('web');


Route::controller(OAuthController::class)->group(function () {
    Route::get('/redirect', 'redirect')->name('redirect');
    Route::get('/callback', 'callback')->name('callback');
});

Route::controller(BookController::class)->group(function () {
    Route::get('/book/all', 'listAllBooks')->name('book.list.all');
    Route::get('/book/user', 'listUserBooks')->name('book.list.user');
    Route::get('/book/borrow', 'borrow')->name('book.borrow');
    Route::post('/book/return', 'return')->name('book.return');
    Route::post('/book/add', 'add')->name('book.add');
})->middleware(['auth', 'verified']);
