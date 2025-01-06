@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-md-0">Edit Profil Sekolah</h4>
        <a href="{{ route('profil_sekolah.index') }}" class="btn btn-danger btn-icon-split">
            <span class="text"><i class="bi bi-arrow-left-short"></i> Kembali</span>
        </a>
    </div>


    <form action="{{ route('profil_sekolah.update', $profilSekolah->id_profil_sekolah) }}" method="POST">
        @csrf
        @method('PUT') <!-- Method for updating -->
        <div class="row d-flex">
            <div class="col-md col-stretch">
                <div class="card shadow mb-4 w-100">
                    <div class="card-body">
                        <div class="mb-3">

                            <div class="mb-3">
                                <label for="nama_sekolah" class="form-label">Nama Sekolah<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_sekolah') is-invalid @enderror"
                                    name="nama_sekolah" value="{{ old('nama_sekolah', $profilSekolah->nama_sekolah) }}"
                                    required>
                                @error('nama_sekolah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                </title>
                            </div>

                            <div class="row">
                                <div class="col-md mb-3">
                                    <label for="akreditas" class="form-label">Akreditasi<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('akreditas') is-invalid @enderror"
                                        name="akreditas" value="{{ old('akreditas', $profilSekolah->akreditas) }}" required>
                                    @error('akreditas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md mb-3">
                                    <label for="npsn" class="form-label">NPSN<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('npsn') is-invalid @enderror"
                                        name="npsn" value="{{ old('npsn', $profilSekolah->npsn) }}" required>
                                    @error('npsn')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="kode_pos" class="form-label">Kode Pos<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('kode_pos') is-invalid @enderror"
                                        name="kode_pos" value="{{ old('kode_pos', $profilSekolah->kode_pos) }}" required>
                                    @error('kode_pos')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
    
                                <div class="col-md-8 mb-3">
                                    <label for="telepon" class="form-label">No Telepon<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('telepon') is-invalid @enderror"
                                        name="telepon" value="{{ old('telepon', $profilSekolah->telepon) }}" required>
                                    @error('telepon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email', $profilSekolah->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat<span class="text-danger">*</span></label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" required>{{ old('alamat', $profilSekolah->alamat) }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md col-stretch">
                <div class="card shadow mb-4 w-100">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="nama_kepsek" class="form-label">Nama Kepala Sekolah<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_kepsek') is-invalid @enderror"
                                name="nama_kepsek" value="{{ old('nama_kepsek', $profilSekolah->nama_kepsek) }}" required>
                            @error('nama_kepsek')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nip_kepsek" class="form-label">NIP Kepala Sekolah<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nip_kepsek') is-invalid @enderror"
                                name="nip_kepsek" value="{{ old('nip_kepsek', $profilSekolah->nip_kepsek) }}" required>
                            @error('nip_kepsek')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="pangkat_golongan_kepsek" class="form-label">Pangkat/Golongan Kepala Sekolah<span
                                    class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('pangkat_golongan_kepsek') is-invalid @enderror"
                                name="pangkat_golongan_kepsek"
                                value="{{ old('pangkat_golongan_kepsek', $profilSekolah->pangkat_golongan_kepsek) }}"
                                required>
                            @error('pangkat_golongan_kepsek')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>
                        <div class="mb-3">
                            <label for="ttd_tempat_tanggal_rapot" class="form-label">Tanggal Rapot<span
                                    class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('ttd_tempat_tanggal_rapot') is-invalid @enderror"
                                name="ttd_tempat_tanggal_rapot"
                                value="{{ old('ttd_tempat_tanggal_rapot', $profilSekolah->ttd_tempat_tanggal_rapot) }}"
                                required>
                            @error('ttd_tempat_tanggal_rapot')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary"><i class="bi bi-save me-2"></i> Update</button>
    </form>
@endsection
