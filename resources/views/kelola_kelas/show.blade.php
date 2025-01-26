@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">Detail {{ $title }}</h4>
    <a href="{{ route('siswa.index') }}" class="btn btn-danger btn-icon-split">
        <span class="text"><i class="bi bi-arrow-left-short"></i> Kembali</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>Foto</th>
                <td>
                    @if($siswa->foto)
                        <img src="{{ asset('storage/' . $siswa->foto) }}" class="border object-fit-cover " style="width: 75px; height: 95px;">  
                    @else
                        <img src="{{ asset('storage/no-image.png') }}" class="border object-fit-cover " style="width: 75px; height: 95px;"> 
                    @endif
                </td>
            </tr>
            <tr>
                <th>Nama</th>
                <td>{{ $siswa->nama }}</td>
            </tr>
            <tr>
                <th>NIS</th>
                <td>{{ $siswa->nis ?? '-' }}</td>
            </tr>
            <tr>
                <th>NISN</th>
                <td>{{ $siswa->nisn ?? '-' }}</td>
            </tr>
            <tr>
                <th>Tempat Lahir</th>
                <td>{{ $siswa->tempat_lahir ?? '-' }}</td>
            </tr>
            <tr>
                <th>Tanggal Lahir</th>
                <td>{{ $siswa->tanggal_lahir ? \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d M Y') : '-' }}</td>
            </tr>
            <tr>
                <th>Jenis Kelamin</th>
                <td>{{ $siswa->jk ?? '-' }}</td>
            </tr>
            <tr>
                <th>Agama</th>
                <td>{{ $siswa->agama ?? '-' }}</td>
            </tr>
            <tr>
                <th>Nama Ayah</th>
                <td>{{ $siswa->nama_ayah ?? '-' }}</td>
            </tr>
            <tr>
                <th>Nama Ibu</th>
                <td>{{ $siswa->nama_ibu ?? '-' }}</td>
            </tr>
            <tr>
                <th>No. Telepon Orang Tua</th>
                <td>{{ $siswa->no_telp_ortu ?? '-' }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $siswa->alamat ?? '-' }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ ucfirst($siswa->status) }}</td>
            </tr>
        </table>
    </div>
</div>
@endsection
