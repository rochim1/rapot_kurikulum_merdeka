@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    {{-- <h4 class="mb-md-0">Detail {{ $title }}</h4>
    <a href="{{ route('rapot.index') }}" class="btn btn-danger btn-icon-split">
        <span class="text"><i class="bi bi-arrow-left-short"></i> Kembali</span>
    </a> --}}
</div>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">Data {{ $title }}</h4>

    <div class="d-flex gap-3">
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#import"><i class="bi bi-folder-plus"></i>
            Import
        </button>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-1 fw-bold mt-2">Pilih Mapel:</div>
            <div class="col-md">
                <!-- Form -->
                <form action="{{ route('rapot_nilai.editOrCreate') }}" method="GET">
                    <select class="form-select @error('id_mata_pelajaran') is-invalid @enderror" 
                            name="id_mata_pelajaran" 
                            required 
                            onchange="this.form.submit()">
                        <option value="">Pilih Mata Pelajaran</option>
                        @foreach($mataPelajaran as $item_mata_pelajaran)
                            <option value="{{ $item_mata_pelajaran->id_mata_pelajaran }}" 
                                    {{ request('id_mata_pelajaran') == $item_mata_pelajaran->id_mata_pelajaran ? 'selected' : '' }}>
                                {{ $item_mata_pelajaran->kelompok }} - {{ $item_mata_pelajaran->nama_mata_pelajaran }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_mata_pelajaran')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </form>                
            </div>
        </div>
    </div>
</div>
<button type="submit" class="btn btn-primary">Simpan</button>
@endsection