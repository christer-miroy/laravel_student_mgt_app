<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $courses = Course::all();
        return view('courses.index')->with('courses', $courses);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        // return view('courses.create');
        $teachers = Teacher::pluck('name','id');
        return view('courses.create', compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'syllabus' => 'required',
            'duration' => 'required',
            'teacher_id' => 'required',
        ]);

        $input = $request->all();
        Course::create($input);
        return redirect('courses')->with(['flash_message'=>'Course Added!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $course = Course::find($id);
        return view('courses.show')->with('courses', $course);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $course = Course::find($id);
        $teachers = Teacher::pluck('name','id');
        return view('courses.edit', compact('teachers'))->with('courses', $course);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'syllabus' => 'required',
            'duration' => 'required',
            'teacher_id' => 'required',
        ]);

        $course = Course::find($id);

        $course->update($request->all());
        return redirect('courses')->with([
            'flash_message' => 'Course Updated!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        Course::destroy($id);
        return redirect('courses')->with(['flash_message'=>'Course deleted!']); 
    }
}
