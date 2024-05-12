@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ADD POLICY') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('masters.store', ['option' => $option]) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="policy_name" class="col-md-4 col-form-label text-md-right">{{ __('Policy Name') }}</label>
                            <div class="col-md-6">
                                <input id="master_name" type="text" class="form-control @error('master_name') is-invalid @enderror" name="master_name" value="{{ old('master_name') }}" required autocomplete="master_name" autofocus>

                                @error('master_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="policy_brokerage" class="col-md-4 col-form-label text-md-right">{{ __('Policy Brokerage Percent') }}</label>
                            <div class="col-md-6">
                                <input id="policy_brokerage" type="text" class="form-control @error('policy_brokerage') is-invalid @enderror" name="policy_brokerage" value="{{ old('policy_brokerage') }}" required autocomplete="policy_brokerage" autofocus>

                                @error('policy_brokerage')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">{{ __('Add Policy') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
