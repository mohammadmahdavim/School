<?php

namespace App\Http\Controllers\student;

use Shetabit\Payment\Facade\Payment;
use Shetabit\Payment\Invoice;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TuitionController extends Controller
{
    public function index()
    {
        $iduser = auth()->user()->id;
        if (auth()->user()->role == 'اولیا') {
            $iduser = auth()->user()->id - 1000;
        }
        $data = User::where('id', $iduser)->with('student_class.tuition.student_pay_tuition')->first();

        return view('student.tuition.index', compact('data','iduser'));
    }

    public function store(Request $request){
# create new invoice
        $invoice = new Invoice();

# set invoice amount
        $invoice->amount(100);

        # purchase the given invoice
        Payment::purchase($invoice,function($driver, $transactionId) {
            // we can store $transactionId in database
        });

# purchase method accepts a callback function
        Payment::purchase($invoice, function($driver, $transactionId) {
            // we can store $transactionId in database
        });
    }
}
