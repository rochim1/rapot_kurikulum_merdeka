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
                <label for="id_guru" class="form-label">Guru</label>
                <select class="form-select @error('id_guru') is-invalid @enderror" id="id_guru" name="id_guru">
                    <option value="">Pilih Guru</option>
                    @foreach($guru as $item_guru)
                        <option value="{{ $item_guru->id_guru }}" {{ old('id_guru') == $item_guru->id_guru ? 'selected' : '' }}>
                            {{ $item_guru->nama }}
                        </option>
                    @endforeach
                </select>
                @error('id_guru')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="id_tahun_ajaran" class="form-label">Tahun Ajaran</label>
                <select class="form-select @error('id_tahun_ajaran') is-invalid @enderror" id="id_tahun_ajaran" name="id_tahun_ajaran">
                    <option value="">Pilih Tahun Ajaran</option>
                    @foreach($tahunAjaran as $item_tahunAjaran)
                        <option value="{{ $item_tahunAjaran->id_tahun_ajaran }}" {{ old('id_tahun_ajaran') == $item_tahunAjaran->id_tahun_ajaran ? 'selected' : '' }}>
                            {{ $item_tahunAjaran->nama_tahun_ajaran }}
                        </option>
                    @endforeach
                </select>
                @error('id_tahun_ajaran')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nama_kelas" class="form-label">Nama Kelas</label>
                <input type="text" class="form-control @error('nama_kelas') is-invalid @enderror" id="nama_kelas" name="nama_kelas" value="{{ old('nama_kelas') }}" maxlength="50">
                @error('nama_kelas')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tingkat" class="form-label">Tingkat</label>
                <select class="form-select @error('tingkat') is-invalid @enderror" id="tingkat" name="tingkat">
                    <option value="">Pilih Tingkat</option>
                    <option value="1" {{ old('tingkat') == '1' ? 'selected' : '' }}>1</option>
                    <option value="2" {{ old('tingkat') == '2' ? 'selected' : '' }}>2</option>
                    <option value="3" {{ old('tingkat') == '3' ? 'selected' : '' }}>3</option>
                    <option value="4" {{ old('tingkat') == '4' ? 'selected' : '' }}>4</option>
                    <option value="5" {{ old('tingkat') == '5' ? 'selected' : '' }}>5</option>
                    <option value="6" {{ old('tingkat') == '6' ? 'selected' : '' }}>6</option>
                </select>
                @error('tingkat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="fase" class="form-label">Fase</label>
                <select class="form-select @error('fase') is-invalid @enderror" id="fase" name="fase">
                    <option value="">Pilih Fase</option>
                    <option value="A" {{ old('fase') == 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ old('fase') == 'B' ? 'selected' : '' }}>B</option>
                    <option value="C" {{ old('fase') == 'C' ? 'selected' : '' }}>C</option>
                </select>
                @error('fase')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="id_siswa" class="form-label">Pilih Siswa</label>
                <select class="form-select select2 @error('id_siswa') is-invalid @enderror" id="id_siswa" name="id_siswa[]" multiple="multiple">
                    @foreach($siswa as $item_siswa)
                        <option value="{{ $item_siswa->id_siswa }}" {{ in_array($item_siswa->id_siswa, old('id_siswa', [])) ? 'selected' : '' }}>
                            {{ $item_siswa->nama }}
                        </option>
                    @endforeach
                </select>
                @error('id_siswa')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>            

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection
