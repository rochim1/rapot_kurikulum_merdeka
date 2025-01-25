@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">{{ $title }}</h4>
    <a href="{{ route('data_projek.index') }}" class="btn btn-secondary btn-icon-split">
        <span class="text"><i class="bi bi-arrow-left-circle"></i> Kembali</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="mb-3">
            <label for="tema" class="form-label">Tema</label>
            <p>{{ $dataProjek->tema }}</p>
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <p>{{ $dataProjek->nama }}</p>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <p>{{ $dataProjek->deskripsi }}</p>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <h4 class="">Tabel Target Capaian</h4>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">
            <i class="bi bi-plus"></i>
            add
        </button>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Dimensi</th>
                    <th>Elemen</th>
                    <th>Sub Elemen</th>
                    <th>Capaian Akhir Fase</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dataProjekTargetCapaian as $item)
                    <tr class="align-top">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->targetCapaian->dimensi }}</td>
                        <td>{{ $item->targetCapaian->elemen }}</td>
                        <td>{{ Str::limit($item->targetCapaian->sub_elemen, 100, '...') }}</td>
                        <td>{{ Str::limit($item->targetCapaian->capaian_akhir_fase, 100, '...') }}</td>
                        <td>
                            <form id="myForm" action="{{ route('data_projek_target_capaian.destroy', $item->id_data_projek_target_capaian) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <input type="hidden" name="id_data_projek" value="{{ $item->id_data_projek }}">
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
                            <th>Dimensi</th>
                            <th>Elemen</th>
                            <th>Sub Elemen</th>
                            <th>Capaian Akhir Fase</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($targetCapaianList as $item)
                            <tr class="align-top">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->dimensi }}</td>
                                <td>{{ $item->elemen }}</td>
                                <td>{{ $item->sub_elemen }}</td>
                                <td>{{ $item->capaian_akhir_fase }}</td>
                                <td>
                                    <form action="{{ route('data_projek_target_capaian.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id_data_projek" value="{{ $dataProjek->id_data_projek }}">
                                        <input type="hidden" name="id_target_capaian" value="{{ $item->id_target_capaian }}">
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
