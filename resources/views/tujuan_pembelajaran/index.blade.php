@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">{{ $title }}</h4>

    <a href="{{ route('tujuan_pembelajaran.create') }}" class="btn btn-primary btn-icon-split">
        <span class="text"><i class="bi bi-plus"></i> Tambah</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            @if (count($tujuanPembelajaran))
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kelompok</th>
                            <th>Mata Pelajaran</th>
                            <th>Kelas</th>
                            <th>Tujuan Pembelajaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tujuanPembelajaran as $item_tujuan_pembelajaran)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item_tujuan_pembelajaran->mataPelajaran->kelompok }}</td>
                                <td>{{ $item_tujuan_pembelajaran->mataPelajaran->nama_mata_pelajaran }}</td>
                                <td>{{ $item_tujuan_pembelajaran->kelas->kelas_tingkatan }}.{{ $item_tujuan_pembelajaran->kelas->kelas_abjad }}</td>
                                <td>{{ Str::limit($item_tujuan_pembelajaran->tujuan_pembelajaran, 50, '...') }}</td>
                                <td>
                                    <form action="{{ route('tujuan_pembelajaran_is_active', $item_tujuan_pembelajaran->id_tujuan_pembelajaran) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-check form-switch mb-2">
                                            <input 
                                                class="form-check-input" 
                                                type="checkbox" 
                                                id="flexSwitchCheckChecked-{{ $item_tujuan_pembelajaran->id_tujuan_pembelajaran }}" 
                                                name="is_active" 
                                                onchange="this.form.submit()" 
                                                {{ $item_tujuan_pembelajaran->is_active ? 'checked' : '' }}>
                                            <label class="form-check-label" for="flexSwitchCheckChecked-{{ $item_tujuan_pembelajaran->id_tujuan_pembelajaran }}">
                                                {{ $item_tujuan_pembelajaran->is_active ? 'Aktif' : 'Nonaktif' }}
                                            </label>
                                        </div>
                                    </form>
                                </td>
                                <td class="d-flex gap-2">
                                    <a href="{{ route('tujuan_pembelajaran.edit', $item_tujuan_pembelajaran->id_tujuan_pembelajaran) }}" class="btn btn-outline-success">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form id="myForm" action="{{ route('tujuan_pembelajaran.destroy', $item_tujuan_pembelajaran->id_tujuan_pembelajaran) }}" method="POST">
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
                                <td colspan="6" class="text-center">Data Tujuan Pembelajaran belum tersedia.</td>
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
