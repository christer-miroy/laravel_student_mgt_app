<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $studentCount = Student::count();
        $teacherCount = Teacher::count();
        $courseCount = Course::count();
        $batchCount = Batch::count();
        $enrollmentCount = Enrollment::count();
        $unpaidEnrollmentCount = Enrollment::where('status', 'unpaid')->count();

        return view('home.index', compact('studentCount', 'teacherCount','courseCount', 'batchCount','enrollmentCount','unpaidEnrollmentCount'));
    }
}
