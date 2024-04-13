<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    /**
     * create an invoice on the finance app microservice.
     */
    public function createInvoice(Book $book): Void
    {
        $response = Http::post('http://laravel-finance.test/invoice/create',[
            'book_id' => $book->id,
            'amount' => $book->fee,
        ]);
    }
}
