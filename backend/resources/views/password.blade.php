@extends('layouts.app')

@section('register')
    <div class="container">
        <div class="row">
            @yield('title', $title)
        </div>
    </div>
    <div class="row">
        @if(session('success'))
            <p class="alert alert-success">{{ session('success') }}</p>
        @endif
        @if($errors->all())
            @foreach($errors->all() as $err)
                <p class="alert alert-danger">{{ $err }}</p>
            @endforeach
        @endif
        <div class="col-md-6">
            <form action="{{ route('password.action') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label>Old Password <span class="text-danger">*</span></label>
                    <input class="form-control" type="password" name="old_password" />
                </div>
                <div class="mb-3">
                    <label>New Password <span class="text-danger">*</span></label>
                    <input class="form-control" type="password" name="new_password" />
                </div>
                <div class="mb-3">
                    <label>New Password Confirmation<span class="text-danger">*</span></label>
                    <input class="form-control" type="password" name="new_password_confirmation" />
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary">Change</button>

                </div>
            </form>
        </div>
    </div>
@endsection
