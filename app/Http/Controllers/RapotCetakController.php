<?php

namespace App\Http\Controllers;

use App\Models\ProfilSekolah;
use App\Models\Rapot;
use App\Models\RapotP5CapaianProjek;
use App\Models\Siswa;
use App\Models\TujuanPembelajaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfParser\StreamReader;

class RapotCetakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rapot = Rapot::with('kelas', 'TahunAjaran', 'siswa', 'guru', 'rapotEkstrakulikuler.ekstrakulikuler', 'rapotNilai.mataPelajaran')
            ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
            ->where('id_guru', session('id_guru'))
            ->get();

        $title = 'Rapot';

        return view('rapot_cetak.index', compact('title', 'rapot'));
    }

    public function show($id, Request $request)
    {
        $rapot = Rapot::with('kelas', 'TahunAjaran', 'siswa', 'guru.user', 'rapotEkstrakulikuler.ekstrakulikuler', 'rapotNilai.mataPelajaran')
            ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
            ->where('id_guru', session('id_guru'))
            ->whereHas('siswa', function ($query) use ($id) {
                $query->where('id_siswa', $id);
            })
            ->get();

        if (!$rapot) {
            return redirect()->back()->with('error', 'Data rapot tidak ditemukan.');
        }

        if ($rapot) {
            // Iterasi setiap data rapot
            foreach ($rapot as $item) {
                // Periksa jika $item->rapot_nilai bukan null dan memiliki data
                foreach ($item->rapotNilai as $nilai) {

                    // Decode JSON tujuan_pembelajaran_tercapai
                    $tujuan_ids_tercapai = json_decode($nilai->tujuan_pembelajaran_tercapai);
                    $tujuan_ids_tidak_tercapai = json_decode($nilai->tujuan_pembelajaran_tidak_tercapai);

                    // Cek apakah tujuan_ids terkapai ada dan berupa array
                    if (is_array($tujuan_ids_tercapai)) {
                        // Ambil data tujuan pembelajaran berdasarkan ID yang ada
                        $nilai->tujuan_pembelajaran_tercapai_detail = TujuanPembelajaran::whereIn('id_tujuan_pembelajaran', $tujuan_ids_tercapai)->get();
                        // Convert to readable format (text) if needed
                        $nilai->tujuan_pembelajaran_tercapai_text = $nilai->tujuan_pembelajaran_tercapai_detail->pluck('tujuan_pembelajaran')->join(', ');
                    }

                    // Cek apakah tujuan_ids tidak tercapai ada dan berupa array
                    if (is_array($tujuan_ids_tidak_tercapai)) {
                        // Ambil data tujuan pembelajaran berdasarkan ID yang ada
                        $nilai->tujuan_pembelajaran_tidak_tercapai_detail = TujuanPembelajaran::whereIn('id_tujuan_pembelajaran', $tujuan_ids_tidak_tercapai)->get();
                        // Convert to readable format (text) if needed
                        $nilai->tujuan_pembelajaran_tidak_tercapai_text = $nilai->tujuan_pembelajaran_tidak_tercapai_detail->pluck('tujuan_pembelajaran')->join(', ');
                    }
                }
            }
        }

        $profilSekolah = ProfilSekolah::find(1);
        $nama_siswa = $rapot->first()->siswa->nama;

        $pdf = Pdf::loadView('rapot_cetak.cetak.view_persiswa', compact('rapot', 'profilSekolah', 'nama_siswa'))
            ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);

        if ($request->get('btn') == 'view') {
            return $pdf->stream('rapot kelas 1a.pdf');
        } else if ($request->get('btn') == 'download') {
            return $pdf->download('Rapot ' . $nama_siswa . '.pdf');
        }
    }

    public function mergePdfs($rapot, $profilSekolah)
    {
        // Create a new FPDI instance to merge PDFs
        $pdf = new Fpdi();

        // Loop through the rapot collection
        foreach ($rapot as $data) {
            // Prepare the view data
            $viewData = [
                'rapot' => [0 => $data],
                'profilSekolah' => $profilSekolah,
                'nama_siswa' => $data->nama_siswa ?? '' // Access 'nama_siswa' as a model property
            ];

            // Generate the current PDF from the view
            $pdfContent = Pdf::loadView('rapot_cetak.cetak.view_persiswa', $viewData)
                ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true])
                ->output(); // This will generate PDF content as a string

            // Create a StreamReader instance from the generated PDF content
            $streamReader = StreamReader::createByString($pdfContent);

            // Set the source file to the PDF content in memory
            $pageCount = $pdf->setSourceFile($streamReader);

            // Add each page from the generated PDF to the FPDI instance
            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                $pdf->AddPage();
                $templateId = $pdf->importPage($pageNo);
                $pdf->useTemplate($templateId);
            }
        }

        // Output the merged PDF
        return $pdf->Output('I', 'merged.pdf');
    }


    public function rapot_all(Request $request)
    {
        if ($request->download_all == 'rapot_umum') {
            $rapot = Rapot::with('kelas', 'TahunAjaran', 'siswa', 'guru.user', 'rapotEkstrakulikuler.ekstrakulikuler', 'rapotNilai.mataPelajaran')
                ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
                ->where('id_guru', session('id_guru'))
                ->get();

            if (!$rapot) {
                return redirect()->back()->with('error', 'Data rapot tidak ditemukan.');
            }

            if ($rapot) {
                // Iterasi setiap data rapot
                foreach ($rapot as $item) {
                    // Periksa jika $item->rapot_nilai bukan null dan memiliki data
                    foreach ($item->rapotNilai as $nilai) {

                        // Decode JSON tujuan_pembelajaran_tercapai
                        $tujuan_ids_tercapai = json_decode($nilai->tujuan_pembelajaran_tercapai);
                        $tujuan_ids_tidak_tercapai = json_decode($nilai->tujuan_pembelajaran_tidak_tercapai);

                        // Cek apakah tujuan_ids terkapai ada dan berupa array
                        if (is_array($tujuan_ids_tercapai)) {
                            // Ambil data tujuan pembelajaran berdasarkan ID yang ada
                            $nilai->tujuan_pembelajaran_tercapai_detail = TujuanPembelajaran::whereIn('id_tujuan_pembelajaran', $tujuan_ids_tercapai)->get();
                            // Convert to readable format (text) if needed
                            $nilai->tujuan_pembelajaran_tercapai_text = $nilai->tujuan_pembelajaran_tercapai_detail->pluck('tujuan_pembelajaran')->join(', ');
                        }

                        // Cek apakah tujuan_ids tidak tercapai ada dan berupa array
                        if (is_array($tujuan_ids_tidak_tercapai)) {
                            // Ambil data tujuan pembelajaran berdasarkan ID yang ada
                            $nilai->tujuan_pembelajaran_tidak_tercapai_detail = TujuanPembelajaran::whereIn('id_tujuan_pembelajaran', $tujuan_ids_tidak_tercapai)->get();
                            // Convert to readable format (text) if needed
                            $nilai->tujuan_pembelajaran_tidak_tercapai_text = $nilai->tujuan_pembelajaran_tidak_tercapai_detail->pluck('tujuan_pembelajaran')->join(', ');
                        }
                    }
                }
            }
            $profilSekolah = ProfilSekolah::find(1);
            $nama_siswa = 'Kelas ' . $rapot->first()->kelas->kelas_tingkatan . '.' . $rapot->first()->kelas->kelas_abjad;
            return $this->mergePdfs($rapot, $profilSekolah);

            // $pdf = Pdf::loadView('rapot_cetak.cetak.view_persiswa', compact('rapot', 'profilSekolah', 'nama_siswa'))
            //     ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);
            // return $pdf->stream('rapot kelas 1a.pdf');
        } else if ($request->download_all == 'rapot_p5') {
            $rapot = Rapot::with(['kelas', 'TahunAjaran', 'siswa', 'guru.user', 'RapotP5CapaianProjek.KelompokProjekDataProjek.dataProjek', 'RapotP5CatatanProsesProjek'])
                ->where('id_tahun_ajaran', session('id_tahun_ajaran'))
                ->where('id_guru', session('id_guru'))
                ->paginate(1);

            $profilSekolah = ProfilSekolah::find(1);
            $nama_siswa = 'P5';
            $pdf = Pdf::loadView('rapot_cetak.cetak_p5.view_persiswa', compact('rapot', 'profilSekolah', 'nama_siswa'))
                ->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);


            return $rapot;
            return $pdf->stream('rapot kelas 1a.pdf');
        }
    }
}
