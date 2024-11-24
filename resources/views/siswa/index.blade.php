@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">{{ $title }}</h4>

    <div class="d-flex gap-3">
        <a href="#" class="btn btn-info btn-icon-split">
            <i class="bi bi-folder-plus"></i></i></i> Import</span>
        </a>
        <a href="{{ route('siswa.create') }}" class="btn btn-primary btn-icon-split">
            <span class="text"><i class="bi bi-plus"></i></i> Tambah</span>
        </a>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            @if (count($siswa))
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>NIS</th>
                            <th>NISN</th>
                            <th>Jenis Kelamin</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($siswa as $item_siswa)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if($item_siswa->foto)
                                        <img src="{{ asset('storage/' . $item_siswa->foto) }}" alt="Foto {{ $item_siswa->nama }}" class="border object-fit-cover " style="width: 75px; height: 95px;">
                                    @else
                                        <img src="{{ asset('storage/no-image.png') }}" alt="Default Foto" class="border object-fit-cover " style="width: 75px; height: 95px;">
                                    @endif
                                </td>
                                <td>{{ $item_siswa->nama }}</td>
                                <td>{{ $item_siswa->nis }}</td>
                                <td>{{ $item_siswa->nisn ?? '-' }}</td>
                                <td>{{ $item_siswa->jk }}</td>
                                <td>
                                    @if($item_siswa->status == 'active')
                                        <span class="badge bg-success">Active</span>
                                    @elseif($item_siswa->status == 'berhenti')
                                        <span class="badge bg-danger">Berhenti</span>
                                    @elseif($item_siswa->status == 'mutasi')
                                        <span class="badge bg-warning text-dark">Mutasi</span>
                                    @else
                                        <span class="badge bg-secondary">Pensiun</span>
                                    @endif
                                </td>
                                <td class="d-flex gap-2">
                                    <a href="{{ route('siswa.show', $item_siswa->id_siswa) }}" class="btn btn-outline-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('siswa.edit', $item_siswa->id_siswa) }}" class="btn btn-outline-success">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form id="myForm" action="{{ route('siswa.destroy', $item_siswa->id_siswa) }}" method="POST">
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
                                <td colspan="8" class="text-center">Data siswa belum tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            @else
                <h6 class="text-center">Data {{ $title }} Belum Ada!</h6>
            @endif
        </div>
    </div>
</div>
@endsection
