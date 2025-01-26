@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-md-0">Ekstrakulikuler</h4>
        <div class="d-flex gap-3">
            @if (Auth::user()->hasRole('admin'))
                <a href="{{ route('create-ekstrakulikuler') }}" class="btn btn-primary btn-icon-split"><i
                        class="bi bi-plus"></i><span class="'text">Tambah</span></a>
            @endif
            <div>
                <form action="{{ route('ekstrakulikuler.index') }}" method="GET" class="m-0">
                    <div class="input-group">
                        <input name="nama_ekstrakulikuler" value="{{ request('nama_ekstrakulikuler') }}" type="text"
                            class="form-control" placeholder="nama ekstrakulikuler" aria-label="Recipient's username"
                            aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">cari</button>
                    </div>
                </form>
            </div>
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
                            @if (Auth::user()->hasRole('admin'))
                                <th class="text-center">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ekskuls as $ekskul)
                            <tr>
                                <td>{{ ($ekskuls->currentPage() - 1) * $ekskuls->perPage() + $loop->iteration }}</td>
                                <td>{{ $ekskul->nama_ekstrakulikuler }}</td>
                                @if (Auth::user()->hasRole('admin'))
                                    <td class="d-flex gap-2 justify-content-center">
                                        <a href="{{ route('edit-ekstrakulikuler', $ekskul->id_ekstrakulikuler) }}"
                                            class="btn btn-outline-success" title="Edit"> <i
                                                class="bi bi-pencil-square"></i></a>
                                        <a href="{{ route('delete-ekstrakulikuler', $ekskul->id_ekstrakulikuler) }}"
                                            class="btn btn-outline-danger" id="btn_delete" title="Hapus"><i
                                                class="bi bi-trash"></i></a>
                                    </td>
                                @endif
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
