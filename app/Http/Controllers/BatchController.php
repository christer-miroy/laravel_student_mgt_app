<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():  View
    {
        $batches = Batch::all();
        return view('batches.index')->with('batches', $batches);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():  View
    {
        // return view('batches.create');
        $courses = Course::pluck('name','id');
        return view('batches.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // $input = $request->all();
        // Batch::create($input);
        // return redirect('batches')->with('flash_message', 'Batch Added!');
        $request->validate([
            'name' => 'required',
            'course_id' => 'required|exists:courses,id',
            'start_date' => 'required|date|after_or_equal:' . date('Y-m-d'),
        ]);

        // Check for duplicate batch
        $existingBatch = Batch::where([
            'name' => $request->input('name'),
            'course_id' => $request->input('course_id'),
        ])->first();

        if ($existingBatch) {
            return redirect('batches/create')
                ->withInput($request->input())
                ->withErrors(['duplicate' => 'Duplicate batch exists.']);
        }

        $input = $request->all();
        Batch::create($input);
        return redirect('batches')->with('flash_message', 'Batch Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $batch = Batch::find($id);
        return view('batches.show')->with('batches', $batch);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $batch = Batch::find($id);
        $courses = Course::pluck('name','id');
        return view('batches.edit', compact('courses'))->with('batches', $batch);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        // $batch = Batch::find($id);
        // $input = $request->all();
        // $batch->update($input);
        // return redirect('batches')->with('flash_message', 'Batch Updated!'); 

        $request->validate([
            'name' => 'required',
            'course_id' => 'required|exists:courses,id',
            'start_date' => 'required|date|after_or_equal:' . date('Y-m-d'),
        ]);

        // Check for duplicate batch excluding the current batch being updated
        $existingBatch = Batch::where([
            'name' => $request->input('name'),
            'course_id' => $request->input('course_id'),
        ])->where('id', '<>', $id)->first();

        if ($existingBatch) {
            return redirect("batches/{$id}/edit")
                ->withInput($request->input())
                ->withErrors(['duplicate' => 'Duplicate batch exists.']);
        }

        $batch = Batch::find($id);
        $input = $request->all();
        $batch->update($input);

        return redirect('batches')->with('flash_message', 'Batch Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        Batch::destroy($id);
        return redirect('batches')->with('flash_message', 'Batch deleted!'); 
    }
}
