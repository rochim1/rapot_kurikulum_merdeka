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
        <form action="{{ route('rapot_ekstrakulikuler.storeOrUpdate') }}" method="POST">
            @csrf
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Siswa</th>
                            <th>NIS/NISN</th>
                            <th>Nama Ekstrakulikuler</th>
                            <th>Predikat</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>
                    <tbody class="align-top">
                        @foreach($kelola_kelas as $kelola)
                            @foreach($kelola->siswa as $siswa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $siswa->nama }}</td>
                                    <td>{{ $siswa->nis }} / {{ $siswa->nisn ?? '-' }}</td>
                                    <td>
                                        <input type="hidden" name="id_siswa[{{ $siswa->id_siswa }}]" value="{{ $siswa->id_siswa }}">
                                        @foreach($ekstrakulikuler as $ekskul)
                                            <input type="text" class="form-control mb-1 bg-white" 
                                                name="id_ekstrakulikuler[{{ $siswa->id_siswa }}][{{ $ekskul->id_ekstrakulikuler }}]" 
                                                value="{{ $ekskul->nama_ekstrakulikuler }}" readonly>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($ekstrakulikuler as $ekskul)
                                            @php
                                                $predikat = optional($siswa->ekstrakulikuler->firstWhere('id_ekstrakulikuler', $ekskul->id_ekstrakulikuler))->predikat_ekstrakulikuler;
                                            @endphp
                                            <select class="form-control mb-1" name="predikat_ekstrakulikuler[{{ $siswa->id_siswa }}][{{ $ekskul->id_ekstrakulikuler }}]">
                                                <option value="" class="text-center">-Pilih Predikat-</option>
                                                <option value="Amat Baik" {{ $predikat === 'Amat Baik' ? 'selected' : '' }}>Amat Baik</option>
                                                <option value="Baik" {{ $predikat === 'Baik' ? 'selected' : '' }}>Baik</option>
                                                <option value="Cukup" {{ $predikat === 'Cukup' ? 'selected' : '' }}>Cukup</option>
                                                <option value="Sedang" {{ $predikat === 'Sedang' ? 'selected' : '' }}>Sedang</option>
                                            </select>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($ekstrakulikuler as $ekskul)
                                            <input type="text" class="form-control mb-1" 
                                                name="catatan_ekstrakulikuler[{{ $siswa->id_siswa }}][{{ $ekskul->id_ekstrakulikuler }}]" 
                                                value="{{ optional($siswa->ekstrakulikuler->firstWhere('id_ekstrakulikuler', $ekskul->id_ekstrakulikuler))->catatan_ekstrakulikuler }}" />
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection
