@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">Edit {{ $title }}</h4>
    <a href="{{ route('tahun_ajaran.index') }}" class="btn btn-danger btn-icon-split">
        <span class="text"><i class="bi bi-arrow-left-short"></i> Kembali</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('tahun_ajaran.update', $tahunAjaran->id_tahun_ajaran) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Nama Tahun Ajaran Field -->
            <div class="mb-3">
                <label for="nama_tahun_ajaran" class="form-label">Nama Tahun Ajaran</label>
                <input type="text" class="form-control @error('nama_tahun_ajaran') is-invalid @enderror" id="nama_tahun_ajaran" name="nama_tahun_ajaran" maxlength="50" value="{{ old('nama_tahun_ajaran', $tahunAjaran->nama_tahun_ajaran) }}" required>
                @error('nama_tahun_ajaran')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
