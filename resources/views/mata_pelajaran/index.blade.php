@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">{{ $title }}</h4>

    <a href="{{ route('mata_pelajaran.create') }}" class="btn btn-primary btn-icon-split">
        <span class="text"><i class="bi bi-plus"></i> Tambah</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            @if (count($mataPelajaran))
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mata Pelajaran</th>
                            <th>Kelompok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mataPelajaran as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_mata_pelajaran }}</td>
                                <td>{{ $item->kelompok }}</td>
                                <td class="d-flex gap-2">
                                    <a href="{{ route('mata_pelajaran.edit', $item->id_mata_pelajaran) }}" class="btn btn-outline-success">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form id="myForm" action="{{ route('mata_pelajaran.destroy', $item->id_mata_pelajaran) }}" method="POST">
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
                <h6 class="text-center">Data Mata Pelajaran belum tersedia.</h6>
            @endif
        </div>
    </div>
</div>
@endsection
