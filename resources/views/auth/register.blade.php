@extends('layouts.guest')

@section('content')
<a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
    <img src="../assets/images/logos/logo.svg" alt="">
</a>
<p class="text-center">Buat Akun Anda</p>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
<form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" value="{{old("name")}}">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old("email")}}">
    </div>
    <div class="mb-4">
        <label for="exampleInputPassword1" class="form-label">Kata Sandi</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-4">
        <label for="exampleInputPassword1" class="form-label">Ulangi Kata Sandi</label>
        <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="form-check">
            <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" name="remember" >
            <label class="form-check-label text-dark" for="flexCheckChecked">
                Ingat Akun Ini
            </label>
        </div>
        <a class="text-primary fw-bold" href="./index.html">Lupa Kata Sandi ?</a>
    </div>
    <button type="submit" href="./index.html" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Daftar</button>
    
</form>
@endsection