<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $payments = Payment::all();
        return view('payments.index')->with('payments', $payments);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $enrollments = Enrollment::pluck('enroll_no','id');
        return view('payments.create', compact('enrollments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // $input = $request->all();
        // Payment::create($input);
        // return redirect('payments')->with('flash_message', 'Payment Added!');
        $request->validate([
            'payment_date' => 'required|date|after_or_equal:' . date('Y-m-d'),
            'amount' => 'required|numeric|min:0.01',
            'enrollment_id' => 'required|exists:enrollments,id',
        ]);

        // Check for duplicate payment
        $existingPayment = Payment::where([
            'payment_date' => $request->input('payment_date'),
            'amount' => $request->input('amount'),
            'enrollment_id' => $request->input('enrollment_id'),
        ])->first();

        if ($existingPayment) {
            return redirect('payments/create')
                ->withInput($request->input())
                ->withErrors(['duplicate' => 'Duplicate payment exists.']);
        }

        // Check if payment amount is within the enrollment amount
        $enrollment = Enrollment::find($request->input('enrollment_id'));

        // if ($enrollment && $request->input('amount') > $enrollment->amount) {
        //     return redirect('payments/create')
        //         ->withInput($request->input())
        //         ->withErrors(['amount' => 'Payment amount should be equal to enrollment amount.']);
        // }

        // Update enrollment status to 'paid'
        $enrollment = Enrollment::find($request->input('enrollment_id'));
        $enrollment->update(['status' => 'paid']);

        $input = $request->all();
        Payment::create($input);
        
        return redirect('payments')->with('flash_message', 'Payment Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $payment = Payment::find($id);
        return view('payments.show')->with('payments', $payment);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $payment = Payment::find($id);
        $enrollments = Enrollment::pluck('enroll_no','id');
        return view('payments.edit', compact('enrollments'))->with('payments', $payment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'payment_date' => 'required|date|after_or_equal:' . date('Y-m-d'),
            'amount' => 'required|numeric|min:0.01',
            'enrollment_id' => 'required|exists:enrollments,id',
        ]);

        // Check for duplicate payment excluding the current payment being updated
        $existingPayment = Payment::where([
            'payment_date' => $request->input('payment_date'),
            'amount' => $request->input('amount'),
            'enrollment_id' => $request->input('enrollment_id'),
        ])->where('id', '<>', $id)->first();

        if ($existingPayment) {
            return redirect("payments/{$id}/edit")
                ->withInput($request->input())
                ->withErrors(['duplicate' => 'Duplicate payment exists.']);
        }

        // Check if payment amount is within the enrollment amount
        // $enrollment = Enrollment::find($request->input('enrollment_id'));

        // if ($enrollment && $request->input('amount') > $enrollment->amount) {
        //     return redirect("payments/{$id}/edit")
        //         ->withInput($request->input())
        //         ->withErrors(['amount' => 'Payment amount cannot be greater than the enrollment amount.']);
        // }

        $payment = Payment::find($id);
        $input = $request->all();
        $payment->update($input);

        return redirect('payments')->with('flash_message', 'Payment Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Payment::destroy($id);
        return redirect('payments')->with('flash_message', 'Payment deleted!'); 
    }
}
