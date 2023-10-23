<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        // $enrollments = Enrollment::all();
        // return view('enrollments.index')->with('enrollments', $enrollments);

        // Get the selected status from the request, default to 'all'
        $status = $request->input('status', 'all');

        // Fetch enrollments based on the selected status
        $enrollments = ($status == 'all')
            ? Enrollment::all()
            : Enrollment::where('status', $status)->get();

        return view('enrollments.index')->with([
            'enrollments' => $enrollments,
            'selectedStatus' => $status,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        // return view('enrollments.create');
        $batches = Batch::pluck('name','id');
        $students = Student::pluck('name', 'id');
        return view('enrollments.create',compact('batches','students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // $input = $request->all();
        // Enrollment::create($input);
        // return redirect('enrollments')->with('flash_message', 'Enrollment Added!');
        $request->validate([
            'enroll_no' => 'required',
            'batch_id' => 'required|exists:batches,id',
            'student_id' => 'required|exists:students,id',
            'join_date' => 'required|date',
            'fee' => 'required|numeric',
        ]);

        // Check for duplicate enrollment
        $existingEnrollment = Enrollment::where([
            'batch_id' => $request->input('batch_id'),
            'student_id' => $request->input('student_id'),
            'join_date' => $request->input('join_date'),
            'fee' => $request->input('fee'),
        ])->first();

        if ($existingEnrollment) {
            return redirect('enrollments/create')
                ->withInput($request->input())
                ->withErrors(['duplicate' => 'Duplicate enrollment exists.']);
        }

        $input = $request->all();
        Enrollment::create($input);
        return redirect('enrollments')->with('flash_message', 'Enrollment Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $enrollment = Enrollment::find($id);
        return view('enrollments.show')->with('enrollments', $enrollment);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $enrollment = Enrollment::find($id);
        $batches = Batch::pluck('name','id');
        $students = Student::pluck('name', 'id');
        return view('enrollments.edit', compact('batches', 'students'))->with('enrollments', $enrollment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        // $enrollment = Enrollment::find($id);
        // $input = $request->all();
        // $enrollment->update($input);
        // return redirect('enrollments')->with('flash_message', 'Enrollment Updated!'); 
        
        $enrollment = Enrollment::find($id);
        if (!$enrollment) {
            dd("Enrollment not found");
        }

        $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'student_id' => 'required|exists:students,id',
            'join_date' => 'required|date',
            'fee' => 'required|numeric',
        ]);
    
        // Check for duplicate enrollment excluding the current enrollment being updated
        $existingEnrollment = Enrollment::where([
            'batch_id' => $request->input('batch_id'),
            'student_id' => $request->input('student_id'),
            'join_date' => $request->input('join_date'),
            'fee' => $request->input('fee'),
        ])->where('id', '<>', $id)->first();
    
        if ($existingEnrollment) {
            return redirect("enrollments/{$id}/edit")
                ->withInput($request->input())
                ->withErrors(['duplicate' => 'Duplicate enrollment exists.']);
        }
    
        $enrollment = Enrollment::find($id);
        $input = $request->all();
        $enrollment->update($input);

        return redirect('enrollments')->with('flash_message', 'Enrollment Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        Enrollment::destroy($id);
        return redirect('enrollments')->with('flash_message', 'Enrollment deleted!'); 
    }
}
