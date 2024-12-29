@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">Edit Kelas</h4>
    <a href="{{ route('kelas.index') }}" class="btn btn-danger btn-icon-split">
        <span class="text"><i class="bi bi-arrow-left-short"></i> Kembali</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('kelas.update', $kelas->id_kelas) }}" method="POST">
            @csrf
            @method('PUT') <!-- Method for updating -->

            <div class="mb-3">
                <label for="id_tahun_ajaran" class="form-label">Tahun Ajaran<span class="text-danger fs-5">*</span></label>
                <select class="form-select @error('id_tahun_ajaran') is-invalid @enderror" id="id_tahun_ajaran" name="id_tahun_ajaran" required>
                    <option value="">Pilih Tahun Ajaran</option>
                    @foreach($tahunAjaran as $item_tahun_ajaran)
                        <option value="{{ $item_tahun_ajaran->id_tahun_ajaran }}" 
                            {{ old('id_tahun_ajaran', $kelas->id_tahun_ajaran) == $item_tahun_ajaran->id_tahun_ajaran ? 'selected' : '' }}>
                            {{ $item_tahun_ajaran->tahun_ajaran_awal }}/{{ $item_tahun_ajaran->tahun_ajaran_akhir }} - {{ $item_tahun_ajaran->semester }}
                        </option>
                    @endforeach
                </select>
                @error('id_tahun_ajaran')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="kelas_tingkatan" class="form-label">Tingkat<span class="text-danger fs-5">*</span></label>
                <select class="form-select @error('kelas_tingkatan') is-invalid @enderror" id="kelas_tingkatan" name="kelas_tingkatan" required>
                    <option value="">Pilih Tingkat</option>
                    <option value="I" {{ old('kelas_tingkatan', $kelas->kelas_tingkatan) == 'I' ? 'selected' : '' }}>I</option>
                    <option value="II" {{ old('kelas_tingkatan', $kelas->kelas_tingkatan) == 'II' ? 'selected' : '' }}>II</option>
                    <option value="III" {{ old('kelas_tingkatan', $kelas->kelas_tingkatan) == 'III' ? 'selected' : '' }}>III</option>
                    <option value="IV" {{ old('kelas_tingkatan', $kelas->kelas_tingkatan) == 'IV' ? 'selected' : '' }}>IV</option>
                    <option value="V" {{ old('kelas_tingkatan', $kelas->kelas_tingkatan) == 'V' ? 'selected' : '' }}>V</option>
                    <option value="VI" {{ old('kelas_tingkatan', $kelas->kelas_tingkatan) == 'VI' ? 'selected' : '' }}>VI</option>
                </select>
                @error('kelas_tingkatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="kelas_abjad" class="form-label">Abjad Kelas<span class="text-danger fs-5">*</span></label>
                <select class="form-select @error('kelas_abjad') is-invalid @enderror" id="kelas_abjad" name="kelas_abjad" required>
                    <option value="">Pilih Abjad Kelas</option>
                    <option value="A" {{ old('kelas_abjad', $kelas->kelas_abjad) == 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ old('kelas_abjad', $kelas->kelas_abjad) == 'B' ? 'selected' : '' }}>B</option>
                    <option value="C" {{ old('kelas_abjad', $kelas->kelas_abjad) == 'C' ? 'selected' : '' }}>C</option>
                    <option value="D" {{ old('kelas_abjad', $kelas->kelas_abjad) == 'D' ? 'selected' : '' }}>D</option>
                    <option value="E" {{ old('kelas_abjad', $kelas->kelas_abjad) == 'E' ? 'selected' : '' }}>E</option>
                    <option value="F" {{ old('kelas_abjad', $kelas->kelas_abjad) == 'F' ? 'selected' : '' }}>F</option>
                </select>
                @error('kelas_abjad')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="fase" class="form-label">Fase<span class="text-danger fs-5">*</span></label>
                <select class="form-select @error('fase') is-invalid @enderror" id="fase" name="fase" required>
                    <option value="">Pilih Fase</option>
                    <option value="A" {{ old('fase', $kelas->fase) == 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ old('fase', $kelas->fase) == 'B' ? 'selected' : '' }}>B</option>
                    <option value="C" {{ old('fase', $kelas->fase) == 'C' ? 'selected' : '' }}>C</option>
                </select>
                @error('fase')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
