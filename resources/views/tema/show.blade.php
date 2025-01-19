@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">Detail Tema</h4>
    <a href="{{ route('tema.index') }}" class="btn btn-danger btn-icon-split">
        <span class="text"><i class="bi bi-arrow-left-short"></i> Kembali</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <!-- Tahun Ajaran -->
        <div class="mb-3">
            <label for="id_tahun_ajaran" class="form-label">Tahun Ajaran</label>
            <p>{{ $tema->tahunAjaran->tahun_ajaran_awal }}/{{ $tema->tahunAjaran->tahun_ajaran_akhir }} - {{ $tema->tahunAjaran->semester }}</p>
        </div>

        <!-- Nama Tema -->
        <div class="mb-3">
            <label for="nama_tema" class="form-label">Nama Tema</label>
            <p>{{ $tema->nama_tema }}</p>
        </div>

        <!-- Deskripsi Tema -->
        <div class="mb-3">
            <label for="deskripsi_tema" class="form-label">Deskripsi Tema</label>
            <p>{{ $tema->deskripsi_tema }}</p>
        </div>

        <!-- Dimensi -->
        <div class="mb-3">
            <label for="dimensi" class="form-label">Dimensi</label>
            <p>{{ $tema->dimensi }}</p>
        </div>

        <!-- Deskripsi Dimensi -->
        <div class="mb-3">
            <label for="deskripsi_dimensi" class="form-label">Deskripsi Dimensi</label>
            <p>{{ $tema->deskripsi_dimensi }}</p>
        </div>
    </div>
</div>
@endsection
