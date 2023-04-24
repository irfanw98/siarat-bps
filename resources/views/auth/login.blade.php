@extends('layouts.app')

@section('title')
    SIARAT - Sistem Informasi Arsip Surat
@endsection

@section('content')
<div class="container">
    <div class="row text-center mt-5">
        <div class="col-12 col-md-12">
            <h4 class="mt-3">SISTEM INFORMASI ARSIP SURAT</h4>
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <div class="col-md-5">
            <div class="card p-2">
                <div class="col-12 col-md-12 text-center mt-3">
                    <h2 class="fw-bold">Log in.</h2>
                    <p>Silahkan Masukkan Username & Password</p>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3 justify-content-center">
                            <div class="col-md-10">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" autocomplete="username" placeholder="Username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 justify-content-center">

                            <div class="col-md-10">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" placeholder="Password">

                                @error('password')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 justify-content-center">
                            <div class="col-md-10">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('Log in') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
