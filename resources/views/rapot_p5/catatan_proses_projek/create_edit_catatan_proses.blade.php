@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">{{ $title }}</h4>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('rapot_p5_catatan_proses_projek.index') }}" method="GET">
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">
                    Pilih Kelompok
                </label>
                <div class="col-sm-10">
                    <select class="form-select @error('id_kelompok_projek') is-invalid @enderror" 
                        name="id_kelompok_projek" 
                        id="id_kelompok_projek" 
                        required
                        onchange="this.form.submit()"
                    >
                        <option value="">Pilih Kelompok</option>
                        @foreach ($kelompokProjek as $item)
                            <option value="{{ $item->id_kelompok_projek }}" {{ request('id_kelompok_projek') == $item->id_kelompok_projek ? 'selected' : '' }}>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_kelompok_projek')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">
                    Pilih Projek
                </label>
                <div class="col-sm-10">
                    <select class="form-select @error('id_kelompok_projek_data_projek') is-invalid @enderror" 
                        name="id_kelompok_projek_data_projek" 
                        id="id_kelompok_projek_data_projek" 
                        required
                        onchange="this.form.submit()"
                    >
                        <option value="">Pilih Projek</option>
                        @foreach ($kelompokProjekDataProjek as $item)
                            <option value="{{ $item->id_kelompok_projek_data_projek }}" 
                                    {{ request('id_kelompok_projek_data_projek') == $item->id_kelompok_projek_data_projek ? 'selected' : '' }}>
                                {{ $item->dataProjek->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_kelompok_projek_data_projek')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror        
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('rapot_p5_catatan_proses_projek.storeOrUpdate') }}" method="POST">
            @csrf
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Siswa</th>
                            <th>NIS/NISN</th>
                            <th>Catatan Rapot P5</th>
                        </tr>
                    </thead>
                    <tbody class="align-top">
                        @forelse($kelola_kelas as $kelola)
                            @foreach($kelola->siswa as $siswa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $siswa->nama }}</td>
                                    <td>
                                        {{ $siswa->nis }} / 
                                        @if ($siswa->nisn)
                                            {{ $siswa->nisn }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <input type="hidden" name="id_rapot[{{ $siswa->rapot->id_rapot ?? 'null' }}]" value="{{ optional($siswa->rapot)->id_rapot }}">
                                        <input type="hidden" name="id_kel_pro_data_pro[{{ $siswa->rapot->id_rapot ?? 'null' }}]" value="{{ $id_kelompok_projek_data_projek }}">
                                        <input type="text" class="form-control" name="catatan[{{ optional($siswa->rapot)->id_rapot ?? 'null' }}]" rows="3" 
                                            value="{{ isset($catatanProsesProjek[optional($siswa->rapot)->id_rapot]) ? $catatanProsesProjek[optional($siswa->rapot)->id_rapot]->catatan_proses_projek : '' }}"
                                        >
                                   
                                    </td>
                                </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-danger fw-bold py-3">Data {{ $title }} belum tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div>
</div>
@endsection
