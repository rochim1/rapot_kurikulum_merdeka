@extends('auth.layout_auth')

@section('content')
        <div class="text-center opacity-75 mb-4">
            <h6 class="opacity-75">LOGIN</h6>
            <small class="opacity-75 fst-italic">Silahkan Login dengan Email dan Password anda</small>
            <hr>
        </div>
        @if (session('error'))
            <div class="alert alert-danger mx-3 mt-3"><i class="bi bi-check2-circle"></i> 
                {{ session('error') }}
        </div>
        @endif
        <form class="mb-4" method="POST" action="{{ route('login') }}" autocomplete="off">
    @csrf
    <!-- Input Email -->
    <div class="mb-3 position-relative">
        <i class="bi bi-person position-absolute top-50 translate-middle-y ms-2 text-muted"></i>
        <input id="email" type="email" 
               class="form-control ps-5 @error('email') is-invalid @enderror" 
               name="email" value="{{ old('email') }}" 
               autocomplete="email"
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
                placeholder="Masukan Password...">
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    
    <!-- Select Tahun Ajaran -->
    <div class="mb-3 position-relative">
        <i class="bi bi-calendar position-absolute top-50 translate-middle-y ms-2 text-muted"></i>
        <select id="id_tahun_ajaran" name="id_tahun_ajaran" 
                class="form-select ps-5 @error('id_tahun_ajaran') is-invalid @enderror">
            <option value="" disabled selected>Pilih Tahun Ajaran...</option>
            @foreach ($tahunAjaran as $item_tahun_ajaran)
                <option value="{{ $item_tahun_ajaran->id_tahun_ajaran }}">{{ $item_tahun_ajaran->tahun_ajaran_awal }}/{{ $item_tahun_ajaran->tahun_ajaran_akhir }} - {{ $item_tahun_ajaran->semester }} @if ($item_tahun_ajaran->is_active)
                    (aktif)
                @endif</option>
            @endforeach
        </select>
        @error('id_tahun_ajaran')
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
                    <a class="btn btn-danger" href="{{ route('password.request') }}">
                        <i class="fa fa-key me-2"></i>Lupa Password
                    </a>
                @endif 
            </div>
        </div>
    </div>
    
</form>

@endsection