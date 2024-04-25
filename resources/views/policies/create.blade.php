@php
    $dropdownOptions = config('dropdownOptions');
@endphp

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ADD POLICY DETAILS') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('policies.store') }}">
                        @csrf

                        
                        <div class="form-group row">
                            <label for="c_name" class="col-md-4 col-form-label text-md-right">{{ __('Client Name') }}</label>
                            <div class="col-md-6">
                                <input id="c_name" type="text" class="form-control @error('name') is-invalid @enderror" name="c_name" value="{{ old('c_name') }}" required autocomplete="c_name" autofocus>
                                @error('c_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customer_id" class="col-md-4 col-form-label text-md-right">{{ __('Customer ID') }}</label>
                            <div class="col-md-6">
                                <select id="customer_id" name="customer_id" class="form-control" required>
                                    <option value=""></option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->id }} {{ $customer->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mobile_no" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>
                            <div class="col-md-6">
                                <input id="mobile_no" type="text" class="form-control @error('mobile_no') is-invalid @enderror" name="mobile_no" value="{{ old('mobile_no') }}" required autocomplete="mobile_no" autofocus>
                                @error('mobile_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="group" class="col-md-4 col-form-label text-md-right">{{ __('Group') }}</label>
                            <div class="col-md-6">
                                <select id="group" name="group" class="form-control" required>
                                    <option value=""></option>
                                    @if (isset($dropdownOptions['groups']) && !empty($dropdownOptions['groups']))
                                        @foreach ($dropdownOptions['groups'] as $group)
                                            <option value="{{ $group }}">{{ $group }}</option>
                                        @endforeach
                                    @else
                                        <option disabled>No Groups Available</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                                                
                        <div class="form-group row">
                            <label for="insurer_name" class="col-md-4 col-form-label text-md-right">{{ __('Insurer Name') }}</label>
                            <div class="col-md-6">
                                <select id="insurer_name" name="insurer_name" class="form-control" required>
                                    <option value=""></option>
                                    @if (isset($dropdownOptions['insuranceCompanies']) && !empty($dropdownOptions['insuranceCompanies']))
                                        @foreach ($dropdownOptions['insuranceCompanies'] as $company)
                                            <option value="{{ $company }}">{{ $company }}</option>
                                        @endforeach
                                    @else
                                        <option disabled>No Insurer Names Available</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="p_type" class="col-md-4 col-form-label text-md-right">{{ __('Policy Type') }}</label>
                            <div class="col-md-6">
                                <select id="p_type" name="p_type" class="form-control" required>
                                    <option value=""></option>
                                    @if (isset($dropdownOptions['policyTypes']) && !empty($dropdownOptions['policyTypes']))
                                        @foreach ($dropdownOptions['policyTypes'] as $type)
                                            <option value="{{ $type }}">{{ $type }}</option>
                                        @endforeach
                                    @else
                                        <option disabled>No Policy Types Available</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="p_name" class="col-md-4 col-form-label text-md-right">{{ __('Policy Name') }}</label>
                            <div class="col-md-6">
                                <select id="p_name" name="p_name" class="form-control" required>
                                    <option value=""></option>
                                    @if (isset($dropdownOptions['policy']) && !empty($dropdownOptions['policy']))
                                        @foreach ($dropdownOptions['policy'] as $policy)
                                            <option value="{{ $policy }}">{{ $policy }}</option>
                                        @endforeach
                                    @else
                                        <option disabled>No Policies Available</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="p_number" class="col-md-4 col-form-label text-md-right">{{ __('Policy Number') }}</label>
                            <div class="col-md-6">
                                <input id="p_number" type="text" class="form-control @error('p_number') is-invalid @enderror" name="p_number" value="{{ old('p_number') }}" required autocomplete="p_number">
                                @error('p_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="start_date" class="col-md-4 col-form-label text-md-right">{{ __('Start Date') }}</label>
                            <div class="col-md-6">
                                <input id="start_date" type="Date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ old('start_date') }}" required autocomplete="start_date">
                                @error('start_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="end_date" class="col-md-4 col-form-label text-md-right">{{ __('End Date') }}</label>
                            <div class="col-md-6">
                                <input id="end_date" type="Date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{ old('end_date') }}" required autocomplete="end_date">
                                @error('Date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sub_ins" class="col-md-4 col-form-label text-md-right">{{ __('Sub Insure') }}</label>
                            <div class="col-md-6">
                                <input id="sub_ins" type="number" class="form-control @error('sub_ins') is-invalid @enderror" name="sub_ins" value="{{ old('sub_ins') }}" required autocomplete="sub_ins">
                                @error('sub_ins')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="premium" class="col-md-4 col-form-label text-md-right">{{ __('Premium') }}</label>
                            <div class="col-md-6">
                                <input id="premium" type="number" class="form-control @error('premium') is-invalid @enderror" name="premium" value="{{ old('premium') }}" required autocomplete="premium">
                                @error('premium')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tp_motor" class="col-md-4 col-form-label text-md-right">{{ __('T.P Motor') }}</label>
                            <div class="col-md-6">
                                <input id="tp_motor" type="number" class="form-control @error('tp_motor') is-invalid @enderror" name="tp_motor" value="{{ old('tp_motor') }}" required autocomplete="tp_motor">
                                @error('tp_motor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="basic" class="col-md-4 col-form-label text-md-right">{{ __('Basic') }}</label>
                            <div class="col-md-6">
                                <input id="basic" type="number" class="form-control @error('basic') is-invalid @enderror" name="basic" value="{{ old('basic') }}" required autocomplete="basic">
                                @error('basic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="terr" class="col-md-4 col-form-label text-md-right">{{ __('Terr') }}</label>
                            <div class="col-md-6">
                                <input id="terr" type="number" class="form-control @error('terr') is-invalid @enderror" name="terr" value="{{ old('terr') }}" required autocomplete="terr">
                                @error('terr')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="eq" class="col-md-4 col-form-label text-md-right">{{ __('EQ') }}</label>
                            <div class="col-md-6">
                                <input id="eq" type="number" class="form-control @error('eq') is-invalid @enderror" name="eq" value="{{ old('eq') }}" required autocomplete="eq">
                                @error('eq')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="other" class="col-md-4 col-form-label text-md-right">{{ __('Other') }}</label>
                            <div class="col-md-6">
                                <input id="other" type="number" class="form-control @error('other') is-invalid @enderror" name="other" value="{{ old('other') }}" required autocomplete="other">
                                @error('other')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="stfi" class="col-md-4 col-form-label text-md-right">{{ __('STFI') }}</label>
                            <div class="col-md-6">
                                <input id="stfi" type="number" class="form-control @error('stfi') is-invalid @enderror" name="stfi" value="{{ old('stfi') }}" required autocomplete="stfi">
                                @error('stfi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gst" class="col-md-4 col-form-label text-md-right">{{ __('GST') }}</label>
                            <div class="col-md-6">
                                <input id="gst" type="number" class="form-control @error('gst') is-invalid @enderror" name="gst" value="{{ old('gst') }}" required autocomplete="gst">
                                @error('gst')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="receipt_date" class="col-md-4 col-form-label text-md-right">{{ __('Receipt Date') }}</label>
                            <div class="col-md-6">
                                <input id="receipt_date" type="date" class="form-control @error('receipt_date') is-invalid @enderror" name="receipt_date" value="{{ old('receipt_date') }}" required autocomplete="receipt_date">
                                @error('receipt_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total" class="col-md-4 col-form-label text-md-right">{{ __('Total') }}</label>
                            <div class="col-md-6">
                                <input id="total" type="number" class="form-control @error('total') is-invalid @enderror" name="total" value="{{ old('Total') }}" required autocomplete="total">
                                @error('total')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="remark" class="col-md-4 col-form-label text-md-right">{{ __('Remark') }}</label>
                            <div class="col-md-6">
                                <input id="remark" type="text" class="form-control @error('remark') is-invalid @enderror" name="remark" value="{{ old('remark') }}" required autocomplete="remark">
                                @error('remark')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
