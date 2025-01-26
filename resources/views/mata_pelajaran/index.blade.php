@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-md-0">{{ $title }}</h4>

        @if (Auth::user()->hasRole('admin'))
            <div class="d-flex gap-3">
                @if (Auth::user()->hasRole('admin'))
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#import"><i
                            class="bi bi-folder-plus"></i>
                        Import
                    </button>
                    <a href="{{ route('mata_pelajaran.create') }}" class="btn btn-primary btn-icon-split">
                        <span class="text"><i class="bi bi-plus"></i></i> Tambah</span>
                    </a>
                @endif
                <div>
                    <form action="{{ route('mata_pelajaran.index') }}" method="GET" class="m-0">
                        <div class="d-flex">
                            <div class="input-group mx-1">
                                <select name="kelompok" class="form-control" aria-label="kelompok"
                                    aria-describedby="button-addon2">
                                    <option value="">Select Kelompok</option>
                                    <option value="A" {{ request('kelompok') === 'A' ? 'selected' : '' }}>A</option>
                                    <option value="B" {{ request('kelompok') === 'B' ? 'selected' : '' }}>B</option>
                                    <option value="C" {{ request('kelompok') === 'C' ? 'selected' : '' }}>C</option>
                                </select>
                            </div>
                            <div class="input-group mx-1">
                                <input name="nama_mata_pelajaran" value="{{ request('nama_mata_pelajaran') }}"
                                    type="text" class="form-control" placeholder="nama mata pelajaran"
                                    aria-label="nama_mata_pelajaran" aria-describedby="button-addon2">
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mata Pelajaran</th>
                            <th>Kelompok</th>
                            @if (Auth::user()->hasRole('admin'))
                                <th class="text-center">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mataPelajaran as $item)
                            <tr>
                                <td>{{ ($mataPelajaran->currentPage() - 1) * $mataPelajaran->perPage() + $loop->iteration }}
                                </td>
                                <td>{{ $item->nama_mata_pelajaran }}</td>
                                <td>{{ $item->kelompok }}</td>
                                @if (Auth::user()->hasRole('admin'))
                                    <td class="d-flex gap-2 justify-content-center">
                                        <a href="{{ route('mata_pelajaran.edit', $item->id_mata_pelajaran) }}"
                                            class="btn btn-outline-success">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form id="myForm"
                                            action="{{ route('mata_pelajaran.destroy', $item->id_mata_pelajaran) }}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger" id="btn_delete">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-danger fw-bold py-3">Data {{ $title }}
                                    belum tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center my-3">
                <!-- Pagination Info -->
                <div>
                    <p class="mb-0">
                        Menampilkan
                        <strong>{{ $mataPelajaran->firstItem() }}</strong>
                        sampai
                        <strong>{{ $mataPelajaran->lastItem() }}</strong>
                        dari total
                        <strong>{{ $mataPelajaran->total() }}</strong>
                        data.
                    </p>
                    <p class="mb-0">
                        Halaman
                        <strong>{{ $mataPelajaran->currentPage() }}</strong>
                        dari
                        <strong>{{ $mataPelajaran->lastPage() }}</strong>.
                    </p>
                </div>

                <!-- Pagination Links -->
                <div>
                    {{ $mataPelajaran->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Import -->
    <div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Data {{ $title }}</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('import_mata_pelajaran') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="nama" class="form-label">Masukkan file<span
                                class="text-danger fs-5">*</span></label>
                        <input type="file" name="file" class="form-control @error('file') is-invalid @enderror"
                            required>
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
