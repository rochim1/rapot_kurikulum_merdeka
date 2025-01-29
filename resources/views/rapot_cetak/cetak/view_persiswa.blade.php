<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $nama_siswa ?? '-' }}</title>
    <style>
        body {
            counter-reset: page;
        }

        .footer {
            position: fixed;
            bottom: 10px;
            width: 100%;
            text-align: center;
            font-size: 12px;
            display: flex;
            justify-content: center;
            background-color: #fff;
            z-index: 10;
        }

        .footer span {
            margin-right: 10px;
        }

        .footer::after {
            content: "Halaman " counter(page);
            font-weight: bold;
        }

        @page {
            margin: 150px 15mm !important;
        }

        header {
            position: fixed;
            top: -100px;
            left: 0;
            right: 0;
            border-bottom: 1px solid #000;
            background-color: #fff;
            z-index: 10;
        }

        .page-break {
            page-break-before: always;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    @php
        $noHal = 1;
        $previousStudent = null;
    @endphp

    @foreach ($rapot as $itemRapot)
        @if ($previousStudent !== null && $previousStudent !== $itemRapot->siswa->nama)
            <div class="page-break"></div> {{-- Force new page when student changes --}}
        @endif

        <header>
            <table class="header-table">
                <tr>
                    <td style="width:50%;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <tbody>
                                <tr>
                                    <td style="padding: 0;">Nama</td>
                                    <td style="padding: 0;">: {{ $itemRapot->siswa->nama }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0;">NIS/NISN</td>
                                    <td style="padding: 0;">: {{ $itemRapot->siswa->nis }} / {{ $itemRapot->siswa->nisn }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0;">Nama Sekolah</td>
                                    <td style="padding: 0;">: {{ $profilSekolah->nama_sekolah }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0;">Alamat</td>
                                    <td style="padding: 0;">: {{ $profilSekolah->alamat }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td style="width:50%;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <tbody>
                                <tr>
                                    <td style="padding: 0;">Kelas</td>
                                    <td style="padding: 0;">: {{ $itemRapot->kelas->kelas_tingkatan }}.{{ $itemRapot->kelas->kelas_abjad }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0;">Fase</td>
                                    <td style="padding: 0;">: {{ $itemRapot->kelas->fase }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0;">Semester</td>
                                    <td style="padding: 0;">: {{ $itemRapot->tahunAjaran->semester }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0;">Tahun Pelajaran</td>
                                    <td style="padding: 0;">: {{ $itemRapot->tahunAjaran->tahun_ajaran_awal }}/{{ $itemRapot->tahunAjaran->tahun_ajaran_akhir }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
        </header>

        <div style="content">
            <div style="text-align: center; margin-bottom: 1.5rem;">
                <h4>LAPORAN HASIL BELAJAR</h4>
            </div>

            <div>
                <table style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
                    <thead style="background-color: #f0f5ff;">
                        <tr style="text-align: center;">
                            <th style="padding: 8px; border: 1px solid #000;">No</th>
                            <th style="padding: 8px; border: 1px solid #000;">Mata Pelajaran</th>
                            <th style="padding: 8px; border: 1px solid #000;">Nilai Akhir</th>
                            <th style="padding: 8px; border: 1px solid #000;">Capaian Kompetensi</th>
                        </tr>
                    </thead>
                    <tbody style="vertical-align: top;">
                        @php
                            $kelompokSebelumnya = null;
                            $nomorUrut = 0;
                        @endphp
                        @foreach ($itemRapot->rapotNilai as $rapotNilai)
                            @if ($rapotNilai->mataPelajaran->kelompok != $kelompokSebelumnya)
                                @php
                                    $kelompokSebelumnya = $rapotNilai->mataPelajaran->kelompok;
                                    $nomorUrut = 1;
                                @endphp
                                <tr style="background-color: #e9ecef;">
                                    <td colspan="4" style="padding: 8px; font-weight: bold; border: 1px solid #000;">
                                        Kelompok {{ $rapotNilai->mataPelajaran->kelompok }}
                                    </td>
                                </tr>
                            @else
                                @php
                                    $nomorUrut++;
                                @endphp
                            @endif
                            <tr>
                                <td style="text-align: center; padding: 8px; border: 1px solid #000;">{{ $nomorUrut }}</td>
                                <td style="padding: 8px; border: 1px solid #000;">{{ $rapotNilai->mataPelajaran->nama_mata_pelajaran }}</td>
                                <td style="text-align: center; padding: 8px; border: 1px solid #000;">{{ $rapotNilai->nilai_akhir }}</td>
                                <td style="padding: 8px; border: 1px solid #000;">{{ $rapotNilai->capaian_kompetensi }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div>
                <h4 style="margin: 25px 0px 10px 0px">Ektakurikuler</h4>
                <table style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
                    <thead style="background-color: #f0f5ff;">
                        <tr style="text-align: center;">
                            <th style="border: 1px solid #000; padding: 8px;">No</th>
                            <th style="border: 1px solid #000; padding: 8px;">Kegiatan</th>
                            <th style="border: 1px solid #000; padding: 8px;">Predikat</th>
                            <th style="border: 1px solid #000; padding: 8px;">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $counter = 1;
                        @endphp
                        @forelse ($itemRapot->rapotEkstrakulikuler as $itemrapotEkstrakulikuler)
                            <tr>
                                @if ($itemrapotEkstrakulikuler->predikat_ekstrakulikuler)
                                    <td
                                        style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: top;">
                                        {{ $counter++ }}
                                    </td>
                                    <td
                                        style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: top;">
                                        {{ $itemrapotEkstrakulikuler->ekstrakulikuler->nama_ekstrakulikuler }}
                                    </td>
                                    <td
                                        style="border: 1px solid #000; padding: 8px; text-align: center; vertical-align: top;">
                                        {{ $itemrapotEkstrakulikuler->predikat_ekstrakulikuler }}
                                    </td>
                                    <td style="border: 1px solid #000; padding: 8px; vertical-align: top;">
                                        {{ $itemrapotEkstrakulikuler->catatan_ekstrakulikuler }}
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr style="background-color: #f0f5ff; text-align: center;">
                                <td colspan="4" style="border: 1px solid #000; padding: 10px; font-style: italic;">
                                    Tidak ada data ekstrakurikuler</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
    
            <div>
                <h4 style="margin: 25px 0px 10px 0px">Kehadiran</h4>
                <table style="width: 50%; border: 1px solid #000; border-collapse: collapse;">
                    <thead style="background-color: #f0f5ff; text-align: center;">
                        <tr>
                            <th style="border: 1px solid #000; padding: 8px;">Keterangan</th>
                            <th style="border: 1px solid #000; padding: 8px;">Jumlah Hari</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="border: 1px solid #000; padding: 8px;">Sakit</td>
                            <td style="border: 1px solid #000; padding: 8px; text-align: center;">
                                @if ($itemRapot->sakit)
                                    {{ $itemRapot->sakit }} Hari
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 8px;">Izin</td>
                            <td style="border: 1px solid #000; padding: 8px; text-align: center;">
                                @if ($itemRapot->izin)
                                    {{ $itemRapot->izin }} Hari
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 8px;">Tanpa Keterangan</td>
                            <td style="border: 1px solid #000; padding: 8px; text-align: center;">
                                @if ($itemRapot->tanpa_keterangan)
                                    {{ $itemRapot->tanpa_keterangan }} Hari
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
    
            <div>
                <h4 style="margin: 25px 0px -5px 0px">Catatan Wali Kelas</h4>
                <p style="border: 1px solid #000; padding: 10px;">
                    {{ $itemRapot->catatan_wali_kelas }}
                </p>
            </div>
    
            <div>
                @php
                    $tahunAjaran = \App\Models\TahunAjaran::find(session('id_tahun_ajaran'));
                @endphp
                @if ($tahunAjaran->semester == 'Genap')
                    @if ($itemRapot->naik_kelas == true)
                        <div style="text-align: center;">
                            <p style="border: 1px solid #000; padding: 10px; font-weight: bold;">
                                Keterangan Kenaikan Kelas: {{ $itemRapot->naik_kelas }}
                            </p>
                        </div>
                    @endif
                @endif
            </div>
    
            <div>
                <table style="width: 100%;">
                    <tr>
                        <td>
                            <p style="margin: 0;">Mengetahui,</p>
                            <p style="margin: 0;">Orang Tua/Wali</p>
                            <br><br><br>
                            <p style="margin: 0;">......................................</p>
                        </td>
                        <td style="text-align: right;">
                            <p style="margin: 0;">
                                @if (!$itemRapot->ttd_tempat_tanggal_rapot)
                                    <span style="margin: 0;">..................................................</span>
                                @endif
                                {{ $itemRapot->ttd_tempat_tanggal_rapot }}
                            </p>
                            <p style="margin: 0;">Wali Kelas</p>
                            <br><br><br>
                            <p style="margin: 0; text-decoration: underline; font-weight: bold;">
                                {{ $itemRapot->guru->user->name }}</p>
                            <p style="margin: 0;">NIP.{{ $itemRapot->guru->nip }}</p>
                        </td>
                    </tr>
                </table>
    
                <div style="margin-top: 20px;">
                    <div style="text-align: center;">
                        <p style="margin: 0;">Mengetahui,</p>
                        <p style="margin: 0;">Kepala Sekolah</p>
                        <br><br><br>
                        <p style="margin: 0; text-decoration: underline; font-weight: bold;">
                            {{ $itemRapot->nama_kepsek }}</p>
                        <p style="margin: 0;">NIP.{{ $itemRapot->nip_kepsek }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <div style="border-bottom: 1px solid #000;"></div>
            <table style="width: 100%;">
                <tr style="font-style: italic; font-weight: bold;">
                    <td>
                        <p style="margin: 0;">
                            {{ $itemRapot->kelas->kelas_tingkatan }}.{{ $itemRapot->kelas->kelas_abjad }} /
                            {{ $itemRapot->siswa->nama }} / {{ $itemRapot->siswa->nis }} /
                            {{ $itemRapot->siswa->nisn }}</p>
                    </td>
                    <td style="text-align: right;">
                        <p style="margin: 0;">Halaman: {{ $noHal++ }}</p>
                    </td>
                </tr>
            </table>
        </div>

        @php
            $previousStudent = $itemRapot->siswa->nama;
        @endphp
    @endforeach

</body>

</html>
