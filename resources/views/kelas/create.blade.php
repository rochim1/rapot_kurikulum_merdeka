@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">Tambah Kelas</h4>
    <a href="{{ route('kelas.index') }}" class="btn btn-danger btn-icon-split">
        <span class="text"><i class="bi bi-arrow-left-short"></i> Kembali</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('kelas.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="kelas_tingkatan" class="form-label">Tingkat<span class="text-danger fs-5">*</span></label>
                <select class="form-select @error('kelas_tingkatan') is-invalid @enderror" id="kelas_tingkatan" name="kelas_tingkatan" required>
                    <option value="">Pilih Tingkat</option>
                    <option value="I" {{ old('kelas_tingkatan') == 'I' ? 'selected' : '' }}>I</option>
                    <option value="II" {{ old('kelas_tingkatan') == 'II' ? 'selected' : '' }}>II</option>
                    <option value="III" {{ old('kelas_tingkatan') == 'III' ? 'selected' : '' }}>III</option>
                    <option value="IV" {{ old('kelas_tingkatan') == 'IV' ? 'selected' : '' }}>IV</option>
                    <option value="V" {{ old('kelas_tingkatan') == 'V' ? 'selected' : '' }}>V</option>
                    <option value="VI" {{ old('kelas_tingkatan') == 'VI' ? 'selected' : '' }}>VI</option>
                </select>
                @error('kelas_tingkatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="kelas_abjad" class="form-label">Abjad Kelas<span class="text-danger fs-5">*</span></label>
                <select class="form-select @error('kelas_abjad') is-invalid @enderror" id="kelas_abjad" name="kelas_abjad" required>
                    <option value="">Pilih Abjad Kelas</option>
                    <option value="A" {{ old('kelas_abjad') == 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ old('kelas_abjad') == 'B' ? 'selected' : '' }}>B</option>
                    <option value="C" {{ old('kelas_abjad') == 'C' ? 'selected' : '' }}>C</option>
                    <option value="D" {{ old('kelas_abjad') == 'D' ? 'selected' : '' }}>D</option>
                    <option value="E" {{ old('kelas_abjad') == 'E' ? 'selected' : '' }}>E</option>
                    <option value="F" {{ old('kelas_abjad') == 'F' ? 'selected' : '' }}>F</option>
                </select>
                @error('kelas_abjad')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="fase" class="form-label">Fase<span class="text-danger fs-5">*</span></label>
                <select class="form-select @error('fase') is-invalid @enderror" id="fase" name="fase" required>
                    <option value="">Pilih Fase</option>
                    <option value="A" {{ old('fase') == 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ old('fase') == 'B' ? 'selected' : '' }}>B</option>
                    <option value="C" {{ old('fase') == 'C' ? 'selected' : '' }}>C</option>
                </select>
                @error('fase')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection
