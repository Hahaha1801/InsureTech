@extends('layouts.app')

@section('content')
<div class="container">
<h1>Welcome {{ Auth::user()->name }} | {{ Auth::user()->role }}</h1>
</div>
@endsection