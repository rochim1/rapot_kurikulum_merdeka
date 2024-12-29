@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">{{ $title }}</h4>

    <div class="d-flex gap-3">
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#import"><i class="bi bi-folder-plus"></i>
            Import
        </button>
        <a href="{{ route('siswa.create') }}" class="btn btn-primary btn-icon-split">
            <span class="text"><i class="bi bi-plus"></i></i> Tambah</span>
        </a>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>NIS</th>
                        <th>NISN</th>
                        <th>Jenis Kelamin</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($siswa as $item_siswa)
                        <tr class="align-top">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($item_siswa->foto)
                                    <img src="{{ asset('storage/' . $item_siswa->foto) }}" alt="Foto {{ $item_siswa->nama }}" class="border object-fit-cover " style="width: 75px; height: 95px;">
                                @else
                                    <img src="{{ asset('storage/no-image.png') }}" alt="Default Foto" class="border object-fit-cover " style="width: 75px; height: 95px;">
                                @endif
                            </td>
                            <td>{{ $item_siswa->nama }}</td>
                            <td>{{ $item_siswa->nis }}</td>
                            <td>{{ $item_siswa->nisn ?? '-' }}</td>
                            <td>{{ $item_siswa->jk }}</td>
                            <td>
                                @if($item_siswa->status == 'active')
                                    <span class="badge bg-success">Active</span>
                                @elseif($item_siswa->status == 'berhenti')
                                    <span class="badge bg-danger">Berhenti</span>
                                @elseif($item_siswa->status == 'mutasi')
                                    <span class="badge bg-warning text-dark">Mutasi</span>
                                @else
                                    <span class="badge bg-secondary">Lulus</span>
                                @endif
                            </td>
                            <td>                                   
                                <div class="d-flex gap-2">
                                    <a href="{{ route('siswa.show', $item_siswa->id_siswa) }}" class="btn btn-outline-info" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a href="{{ route('siswa.edit', $item_siswa->id_siswa) }}" class="btn btn-outline-success" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form id="myForm" action="{{ route('siswa.destroy', $item_siswa->id_siswa) }}" method="POST" title="Hapus">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger" id="btn_delete">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-danger fw-bold py-3">Data {{ $title }} belum tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Import -->
<div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Import Data {{ $title }}</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('import_siswa') }}" method="post" enctype="multipart/form-data">
                @csrf
                    <label for="nama" class="form-label">Masukkan file<span class="text-danger fs-5">*</span></label>
                    <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" required>
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
@endsection
