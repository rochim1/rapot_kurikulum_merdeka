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

    
@forelse ($rapot as $itemRapot)
    <div class="">

        {{-- Nilai --}}
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="container mt-5">
        
                    <div class="d-flex justify-content-between">
                        <div>
                            <table class="table table-borderless mb-1">
                                <tbody>
                                    <tr>
                                        <td class="py-0">Nama</td>
                                        <td class="py-0">: {{ $itemRapot->siswa->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-0">NIS/NISN</td>
                                        <td class="py-0">: {{ $itemRapot->siswa->nis }} / {{ $itemRapot->siswa->nisn }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-0">Nama Sekolah</td>
                                        <td class="py-0">: {{ $profilSekolah->nama_sekolah }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-0">Alamat</td>
                                        <td class="py-0">: {{ $profilSekolah->alamat }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <table class="table table-borderless mb-1 text-start">
                                <tbody>
                                    <tr>
                                        <td class="py-0">Kelas</td>
                                        <td class="py-0">: {{ $itemRapot->kelas->kelas_tingkatan }}.{{ $itemRapot->kelas->kelas_abjad }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-0">Fase</td>
                                        <td class="py-0">: {{ $itemRapot->kelas->fase }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-0">Semester</td>
                                        <td class="py-0">: {{ $itemRapot->tahunAjaran->semester }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-0">Tahun Pelajaran</td>
                                        <td class="py-0">: {{ $itemRapot->tahunAjaran->tahun_ajaran_awal }}/{{ $itemRapot->tahunAjaran->tahun_ajaran_akhir }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="text-center my-4">
                        <h5 class="text-dark">LAPORAN HASIL BELAJAR</h5>
                    </div>   

                    <table class="table table-bordered mb-4">
                        <thead class="table-secondary">
                            <tr class="text-center">
                                <th>No</th>
                                <th>Mata Pelajaran</th>
                                <th>Nilai Akhir</th>
                                <th>Capaian Kompetensi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-light">
                                <td colspan="4" class="text-start fw-bold small">Kelompok A</td>
                            </tr>
                            <tr>
                                <td class="text-center">1</td>
                                <td>Pendidikan Agama Islam dan Budi Pekerti</td>
                                <td class="text-center">76</td>
                                <td>
                                    <p>Mencapai Kompetensi dengan sangat baik dalam hal Menerapkan sikap akhlak terpuji (Gaya Hidup Bersih, Gaya Hidup Rapi dan Gaya Hidup Teratur)</p>
                                    <p class="mb-n1">Perlu peningkatan dalam hal Mengetahui bacaan Zikir dan Doa setelah sholat.</p>
                                </td>
                            </tr>

                            <tr class="table-light">
                                <td colspan="4" class="text-start fw-bold small">Kelompok B</td>
                            </tr>
                            <tr>
                                <td class="text-center">1</td>
                                <td>Pendidikan Agama Islam dan Budi Pekerti</td>
                                <td class="text-center">76</td>
                                <td>
                                    <p>Mencapai Kompetensi dengan sangat baik dalam hal Menerapkan sikap akhlak terpuji (Gaya Hidup Bersih, Gaya Hidup Rapi dan Gaya Hidup Teratur)</p>
                                    <p class="mb-n1">Perlu peningkatan dalam hal Mengetahui bacaan Zikir dan Doa setelah sholat.</p>
                                </td>
                            </tr>

                            <tr class="table-light">
                                <td colspan="4" class="text-start fw-bold small">Kelompok C</td>
                            </tr>
                            <tr>
                                <td class="text-center">1</td>
                                <td>Pendidikan Agama Islam dan Budi Pekerti</td>
                                <td class="text-center">76</td>
                                <td>
                                    <p>Mencapai Kompetensi dengan sangat baik dalam hal Menerapkan sikap akhlak terpuji (Gaya Hidup Bersih, Gaya Hidup Rapi dan Gaya Hidup Teratur)</p>
                                    <p class="mb-n1">Perlu peningkatan dalam hal Mengetahui bacaan Zikir dan Doa setelah sholat.</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Eskul dan Kehadiran --}}
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="container mt-5">
        
                    <div class="d-flex justify-content-between">
                        <div>
                            <table class="table table-borderless mb-1">
                                <tbody>
                                    <tr>
                                        <td class="py-0">Nama</td>
                                        <td class="py-0">: {{ $itemRapot->siswa->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-0">NIS/NISN</td>
                                        <td class="py-0">: {{ $itemRapot->siswa->nis }} / {{ $itemRapot->siswa->nisn }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-0">Nama Sekolah</td>
                                        <td class="py-0">: {{ $profilSekolah->nama_sekolah }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-0">Alamat</td>
                                        <td class="py-0">: {{ $profilSekolah->alamat }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <table class="table table-borderless mb-1 text-start">
                                <tbody>
                                    <tr>
                                        <td class="py-0">Kelas</td>
                                        <td class="py-0">: {{ $itemRapot->kelas->kelas_tingkatan }}.{{ $itemRapot->kelas->kelas_abjad }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-0">Fase</td>
                                        <td class="py-0">: {{ $itemRapot->kelas->fase }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-0">Semester</td>
                                        <td class="py-0">: {{ $itemRapot->tahunAjaran->semester }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-0">Tahun Pelajaran</td>
                                        <td class="py-0">: {{ $itemRapot->tahunAjaran->tahun_ajaran_awal }}/{{ $itemRapot->tahunAjaran->tahun_ajaran_akhir }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <h6 class="mt-5">Ektakurikuler</h6>
                    <table class="table table-bordered my-4">
                        <thead class="table-secondary">
                            <tr class="text-center">
                                <th>No</th>
                                <th>Kegiatan</th>
                                <th>Predikat</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($itemRapot->rapotEkstrakulikuler as $itemrapotEkstrakulikuler)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $itemrapotEkstrakulikuler->ekstrakulikuler->nama_ekstrakulikuler }}</td>
                                    <td class="text-center">{{ $itemrapotEkstrakulikuler->predikat_ekstrakulikuler }}</td>
                                    <td>{{ $itemrapotEkstrakulikuler->catatan_ekstrakulikuler }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h6 class="mt-5">Kehadiran</h6>
                    <table class="table table-bordered w-50">
                        <thead class="table-secondary text-center">
                            <tr>
                                <th>Keterangan</th>
                                <th>Jumlah Hari</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Sakit</td>
                                <td class="text-center">{{ $itemRapot->sakit }} Hari</td>
                            </tr>
                            <tr>
                                <td>Izin</td>
                                <td class="text-center">{{ $itemRapot->izin }} Hari</td>
                            </tr>
                            <tr>
                                <td>Tanpa Keterangan</td>
                                <td class="text-center">{{ $itemRapot->tanpa_keterangan }} Hari</td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <h6 class="mt-5">Catatan Wali Kelas</h6>
                    <p class="border p-2">{{ $itemRapot->catatan_wali_kelas }}</p>
            
                    @if ($itemRapot->ket_naik_kelas == true)
                        <div class="mt-4 text-center">
                            <p class="border p-2 fw-bold">Keterangan Kenaikan Kelas: ???</p>
                        </div>
                    @endif
                    
                    <div class="row mt-5 mx-3">
                        <div class="d-flex justify-content-between w-100">
                            <div class="text-start">
                                <p class="m-0">Mengetahui,</p>
                                <p class="m-0">Orang Tua/Wali</p>
                                <br><br><br>
                                <p class="m-0">......................................</p>
                            </div>
                    
                            <div class="">
                                <p class="m-0">{{ $itemRapot->ttd_tempat_tanggal_rapot }}</p>
                                <p class="m-0">Wali Kelas</p>
                                <br><br><br>
                                <p class="m-0 text-decoration-underline fw-bold">{{ $itemRapot->guru->nama }}</p>
                                <p class="m-0">NIP.{{ $itemRapot->guru->nip }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-md-12 text-center">
                            <p class="m-0">Mengetahui,</p>
                            <p class="m-0">Kepala Sekolah</p>
                            <br><br><br>
                            <p class="m-0 text-decoration-underline fw-bold">{{ $itemRapot->nama_kepsek }}</p>
                            <p class="m-0">NIP.{{ $itemRapot->nip_kepsek }}</p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="container">
                <div class="text-center text-danger fst-italic fw-bold">
                    Input data (Nilai / Kehadiran / Ekstrakulikuler / Catatan Wali Kelas) Terlebih Dahulu!
                </div>
            </div>
        </div>
    </div>
@endforelse
@endsection