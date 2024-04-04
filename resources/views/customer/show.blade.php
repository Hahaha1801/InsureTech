@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Personal Details</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">Name:</div>
                        <div class="col-md-8">{{ $customer->name }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Agent Name:</div>
                        <div class="col-md-8">
                            @php
                                $agentName = App\Agent::join('users', 'agents.id', '=', 'users.id')
                                    ->where('agents.id', $customer->agent_id)
                                    ->pluck('users.name')
                                    ->first();
                            @endphp
                            {{ $agentName }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Email:</div>
                        <div class="col-md-8">{{ $customer->email }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Phone Number:</div>
                        <div class="col-md-8">{{ $customer->phone_no }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Address:</div>
                        <div class="col-md-8">{{ $customer->address }}</div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">Policies</div>

                <div class="card-body">
                    @if (count($policies) > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Policy Name</th>
                                    <th>Policy Number</th>
                                    <th>Start Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($policies as $policy)
                                    <tr>
                                        <td>{{ $policy->p_name }}</td>
                                        <td>{{ $policy->p_number }}</td>
                                        <td>{{ $policy->start_date }}</td>
                                        <td>
                                            <a href="{{ route('policies.show', $policy->p_number) }}" class="btn btn-primary">View</a>
                                            <!-- Add more actions if needed -->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No policies found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
