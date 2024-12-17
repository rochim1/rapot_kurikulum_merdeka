@extends('auth.layout_auth')

@section('content')
        <div class="text-center opacity-75 mb-4">
            <h6 class="opacity-75">LOGIN</h6>
            <small class="opacity-75 fst-italic">Silahkan Login dengan Email dan Password anda</small>
            <hr>
        </div>
        
        <form class="mb-4" method="POST" action="{{ route('login') }}" autocomplete="off">
    @csrf
    <!-- Input Email -->
    <div class="mb-3 position-relative">
        <i class="bi bi-person position-absolute top-50 translate-middle-y ms-2 text-muted"></i>
        <input id="email" type="email" 
               class="form-control ps-5 @error('email') is-invalid @enderror" 
               name="email" value="{{ old('email') }}" 
               autocomplete="email" autofocus required 
               placeholder="Masukan Alamat Email...">
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>  

    <!-- Input Password -->
    <div class="mb-3 position-relative">
        <i class="bi bi-key position-absolute top-50 translate-middle-y ms-2 text-muted"></i>
        <input id="password" type="password" 
               class="form-control ps-5 @error('password') is-invalid @enderror" 
               name="password" autocomplete="current-password" 
               required placeholder="Masukan Password...">
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <!-- Select Tahun Ajaran -->
    <div class="mb-3 position-relative">
        <i class="bi bi-calendar position-absolute top-50 translate-middle-y ms-2 text-muted"></i>
        <select id="tahun_ajaran" name="tahun_ajaran" 
                class="form-select ps-5 @error('tahun_ajaran') is-invalid @enderror">
            <option value="" disabled selected>Pilih Tahun Ajaran...</option>
            @foreach ($tahunAjaran as $tahun)
                <option value="{{ $tahun->id }}">{{ $tahun->nama_tahun_ajaran }}</option>
            @endforeach
        </select>
        @error('tahun_ajaran')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="mb-3 position-relative">
        <input type="checkbox" class="m-2 mt-3" onclick="pass_eyes()">Show Password
    </div>
    <!-- Tombol Login -->
    <div class="container text-center">
        <div class="row justify-content-around align-items-center">
            <div class="col-md">
                <button type="submit" class="btn btn-primary px-5">
                    <i class="fa fa-sign-in-alt me-2"></i>{{ __('Login') }}
                </button>
            </div>
            <div class="col-md">
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        <i class="fa fa-key me-2"></i>Lupa Password?
                    </a>
                @endif 
            </div>
        </div>
    </div>
    
</form>

@endsection