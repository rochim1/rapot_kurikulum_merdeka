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
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Siswa</th>
                        <th>NIS/NISN</th>
                        <th>Nilai</th>
                        <th>Tercapai</th>
                        <th>Tidak Tercapai</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kelola_kelas as $kelola)
                        @foreach($kelola->siswa as $siswa)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $siswa->nama }}</td>
                                <td>
                                    {{ $siswa->nis }} / 
                                    @if ($siswa->nisn)
                                        {{ $siswa->nisn }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="" />
                                        <label class="form-check-label" for="">Mampu Menjelaskan PHP</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="" />
                                        <label class="form-check-label" for=""> Peseserta Didik Mampu Menjelaskan PHP </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="" />
                                        <label class="form-check-label" for="">Tidak Menjelaskan PHP</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="" />
                                        <label class="form-check-label" for=""> Peseserta Didik Tidak Mampu Menjelaskan PHP</label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-danger fw-bold py-3">Data {{ $title }} belum tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary">Simpan</button>
@endsection