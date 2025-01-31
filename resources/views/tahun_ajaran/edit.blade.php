@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">{{ $title }}</h4>
    <a href="{{ route('tahun_ajaran.index') }}" class="btn btn-danger btn-icon-split">
        <span class="text"><i class="bi bi-arrow-left-short"></i> Kembali</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('tahun_ajaran.update', $tahunAjaran->id_tahun_ajaran) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Tahun Ajaran Awal Field -->
            <div class="mb-3">
                <label for="tahun_ajaran_awal" class="form-label">Tahun Ajaran Awal<span class="text-danger fs-5">*</span></label>
                <input type="number" class="form-control @error('tahun_ajaran_awal') is-invalid @enderror" id="tahun_ajaran_awal" name="tahun_ajaran_awal" maxlength="50" value="{{ old('tahun_ajaran_awal', $tahunAjaran->tahun_ajaran_awal) }}" required>
                @error('tahun_ajaran_awal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tahun Ajaran Akhir Field -->
            <div class="mb-3">
                <label for="tahun_ajaran_akhir" class="form-label">Tahun Ajaran Akhir<span class="text-danger fs-5">*</span></label>
                <input type="number" class="form-control @error('tahun_ajaran_akhir') is-invalid @enderror" id="tahun_ajaran_akhir" name="tahun_ajaran_akhir" maxlength="50" value="{{ old('tahun_ajaran_akhir', $tahunAjaran->tahun_ajaran_akhir) }}" required>
                @error('tahun_ajaran_akhir')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Semester Field -->
            <div class="mb-3">
                <label for="semester" class="form-label">Semester<span class="text-danger fs-5">*</span></label>
                <select class="form-control @error('semester') is-invalid @enderror" id="semester" name="semester" required>
                    <option value="" disabled>Pilih Semester</option>
                    <option value="Ganjil" {{ old('semester', $tahunAjaran->semester) == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                    <option value="Genap" {{ old('semester', $tahunAjaran->semester) == 'Genap' ? 'selected' : '' }}>Genap</option>
                </select>
                @error('semester')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
