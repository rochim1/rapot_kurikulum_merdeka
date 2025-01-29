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

        .check-mark {
            width: 12px;
            height: 6px;
            border: solid rgb(0, 0, 0);
            border-width: 0 0 3px 3px;
            transform: rotate(-45deg);
            display: inline-block;
        }

    </style>
</head>
<body>

@php
    $noHal = 1; // Initialize $noHal
    $noBefore = null; // Initialize previous student name
@endphp

@foreach ($rapot as $itemRapot)
<h3 style="text-align: center;">RAPOR PROJEK PENGUATAN PROFIL PELAJAR PANCASILA</h3>

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


<div style="margin-top: 1rem; margin-bottom: 4rem;">
    @foreach ($itemRapot->RapotP5CapaianProjek as $item)
        <div style="font-weight: bold; margin-bottom: 5px;">Projek {{ $loop->iteration }} | {{ $item->KelompokProjekDataProjek->dataProjek->nama }}</div>
        <div style="">{{ $item->KelompokProjekDataProjek->dataProjek->deskripsi }}</div>
    @endforeach
</div>

<table style="width: 100%;">
    <tr>
        <td></td>
        <td style="text-align: right;">
            <p style="margin: 0;">
                @if (!$itemRapot->ttd_tempat_tanggal_rapot)
                    <span style="margin: 0;">..................................................</span>
                @endif
                {{ $itemRapot->ttd_tempat_tanggal_rapot }}
            </p>
            <p style="margin: 0;">Wali Kelas</p>
            <br><br><br>
            <p style="margin: 0; text-decoration: underline; font-weight: bold;">{{ $itemRapot->guru->user->name }}</p>
            <p style="margin: 0;">NIP.{{ $itemRapot->guru->nip }}</p>
        </td>
    </tr>
</table>

<div class="footer">
    <div style="border-bottom: 1px solid #000;"></div>
    <table style="width: 100%;">
        <tr style="font-style: italic; font-weight: bold;">
            <td>
                <p style="margin: 0;">{{ $itemRapot->kelas->kelas_tingkatan }}.{{ $itemRapot->kelas->kelas_abjad }} / {{ $itemRapot->siswa->nama }} / {{ $itemRapot->siswa->nis }} / {{ $itemRapot->siswa->nisn }}</p>
            </td>
            <td style="text-align: right;">
                <p style="margin: 0;">Halaman: {{ $noHal++ }}</p>
            </td>
        </tr>
    </table>
</div>

<div class="page-break"></div>

{{-- hal 2 --}}
@foreach ($itemRapot->RapotP5CapaianProjek as $itemRapotP5CapaianProjek)

<table style="width: 100%; border-collapse: collapse; border: 0px solid #000;">
    <thead>
        <tr>
            <th style="padding: 8px; text-align: left; border: 1px solid #000;">{{ $loop->iteration }} | {{ $itemRapotP5CapaianProjek->KelompokProjekDataProjek->dataProjek->nama }}</th>
            <th style="padding: 8px; text-align: center; border: 1px solid #000;">Mulai Berkembang</th>
            <th style="padding: 8px; text-align: center; border: 1px solid #000;">Sedang Berkembang</th>
            <th style="padding: 8px; text-align: center; border: 1px solid #000;">Berkembang Sesuai Harapan</th>
            <th style="padding: 8px; text-align: center; border: 1px solid #000;">Sangat Berkembang</th>
        </tr>
        
        @foreach ($itemRapotP5CapaianProjek->KelompokProjekDataProjek->dataProjek->dataProjekTargetCapaian as $itemdataProjekTargetCapaian)
            <tr>
                <td colspan="5" style="padding: 8px; text-align: left; border: 1px solid #000; font-weight: bold">{{ $itemdataProjekTargetCapaian->targetCapaian->dimensi }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; text-align: left; border: 1px solid #000;">{{ $itemdataProjekTargetCapaian->targetCapaian->capaian_akhir_fase }}</td>
                <td style="padding: 8px; text-align: center; border: 1px solid #000;">
                    @if ($itemRapotP5CapaianProjek->predikat == "Mulai Berkembang")
                        <div class="check-mark"></div>
                    @endif
                </td>
                <td style="padding: 8px; text-align: center; border: 1px solid #000;">
                    @if ($itemRapotP5CapaianProjek->predikat == "Sedang Berkembang")
                        <div class="check-mark"></div>
                    @endif
                </td>
                <td style="padding: 8px; text-align: center; border: 1px solid #000;">
                    @if ($itemRapotP5CapaianProjek->predikat == "Berkembang Sesuai Harapan")
                        <div class="check-mark"></div>
                    @endif
                </td>
                <td style="padding: 8px; text-align: center; border: 1px solid #000;">
                    @if ($itemRapotP5CapaianProjek->predikat == "Sangat Berkembang")
                        <div class="check-mark"></div>
                    @endif
                </td>
            </tr>
        @endforeach
            <tr>
                <td colspan="5" style="border: 1px solid #000;">
                    <div style="padding: 8px; font-style: italic; margin-bottom: 0.5rem;">Catatan Proses</div>
                    @foreach ($itemRapot->rapotP5CatatanProsesProjek as $itemrapotP5CatatanProsesProjek)
                        <div style="padding: 8px; font-style: italic; margin-bottom: 0.5rem;">
                            {{ $itemrapotP5CatatanProsesProjek->catatan_proses_projek }}
                        </div>
                    @endforeach
                </td>
            </tr>
    </thead>
</table>

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

@endforeach


@endforeach
    
</body>
</html>
