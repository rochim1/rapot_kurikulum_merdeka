{{-- resources/views/kelola_kelas/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">{{ $title }}</h4>

    <div class="d-flex gap-3">
        <a href="{{ route('kelola_kelas.create') }}" class="btn btn-primary btn-icon-split">
            <span class="text"><i class="bi bi-plus"></i> Tambah</span>
        </a>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tingkatan</th>
                        <th>Fase</th>
                        <th>Wali Kelas</th>
                        <th>Tahun Ajaran</th>
                        <th>Active</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kelolaKelas as $item_kelola_kelas)
                        <tr>
                            <td>{{ ($kelolaKelas->currentPage() - 1) * $kelolaKelas->perPage() + $loop->iteration }}</td>
                            <td>{{ $item_kelola_kelas->kelas->kelas_tingkatan }}.{{ $item_kelola_kelas->kelas->kelas_abjad }}</td>
                            <td>{{ $item_kelola_kelas->kelas->fase }}</td>
                            <td>{{ $item_kelola_kelas->guru->nama }}</td>
                            <td>{{ $item_kelola_kelas->tahunAjaran->tahun_ajaran_awal }}/{{ $item_kelola_kelas->tahunAjaran->tahun_ajaran_akhir }} - {{ $item_kelola_kelas->tahunAjaran->semester }}</td>
                            <td>
                                @if ($item_kelola_kelas->tahunAjaran->is_active)
                                    <span class="badge rounded-pill text-bg-success">Active</span>
                                @else
                                    <span class="badge rounded-pill text-bg-danger">Non Active</span>
                                @endif
                            </td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('kelola_kelas.edit', $item_kelola_kelas->id_kelola_kelas) }}" class="btn btn-outline-success">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                
                                <form action="{{ route('kelola_kelas.destroy', $item_kelola_kelas->id_kelola_kelas) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
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
                    <strong>{{ $kelolaKelas->firstItem() }}</strong>
                    sampai
                    <strong>{{ $kelolaKelas->lastItem() }}</strong>
                    dari total
                    <strong>{{ $kelolaKelas->total() }}</strong>
                    data.
                </p>
                <p class="mb-0">
                    Halaman
                    <strong>{{ $kelolaKelas->currentPage() }}</strong>
                    dari
                    <strong>{{ $kelolaKelas->lastPage() }}</strong>.
                </p>
            </div>

            <!-- Pagination Links -->
            <div>
                {{ $kelolaKelas->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
