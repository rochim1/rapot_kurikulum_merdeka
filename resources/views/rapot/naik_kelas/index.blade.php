@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">Data {{ $title }}</h4>

    <div class="d-flex gap-3">
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#import"><i class="bi bi-folder-plus"></i>
            Import
        </button>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('rapot_naik_kelas.storeOrUpdate') }}" method="POST">
            @csrf
            <div class="table-responsive">
                <div class="d-flex mb-3">
                    <label class="me-2 mt-2">Pilih Kelas All</label>
                    <select id="selectAll" class="form-control w-auto">
                        <option value="">- Pilih Predikat untuk Semua -</option>
                        <option value="Tinggal Kelas">Tinggal Kelas</option>
                        <option value="II">II</option>
                        <option value="III">III</option>
                        <option value="IV">IV</option>
                        <option value="V">V</option>
                        <option value="VI">VI</option>
                    </select>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Siswa</th>
                            <th>NIS/NISN</th>
                            <th>Naik Kelas</th>
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
                                        <input type="hidden" name="id_siswa[{{ $siswa->id_siswa }}]" value="{{ $siswa->id_siswa }}">
                                        <select class="form-control mb-1 naik-kelas" name="naik_kelas[{{ $siswa->id_siswa }}]">
                                            <option value="">- Pilih Predikat -</option>
                                            <option value="Tinggal Kelas" {{ $siswa->rapot && $siswa->rapot->naik_kelas === 'Tinggal Kelas' ? 'selected' : '' }}>Tinggal Kelas</option>
                                            <option value="II" {{ $siswa->rapot && $siswa->rapot->naik_kelas === 'II' ? 'selected' : '' }}>II</option>
                                            <option value="III" {{ $siswa->rapot && $siswa->rapot->naik_kelas === 'III' ? 'selected' : '' }}>III</option>
                                            <option value="IV" {{ $siswa->rapot && $siswa->rapot->naik_kelas === 'IV' ? 'selected' : '' }}>IV</option>
                                            <option value="V" {{ $siswa->rapot && $siswa->rapot->naik_kelas === 'V' ? 'selected' : '' }}>V</option>
                                            <option value="VI" {{ $siswa->rapot && $siswa->rapot->naik_kelas === 'VI' ? 'selected' : '' }}>VI</option>
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

@push('script')
<script>
    document.getElementById('selectAll').addEventListener('change', function () {
        const selectedValue = this.value;
        const dropdowns = document.querySelectorAll('.naik-kelas');
        dropdowns.forEach(dropdown => {
            dropdown.value = selectedValue;
        });
    });
</script>
@endpush
