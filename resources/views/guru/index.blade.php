@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">Guru</h4>
    <div class="d-flex gap-3">
        @if (Auth::user()->hasRole('admin'))
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#importGuru"><i class="bi bi-folder-plus"></i>
            </button>
            <a href="{{ route('create-guru') }}" class="btn btn-primary btn-icon-split"><i class="bi bi-plus"></i><span class="'text"></span></a>
        @endif
        <form action="{{ route('data-guru') }}" method="GET" class="m-0">
            <div class="d-flex">
                <div class="input-group mx-1">
                    <input name="nip" value="{{ request('nip') }}" type="text" class="form-control"
                        placeholder="nip" aria-label="nip" aria-describedby="button-addon2">
                </div>
                <div class="input-group mx-1">
                    <input name="nrg" value="{{ request('nrg') }}" type="text" class="form-control"
                        placeholder="nrg" aria-label="nrg" aria-describedby="button-addon2">
                </div>
                <div class="input-group mx-1">
                    <input name="nama_guru" value="{{ request('nama_guru') }}" type="text" class="form-control"
                        placeholder="nama guru" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">cari</button>
                </div>
            </div>
        </form>
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
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>NRG</th>
                        <th>Mata Pelajaran</th>
                        <th>Status</th>
                        <th>Wali Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($gurus as $guru)
                        <tr>
                            <td>{{ ($gurus->currentPage() - 1) * $gurus->perPage() + $loop->iteration }}</td>
                            <td>
                                @if($guru->foto)
                                    <img src="{{ asset('storage/' . $guru->foto) }}" alt="Foto Guru" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('storage/no-image.png') }}" alt="Default Foto" class="border object-fit-cover " style="width: 75px; height: 95px;">
                                @endif
                            </td>

                            <td>{{ $guru->user->name }}</td>
                            <td>{{ $guru->nip }}</td>
                            <td>{{ $guru->nrg }}</td>
                            <td>{{ $guru->mata_pelajaran->nama_mata_pelajaran??'-' }}</td>
                            <td>
                                <form action="{{ route('update-status', $guru->id_guru) }}" method="POST">
                                    @csrf
                                    <select name="status" class="form-select" style="width: 150px;" onchange="this.form.submit()">
                                        <option value="Aktif" {{ $guru->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="Non-Aktif" {{ $guru->status == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                                        <option value="Mutasi" {{ $guru->status == 'Mutasi' ? 'selected' : '' }}>Mutasi</option>
                                        <option value="Pensiun" {{ $guru->status == 'Pensiun' ? 'selected' : '' }}>Pensiun</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('guru.update_wali_kelas', $guru->id_guru) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <div class="form-check form-switch mb-2">
                                        <input 
                                            class="form-check-input" 
                                            type="checkbox" 
                                            id="flexSwitchCheckChecked-{{ $guru->id }}" 
                                            name="is_wali_kelas" 
                                            onchange="this.form.submit()" 
                                            {{ $guru->is_wali_kelas ? 'checked' : '' }}>
                                    </div>
                                </form>
                            </td>                            
                            <td>
                                <a href="{{ route('show-guru', $guru->id_guru) }}" class="btn btn-outline-info" title="Lihat Profil">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('edit-guru', $guru->id_guru) }}" class="btn btn-outline-success" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                <form id="myForm" action="{{ route('delete-guru', $guru->id_guru) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger" id="btn_delete">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
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
        <div class="d-flex justify-content-between align-items-center my-3">
            <!-- Pagination Info -->
            <div>
                <p class="mb-0">
                    Menampilkan
                    <strong>{{ $gurus->firstItem() }}</strong>
                    sampai
                    <strong>{{ $gurus->lastItem() }}</strong>
                    dari total
                    <strong>{{ $gurus->total() }}</strong>
                    data.
                </p>
                <p class="mb-0">
                    Halaman
                    <strong>{{ $gurus->currentPage() }}</strong>
                    dari
                    <strong>{{ $gurus->lastPage() }}</strong>.
                </p>
            </div>

            <!-- Pagination Links -->
            <div>
                {{ $gurus->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
