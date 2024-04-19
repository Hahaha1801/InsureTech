@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-md-10">
            <a href="{{ route('register', ['role' => 'customer']) }}" class="btn btn-primary">New Customer</a>

        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Customers</div>

                <div class="card-body">
                    <div class="table-responsive">
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