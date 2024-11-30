@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">Ekstrakulikuler</h4>
    <div class="d-flex gap-3">
        <a href="{{ route('create-ekstrakulikuler') }}" class="btn btn-primary btn-icon-split"><i class="bi bi-plus"></i><span class="'text">Tambah</span></a>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-header">{{ __('Daftar Ekstrakulikuler') }}</div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Ekstrakulikuler</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ekskuls as $ekskul)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ekskul->nama_ekstrakulikuler }}</td>
                        <td>
                            <a href="{{ route('edit-ekstrakulikuler', $ekskul->id_ekstrakulikuler) }}" class="btn btn-outline-warning btn-sm" title="Edit"> <i class="bi bi-pencil-square"></i></a>
                            <a href="{{ route('delete-ekstrakulikuler', $ekskul->id_ekstrakulikuler) }}" class="btn btn-outline-danger btn-sm" title="Hapus"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
