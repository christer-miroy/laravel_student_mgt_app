<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $students = Student::paginate(10);
        return view('students.index')->with('students', $students);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'mobile' => 'required|unique:students,mobile',
            'email' => 'required|unique:students,email',
        ]);

        $input = $request->all();
        Student::create($input);
        return redirect('students')->with('flash_message', 'Student Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $student = Student::find($id);
        return view('students.show')->with('students', $student);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $student = Student::find($id);
        return view('students.edit')->with('students', $student);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'mobile' => 'required|regex:/^\d{4}-\d{3}-\d{4}$/',
            'email' => [
                'required',
                'email',
                Rule::unique('students')->ignore($id),
            ],
        ]);
        
        $student = Student::findOrFail($id);
        
        $student->name = $request->input('name');
        $student->address = $request->input('address');
        $student->mobile = $request->input('mobile');
        $student->email = $request->input('email');
        
        $student->save();
        
        return redirect('students')->with('flash_message', 'Student Updated!');  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        Student::destroy($id);
        return redirect('students')->with('flash_message', 'Student deleted!'); 
    }
}
