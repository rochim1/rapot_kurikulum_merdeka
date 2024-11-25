@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">Guru</h4>
    <div class="d-flex gap-3">
        <a href="{{ route('data-guru') }}" class="btn btn-secondary btn-icon-split"><i class="bi bi-arrow-left-short"></i><span class="'text">Kembali</span></a>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-header">{{ __('Daftar Guru') }}</div>

    <div class="card-body">
        <!-- Tabel Guru -->
        <form action="{{ route('store-guru') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <!-- Nama -->
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
    
                    <!-- Mata Pelajaran -->
                    <div class="form-group mt-2">
                        <label for="mata_pelajaran_id">Mata Pelajaran</label>
                        <select class="form-control @error('mata_pelajaran_id') is-invalid @enderror" id="mata_pelajaran_id" name="mata_pelajaran_id" required>
                            <option value="">Pilih Mata Pelajaran</option>
                            <!-- Anda bisa mengganti dengan data mata pelajaran yang ada di database -->
                            @foreach ($mataPelajarans as $mataPelajaran)
                                <option value="{{ $mataPelajaran->id_mata_pelajaran }}" {{ old('mata_pelajaran_id') == $mataPelajaran->id_mata_pelajaran ? 'selected' : '' }}>
                                    {{ $mataPelajaran->nama_mata_pelajaran }}
                                </option>
                            @endforeach
                        </select>
                        @error('mata_pelajaran_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
    
                    <!-- NIP -->
                    <div class="form-group mt-2">
                        <label for="nip">NIP</label>
                        <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" value="{{ old('nip') }}">
                        @error('nip')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
    
                    <!-- NRG -->
                    <div class="form-group mt-2">
                        <label for="nrg">NRG</label>
                        <input type="text" class="form-control @error('nrg') is-invalid @enderror" id="nrg" name="nrg" value="{{ old('nrg') }}">
                        @error('nrg')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-2">
                        <label for="jk">Jenis Kelamin</label>
                        <select name="jk" id="" class="form-control">
                            <option value="">--Pilih Jenis Kelamin--</option>
                            <option value="Laki-laki" class="form-control">Laki-laki</option>
                            <option value="Perempuan" class="form-control">Perempuan</option>
                        </select>
                    </div>
                    <!-- Tempat Lahir -->
                    <div class="form-group mt-2">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}">
                        @error('tempat_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
    
                    <!-- Tanggal Lahir -->
                    <div class="form-group mt-2">
                        <label for="tgl_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir') }}">
                        @error('tgl_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
    
                    <!-- Agama -->
                    <div class="form-group mt-2">
                        <label for="agama">Agama</label>
                        <input type="text" class="form-control @error('agama') is-invalid @enderror" id="agama" name="agama" value="{{ old('agama') }}">
                        @error('agama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
    
                <div class="col-md-6">
                    <!-- No. HP -->
                    <div class="form-group mt-2">
                        <label for="no_hp">No. HP</label>
                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ old('no_hp') }}">
                        @error('no_hp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
    
                    <!-- Jabatan -->
                    <div class="form-group mt-2">
                        <label for="jabatan">Jabatan</label>
                        <input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan" value="{{ old('jabatan') }}">
                        @error('jabatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
    
                    <!-- Golongan -->
                    <div class="form-group mt-2">
                        <label for="golongan">Golongan</label>
                        <input type="text" class="form-control @error('golongan') is-invalid @enderror" id="golongan" name="golongan" value="{{ old('golongan') }}">
                        @error('golongan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
    
                    <!-- TMT Awal -->
                    <div class="form-group mt-2">
                        <label for="tmt_awal">TMT Awal</label>
                        <input type="date" class="form-control @error('tmt_awal') is-invalid @enderror" id="tmt_awal" name="tmt_awal" value="{{ old('tmt_awal') }}">
                        @error('tmt_awal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
    
                    <!-- Pendidikan Terakhir -->
                    <div class="form-group mt-2">
                        <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                        <input type="text" class="form-control @error('pendidikan_terakhir') is-invalid @enderror" id="pendidikan_terakhir" name="pendidikan_terakhir" value="{{ old('pendidikan_terakhir') }}">
                        @error('pendidikan_terakhir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
    
                    <!-- Alamat -->
                    <div class="form-group mt-2">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Foto -->
                    <div class="form-group mt-2">
                        <label for="foto">Foto</label>
                        <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto">
                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
    
            <!-- Submit Button -->
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('data-guru') }}" class="btn btn-secondary"><i class="bi bi-arrow-left-short"></i>Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
