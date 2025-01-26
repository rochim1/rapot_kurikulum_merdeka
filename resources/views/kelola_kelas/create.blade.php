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
            <form id="createKelolaKelas_form" action="{{ route('kelola_kelas.create') }}" method="GET" class="mb-0">
                @csrf

                <!-- Guru -->
                <div class="mb-3">
                    <label for="id_guru" class="form-label">Guru Walas<span class="text-danger">*</span></label>
                    <select class="form-select @error('id_guru') is-invalid @enderror" id="id_guru" name="id_guru"
                        required>
                        <option value="">Pilih Guru</option>
                        @foreach ($guru as $item_guru)
                            <option value="{{ $item_guru->id_guru }}"
                                {{ old('id_guru', request('id_guru')) == $item_guru->id_guru ? 'selected' : '' }}>
                                {{ $item_guru->user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_guru')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h5>Kelas Tujuan</h5>
                        <div class="mb-3">
                            <label for="id_tahun_ajaran_tujuan" class="form-label">Tahun Ajaran <span
                                    class="text-danger">*</span></label>
                            <select class="form-select select2 @error('id_tahun_ajaran_tujuan') is-invalid @enderror"
                                id="id_tahun_ajaran_tujuan" name="id_tahun_ajaran_tujuan" required>
                                <option value="">Pilih Tahun Ajaran</option>
                                @foreach ($tahunAjaran as $item_tahun)
                                    <option value="{{ $item_tahun->id_tahun_ajaran }}"
                                        {{ old('id_tahun_ajaran_tujuan', request('id_tahun_ajaran_tujuan')) == $item_tahun->id_tahun_ajaran ? 'selected' : '' }}>
                                        {{ $item_tahun->tahun_ajaran_awal }}/{{ $item_tahun->tahun_ajaran_akhir }} -
                                        {{ $item_tahun->semester }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_tahun_ajaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="id_kelas_tujuan" class="form-label">Kelas Tujuan <span
                                    class="text-danger">*</span></label>
                            <select class="form-select @error('id_kelas_tujuan') is-invalid @enderror" id="id_kelas_tujuan"
                                name="id_kelas_tujuan" required>
                                <option value="">Pilih Kelas Tujuan</option>
                                @foreach ($kelas as $item_kelas)
                                    <option value="{{ $item_kelas->id_kelas }}"
                                        {{ request('id_kelas_tujuan') == $item_kelas->id_kelas ? 'selected' : '' }}>
                                        {{ $item_kelas->kelas_tingkatan }} - {{ $item_kelas->kelas_abjad }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_kelas_tujuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <hr>
                <label for="">filter siswa</label>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="id_tahun_ajaran" class="form-label">Tahun Ajaran</label>
                            <select class="form-select select2 @error('id_tahun_ajaran') is-invalid @enderror"
                                id="id_tahun_ajaran" name="id_tahun_ajaran">
                                <option value="">Pilih Tahun Ajaran</option>
                                @foreach ($tahunAjaran as $item_tahun)
                                    <option value="{{ $item_tahun->id_tahun_ajaran }}"
                                        {{ old('id_tahun_ajaran', request('id_tahun_ajaran')) == $item_tahun->id_tahun_ajaran ? 'selected' : '' }}>
                                        {{ $item_tahun->tahun_ajaran_awal }}/{{ $item_tahun->tahun_ajaran_akhir }} -
                                        {{ $item_tahun->semester }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_tahun_ajaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="id_kelas" class="form-label">pilih kelas <span class="text-danger">*</span></label>
                            <div class="row">
                                <div class="col-md-8">
                                    <select class="form-select @error('id_kelas') is-invalid @enderror" id="id_kelas"
                                        name="id_kelas" required>
                                        <option value="">Pilih Kelas</option>
                                        <option value="not_registered"
                                            {{ request('id_kelas') === 'not_registered' ? 'selected' : '' }}>Siswa yang
                                            Belum Terdaftar</option>
                                        @foreach ($kelas as $item_kelas)
                                            <option value="{{ $item_kelas->id_kelas }}"
                                                {{ request('id_kelas') == $item_kelas->id_kelas ? 'selected' : '' }}>
                                                {{ $item_kelas->kelas_tingkatan }} - {{ $item_kelas->kelas_abjad }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-success inline-text">Pilih Siswa</button>
                                </div>
                            </div>
                            @error('id_kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="daftar_id_siswa" class="form-label">
                        Pilih Siswa<span class="text-danger fs-5">*</span>
                    </label>
                    @if (!empty($siswa))
                        <div id="list_siswa" class="border p-3" style="max-height: 300px; overflow-y: auto;">
                            <div class="row">
                                @foreach ($siswa as $s)
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input siswa-checkbox"
                                                value="{{ $s->id_siswa }}" name="id_siswa[]"
                                                {{ in_array($s->id_siswa, session('selected_students', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label ms-2">{{ $s->nama }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="w-100 bg-secondary text-white p-2 rounded text-center">Tidak ada data siswa</div>
                    @endif
                </div>

                <!-- Hidden input for unselected students -->
                <input type="hidden" class="unselected_students" name="unselected_students" value="">
                <button type="submit" name="submit_action" value="true" class="btn btn-primary">Simpan</button>
            </form>

            <!-- Form untuk Menyimpan Data -->
            {{-- <form action="{{ route('kelola_kelas.store') }}" method="POST" class="mt-0">
                @csrf

                <!-- Include hidden inputs for the first form's data -->
                <input type="hidden" name="id_guru" value="{{ request('id_guru') }}">
                <input type="hidden" name="id_tahun_ajaran" value="{{ request('id_tahun_ajaran') }}">
                <input type="hidden" name="id_tahun_ajaran_tujuan" value="{{ request('id_tahun_ajaran_tujuan') }}">
                <input type="hidden" name="id_kelas" value="{{ request('id_kelas') }}">
                <input type="hidden" name="id_kelas_tujuan" value="{{ request('id_kelas_tujuan') }}">
                <input type="hidden" class="unselected_students" name="unselected_students" value="">
                <input type="hidden" name="id_siswa[]" value="{{ implode(',', request('id_siswa', [])) }}">

                <!-- List Siswa with Checkboxes -->


                <!-- Submit Button -->
                
            </form> --}}

        </div>
    </div>

@endsection

@push('upper_script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('createKelolaKelas_form');
            if (form) {
                form.addEventListener('submit', function(event) {
                    // Collect all student checkboxes
                    const allCheckboxes = document.querySelectorAll('.siswa-checkbox');
                    const unselectedStudents = [];

                    // Debugging: Check if checkboxes are being selected
                    console.log(`Total checkboxes: ${allCheckboxes.length}`);

                    // Find unchecked students
                    allCheckboxes.forEach(checkbox => {
                        if (!checkbox.checked) {
                            unselectedStudents.push(checkbox.value);
                        }
                    });

                    // Debugging: Check unselected students
                    console.log('Unselected students:', unselectedStudents);

                    // Set the hidden input's value
                    const hiddenInput = document.querySelector(
                    '.unselected_students'); // Fix: document.querySelector, not getElementByClass
                    if (hiddenInput) {
                        hiddenInput.value = JSON.stringify(
                        unselectedStudents); // Setting value as JSON string
                    } else {
                        console.error('Hidden input .unselected_students not found.');
                    }
                });

            } else {
                console.error('Form #createKelolaKelas_form not found.');
            }
        });
    </script>
@endpush
