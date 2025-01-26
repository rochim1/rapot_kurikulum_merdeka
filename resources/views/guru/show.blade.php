@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">Profil Guru</h4>
    <a href="{{ route('data-guru') }}" class="btn btn-secondary btn-icon-split">
        <i class="bi bi-arrow-left"></i>
        <span class="text">Kembali</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header">
        <h5>{{ $guru->nama }} - Profil Guru</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th width="30%">Foto Guru</th>
                    <td class="text-center">
                        <img src="{{ asset('storage/' . $guru->foto) }}" alt="Foto Guru" class="img-thumbnail rounded" style="width: 150px; height: 150px; object-fit: cover;">
                    </td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $guru->user->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $guru->user->email }}</td>
                </tr>
                <tr>
                    <th>NIP</th>
                    <td>{{ $guru->nip }}</td>
                </tr>
                <tr>
                    <th>NRG</th>
                    <td>{{ $guru->nrg }}</td>
                </tr>
                <tr>
                    <th>Mata Pelajaran</th>
                    <td>{{ $guru->mata_pelajaran->nama_mata_pelajaran??'-' }}</td>
                </tr>
                <tr>
                    <th>Tempat Lahir</th>
                    <td>{{ $guru->tempat_lahir }}</td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td>{{ $guru->tgl_lahir ? \Carbon\Carbon::parse($guru->tgl_lahir)->format('d-m-Y') : '-' }}</td>
                </tr>
                <tr>
                    <th>Agama</th>
                    <td>{{ $guru->agama }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $guru->alamat }}</td>
                </tr>
                <tr>
                    <th>No. HP</th>
                    <td>{{ $guru->no_hp }}</td>
                </tr>
                <tr>
                    <th>Jabatan</th>
                    <td>{{ $guru->jabatan }}</td>
                </tr>
                <tr>
                    <th>Golongan</th>
                    <td>{{ $guru->golongan }}</td>
                </tr>
                <tr>
                    <th>TMT Awal</th>
                    <td>{{ $guru->tmt_awal ? \Carbon\Carbon::parse($guru->tmt_awal)->format('d-m-Y') : '-' }}</td>
                </tr>
                <tr>
                    <th>Pendidikan Terakhir</th>
                    <td>{{ $guru->pendidikan_terakhir }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        @if($guru->status == 'Aktif')
                            <span class="badge bg-success">{{ $guru->status }}</span>
                        @elseif($guru->status == 'Tidak Aktif')
                            <span class="badge bg-danger">{{ $guru->status }}</span>
                        @elseif($guru->status == 'Mutasi')
                            <span class="badge bg-warning">{{ $guru->status }}</span>
                        @elseif($guru->status == 'Wali Kelas')
                            <span class="badge bg-primary">{{ $guru->status }}</span>
                        @elseif($guru->status == 'Cuti')
                            <span class="badge bg-secondary">{{ $guru->status }}</span>
                        @else
                            <span class="badge bg-secondary">Tidak Diketahui</span>
                        @endif
                    </td>
                </tr>                
            </tbody>
        </table>
    </div>
</div>
@endsection
