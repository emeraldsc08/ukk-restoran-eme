@extends('base')
@section('site-content')
    <p>Welcome {{ Session::get('username') }}!!</p>
@endsection