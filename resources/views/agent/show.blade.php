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
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">Policies</div>

                <div class="card-body">
                    <!-- Add content for policies here -->
                    <!-- For now, it's empty -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
