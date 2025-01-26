@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">Tambah Tema</h4>
    <a href="{{ route('tema.index') }}" class="btn btn-danger btn-icon-split">
        <span class="text"><i class="bi bi-arrow-left-short"></i> Kembali</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('tema.store') }}" method="POST">
            @csrf

            <!-- Tahun Ajaran -->
            <div class="mb-3">
                <label for="id_tahun_ajaran" class="form-label">Tahun Ajaran<span class="text-danger fs-5">*</span></label>
                <select class="form-select @error('id_tahun_ajaran') is-invalid @enderror" id="id_tahun_ajaran" name="id_tahun_ajaran" required>
                    <option value="">Pilih Tahun Ajaran</option>
                    @foreach($tahunAjaran as $itemTahunAjaran)
                        <option value="{{ $itemTahunAjaran->id_tahun_ajaran }}" 
                            {{ old('id_tahun_ajaran') == $itemTahunAjaran->id_tahun_ajaran ? 'selected' : '' }}>
                            {{ $itemTahunAjaran->tahun_ajaran_awal }}/{{ $itemTahunAjaran->tahun_ajaran_akhir }} - {{ $itemTahunAjaran->semester }}
                        </option>
                    @endforeach
                </select>
                @error('id_tahun_ajaran')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            

            <!-- Dimensi -->
            <div class="mb-3">
                <label for="dimensi" class="form-label">Dimensi</label>
                <select class="form-select @error('dimensi') is-invalid @enderror" id="dimensi" name="dimensi">
                    <option value="">Pilih Dimensi</option>
                    <option value="Gaya Hidup Berkelanjutan" {{ old('dimensi') == 'Gaya Hidup Berkelanjutan' ? 'selected' : '' }}>Gaya Hidup Berkelanjutan</option>
                    <option value="Kearifan Lokal" {{ old('dimensi') == 'Kearifan Lokal' ? 'selected' : '' }}>Kearifan Lokal</option>
                    <option value="Bhinneka Tunggal Ika" {{ old('dimensi') == 'Bhinneka Tunggal Ika' ? 'selected' : '' }}>Bhinneka Tunggal Ika</option>
                    <option value="Bangunlah Jiwa dan Raganya" {{ old('dimensi') == 'Bangunlah Jiwa dan Raganya' ? 'selected' : '' }}>Bangunlah Jiwa dan Raganya</option>
                    <option value="Berekayasa dan Berteknologi untuk Membanguan NKRI" {{ old('dimensi') == 'Berekayasa dan Berteknologi untuk Membanguan NKRI' ? 'selected' : '' }}>Berekayasa dan Berteknologi untuk Membanguan NKRI</option>
                    <option value="Kewirausahaan" {{ old('dimensi') == 'Kewirausahaan' ? 'selected' : '' }}>Kewirausahaan</option>
                </select>
                @error('dimensi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Deskripsi Dimensi -->
            <div class="mb-3">
                <label for="deskripsi_dimensi" class="form-label">Deskripsi Dimensi</label>
                <textarea class="form-control @error('deskripsi_dimensi') is-invalid @enderror" id="deskripsi_dimensi" name="deskripsi_dimensi" rows="4">{{ old('deskripsi_dimensi') }}</textarea>
                @error('deskripsi_dimensi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nama Tema -->
            <div class="mb-3">
                <label for="nama_tema" class="form-label">Nama Tema<span class="text-danger fs-5">*</span></label>
                <input type="text" class="form-control @error('nama_tema') is-invalid @enderror" id="nama_tema" name="nama_tema" value="{{ old('nama_tema') }}" required>
                @error('nama_tema')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Deskripsi Tema -->
            <div class="mb-3">
                <label for="deskripsi_tema" class="form-label">Deskripsi Tema</label>
                <textarea class="form-control @error('deskripsi_tema') is-invalid @enderror" id="deskripsi_tema" name="deskripsi_tema" rows="4">{{ old('deskripsi_tema') }}</textarea>
                @error('deskripsi_tema')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>
@endsection
