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
                <label for="id_tahun_ajaran" class="form-label">Pilih Kelas</label>
                
                @error('id_tahun_ajaran')
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
