@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">{{ $title }}</h4>

    <div class="d-flex gap-3">
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#import"><i class="bi bi-folder-plus"></i>
            Import
        </button>
        <a href="{{ route('target_capaian.create') }}" class="btn btn-primary btn-icon-split">
            <span class="text"><i class="bi bi-plus"></i> Tambah</span>
        </a>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            @if (count($targetCapaian))
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Dimensi</th>
                            <th>Elemen</th>
                            <th>Sub Elemen</th>
                            <th>Capaian Akhir Fase</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($targetCapaian as $item)
                            <tr class="align-top">
                                <td>{{ ($targetCapaian->currentPage() - 1) * $targetCapaian->perPage() + $loop->iteration }}</td>
                                <td>{{ $item->dimensi }}</td>
                                <td>{{ $item->elemen }}</td>
                                <td>{{ $item->sub_elemen }}</td>
                                <td>{{ $item->capaian_akhir_fase }}</td>
                                <td class="d-flex gap-2 justify-content-center">
                                    <a href="{{ route('target_capaian.show', $item->id_target_capaian) }}" class="btn btn-outline-info" title="Lihat Profil">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('target_capaian.edit', $item->id_target_capaian) }}" class="btn btn-outline-success">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form id="myForm" action="{{ route('target_capaian.destroy', $item->id_target_capaian) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger" id="btn_delete">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Data target capaian belum tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            @else
                <h6 class="text-center">Data {{ $title }} Belum Ada!</h6>
            @endif
        </div>

        <div class="d-flex justify-content-between align-items-center my-3">
            <!-- Pagination Info -->
            <div>
                <p class="mb-0">
                    Menampilkan
                    <strong>{{ $targetCapaian->firstItem() }}</strong>
                    sampai
                    <strong>{{ $targetCapaian->lastItem() }}</strong>
                    dari total
                    <strong>{{ $targetCapaian->total() }}</strong>
                    data.
                </p>
                <p class="mb-0">
                    Halaman
                    <strong>{{ $targetCapaian->currentPage() }}</strong>
                    dari
                    <strong>{{ $targetCapaian->lastPage() }}</strong>.
                </p>
            </div>

            <!-- Pagination Links -->
            <div>
                {{ $targetCapaian->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Modal Import -->
<div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Data {{ $title }}</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('import_target_capaian') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <label for="nama" class="form-label">Masukkan file<span class="text-danger fs-5">*</span></label>
                    <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" required>
                    @error('file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
