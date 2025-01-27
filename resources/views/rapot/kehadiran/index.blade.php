@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-md-0">Data {{ $title }}</h4>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('rapot_kehadiran.storeOrUpdate') }}" method="POST">
                <div class="table-responsive mb-3">
                    @csrf
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Siswa</th>
                                <th>NIS/NISN</th>
                                <th>Sakit</th>
                                <th>Izin</th>
                                <th>Tanpa Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kelola_kelas as $kelola)
                                @foreach ($kelola->siswa as $siswa)
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
                                            <input type="hidden" name="id_siswa[{{ $siswa->id_siswa }}]"
                                                value="{{ $siswa->id_siswa }}">
                                            <input type="number" class="form-control" name="sakit[{{ $siswa->id_siswa }}]"
                                                value="{{ $siswa->rapot->sakit ?? 0 }}" min="0" />
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="izin[{{ $siswa->id_siswa }}]"
                                                value="{{ $siswa->rapot->izin ?? 0 }}" min="0" />
                                        </td>
                                        <td>
                                            <input type="number" class="form-control"
                                                name="tanpa_keterangan[{{ $siswa->id_siswa }}]"
                                                value="{{ $siswa->rapot->tanpa_keterangan ?? 0 }}" min="0" />
                                        </td>
                                    </tr>
                                @endforeach
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-danger fw-bold py-3">Data
                                        {{ $title }} belum tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
