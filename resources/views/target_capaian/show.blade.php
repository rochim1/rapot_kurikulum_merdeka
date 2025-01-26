@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">{{ $title }}</h4>
    <a href="{{ route('target_capaian.index') }}" class="btn btn-secondary btn-icon-split">
        <span class="text"><i class="bi bi-arrow-left-circle"></i> Kembali</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5>Dimensi</h5>
                <p>{{ $targetCapaian->dimensi ?? 'Tidak ada data' }}</p>
            </div>
            <div class="col-md-6">
                <h5>Elemen</h5>
                <p>{{ $targetCapaian->elemen ?? 'Tidak ada data' }}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h5>Sub Elemen</h5>
                <p>{{ $targetCapaian->sub_elemen ?? 'Tidak ada data' }}</p>
            </div>
            <div class="col-md-6">
                <h5>Capaian Akhir Fase</h5>
                <p>{{ $targetCapaian->capaian_akhir_fase ?? 'Tidak ada data' }}</p>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('target_capaian.edit', $targetCapaian->id_target_capaian) }}" class="btn btn-outline-warning">
                <i class="bi bi-pencil-square"></i> Edit
            </a>
        </div>
    </div>
</div>
@endsection
