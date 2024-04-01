@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-md-10">
            <a href="{{ route('policies.create') }}" class="btn btn-primary">New Policy</a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Policies') }}</div>

                <div class="card-body">
                    @if (count($policies) > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Group</th>
                                    <th>Policy Name</th>
                                    <th>Policy Number</th>
                                    <th>Start Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($policies as $policy)
                                    <tr>
                                        <td>{{ $policy->c_name }}</td>
                                        <td>{{ $policy->group }}</td>
                                        <td>{{ $policy->p_name }}</td>
                                        <td>{{ $policy->p_number }}</td>
                                        <td>{{ $policy->start_date }}</td>
                                        <td>
                                            <a href="{{ route('policies.show', $policy->p_number) }}" class="btn btn-primary">View</a>
                                            <form id="delete-form-{{ $policy->p_number }}" action="{{ route('policies.destroy', $policy->p_number) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        
                                            <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $policy->p_number}})">Delete</button>
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

<script>
    function confirmDelete(p_number) {
        if (confirm('Are you sure you want to delete this Policy?')) {
            event.preventDefault();
            document.getElementById('delete-form-' + p_number).submit();
        }
    }
</script>