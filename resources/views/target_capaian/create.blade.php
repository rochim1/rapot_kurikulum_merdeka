@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">{{ $title }} - Tambah Data</h4>
    <a href="{{ route('target_capaian.index') }}" class="btn btn-secondary btn-icon-split">
        <span class="text"><i class="bi bi-arrow-left-circle"></i> Kembali</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('target_capaian.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="dimensi" class="form-label">Dimensi</label>
                <textarea name="dimensi" id="dimensi" class="form-control @error('dimensi') is-invalid @enderror" rows="3">{{ old('dimensi') }}</textarea>
                @error('dimensi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="elemen" class="form-label">Elemen</label>
                <textarea name="elemen" id="elemen" class="form-control @error('elemen') is-invalid @enderror" rows="3">{{ old('elemen') }}</textarea>
                @error('elemen')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="sub_elemen" class="form-label">Sub Elemen</label>
                <textarea name="sub_elemen" id="sub_elemen" class="form-control @error('sub_elemen') is-invalid @enderror" rows="3">{{ old('sub_elemen') }}</textarea>
                @error('sub_elemen')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="capaian_akhir_fase" class="form-label">Capaian Akhir Fase</label>
                <textarea name="capaian_akhir_fase" id="capaian_akhir_fase" class="form-control @error('capaian_akhir_fase') is-invalid @enderror" rows="3">{{ old('capaian_akhir_fase') }}</textarea>
                @error('capaian_akhir_fase')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Tambah Data Capaian</button>
            </div>
        </form>
    </div>
</div>
@endsection
