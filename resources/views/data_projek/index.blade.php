@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">{{ $title }}</h4>

    <a href="{{ route('data_projek.create') }}" class="btn btn-primary btn-icon-split">
        <span class="text"><i class="bi bi-plus"></i> Tambah</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            @if (count($dataProjek))
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tema</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dataProjek as $item_projek)
                            <tr>
                                <td>{{ ($dataProjek->currentPage() - 1) * $dataProjek->perPage() + $loop->iteration }}</td>
                                <td>{{ $item_projek->tema }}</td>
                                <td>{{ Str::limit($item_projek->nama, 50, '...') }}</td>
                                <td>{{ Str::limit($item_projek->deskripsi, 50, '...') }}</td>
                                <td class="d-flex gap-2">
                                    <a href="{{ route('data_projek.show', $item_projek->id_data_projek) }}" class="btn btn-outline-info" title="Lihat Profil">
                                        Target Capaian
                                    </a>
                                    <a href="{{ route('data_projek.edit', $item_projek->id_data_projek) }}" class="btn btn-outline-success">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form id="myForm" action="{{ route('data_projek.destroy', $item_projek->id_data_projek) }}" method="POST">
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
                                <td colspan="5" class="text-center">Data belum tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            @else
                <h6 class="text-center">Data {{ $title }} Belum Ada!</h6>
            @endif
        </div>

        <div class="d-flex justify-content-between align-items-center my-3">
            <!-- Pagination Info -->
            <div>
                <p class="mb-0">
                    Menampilkan
                    <strong>{{ $dataProjek->firstItem() }}</strong>
                    sampai
                    <strong>{{ $dataProjek->lastItem() }}</strong>
                    dari total
                    <strong>{{ $dataProjek->total() }}</strong>
                    data.
                </p>
                <p class="mb-0">
                    Halaman
                    <strong>{{ $dataProjek->currentPage() }}</strong>
                    dari
                    <strong>{{ $dataProjek->lastPage() }}</strong> halaman.
                </p>
            </div>

            <!-- Pagination Links -->
            <div>
                {{ $dataProjek->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
