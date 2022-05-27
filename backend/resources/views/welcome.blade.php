@extends('layouts.app')
@section('welcome')
    @auth
        <h2>Home Page</h2>
        <h5>Welcome: <b>{{ Auth::user()->name }}</b></h5>
        <a class="btn btn-primary" href="{{ route('password') }}">Change Password</a>
        <a class="btn btn-danger" href="{{ route('logout') }}">Logout</a>
    @endauth

    @guest
        <h2>Hello guest</h2>
        <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
        <a class="btn btn-info" href="{{ route('register') }}">Register</a>
    @endguest
@endsection
