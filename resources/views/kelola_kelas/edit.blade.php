<form action="{{ route('kelas.store') }}" method="POST">
    @csrf
    <!-- Dropdown Pilih Tahun Ajaran -->
    <div class="mb-3">
        <label for="id_tahun_ajaran" class="form-label">Tahun Ajaran</label>
        <select class="form-select select2 @error('id_tahun_ajaran') is-invalid @enderror" id="id_tahun_ajaran" name="id_tahun_ajaran">
            <option value="">Pilih Tahun Ajaran</option>
            @foreach($tahunAjaran as $item_tahun)
                <option value="{{ $item_tahun->id_tahun_ajaran }}" {{ old('id_tahun_ajaran') == $item_tahun->id_tahun_ajaran ? 'selected' : '' }}>
                    {{ $item_tahun->tahun_ajaran_awal }}/{{ $item_tahun->tahun_ajaran_akhir }} - {{ $item_tahun->semester }}
                </option>
            @endforeach
        </select>
        @error('id_tahun_ajaran')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Dropdown Pilih Guru -->
    <div class="mb-3">
        <label for="id_guru" class="form-label">Guru</label>
        <select class="form-select select2 @error('id_guru') is-invalid @enderror" id="id_guru" name="id_guru">
            <option value="">Pilih Guru</option>
            @foreach($guru as $item_guru)
                <option value="{{ $item_guru->id_guru }}" {{ old('id_guru') == $item_guru->id_guru ? 'selected' : '' }}>
                    {{ $item_guru->nama }}
                </option>
            @endforeach
        </select>
        @error('id_guru')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Dropdown Pilih Kelas -->
    <div class="mb-3">
        <label for="id_kelas" class="form-label">Pilih Kelas Baru</label>
        <select class="form-select select2 @error('id_kelas') is-invalid @enderror" id="id_kelas" name="id_kelas">
            <option value="">Pilih Kelas</option>
            @foreach($kelas as $item_kelas)
                <option value="{{ $item_kelas->id_kelas }}" {{ old('id_kelas') == $item_kelas->id_kelas ? 'selected' : '' }}>
                    {{ $item_kelas->kelas_tingkatan }}.{{ $item_kelas->kelas_abjad }} - {{ $item_kelas->fase }}
                </option>
            @endforeach
        </select>
        @error('id_kelas')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Daftar Siswa (Dinamis Berdasarkan Kelas) -->
    <div id="siswa_list" class="row">
        <!-- Daftar siswa akan diisi menggunakan AJAX -->
    </div>

    <!-- Tombol Simpan -->
    <button type="submit" class="btn btn-primary mt-4">Simpan</button>
</form>
