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
                        <div class="col-md-8">{{ $agent->name }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Email:</div>
                        <div class="col-md-8">{{ $agent->email }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Phone Number:</div>
                        <div class="col-md-8">{{ $agent->phone_no }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Address:</div>
                        <div class="col-md-8">{{ $agent->address }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Brokerage Rate:</div>
                        <div class="col-md-8">{{ $agent->brokerage_rate }}</div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">Customers</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone No</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->phone_no }}</td>
                                    <td>
                                        <a href="{{ route('customer.show', $customer->id) }}" class="btn btn-primary">View</a>
                                        <form id="delete-form-{{ $customer->id }}" action="{{ route('customer.destroy', $customer->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    
                                        <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $customer->id }})">Delete</button>
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
@endsection
<script>
    function confirmDelete(customerId) {
        if (confirm('Are you sure you want to delete this customer?')) {
            event.preventDefault();
            document.getElementById('delete-form-' + customerId).submit();
        }
    }
</script>
