@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">Data {{ $title }}</h4>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('rapot_catatan_wali_kelas.storeOrUpdate') }}" method="POST">
            @csrf
            <div class="table-responsive mb-3">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Siswa</th>
                            <th>NIS/NISN</th>
                            <th>Catatan Wali Kelas</th>
                        </tr>
                    </thead>
                    <tbody class="align-top">
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
                                        <input type="hidden" name="id_siswa[{{ $siswa->id_siswa }}]" value="{{ $siswa->id_siswa }}">
                                        <input type="text" class="form-control" name="catatan[{{ $siswa->id_siswa }}]" rows="3"
                                            @if($siswa->rapot && is_object($siswa->rapot) && isset($siswa->rapot->catatan_wali_kelas))
                                                value="{{ $siswa->rapot->catatan_wali_kelas }}"
                                            @endif
                                        >
                                        </input>                                        
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
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection
