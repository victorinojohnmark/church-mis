<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return view('admin.payment.paymentlist', [
            'payments' => Payment::isActive()->latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Payment $payment)
    {
        //
    }

    public function update(Request $request, Payment $payment)
    {
        //
    }

    public function verify(Request $request, Payment $payment)
    {
        $payment->is_verified = true;
        $payment->save();

        session()->flash('success', 'Payment verified successfully.');
        return redirect()->back();
    }
}
