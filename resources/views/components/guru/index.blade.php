@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">Guru</h4>
    <div class="d-flex gap-3">
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#importGuru"><i class="bi bi-folder-plus"></i>
            Import Guru
        </button>
        <a href="{{ route('create-guru') }}" class="btn btn-primary btn-icon-split"><i class="bi bi-plus"></i><span class="'text">Tambah Guru</span></a>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-header">{{ __('Daftar Guru') }}</div>

    <div class="card-body">
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
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary">Import</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tabel Guru -->
        <div class="table-responsive">
            <table class="table table-hover">
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
                            <td>{{ $guru->mata_pelajaran->nama_mata_pelajaran }}</td>
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
                                <a href="{{ route('edit-guru', $guru->id_guru) }}" class="btn btn-outline-warning btn-sm" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                <a href="{{ route('delete-guru', $guru->id_guru) }}" class="btn btn-outline-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></a>
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
@endsection
