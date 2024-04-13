<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrow;

class BookController extends Controller
{
    /**
     * list all books
     */
    function listAllBooks(Request $request) : View {

        return view('dashboard.all-books', [
            'books' => Course::get()->unique(),
        ]);
    }

    /**
     * list all books borrowed by the user
     */
    function listUserBooks(Request $request) : View {
        //TODO: get user books not all
        return view('dashboard.user-books', [
            'books' => Course::get()->unique(),
        ]);
    }

    /**
     * create a new borrow record for the book
     */
    function borrow(Request $request) : View {
        $borrow = Auth::user()->books()->attach($request->book_id);
        $response = Http::post('http://laravel-finance.test/invoice/create',[
            'book_id' => $borow->id,
            'amount' => $borow->fee,
        ]);
        return view('dashboard.user-books', [
            'books' => Course::get()->unique(),
        ]);
    }

    /**
     * remove a borrow record for a book
     */
    function return(Request $request) : View {

        return view('dashboard.all-books', [
            'books' => Course::get()->unique(),
        ]);
    }

    /**
     * register a new book
     */
    function add(Request $request) : View {
        return view('dashboard.add-books');
    }

    /**
     * Store new book.
     */
    public function store(Request $request): View
    {
        Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'fee' => $request->fee,
            'paid' => false,
        ]);
        return view('dashboard.all-books', [
            'books' => Books::get()->unique(),
        ]);
    }

}
