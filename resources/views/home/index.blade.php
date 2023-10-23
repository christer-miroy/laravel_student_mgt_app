@extends('layout')
@section('content')
<div class="card">
    <div class="card-header">
        <h2>Stats</h2>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Students</th>
                        <th class="text-center">Teachers</th>
                        <th class="text-center">Courses</th>
                        <th class="text-center">Batch</th>
                        <th class="text-center">Enrollments</th>
                        <th class="text-center">Unpaid</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td class="text-center">{{ $studentCount }}</td>
                            <td class="text-center">{{ $teacherCount }}</td>
                            <td class="text-center">{{ $courseCount }}</td>
                            <td class="text-center">{{ $batchCount }}</td>
                            <td class="text-center">{{ $enrollmentCount }}</td>
                            <td class="text-center">{{ $unpaidEnrollmentCount }}</td>
                        </tr>  
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection