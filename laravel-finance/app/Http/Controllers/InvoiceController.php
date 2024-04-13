<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\Http;

class InvoiceController extends Controller
{
    /**
     * mark an enrolment as paid.
     */
    public function pay(Request $request): View
    {
        Auth::user()->courses()->detach($request->course_id);
        return view('dashboard.user-courses', [
            'courses' => $request->user()->courses()->get()->unique(),
        ]);
    }

    /**
     * create an invoice record.
     */
    public function createInvoice(Request $request): View
    {
        Invoice::create([
            'enrolment_id' => $request->enrolment_id,
            'amount' => $request->amount,
            'paid' => false,
        ]);
    }

    /**
     * Display all owned invoices for the user.
     */
    public function listOwned(Request $request): View
    {
        return view('user-invoices', [
            'invoices' => Invoice::findAll(Http::post('http://laravel-student.test/enrolments/list/1')),
        ]);
    }

    /**
     * create all Invoices based on all existing enrolments on student app.
     */
    public function migrate(Request $request): mixed
    {
        $enrolments = Http::get('http://laravel-student.test/enrolments/list');
        echo $enrolments;
        return back();
    }

    /**
     * create an invoice record SOAP version.
     */
    // public function createInvoiceSOAP(Request $request): View
    // {
    //     Auth::user()->courses()->detach($request->course_id);
    //     return view('dashboard.user-courses', [
    //         'courses' => $request->user()->courses()->get()->unique(),
    //     ]);
    // }
}
