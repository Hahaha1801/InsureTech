@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Policy Details') }}</div>

                <div class="card-body">
                    @if (Storage::exists('public/pdfs/' . $policy->p_number . '.pdf'))
                    <!-- If PDF exists, display a button to view PDF -->
                    <a href="{{ asset('storage/pdfs/' . $policy->p_number . '.pdf') }}" class="btn btn-primary" target="_blank">View Policy PDF</a>
                @else
                    <!-- If PDF doesn't exist, display a form to upload PDF -->
                    <form action="{{ route('policy.upload.pdf', ['id' => $policy->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="pdf_file">Upload Policy PDF</label>
                            <input type="file" class="form-control-file" id="pdf_file" name="pdf_file" accept="application/pdf">
                        </div>
                        <button type="submit" class="btn btn-primary">Upload PDF</button>
                    </form>
                @endif
                
                

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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
