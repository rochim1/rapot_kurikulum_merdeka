@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">Data {{ $title }}</h4>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="mb-4 row">
            <label for="inputPassword" class="col-sm-1 col-form-label">Download All</label>
            <div class="col-sm-4">
                <form action="{{ route('rapot_all') }}" target="_blank" method="POST">
                    @csrf
                    <select
                        class="form-select form-select"
                        name="download_all"
                        onchange="this.form.submit()">
                    >
                        <option selected>-Pilih Rapot-</option>
                        <option value="rapot_umum">Rapot Utama</option>
                        <option value="rapot_p5">Rapot P5</option>
                    </select>
                </form>
            </div>
        </div>

        <div class="table-responsive mb-3">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Siswa</th>
                        <th>NIS/NISN</th>
                        <th>Rapot Utama</th>
                        <th>Rapot P5</th>
                    </tr>
                </thead>
                <tbody class="align-top">
                    @forelse ($rapot as $itemRapot)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $itemRapot->siswa->nama }}</td>
                            <td>{{ $itemRapot->siswa->nis }} / {{ $itemRapot->siswa->nisn }}</td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('rapot_persiswa.show', $itemRapot->siswa->id_siswa) }}?btn=view" target="_blank" class="btn btn-secondary">
                                    <i class="bi bi-search">
                                        View
                                    </i>
                                </a>  
                                <a href="{{ route('rapot_persiswa.show', $itemRapot->siswa->id_siswa) }}?btn=download" class="btn btn-primary">
                                    <i class="bi bi-search">
                                        Download
                                    </i>
                                </a>
                            </td>
                            <td>
                                <a href="" class="btn btn-secondary">
                                    <i class="bi bi-search">
                                        View
                                    </i>
                                </a>
                                <a href="" class="btn btn-primary">
                                    <i class="bi bi-download">
                                        Download
                                    </i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center">Tidak ada data guru.</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
