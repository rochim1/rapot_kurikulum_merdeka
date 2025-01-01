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
        <form action="{{ route('rapot_catatan_wali_kelas.store') }}" method="POST">
            @csrf
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Siswa</th>
                            <th>NISN</th>
                            <th>Catatan Wali Kelas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kelola_kelas as $kelola)
                        <input type="text" name="id_kelas" value="{{ $kelola->id_kelola_kelas }}">
                        <input type="text" name="id_tahun_ajaran" value="{{ $kelola->id_tahun_ajaran }}">
                        <input type="text" name="semester" value="{{ $kelola->tahunAjaran->semester }}">
                            @foreach($kelola->siswa as $siswa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $siswa->nama }}</td>
                                    <td>{{ $siswa->nis }} / {{ $siswa->nisn }}</td>

                                    <td><input type="text" name="id_siswa[{{ $siswa->id_siswa }}]" value="{{ $siswa->id_siswa }}"></td>
                                    <td>
                                        <textarea class="form-control" name="catatan[{{ $siswa->id_siswa }}]" rows="3"></textarea>
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
            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div>
</div>
@endsection
