@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">{{ $title }}</h4>
<<<<<<< HEAD

    <div class="d-flex gap-3">
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#import"><i class="bi bi-folder-plus"></i>
            Import
        </button>
        <a href="{{ route('kelas.create') }}" class="btn btn-primary btn-icon-split">
            <span class="text"><i class="bi bi-plus"></i></i> Tambah</span>
        </a>
    </div>
=======
    
    <a href="{{ route('kelas.create') }}" class="btn btn-primary btn-icon-split">
        <span class="text"><i class="bi bi-plus"></i> Tambah</span>
    </a>
>>>>>>> be28cd80851abf75b46053831481c5177801f097
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kelas</th>
                        <th>Guru</th>
                        <th>Tahun Ajaran</th>
                        <th>Tingkat</th>
                        <th>Fase</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kelas as $item_kelas)
                        <tr>
<<<<<<< HEAD
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item_kelas->nama_kelas }}</td>
                            <td>{{ $item_kelas->guru->nama }}</td>
                            <td>{{ $item_kelas->tahunAjaran->nama_tahun_ajaran }}</td>
                            <td>{{ $item_kelas->tingkat }}</td>
                            <td>{{ $item_kelas->fase }}</td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('kelas.edit', $item_kelas->id_kelas) }}" class="btn btn-outline-success">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form id="myForm" action="{{ route('kelas.destroy', $item_kelas->id_kelas) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger" id="btn_delete">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
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
                <form action="{{ route('import_kelas') }}" method="post" enctype="multipart/form-data">
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
=======
                            <th>No</th>
                            <th>Nama Kelas</th>
                            {{-- <th>Guru</th> --}}
                            {{-- <th>Tahun Ajaran</th> --}}
                            <th>Tingkat</th>
                            <th>Fase</th>
                            <th>Siswa</th>
                            <th>Status</th> <!-- Keterangan Status Kelas -->
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kelas as $item_kelas)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item_kelas->nama_kelas }}</td>
                                {{-- <td>{{ $item_kelas->guru->nama }}</td> --}}
                                {{-- <td>{{ $item_kelas->tahunAjaran->nama_tahun_ajaran }}</td> --}}
                                <td>{{ $item_kelas->tingkat }}</td>
                                <td>{{ $item_kelas->fase }}</td>
                                <td>
                                    @if ($item_kelas->siswa->count())
                                        <ul class="list-unstyled mb-0">
                                            @foreach ($item_kelas->siswa as $siswa)
                                                <li> - {{ $siswa->nama }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="text-muted">Tidak ada siswa</span>
                                    @endif
                                </td>
                                <td>
                                    <!-- Menampilkan status aktif atau tidak berdasarkan nilai boolean -->
                                    @if($item_kelas->is_active == 1)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-danger">Tidak Aktif</span>
                                    @endif
                                
                                    <form action="{{ route('kelas.toggleStatus', $item_kelas->id_kelas) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        <select name="is_active" class="form-select form-select-sm" onchange="this.form.submit()">
                                            <option value="1" {{ $item_kelas->is_active == 1 ? 'selected' : '' }}>Aktif</option>
                                            <option value="2" {{ $item_kelas->is_active == 2 ? 'selected' : '' }}>Tidak Aktif</option>
                                        </select>
                                    </form>                                    
                                </td>                                                             
                                <td class="d-flex gap-2">
                                    <a href="{{ route('kelas.edit', $item_kelas->id_kelas) }}" class="btn btn-outline-success">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    
                                    <form id="myForm" action="{{ route('kelas.destroy', $item_kelas->id_kelas) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger" id="btn_delete">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Data kelas belum tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            @else
                <h6 class="text-center">Data {{ $title }} Belum Ada!</h6>
            @endif
>>>>>>> be28cd80851abf75b46053831481c5177801f097
        </div>
    </div>
</div>
@endsection
