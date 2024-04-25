@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ADD NEW BANK') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('masters.store', ['option' => $option]) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="bank_name" class="col-md-4 col-form-label text-md-right">{{ __('Bank Name') }}</label>
                            <div class="col-md-6">
                                <input id="master_name" type="text" class="form-control @error('master_name') is-invalid @enderror" name="master_name" value="{{ old('master_name') }}" required autocomplete="master_name" autofocus>

                                @error('master_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">{{ __('Add Bank') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
