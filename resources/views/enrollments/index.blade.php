@extends('layout')
@section('content')
<div class="card">
    <div class="card-header">
        <h2>Enrollments</h2>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <form method="GET" action="{{ url('/enrollments') }}" class="form-inline" id="filterForm">
                    <label for="statusFilter" class="mr-2">Filter by Status:</label>
                    <select name="status" id="statusFilter" class="form-control mr-2" onchange="submitForm()">
                        <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Show All</option>
                        <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="unpaid" {{ request('status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                    </select>
                    {{-- <button type="submit" class="btn btn-primary btn-sm mt-2 align-middle">Apply Filter</button> --}}
                </form>
            </div>
            <div class="col-md-6 text-center">
                <a href="{{ url('/enrollments/create') }}" class="btn btn-success btn-sm" title="Add New Enrollment">
                    <i class="fa fa-plus" aria-hidden="true"></i> Add New
                </a>
            </div>
        </div>
        <br/>
        <br/>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Enrollment No</th>
                        <th>Batch</th>
                        <th>Student</th>
                        <th>Join Date</th>
                        <th>Fee</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($enrollments as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->enroll_no }}</td>
                        <td>{{ $item->batch->name }}</td>
                        <td>{{ $item->student->name }}</td>
                        <td>{{ $item->join_date }}</td>
                        <td>PHP {{ number_format($item->fee, 2, '.', ',') }}</td>
                        <td class="{{ $item->status == 'unpaid' ? 'text-danger' : 'text-success' }}"><b class="text-uppercase">{{ $item->status }}</b></td>

                        <td>
                            <a href="{{ url('/enrollments/' . $item->id) }}" title="View Enrollment"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                            <a href="{{ url('/enrollments/' . $item->id . '/edit') }}" title="Edit Enrollment"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                            <form method="POST" action="{{ url('/enrollments' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Enrollment" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

<script>
    function submitForm() {
        document.getElementById("filterForm").submit();
    }
</script>
@endsection