@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3>Tambah data guru</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('store-guru') }}" method="POST">
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
                        {{-- <div class="form-group">
                            <label for="mata_pelajaran_id">Mata Pelajaran</label>
                            <select class="form-control @error('mata_pelajaran_id') is-invalid @enderror" id="mata_pelajaran_id" name="mata_pelajaran_id" required>
                                <option value="">Pilih Mata Pelajaran</option>
                                <!-- Anda bisa mengganti dengan data mata pelajaran yang ada di database -->
                                @foreach ($mataPelajarans as $mataPelajaran)
                                    <option value="{{ $mataPelajaran->id }}" {{ old('mata_pelajaran_id') == $mataPelajaran->id ? 'selected' : '' }}>
                                        {{ $mataPelajaran->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('mata_pelajaran_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> --}}
        
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
        
                        <!-- Alamat -->
                        <div class="form-group mt-2">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3">{{ old('alamat') }}</textarea>
                            @error('alamat')
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
        
                        <!-- Wali Kelas -->
                        <div class="form-group mt-2">
                            <label for="is_wali_kelas">Wali Kelas</label>
                            <select class="form-control @error('is_wali_kelas') is-invalid @enderror" id="is_wali_kelas" name="is_wali_kelas">
                                <option value="Aktif" {{ old('is_wali_kelas') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Tidak Aktif" {{ old('is_wali_kelas') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                            @error('is_wali_kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
        
                <!-- Submit Button -->
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('data-guru') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
