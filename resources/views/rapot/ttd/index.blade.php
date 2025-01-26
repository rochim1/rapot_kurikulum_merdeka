@extends('layouts.app')

@section('content')
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
        <form action="{{ route('rapot_ttd.storeOrUpdate') }}" method="POST">
            @csrf
            <div class="mb-3">
                @foreach($kelola_kelas as $kelola)
                    @foreach($kelola->siswa as $siswa)
                    <input type="hidden" name="id_siswa[{{ $siswa->id_siswa }}]" value="{{ $siswa->id_siswa }}">
                    @endforeach
                @endforeach
                <label for="ttd_tempat_tanggal_rapot" class="form-label">TTD Tempat Tanggal Rapot</label>
                <input
                    type="text"
                    class="form-control"
                    name="ttd_tempat_tanggal_rapot"
                    value="{{ old('ttd_tempat_tanggal_rapot', $ttd_tempat_tanggal_rapot ?? '') }}"
                    placeholder="Tempat, Tanggal Bulan Tahun"
                />
            </div>
            
            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div>
</div>
@endsection
