@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">Tambah {{ $title }}</h4>
    <a href="{{ route('mata_pelajaran.index') }}" class="btn btn-danger btn-icon-split">
        <span class="text"><i class="bi bi-arrow-left-short"></i> Kembali</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('mata_pelajaran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nama_mata_pelajaran" class="form-label">Mata Pelajaran</label>
                <input type="text" class="form-control @error('nama_mata_pelajaran') is-invalid @enderror" id="nama_mata_pelajaran" name="nama_mata_pelajaran" maxlength="100" value="{{ old('nama_mata_pelajaran') }}" required>
                @error('nama_mata_pelajaran')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Kelompok (Group) Input Field -->
            <div class="mb-3">
                <label for="kelompok" class="form-label">Kelompok</label>
                <select class="form-select @error('kelompok') is-invalid @enderror" id="kelompok" name="kelompok" required>
                    <option value="">Pilih Kelompok</option>
                    <option value="A" {{ old('kelompok') == 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ old('kelompok') == 'B' ? 'selected' : '' }}>B</option>
                    <option value="C" {{ old('kelompok') == 'C' ? 'selected' : '' }}>C</option>
                </select>
                @error('kelompok')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection
