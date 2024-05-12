@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(Auth::user()->role === 'Admin')
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <a href="{{ route('claims.index') }}" style="text-decoration: none;">
                                <div class="card text-white bg-info">
                                    <div class="card-body">
                                        <h5 class="card-title">Open Claims</h5>
                                        <p class="card-text">{{ $notClosedClaims }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 mb-4">
                            <a href="{{ route('customer.viewAll') }}" style="text-decoration: none;">
                                <div class="card text-white bg-info">
                                    <div class="card-body">
                                        <h5 class="card-title">Number of Customers</h5>
                                        <p class="card-text">{{ $numberOfCustomers }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 mb-4">
                            <a href="{{ route('agent.viewAll') }}" style="text-decoration: none;">
                                <div class="card text-white bg-info">
                                    <div class="card-body">
                                        <h5 class="card-title">Number of Agents</h5>
                                        <p class="card-text">{{ $numberOfAgents }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 mb-4">
                            <a href="{{ route('policies.index') }}" style="text-decoration: none;">
                                <div class="card text-white bg-info">
                                    <div class="card-body">
                                        <h5 class="card-title">Company Earnings</h5>
                                        <p class="card-text">{{ round($companyEarnings, 2) }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 mb-4">
                            <a href="{{ route('policies.index') }}" style="text-decoration: none;">
                                <div class="card text-white bg-info">
                                    <div class="card-body">
                                        <h5 class="card-title">Number of Active Policies</h5>
                                        <p class="card-text">{{ $numberOfActivePolicies }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endif



                    @if(Auth::user()->role === 'Agent')
                    <!-- Agent Metrics -->
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <a href="{{ route('customer.viewAll') }}" style="text-decoration: none;">
                                <div class="card text-white bg-info">
                                    <div class="card-body">
                                        <h5 class="card-title">Your Customers</h5>
                                        <p class="card-text">{{ $yourCustomers }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 mb-4">
                            <a href="{{ route('claims.index') }}" style="text-decoration: none;">
                                <div class="card text-white bg-info">
                                    <div class="card-body">
                                        <h5 class="card-title">Your Open Claims</h5>
                                        <p class="card-text">{{ $yourOpenClaims }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 mb-4">
                            <a href="{{ route('policies.index') }}" style="text-decoration: none;">
                                <div class="card text-white bg-info">
                                    <div class="card-body">
                                        <h5 class="card-title">Your Active Policies</h5>
                                        <p class="card-text">{{ $yourActivePolicies }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endif @if(Auth::user()->role === 'Customer')
                    <!-- Customer Metrics -->
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <a href="{{ route('policies.index') }}" style="text-decoration: none;">
                                <div class="card text-white bg-info">
                                    <div class="card-body">
                                        <h5 class="card-title">Your Active Policies</h5>
                                        <p class="card-text">{{ $yourActivePolicies }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 mb-4">
                            <a href="{{ route('claims.index') }}" style="text-decoration: none;">
                                <div class="card text-white bg-info">
                                    <div class="card-body">
                                        <h5 class="card-title">Your Open Claims</h5>
                                        <p class="card-text">{{ $yourOpenClaims }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection