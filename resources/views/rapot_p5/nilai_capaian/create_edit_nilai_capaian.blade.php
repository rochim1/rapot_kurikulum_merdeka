@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">{{ $title }}</h4>

    <div class="d-flex gap-3">
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#import"><i class="bi bi-folder-plus"></i>
            Import
        </button>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('rapot_p5_capaian_projek.index') }}" method="GET">
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Pilih Kelompok</label>
                <div class="col-sm-10">
                    <select class="form-select @error('id_kelompok_projek') is-invalid @enderror" 
                        name="id_kelompok_projek" 
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

            <!-- Dropdown Projek -->
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Pilih Projek</label>
                <div class="col-sm-10">
                    <select class="form-select @error('id_kelompok_projek_data_projek') is-invalid @enderror" 
                        name="id_kelompok_projek_data_projek" 
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

            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Pilih Dimensi Profil</label>
                <div class="col-sm-10">
                    <select class="form-select @error('id_target_capaian') is-invalid @enderror" 
                        name="id_target_capaian" 
                        required
                        onchange="this.form.submit()"
                    >
                        <option value="">Pilih Dimensi Profil</option>
                        @foreach ($dataProjekTargetCapaian as $item)
                            <option value="{{ $item->targetCapaian->id_target_capaian }}" 
                                {{ request('id_target_capaian') == $item->targetCapaian->id_target_capaian ? 'selected' : '' }}
                            >
                                {{ $item->targetCapaian->dimensi }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_data_projek_target_capaian')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror   
                </div>
            </div>
        </form>
    
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Pilih Elemen Profil</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" readonly value="{{ $targetCapaian->elemen }}">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Pilih Sub Elemen Profil</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" readonly value="{{ $targetCapaian->sub_elemen }}">
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('rapot_p5_capaian_projek.store') }}" method="POST">
            @csrf
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Siswa</th>
                            <th>NIS/NISN</th>
                            <th>Predikat</th>
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
                                        {{-- <input type="text" name="id_rapot[{{ $siswa->rapot->id_rapot ?? 'null' }}]" value="{{ optional($siswa->rapot)->id_rapot }}">
                                        <input type="text" name="id_kel_pro_data_pro[{{ $siswa->rapot->id_rapot ?? 'null' }}]" value="{{ $id_kelompok_projek_data_projek }}"> --}}
                                        <select
                                            class="form-select"
                                            name=""
                                        >
                                            <option value="">-Pilih Predikat-</option>
                                            <option value="">Mulai Berkembang</option>
                                            <option value="">Sedang Berkembang</option>
                                            <option value="">Berkembang Sesuai Berkembang</option>
                                            <option value="">Sangat Berkembang</option>
                                        </select>
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
