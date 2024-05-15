@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-md-10">
            <a href="{{ route('register', ['role' => 'agent']) }}" class="btn btn-primary">New Agent</a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Agents</div>

                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone No</th>
                                <th>Current Month Brokerage</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agents as $agent)
                                <tr>
                                    <td>{{ $agent->name }}</td>
                                    <td>{{ $agent->email }}</td>
                                    <td>{{ $agent->phone_no }}</td>
                                    <td>{{ $agent->currentMonthBrokerage }}</td>
                                    <td>
                                        <a href="{{ route('agent.show', $agent->id) }}" class="btn btn-primary">View</a>
                                        <form id="delete-form-{{ $agent->id }}" action="{{ route('agent.destroy', $agent->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $agent->id }})">Delete</button>
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
    function confirmDelete(agentId) {
        if (confirm('Are you sure you want to delete this agent?')) {
            event.preventDefault();
            document.getElementById('delete-form-' + agentId).submit();
        }
    }
</script>
