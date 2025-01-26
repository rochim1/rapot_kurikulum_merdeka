@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">{{ $title }}</h4>
    <a href="{{ route('kelompok_projek.index') }}" class="btn btn-secondary btn-icon-split">
        <span class="text"><i class="bi bi-arrow-left-circle"></i> Kembali</span>
    </a>
</div>

<!-- Card pertama: Data Kelompok Projek -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Kelompok</label>
            <p>{{ $kelompokProjek->nama }}</p>
        </div>

        <div class="mb-3">
            <label for="kelas_tingkatan" class="form-label">Kelas</label>
            <p>{{ $kelompokProjek->tahunAjaran->tahun_ajaran_awal }}/{{ $kelompokProjek->tahunAjaran->tahun_ajaran_akhir }} - {{ $kelompokProjek->tahunAjaran->semester }}</p>
        </div>

        <div class="mb-3">
            <label for="kelas_tingkatan" class="form-label">Kelas</label>
            <p>{{ $kelompokProjek->kelas->kelas_tingkatan }}.{{ $kelompokProjek->kelas->kelas_abjad }}</p>
        </div>

        <div class="mb-3">
            <label for="deskripsi_kelompok" class="form-label">Koordinator</label>
            <p>{{ $kelompokProjek->user->name }}</p>
        </div>
    </div>
</div>

<!-- Card kedua: Data Kelompok Projek Data Projek -->
<div class="card shadow mb-4">
    <div class="card-body">
        <h4 class="">Tabel Data Projek</h4>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">
            <i class="bi bi-plus"></i> Add
        </button>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Dimensi</th>
                    <th>Nama Projek</th>
                    <th>Deskripsi</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kelompokProjekDataProjek as $item)
                    <tr class="align-top">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->dataProjek->tema }}</td>
                        <td>{{ $item->dataProjek->nama }}</td>
                        <td>{{ $item->dataProjek->deskripsi }}</td>
                        <td>
                            <form id="myForm" action="{{ route('kelompok_projek_data_projek.destroy', $item->id_kelompok_projek_data_projek) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <input type="hidden" name="id_kelompok_projek" value="{{ $kelompokProjek->id_kelompok_projek }}">
                                <button type="submit" class="btn btn-outline-danger" id="btn_delete">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Data target capaian belum tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal add -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Data Target Capaian</h5>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tema</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kelompokProjekList as $item)
                            <tr class="align-top">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->tema }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>
                                    <form action="{{ route('kelompok_projek_data_projek.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id_kelompok_projek" value="{{ $kelompokProjek->id_kelompok_projek }}">
                                        <input type="hidden" name="id_data_projek" value="{{ $item->id_data_projek }}">
                                        <button type="submit" class="btn btn-outline-secondary">
                                            <i class="bi bi-plus"></i> Add
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Data target capaian belum tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
