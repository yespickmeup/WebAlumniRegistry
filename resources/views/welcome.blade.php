




@if (Auth::guest())
@include('auth.login');
@else
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
             @include('timeline')
        </div>
    </div>
</div>
@endsection
@endif
