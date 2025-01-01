@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">Data {{ $title }}</h4>

    <div class="d-flex gap-3">
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#import"><i class="bi bi-folder-plus"></i>
            Import
        </button>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Siswa</th>
                        <th>NISN</th>
                        <th>Nama Eskul</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kelola_kelas as $kelola)
                        @foreach($kelola->siswa as $siswa)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $siswa->nama }}</td>
                                <td>{{ $siswa->nis }} / {{ $siswa->nisn }}</td>
                                <td>
                                    <input type="text" class="form-control" name="" />
                                    <input type="text" class="form-control" name="" />
                                    <input type="text" class="form-control" name="" />
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="" />
                                    <input type="text" class="form-control" name="" />
                                    <input type="text" class="form-control" name="" />
                                </td>
                            </tr>
                        @endforeach
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

<button type="submit" class="btn btn-primary">Simpan</button>
@endsection