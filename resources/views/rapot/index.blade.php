@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">Data {{ $title }}</h4>

    <div class="d-flex gap-3">
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#import"><i class="bi bi-folder-plus"></i>
            Import
        </button>
        <a href="{{ route('rapot.create') }}" class="btn btn-primary btn-icon-split">
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
                        <th>#</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Semester</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rapot as $item_rapot)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item_rapot->siswa->nama }}</td>
                        <td>{{ $item_rapot->kelas->nama_kelas }}</td>
                        <td>{{ $item_rapot->semester }}</td>
                        <td>{{ ucfirst($item_rapot->status) }}</td>
                        <td class="d-flex gap-2">
                            <a href="{{ route('rapot.show', $item_rapot->id_rapot) }}" class="btn btn-outline-info">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('rapot.edit', $item_rapot->id_rapot) }}" class="btn btn-outline-success">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form id="myForm" action="{{ route('rapot.destroy', $item_rapot->id_rapot) }}" method="POST">
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
@endsection
