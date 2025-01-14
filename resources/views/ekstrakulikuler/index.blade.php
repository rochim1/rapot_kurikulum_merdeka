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
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ekskuls as $ekskul)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ekskul->nama_ekstrakulikuler }}</td>
                        <td>{{ $ekskul->keterangan }}</td>
                        <td>
                            <a href="{{ route('edit-ekstrakulikuler', $ekskul->id_ekstrakulikuler) }}" class="btn btn-outline-success" title="Edit"> <i class="bi bi-pencil-square"></i></a>
                            <a href="{{ route('delete-ekstrakulikuler', $ekskul->id_ekstrakulikuler) }}" class="btn btn-outline-danger" id="btn_delete" title="Hapus"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center my-3">
            <!-- Pagination Info -->
            <div>
                <p class="mb-0">
                    Menampilkan
                    <strong>{{ $ekskuls->firstItem() }}</strong>
                    sampai
                    <strong>{{ $ekskuls->lastItem() }}</strong>
                    dari total
                    <strong>{{ $ekskuls->total() }}</strong>
                    data.
                </p>
                <p class="mb-0">
                    Halaman
                    <strong>{{ $ekskuls->currentPage() }}</strong>
                    dari
                    <strong>{{ $ekskuls->lastPage() }}</strong>.
                </p>
            </div>

            <!-- Pagination Links -->
            <div>
                {{ $ekskuls->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
