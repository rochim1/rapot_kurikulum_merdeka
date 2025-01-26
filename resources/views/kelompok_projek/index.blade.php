@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">{{ $title }}</h4>

    <a href="{{ route('kelompok_projek.create') }}" class="btn btn-primary btn-icon-split">
        <span class="text"><i class="bi bi-plus"></i> Tambah</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            @if (count($kelompokProjek))
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kelompok</th>
                            <th>Tahun Ajaran</th>
                            <th>Kelas</th>
                            <th>Koordinator</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kelompokProjek as $item_kelompok)
                            <tr>
                                <td>{{ ($kelompokProjek->currentPage() - 1) * $kelompokProjek->perPage() + $loop->iteration }}</td>
                                <td>{{ $item_kelompok->nama ?? 'N/A' }}</td>
                                <td>
                                    {{ $item_kelompok->tahunAjaran->tahun_ajaran_awal ?? 'N/A' }}/{{ $item_kelompok->tahunAjaran->tahun_ajaran_akhir ?? 'N/A' }}
                                    {{ $item_kelompok->tahunAjaran->semester ?? 'N/A' }}
                                </td>
                                <td>
                                    {{ $item_kelompok->kelas->kelas_tingkatan ?? 'N/A' }}.{{ $item_kelompok->kelas->kelas_abjad ?? 'N/A' }}
                                </td>
                                <td>{{ $item_kelompok->user->name ?? 'N/A' }}</td>
                                <td class="d-flex gap-2 justify-content-center">
                                    <a href="{{ route('kelompok_projek.show', $item_kelompok->id_kelompok_projek) }}" class="btn btn-outline-info" title="Lihat Profil">
                                        Data Projek
                                    </a>
                                    <a href="{{ route('kelompok_projek.edit', $item_kelompok->id_kelompok_projek) }}" class="btn btn-outline-success">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form id="myForm" action="{{ route('kelompok_projek.destroy', $item_kelompok->id_kelompok_projek) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger" id="btn_delete">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
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
                    <strong>{{ $kelompokProjek->firstItem() }}</strong>
                    sampai
                    <strong>{{ $kelompokProjek->lastItem() }}</strong>
                    dari total
                    <strong>{{ $kelompokProjek->total() }}</strong>
                    data.
                </p>
                <p class="mb-0">
                    Halaman
                    <strong>{{ $kelompokProjek->currentPage() }}</strong>
                    dari
                    <strong>{{ $kelompokProjek->lastPage() }}</strong> halaman.
                </p>
            </div>

            <!-- Pagination Links -->
            <div>
                {{ $kelompokProjek->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
