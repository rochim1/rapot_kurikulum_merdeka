@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">Detail {{ $title }}</h4>
    <a href="{{ route('rapot.index') }}" class="btn btn-danger btn-icon-split">
        <span class="text"><i class="bi bi-arrow-left-short"></i> Kembali</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="container mt-5">
  
            <div class="d-flex justify-content-between">
                <div>
                    <table class="table table-borderless mb-1">
                        <tbody>
                            <tr>
                                <td class="py-0">Nama</td>
                                <td class="py-0">: Ahmad Muhassin Syauqi</td>
                            </tr>
                            <tr>
                                <td class="py-0">NIS/NISN</td>
                                <td class="py-0">: 1921 / 3161810822</td>
                            </tr>
                            <tr>
                                <td class="py-0">Nama Sekolah</td>
                                <td class="py-0">: SD NEGERI KARANGANYAR</td>
                            </tr>
                            <tr>
                                <td class="py-0">Alamat</td>
                                <td class="py-0">: Jangkang</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <table class="table table-borderless mb-1 text-start">
                        <tbody>
                            <tr>
                                <td class="py-0">Kelas</td>
                                <td class="py-0">: Kelas 2</td>
                            </tr>
                            <tr>
                                <td class="py-0">Fase</td>
                                <td class="py-0">: A</td>
                            </tr>
                            <tr>
                                <td class="py-0">Semester</td>
                                <td class="py-0">: 2</td>
                            </tr>
                            <tr>
                                <td class="py-0">Tahun Pelajaran</td>
                                <td class="py-0">: 2023/2024</td>
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

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="container mt-5">
  
            <div class="d-flex justify-content-between">
                <div>
                    <table class="table table-borderless mb-1">
                        <tbody>
                            <tr>
                                <td class="py-0">Nama</td>
                                <td class="py-0">: Ahmad Muhassin Syauqi</td>
                            </tr>
                            <tr>
                                <td class="py-0">NIS/NISN</td>
                                <td class="py-0">: 1921 / 3161810822</td>
                            </tr>
                            <tr>
                                <td class="py-0">Nama Sekolah</td>
                                <td class="py-0">: SD NEGERI KARANGANYAR</td>
                            </tr>
                            <tr>
                                <td class="py-0">Alamat</td>
                                <td class="py-0">: Jangkang</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <table class="table table-borderless mb-1 text-start">
                        <tbody>
                            <tr>
                                <td class="py-0">Kelas</td>
                                <td class="py-0">: Kelas 2</td>
                            </tr>
                            <tr>
                                <td class="py-0">Fase</td>
                                <td class="py-0">: A</td>
                            </tr>
                            <tr>
                                <td class="py-0">Semester</td>
                                <td class="py-0">: 2</td>
                            </tr>
                            <tr>
                                <td class="py-0">Tahun Pelajaran</td>
                                <td class="py-0">: 2023/2024</td>
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
                    <tr>
                        <td class="text-center">1</td>
                        <td>Pramuka</td>
                        <td class="text-center">Baik</td>
                        <td>Ananda baik dalam mengikuti kegiatan pramuka.</td>
                    </tr>
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
                        <td class="text-center">1</td>
                    </tr>
                    <tr>
                        <td>Izin</td>
                        <td class="text-center">0</td>
                    </tr>
                    <tr>
                        <td>Tanpa Keterangan</td>
                        <td class="text-center">0</td>
                    </tr>
                </tbody>
            </table>
            
            <h6 class="mt-5">Catatan Wali Kelas</h6>
            <p class="border p-2">Tingkatkan konsentrasimu selama pembelajaran. Perhatikan ketika guru menjelaskan agar kamu lebih paham. Kurangi bermain dengan teman ketika pembelajaran berlangsung.Tingkatkan konsentrasimu selama pembelajaran. Perhatikan ketika guru menjelaskan agar kamu lebih paham. Kurangi bermain dengan teman ketika pembelajaran berlangsung.</p>
    
            <div class="mt-4 text-center">
                <p class="border p-2 fw-bold">Keterangan Kenaikan Kelas: Naik ke kelas III</p>
            </div>
            
            <div class="row mt-5 mx-3">
                <div class="d-flex justify-content-between w-100">
                    <div class="text-start">
                        <p class="m-0">Mengetahui,</p>
                        <p class="m-0">Orang Tua/Wali</p>
                        <br><br><br>
                        <p class="m-0">......................................</p>
                    </div>
            
                    <div class="">
                        <p class="m-0">Ngemplak, 21 Juni 2024</p>
                        <p class="m-0">Wali Kelas</p>
                        <br><br><br>
                        <p class="m-0 text-decoration-underline fw-bold">Pramestiara Yayang Nurainingtias, S.Pd.</p>
                        <p class="m-0">NIP. 199605242020122013</p>
                    </div>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-md-12 text-center">
                    <p class="m-0">Mengetahui,</p>
                    <p class="m-0">Kepala Sekolah</p>
                    <br><br><br>
                    <p class="m-0 text-decoration-underline fw-bold">Heru Gustanta</p>
                    <p class="m-0">NIP. 196408071989031015</p>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
