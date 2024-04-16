@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Customers</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Policy Number</th>
                                <th>Status</th>
                                <th>Customer Name</th>
                                <th>Customer Contact</th>
                                <th>Policy Name</th>
                                <th>Policy Type</th>
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
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


