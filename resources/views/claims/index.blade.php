@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Customers</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Policy Number</th>
                                    <th>Status</th>
                                    <th>Customer Name</th>
                                    <th>Customer Contact</th>
                                    <th>Policy Name</th>
                                    <th>Policy Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($claims as $claim)
                                <tr>
                                    <td>{{ $claim->policy->p_number }}</td>
                                    <td>{{ $claim->status }}</td>
                                    <td>{{ $claim->policy->c_name }}</td>
                                    <td>{{ $claim->policy->mobile_no }}</td>
                                    <td>{{ $claim->policy->p_name }}</td>
                                    <td>{{ $claim->policy->p_type }}</td>
                                    <td>
                                        @if (Auth::user()->role === 'Admin' || Auth::user()->role === 'Agent')
                                            <a href="{{ route('policies.show', $claim->policy->p_number) }}" class="btn btn-primary">View</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection