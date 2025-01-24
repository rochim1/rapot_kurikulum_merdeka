@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">{{ $title }}</h4>
    <a href="{{ route('kelompok_projek.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('kelompok_projek.update', $kelompokProjek->id_kelompok_projek) }}" method="POST">
            @method('PUT')
            @csrf

            <!-- Nama Kelompok -->
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Kelompok</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $kelompokProjek->nama) }}" required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Kelas -->
            <div class="mb-3">
                <label for="id_kelas" class="form-label">Pilih Kelas</label>
                <select name="id_kelas" id="id_kelas" class="form-select select2 @error('id_kelas') is-invalid @enderror" required>
                    <option value="" disabled selected>Pilih Kelas</option>
                    @foreach($kelas as $kelasItem)
                        <option value="{{ $kelasItem->id_kelas }}" 
                            {{ old('id_kelas', $kelompokProjek->id_kelas) == $kelasItem->id_kelas ? 'selected' : '' }}>
                            {{ $kelasItem->kelas_tingkatan }}.{{ $kelasItem->kelas_abjad }}
                        </option>
                    @endforeach
                </select>
                @error('id_kelas')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Koordinator -->
            <div class="mb-3">
                <label for="id_user" class="form-label">Pilih Koordinator</label>
                <select name="id_user" id="id_user" class="form-select select2 @error('id_user') is-invalid @enderror" required>
                    <option value="" disabled selected>Pilih Koordinator</option>
                    @foreach($user as $userItem)
                        <option value="{{ $userItem->id }}" 
                            {{ old('id_user', $kelompokProjek->id_user) == $userItem->id ? 'selected' : '' }}>
                            {{ $userItem->name }}
                        </option>
                    @endforeach
                </select>
                @error('id_user')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
