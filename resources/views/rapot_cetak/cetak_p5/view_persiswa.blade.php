<!DOCTYPE html>
<html>
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rapot {{ $nama_siswa ?? '-' }}</title>
    <style>
        <style>
        @page {
            margin: 50px;
        }

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
        }

        .footer span {
            margin-right: 10px;
        }

        .footer::after {
            content: "Halaman " counter(page);
            font-weight: bold;
        }
    </style>
</head>
<body>

@php
    $noHal = 1; // Initialize $noHal
    $noBefore = null; // Initialize previous student name
@endphp

@foreach ($rapot as $itemRapot)
<div>

    <div class="">
        <h3 style="text-align: center;">RAPOR PROJEK PENGUATAN PROFIL PELAJAR PANCASILA</h3>

        <table style="width: 100%; border-bottom: 1px solid #000;">
            <tr>
                <td style="width:50%; padding: 10px;">
                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 10px;">
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
                <td style="width:50%; padding: 10px;">
                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 10px; text-align: start;">
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
    </div>

    <div class="ty-5">
        <div>Projek 1 | {{ $itemRapot->RapotP5CatatanProsesProjek->kelompokProjekDataProjek->dataProjek->nama }}</div>
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
                    <p style="margin: 0; text-decoration: underline; font-weight: bold;">{{ $itemRapot->guru->user->name }}</p>
                    <p style="margin: 0;">NIP.{{ $itemRapot->guru->nip }}</p>
                </td>
            </tr>
        </table>
        
        <div style="margin-top: 20px;">
            <div style="text-align: center;">
                <p style="margin: 0;">Mengetahui,</p>
                <p style="margin: 0;">Kepala Sekolah</p>
                <br><br><br>
                <p style="margin: 0; text-decoration: underline; font-weight: bold;">{{ $itemRapot->nama_kepsek }}</p>
                <p style="margin: 0;">NIP.{{ $itemRapot->nip_kepsek }}</p>
            </div>
        </div>        
    </div>

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
</div>
@endforeach
    
</body>
</html>
