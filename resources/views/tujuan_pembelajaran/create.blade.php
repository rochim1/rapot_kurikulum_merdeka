@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">Tambah Tujuan Pembelajaran</h4>
    <a href="{{ route('tujuan_pembelajaran.index') }}" class="btn btn-danger btn-icon-split">
        <span class="text"><i class="bi bi-arrow-left-short"></i> Kembali</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('tujuan_pembelajaran.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="id_mata_pelajaran" class="form-label">Mata Pelajaran<span class="text-danger fs-5">*</span></label>
                <select class="form-select @error('id_mata_pelajaran') is-invalid @enderror" id="id_mata_pelajaran" name="id_mata_pelajaran" required>
                    <option value="">Pilih Mata Pelajaran</option>
                    @foreach($mataPelajaran as $item_mata_pelajaran)
                        <option value="{{ $item_mata_pelajaran->id_mata_pelajaran }}" {{ old('id_mata_pelajaran') == $item_mata_pelajaran->id_mata_pelajaran ? 'selected' : '' }}>
                            {{ $item_mata_pelajaran->kelompok }} - {{ $item_mata_pelajaran->nama_mata_pelajaran }}
                        </option>
                    @endforeach
                </select>
                @error('id_mata_pelajaran')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tujuan_pembelajaran" class="form-label">Tujuan Pembelajaran<span class="text-danger fs-5">*</span></label>
                <textarea class="form-control @error('tujuan_pembelajaran') is-invalid @enderror" id="tujuan_pembelajaran" name="tujuan_pembelajaran" rows="4" required>{{ old('tujuan_pembelajaran') }}</textarea>
                @error('tujuan_pembelajaran')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection
