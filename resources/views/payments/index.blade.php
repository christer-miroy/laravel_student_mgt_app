@extends('layout')
@section('content')
<div class="card">
    <div class="card-header">
        <h2>Payments</h2>
    </div>
    <div class="card-body">
        <a href="{{ url('/payments/create') }}" class="btn btn-success btn-sm" title="Add New Payment">
            <i class="fa fa-plus" aria-hidden="true"></i> Add New
        </a>
        <br/>
        <br/>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Payment Date</th>
                        <th>Amount</th>
                        <th>Enrollment ID</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->payment_date }}</td>
                                <td>PHP {{ number_format($item->amount, 2, '.', ',') }}</td>
                                <td>
                                    @if ($item->enrollment)
                                        {{ $item->enrollment->enroll_no }}
                                    @else
                                        No enrollments
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ url('/payments/' . $item->id) }}" title="View Payment"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                    
                                    {{-- <a href="{{ url('/payments/' . $item->id . '/edit') }}" title="Edit Payment"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> --}}

                                    <form method="POST" action="{{ url('/payments' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Payment" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                    </form>
                                    <a href="{{ url('report/report1/' . $item->id) }}" title="Print Receipt">
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fa fa-print" aria-hidden="true"></i> See Receipt
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection