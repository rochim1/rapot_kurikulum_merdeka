@extends('auth.layout_auth')

@section('content')
    <div class="text-center opacity-75 mb-4">
        <h6 class="opacity-75">KONFIRMASI LUPA PASSWORD</h6>
        <small class="opacity-75 fst-italic">Silahkan input Email anda yang terdaftar</small>
        <hr>
    </div>
    
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Masukan Alamat Email...">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="row text-center">
            <div class="col-md">
                <button type="submit" class="btn btn-primary col-md">
                    Kirim link reset password
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