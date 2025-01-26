@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-md-0">{{ $title }}</h4>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header">Form Ubah Profil</div>
        <div class="card-body">
            <form action="{{ route('profil_user.update') }}" method="POST" autocomplete="off">
                @csrf
                <div class="form-group">
                    <label class="form-label">Nama<span class="text-danger fs-5">*</span></label><br>
                    <input id="name" type="text" name="name" required class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Email<span class="text-danger fs-5">*</span></label><br>
                    <input id="email" type="email" name="email" required class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Password<span class="text-danger fs-5">*</span></label><br>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Konfirmasi Password<span class="text-danger fs-5">*</span></label><br>
                    <input type="password" class="form-control" name="password_confirmation" autocomplete="new-password" autocomplete="current-password">
                </div>
                <div class="modal-footer mt-4 mb-n3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
