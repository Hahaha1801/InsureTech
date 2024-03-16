@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <!-- Sidebar -->
            <div class="list-group">
                <a href="{{ route('agent.home') }}" class="list-group-item">Agents</a>
                <a href="{{ route('customer.home') }}" class="list-group-item">Customers</a>
                {{-- <a href="{{ route('policies.index') }}" class="list-group-item">Policies</a> --}}
                <a href="{{ route('home') }}" class="list-group-item">Home</a>
            </div>
        </div>
        <div class="col-md-9">
            <!-- Main Content -->
            <h1>Welcome {{ Auth::user()->name }} | {{ Auth::user()->role }}</h1>
            <!-- Add your main content here -->
        </div>
    </div>
</div>

@endsection
