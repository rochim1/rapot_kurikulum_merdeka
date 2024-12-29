@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">Ekstrakurikuler</h4>
    <div class="d-flex gap-3">
        <a href="{{ route('data-ekstrakulikuler') }}" class="btn btn-secondary btn-icon-split">
            <i class="bi bi-arrow-left-short"></i>
            <span class="text">Kembali</span>
        </a>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header">
        {{ __('Form Tambah data') }}
    </div>

    <div class="card-body">
        <form action="{{ route('store-ekstrakulikuler') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama_ekstrakulikuler" class="form-label">Nama Ekstrakurikuler<span class="text-danger fs-5">*</span></label>
                <input type="text" 
                        class="form-control @error('nama_ekstrakulikuler') is-invalid @enderror" 
                        name="nama_ekstrakulikuler" 
                        value="{{ old('nama_ekstrakulikuler') }}">
                @error('nama_ekstrakulikuler')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">Simpan</button>
                <button type="submit" class="btn btn-primary" name="repeat" value="1"><i class="bi bi-arrow-counterclockwise"></i> Simpan & Buat Ulang</button>
                <a href="{{ route('data-ekstrakulikuler') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
