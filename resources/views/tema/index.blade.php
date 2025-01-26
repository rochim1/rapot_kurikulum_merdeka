@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">{{ $title }}</h4>

    <div class="d-flex gap-3">
        <a href="{{ route('tema.create') }}" class="btn btn-primary btn-icon-split">
            <span class="text"><i class="bi bi-plus"></i> Tambah</span>
        </a>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            @if (count($tema))
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tahun Ajaran</th>
                            <th>Semester</th>
                            <th>Dimensi</th>
                            <th>Tema</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tema as $item)
                            <tr class="align-top">
                                <td>{{ ($tema->currentPage() - 1) * $tema->perPage() + $loop->iteration }}</td>
                                <td>{{ $item->tahunAjaran->tahun_ajaran_awal }}/{{ $item->tahunAjaran->tahun_ajaran_akhir }}</td>
                                <td>{{ $item->tahunAjaran->semester }}</td>
                                <td>{{ $item->dimensi }}</td>
                                <td>{{ $item->nama_tema }}</td>
                                <td class="d-flex gap-2 justify-content-center">
                                    <a href="{{ route('tema.show', $item->id_tema) }}" class="btn btn-outline-info" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('tema.edit', $item->id_tema) }}" class="btn btn-outline-success">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form id="myForm" action="{{ route('tema.destroy', $item->id_tema) }}" method="POST">
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
                                <td colspan="7" class="text-center">Data tema  belum tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            @else
                <h6 class="text-center">Data {{ $title }} belum ada!</h6>
            @endif
        </div>

        <div class="d-flex justify-content-between align-items-center my-3">
            <!-- Pagination Info -->
            <div>
                <p class="mb-0">
                    Menampilkan
                    <strong>{{ $tema->firstItem() }}</strong>
                    sampai
                    <strong>{{ $tema->lastItem() }}</strong>
                    dari total
                    <strong>{{ $tema->total() }}</strong>
                    data.
                </p>
                <p class="mb-0">
                    Halaman
                    <strong>{{ $tema->currentPage() }}</strong>
                    dari
                    <strong>{{ $tema->lastPage() }}</strong> halaman.
                </p>
            </div>

            <!-- Pagination Links -->
            <div>
                {{ $tema->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
