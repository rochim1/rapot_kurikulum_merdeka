@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">{{ $title }}</h4>
    <a href="{{ route('data_projek.index') }}" class="btn btn-secondary btn-icon-split">
        <span class="text"><i class="bi bi-arrow-left-circle"></i> Kembali</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('data_projek.update', $dataProjek->id_data_projek) }}" method="POST">
            @method('PUT')
            @csrf

            <div class="mb-3">
                <label for="tema" class="form-label">Tema</label>
                <select name="tema" id="tema" class="form-control @error('tema') is-invalid @enderror" required>
                    <option value="Gaya Hidup Berkelanjutan" {{ old('tema', $dataProjek->tema) == 'Gaya Hidup Berkelanjutan' ? 'selected' : '' }}>Gaya Hidup Berkelanjutan</option>
                    <option value="Kearifan Lokal" {{ old('tema', $dataProjek->tema) == 'Kearifan Lokal' ? 'selected' : '' }}>Kearifan Lokal</option>
                    <option value="Bhineka Tunggal Ika" {{ old('tema', $dataProjek->tema) == 'Bhineka Tunggal Ika' ? 'selected' : '' }}>Bhineka Tunggal Ika</option>
                    <option value="Bangunlah Jiwa dan Raganya" {{ old('tema', $dataProjek->tema) == 'Bangunlah Jiwa dan Raganya' ? 'selected' : '' }}>Bangunlah Jiwa dan Raganya</option>
                    <option value="Suara Demokrasi" {{ old('tema', $dataProjek->tema) == 'Suara Demokrasi' ? 'selected' : '' }}>Suara Demokrasi</option>
                    <option value="Berekayasa Berteknologi untuk Membangun NKRI" {{ old('tema', $dataProjek->tema) == 'Berekayasa Berteknologi untuk Membangun NKRI' ? 'selected' : '' }}>Berekayasa Berteknologi untuk Membangun NKRI</option>
                    <option value="Kewirausahaan" {{ old('tema', $dataProjek->tema) == 'Kewirausahaan' ? 'selected' : '' }}>Kewirausahaan</option>
                </select>
                @error('teme')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            

            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $dataProjek->nama) }}" required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control @error('deskripsi') is-invalid @enderror" required>{{ old('deskripsi', $dataProjek->deskripsi) }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Update Data</button>
            </div>
        </form>
    </div>
</div>
@endsection
