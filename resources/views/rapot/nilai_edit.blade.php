        @extends('layouts.app')

        @section('content')
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                {{-- <h4 class="mb-md-0">Detail {{ $title }}</h4>
            <a href="{{ route('rapot.index') }}" class="btn btn-danger btn-icon-split">
                <span class="text"><i class="bi bi-arrow-left-short"></i> Kembali</span>
            </a> --}}
            </div>

            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h4 class="mb-md-0">Data {{ $title }}</h4>

                <div class="d-flex gap-3">
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#import"><i
                            class="bi bi-folder-plus"></i>
                        Import
                    </button>
                </div>
            </div>

            <!-- Form Select Mata Pelajaran -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1 fw-bold mt-2">Pilih Mapel:</div>
                        <div class="col-md">
                            <!-- Form untuk memilih mata pelajaran -->
                            <form action="{{ route('rapot_nilai.index') }}" method="GET">
                                <select class="form-select @error('id_mata_pelajaran') is-invalid @enderror"
                                    name="id_mata_pelajaran" required onchange="this.form.submit()">
                                    <option value="">Pilih Mata Pelajaran</option>
                                    @foreach ($mataPelajaran as $item_mata_pelajaran)
                                        <option value="{{ $item_mata_pelajaran->id_mata_pelajaran }}"
                                            {{ request('id_mata_pelajaran') == $item_mata_pelajaran->id_mata_pelajaran ? 'selected' : '' }}>
                                            {{ $item_mata_pelajaran->kelompok }} -
                                            {{ $item_mata_pelajaran->nama_mata_pelajaran }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_mata_pelajaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Data Siswa dan Tujuan Pembelajaran -->
            @if ($tujuan_pembelajaran->isNotEmpty())
                <form action="{{ route('rapot_nilai.storeOrUpdate') }}" method="POST">
                    @csrf
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Siswa</th>
                                            <th>NIS/NISN</th>
                                            <th>Nilai</th>
                                            <th>Tujuan Pembelajaran Tercapai</th>
                                            <th>Tujuan Pembelajaran Tidak Tercapai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kelola_kelas as $kelola)
                                            @foreach ($kelola->siswa as $siswa)
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
                                                    <td width="12%">
                                                        <input type="hidden" name="id_siswa[{{ $siswa->id_siswa }}]"
                                                            value="{{ $siswa->id_siswa }}">
                                                        <input type="hidden"
                                                            name="id_mata_pelajaran[{{ $siswa->id_siswa }}]"
                                                            value="{{ $id_mata_pelajaran }}">
                                                        <input min="0" max="100" type="number"
                                                            class="form-control" name="nilai_akhir[{{ $siswa->id_siswa }}]"
                                                            value="0" placeholder="0-100">
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            @foreach ($tujuan_pembelajaran as $tujuan)
                                                                <input class="form-check-input tujuan-tercapai"
                                                                    type="checkbox"
                                                                    name="tujuan_tercapai[{{ $siswa->id_siswa }}][]"
                                                                    value="{{ $tujuan->id_tujuan_pembelajaran }}"
                                                                    id="tujuan_tercapai_{{ $siswa->id_siswa }}_{{ $tujuan->id_tujuan_pembelajaran }}"
                                                                    data-siswa="{{ $siswa->id_siswa }}"
                                                                    data-tujuan="{{ $tujuan->id_tujuan_pembelajaran }}"
                                                                    onchange="toggleCheckbox(this, 'tercapai')">
                                                                <label class="form-check-label"
                                                                    for="tujuan_tercapai_{{ $siswa->id_siswa }}_{{ $tujuan->id_tujuan_pembelajaran }}">
                                                                    {{ $tujuan->tujuan_pembelajaran_tercapai }}
                                                                </label>
                                                                <br>
                                                            @endforeach
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="form-check">
                                                            @foreach ($tujuan_pembelajaran as $tujuan)
                                                                <input class="form-check-input tujuan-tidak-tercapai"
                                                                    type="checkbox"
                                                                    name="tujuan_tidak_tercapai[{{ $siswa->id_siswa }}][]"
                                                                    value="{{ $tujuan->id_tujuan_pembelajaran }}"
                                                                    id="tujuan_tidak_tercapai_{{ $siswa->id_siswa }}_{{ $tujuan->id_tujuan_pembelajaran }}"
                                                                    data-siswa="{{ $siswa->id_siswa }}"
                                                                    data-tujuan="{{ $tujuan->id_tujuan_pembelajaran }}"
                                                                    onchange="toggleCheckbox(this, 'tidak_tercapai')">
                                                                <label class="form-check-label"
                                                                    for="tujuan_tidak_tercapai_{{ $siswa->id_siswa }}_{{ $tujuan->id_tujuan_pembelajaran }}">
                                                                    {{ $tujuan->tujuan_pembelajaran_tidak_tercapai }}
                                                                </label>
                                                                <br>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Tombol Simpan -->
                    <button type="submit" class="btn btn-primary">Simpan</button>

                    @foreach ($rapot_nilai as $rapot)
                        <h3>{{ $rapot->siswa->nama }}</h3>
                        @foreach ($rapot->rapotNilai as $nilai)
                            <p>Nilai Akhir: {{ $nilai->nilai_akhir }}</p>
                            <p>Tujuan Pembelajaran Tercapai:</p>
                            <ul>
                                {{$nilai}}
                                @if (!empty($nilai->tujuan_tercapai_detail) && is_array($nilai->tujuan_tercapai_detail))
                                    @foreach ($nilai->tujuan_tercapai_detail as $tujuan)
                                        <li>1{{ $tujuan }}</li>
                                    @endforeach
                                @else
                                    <p>Tujuan tercapai tidak tersedia.</p>
                                @endif

                            </ul>
                        @endforeach
                    @endforeach
                </form>
            @endif

        @endsection


        @push('script')
            <script>
                function toggleCheckbox(checkbox, type) {
                    const siswaId = checkbox.dataset.siswa;
                    const tujuanId = checkbox.dataset.tujuan;

                    // Seleksi semua checkbox dengan tujuan yang sama
                    const allCheckboxes = document.querySelectorAll(`[data-tujuan="${tujuanId}"]`);

                    if (type === 'tercapai') {
                        const tidakTercapaiCheckbox = document.querySelector(`#tujuan_tidak_tercapai_${siswaId}_${tujuanId}`);

                        if (checkbox.checked) {
                            // Nonaktifkan dan kosongkan "tidak tercapai" checkbox
                            tidakTercapaiCheckbox.disabled = true;
                            tidakTercapaiCheckbox.checked = false;

                            // Checklist tujuan yang sama untuk semua siswa
                            allCheckboxes.forEach(cb => {
                                if (cb.classList.contains('tujuan-tercapai')) {
                                    cb.checked = true;
                                    const relatedTidakTercapaiCheckbox = document.querySelector(
                                        `#tujuan_tidak_tercapai_${cb.dataset.siswa}_${tujuanId}`);
                                    relatedTidakTercapaiCheckbox.disabled = true;
                                    relatedTidakTercapaiCheckbox.checked = false;
                                }
                            });
                        } else {
                            tidakTercapaiCheckbox.disabled = false;
                        }
                    } else if (type === 'tidak_tercapai') {
                        const tercapaiCheckbox = document.querySelector(`#tujuan_tercapai_${siswaId}_${tujuanId}`);

                        if (checkbox.checked) {
                            // Nonaktifkan dan kosongkan "tercapai" checkbox
                            tercapaiCheckbox.disabled = true;
                            tercapaiCheckbox.checked = false;

                            // Uncheck tujuan yang sama untuk semua siswa
                            allCheckboxes.forEach(cb => {
                                if (cb.classList.contains('tujuan-tercapai')) {
                                    cb.checked = false;
                                    const relatedTidakTercapaiCheckbox = document.querySelector(
                                        `#tujuan_tidak_tercapai_${cb.dataset.siswa}_${tujuanId}`);
                                    relatedTidakTercapaiCheckbox.disabled = false;
                                }
                            });
                        } else {
                            tercapaiCheckbox.disabled = false;
                        }
                    }
                }
            </script>
        @endpush
