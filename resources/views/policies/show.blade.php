@extends('layouts.app')

@section('content')
<div class="container">
    @if ($hasClaim)
    <div class="row justify-content-center mb-4">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Claim Status') }}</span>
                    @if (Auth::check() && (Auth::user()->role === 'Admin' || Auth::user()->role === 'Agent'))
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="claimStatusDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Change Status
                        </button>
                        <div class="dropdown-menu" aria-labelledby="claimStatusDropdown{{ $policy->p_number }}">
                            <a class="dropdown-item" href="#" data-status="Open" data-claim-p-number="{{ $policy->p_number }}">Open</a>
                            <a class="dropdown-item" href="#" data-status="In Process" data-claim-p-number="{{ $policy->p_number }}">In Process</a>
                            <a class="dropdown-item" href="#" data-status="Closed" data-claim-p-number="{{ $policy->p_number }}">Closed</a>
                        </div>
                        
                    </div>
                    @endif
                </div>

                <div class="card-body">
                    <p>Status: {{ $claimStatus }}</p>
                </div>
            </div>
        </div>
    </div>
@endif

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Policy Details') }}</span>
                
                    @if (Storage::exists('public/pdfs/' . $policy->p_number . '.pdf'))
                    <a href="{{ asset('storage/pdfs/' . $policy->p_number . '.pdf') }}" class="btn btn-primary" target="_blank">View Policy PDF</a>
                @else
                    @if (Auth::check() && Auth::user()->role !== 'Customer')
                        <form action="{{ route('policy.upload.pdf', ['id' => $policy->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="pdf_file">Upload Policy PDF</label>
                                <input type="file" class="form-control-file" id="pdf_file" name="pdf_file" accept="application/pdf">
                            </div>
                            <button type="submit" class="btn btn-primary">Upload PDF</button>
                        </form>
                    @endif
                @endif</div>

                <div class="card-body">
                    
                    
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row">Client Name</th>
                                <td>{{ $policy->c_name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Referred By</th>
                                <td>
                                    @php
                                        $agentName = App\Agent::join('users', 'agents.id', '=', 'users.id')
                                            ->where('agents.id', $policy->refered_by)
                                            ->pluck('users.name')
                                            ->first();
                                    @endphp
                                    {{ $agentName }}
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Group</th>
                                <td>{{ $policy->group }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Address</th>
                                <td>{{ $policy->address }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Mobile Number</th>
                                <td>{{ $policy->mobile_no }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Insurer Name</th>
                                <td>{{ $policy->insurer_name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Policy Type</th>
                                <td>{{ $policy->p_type }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Policy Name</th>
                                <td>{{ $policy->p_name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Policy Number</th>
                                <td>{{ $policy->p_number }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Start Date</th>
                                <td>{{ $policy->start_date }}</td>
                            </tr>
                            <tr>
                                <th scope="row">End Date</th>
                                <td>{{ $policy->end_date }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Sub Insure</th>
                                <td>{{ $policy->sub_ins }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Premium</th>
                                <td>{{ $policy->premium }}</td>
                            </tr>
                            <tr>
                                <th scope="row">T.P Motor</th>
                                <td>{{ $policy->tp_motor }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Basic</th>
                                <td>{{ $policy->basic }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Terr</th>
                                <td>{{ $policy->terr }}</td>
                            </tr>
                            <tr>
                                <th scope="row">EQ</th>
                                <td>{{ $policy->eq }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Other</th>
                                <td>{{ $policy->other }}</td>
                            </tr>
                            <tr>
                                <th scope="row">STFI</th>
                                <td>{{ $policy->stfi }}</td>
                            </tr>
                            <tr>
                                <th scope="row">GST</th>
                                <td>{{ $policy->gst }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Receipt Date</th>
                                <td>{{ $policy->receipt_date }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Total</th>
                                <td>{{ $policy->total }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Remark</th>
                                <td>{{ $policy->remark }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Created At</th>
                                <td>{{ $policy->created_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                    @if (!$hasClaim)
                        <div class="mt-3">
                            <form action="{{ route('claims.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="p_number" value="{{ $policy->p_number }}">
                                <div class="form-group">
                                    <label for="description">Description (Optional)</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Request Claim</button>
                            </form>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
<script>
document.addEventListener('DOMContentLoaded', function() {
    var dropdownItems = document.querySelectorAll('.dropdown-item');
    dropdownItems.forEach(function(item) {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            var newStatus = this.dataset.status;
            var pNumber = this.dataset.claimPNumber;
            console.log('pNumber:', pNumber);

            fetch('{{ route('claim.updateStatus') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    p_number: pNumber, 
                    status: newStatus
                })
            })
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(function(data) {
                if (data.success) {
                    alert('Claim status updated successfully');
                    window.location.reload();
                } else {
                    alert('Failed to update claim status: ' + data.message);
                }
            })
            .catch(function(error) {
                console.error('There was a problem with the fetch operation:', error);
            });
        });
    });
});

</script>