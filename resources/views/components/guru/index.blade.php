@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">{{ __('Daftar Guru') }}</div>

            <div class="card-body">

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <!-- Tombol Tambah -->
                <div class="mb-3">
                    <a href="{{ route('create-guru') }}" class="btn btn-primary">Tambah Guru</a>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importGuru">
                        Import Guru
                    </button>
                </div>
                <!-- Modal Import Guru -->
                <div class="modal fade" id="importGuru" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Import Data</h5>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('import-guru') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                    <label for="">Masukkan file</label>
                                    <input type="file" name="file" class="form-control @error('file')
                                        is-invalid
                                    @enderror">
                                    @error('file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </form>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                            <button type="button" class="btn btn-primary">Import</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tabel Guru -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>NRG</th>
                                <th>Mata Pelajaran</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Agama</th>
                                <th>Alamat</th>
                                <th>No. HP</th>
                                <th>Jabatan</th>
                                <th>Golongan</th>
                                <th>TMT Awal</th>
                                <th>Pendidikan Terakhir</th>
                                <th>Wali Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($gurus as $guru)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $guru->nama }}</td>
                                    <td>{{ $guru->nip }}</td>
                                    <td>{{ $guru->nrg }}</td>
                                    <td>{{ $guru->mata_pelajaran->nama }}</td>
                                    <td>{{ $guru->tempat_lahir }}</td>
                                    <td>{{ $guru->tgl_lahir ? \Carbon\Carbon::parse($guru->tgl_lahir)->format('d-m-Y') : '-' }}</td>
                                    <td>{{ $guru->agama }}</td>
                                    <td>{{ $guru->alamat }}</td>
                                    <td>{{ $guru->no_hp }}</td>
                                    <td>{{ $guru->jabatan }}</td>
                                    <td>{{ $guru->golongan }}</td>
                                    <td>{{ $guru->tmt_awal ? \Carbon\Carbon::parse($guru->tmt_awal)->format('d-m-Y') : '-' }}</td>
                                    <td>{{ $guru->pendidikan_terakhir }}</td>
                                    <td>{{ $guru->is_wali_kelas }}</td>
                                    <td>
                                        <a href="{{ route('edit-guru', $guru->id_guru) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="{{ route('delete-guru', $guru->id_guru) }}" class="btn btn-danger btn-sm">Hapus</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="16" class="text-center">Tidak ada data guru.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
