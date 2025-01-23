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
        <h5 class="mb-3">Tambah Kelompok Projek</h5>

        <form action="{{ route('kelompok_projek.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Kelompok</label>
                <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}">
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="id_kelas" class="form-label">Kelas</label>
                <select name="id_kelas" id="id_kelas" class="form-select select2 @error('id_kelas') is-invalid @enderror" required>
                    <option value="">Pilih Kelas</option>
                    @foreach ($kelas as $kelasItem)
                        <option value="{{ $kelasItem->id_kelas }}" {{ old('id_kelas') == $kelasItem->id_kelas ? 'selected' : '' }}>
                            {{ $kelasItem->kelas_tingkatan }}.{{ $kelasItem->kelas_abjad }}
                        </option>
                    @endforeach
                </select>
                @error('id_kelas')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="id_user" class="form-label">Koordinator</label>
                <select name="id_user" id="id_user" class="form-select select2 @error('id_user') is-invalid @enderror" required>
                    <option value="">Pilih Koordinator</option>
                    @foreach ($user as $userItem)
                        <option value="{{ $userItem->id }}" {{ old('id_user') == $userItem->id ? 'selected' : '' }}>
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
