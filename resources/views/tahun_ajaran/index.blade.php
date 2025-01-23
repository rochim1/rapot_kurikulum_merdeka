@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-md-0">{{ $title }}</h4>

        <div class="d-flex gap-3">
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#import"><i
                    class="bi bi-folder-plus"></i>
                Import
            </button>
            <a href="{{ route('tahun_ajaran.create') }}" class="btn btn-primary btn-icon-split">
                <span class="text"><i class="bi bi-plus"></i></i> Tambah</span>
            </a>
            <div>
                <form action="{{ route('tahun_ajaran.index') }}" method="GET" class="m-0">
                    <div class="input-group">
                        <input name="search" value="{{ request('search') }}" type="text" class="form-control"
                            placeholder="nama tahun ajaran" aria-label="Recipient's username"
                            aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">cari</button>
                    </div>
                </form>

            </div>

        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Tahun Ajaran</th>
                            <th>Semester</th>
                            <th>Status Aktif</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tahunAjaran as $item_tahun_ajaran)
                            <tr>
                                <td>{{ ($tahunAjaran->currentPage() - 1) * $tahunAjaran->perPage() + $loop->iteration }}
                                </td>
                                <td>{{ $item_tahun_ajaran->tahun_ajaran_awal }}/{{ $item_tahun_ajaran->tahun_ajaran_akhir }}
                                </td>
                                <td>{{ $item_tahun_ajaran->semester }}</td>
                                <td>
                                    <form
                                        action="{{ route('tahun_ajaran_is_active', $item_tahun_ajaran->id_tahun_ajaran) }}"
                                        method="POST" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox"
                                                id="flexSwitchCheckChecked-{{ $item_tahun_ajaran->id_tahun_ajaran }}"
                                                name="is_active" onchange="this.form.submit()"
                                                {{ $item_tahun_ajaran->is_active ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="flexSwitchCheckChecked-{{ $item_tahun_ajaran->id_tahun_ajaran }}">
                                                {{ $item_tahun_ajaran->is_active ? 'Aktif' : 'Nonaktif' }}
                                            </label>
                                        </div>
                                    </form>
                                </td>
                                <td class="d-flex gap-2">
                                    <a href="{{ route('tahun_ajaran.edit', $item_tahun_ajaran->id_tahun_ajaran) }}"
                                        class="btn btn-outline-success">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form id="myForm"
                                        action="{{ route('tahun_ajaran.destroy', $item_tahun_ajaran->id_tahun_ajaran) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" id="btn_delete">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-danger fw-bold py-3">Data {{ $title }}
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
                        <strong>{{ $tahunAjaran->firstItem() }}</strong>
                        sampai
                        <strong>{{ $tahunAjaran->lastItem() }}</strong>
                        dari total
                        <strong>{{ $tahunAjaran->total() }}</strong>
                        data.
                    </p>
                    <p class="mb-0">
                        Halaman
                        <strong>{{ $tahunAjaran->currentPage() }}</strong>
                        dari
                        <strong>{{ $tahunAjaran->lastPage() }}</strong>.
                    </p>
                </div>

                <!-- Pagination Links -->
                <div>
                    {{ $tahunAjaran->links() }}
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
                    <form action="{{ route('import_tahun_ajaran') }}" method="post" enctype="multipart/form-data">
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
