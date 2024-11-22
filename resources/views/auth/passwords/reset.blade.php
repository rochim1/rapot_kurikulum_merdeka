@extends('auth.layout_auth')

@section('content')
    <div class="text-center opacity-75 mb-4">
        <h6 class="opacity-75">PASSWORD BARU</h6>
        <small class="opacity-75 fst-italic">Silahkan input Password yang belum anda gunakan</small>
        <hr>
    </div>
    
    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">
            <div class="mb-3">
                <input id="email" type="hidden" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" placeholder="Masukan Alamat Email...">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" autofocus placeholder="Masukan Password...">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Masukan Confirmasi Password...">
            </div>

        <div class="row text-center">
            <div class="col-md">
                <button type="submit" class="btn btn-primary col-md">
                    {{ __('Reset Password') }}
                </button>
            </div>
            <div class="col-md">
                <a href="{{ url('/login') }}" class="btn btn-danger col-md">
                    Kembali login
                </a>
            </div>
        </div>
    </form>
@endsection