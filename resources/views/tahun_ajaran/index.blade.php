@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">{{ $title }}</h4>

    <a href="{{ route('tahun_ajaran.create') }}" class="btn btn-primary btn-icon-split">
        <span class="text"><i class="bi bi-plus"></i> Tambah</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            @if (count($tahunAjaran))
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Tahun Ajaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tahunAjaran as $item_tahun_ajaran)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item_tahun_ajaran->nama_tahun_ajaran }}</td>
                                <td class="d-flex gap-2">
                                    <a href="{{ route('tahun_ajaran.edit', $item_tahun_ajaran->id_tahun_ajaran) }}" class="btn btn-outline-success">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form id="myForm" action="{{ route('tahun_ajaran.destroy', $item_tahun_ajaran->id_tahun_ajaran) }}" method="POST">
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
                <h6 class="text-center">Data Tahun Ajaran Belum Ada!</h6>
            @endif
        </div>
    </div>
</div>
@endsection
