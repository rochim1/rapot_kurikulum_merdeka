@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">Tambah {{ $title }}</h4>
    <a href="{{ route('kelola_kelas.index') }}" class="btn btn-danger btn-icon-split">
        <span class="text"><i class="bi bi-arrow-left-short"></i> Kembali</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <!-- Form untuk memilih Tahun Ajaran dan Guru -->
        <form action="{{ route('kelola_kelas.create') }}" method="GET">
            @csrf

            <div class="mb-3">
                <label for="id_tahun_ajaran" class="form-label">Tahun Ajaran</label>
                <select class="form-select select2 @error('id_tahun_ajaran') is-invalid @enderror" id="id_tahun_ajaran" name="id_tahun_ajaran">
                    <option value="">Pilih Tahun Ajaran</option>
                    @foreach($tahunAjaran as $item_tahun)
                        <option value="{{ $item_tahun->id_tahun_ajaran }}" 
                            {{ old('id_tahun_ajaran', request('id_tahun_ajaran')) == $item_tahun->id_tahun_ajaran ? 'selected' : '' }}>
                            {{ $item_tahun->tahun_ajaran_awal }}/{{ $item_tahun->tahun_ajaran_akhir }} - {{ $item_tahun->semester }}
                        </option>
                    @endforeach
                </select>
                @error('id_tahun_ajaran')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="id_guru" class="form-label">Guru<span class="text-danger fs-5">*</span></label>
                <select class="form-select" id="id_guru" name="id_guru" required>
                    <option value="">Pilih Guru</option>
                    @foreach ($guru as $item_guru)
                        <option value="{{ $item_guru->id_guru }}" {{ old('id_guru', request('id_guru')) == $item_guru->id_guru ? 'selected' : '' }}>
                            {{ $item_guru->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="id_kelas" class="form-label">Kelas<span class="text-danger fs-5">*</span></label>
                <select class="form-select" id="id_kelas" name="id_kelas" required onchange="this.form.submit()">
                    <option value="">Pilih Kelas</option>
                    <option value="not_registered" {{ request('id_kelas') === 'not_registered' ? 'selected' : '' }}>
                        Siswa yang Belum Terdaftar
                    </option>
                    @foreach ($kelas as $item_kelas)
                        <option value="{{ $item_kelas->id_kelas }}" {{ request('id_kelas') == $item_kelas->id_kelas ? 'selected' : '' }}>
                            {{ $item_kelas->kelas_tingkatan }} - {{ $item_kelas->kelas_abjad }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        <!-- List Siswa dengan Checkbox -->
        @if (!empty($siswa))
            <form action="{{ route('kelola_kelas.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="daftar_id_siswa" class="form-label">Pilih Siswa<span class="text-danger fs-5">*</span></label>
                    <div id="list_siswa" class="border p-3" style="max-height: 300px; overflow-y: auto;">
                        <div class="row">
                            @foreach ($siswa as $s)
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" value="{{ $s->id_siswa }}" name="id_siswa[]">
                                        <label class="form-check-label ms-2">{{ $s->nama }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
            
            <button type="submit" class="btn btn-primary">Simpan</button>
        @endif
    </div>
</div>
@endsection
