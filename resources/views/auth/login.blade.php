@extends('layouts.guest')

@section('content')
<form method="POST" action="{{ route('login') }}">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    @csrf
    <label>Email</label>
    <div class="mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon" value="{{old("email")}}">
    </div>
    <label>Kata Sandi</label>
    <div class="mb-3">
        <input type="password" name="password" class="form-control" placeholder="Kata Sandi" aria-label="Password" aria-describedby="password-addon">
    </div>
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="rememberMe" name="remember" >
        <label class="form-check-label" for="rememberMe">Ingat Akun Saya</label>
    </div>
    <div class="text-center">
        <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Masuk</button>
    </div>
</form>
@endsection