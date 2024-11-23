@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4 text-center">Data Penukaran</h4>
    <a href="{{ route('penukaran.create') }}" class="btn btn-primary my-3"><i class="bi bi-plus"></i>Add Data Penukaran</a>
    <table class="table small table-bordered table-striped table-hover">
        <thead>
            <tr class="text-center">
                <th scope="col">#</th>
                <th scope="col">Penukaran</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penukaran as $index => $item) <!-- Use $item for each Penukaran -->
                <tr class="align-middle">
                    <th class="text-center" scope="row">{{ $penukaran->firstItem() + $index }}</th> <!-- Correctly display the index -->
                    <td class="text-center">{{ $item->jml_penukaran }}</td> <!-- Access the property of $item -->
                    <td class="text-center">
                        <a href="{{ route('penukaran.edit', $item->id) }}" class="btn btn-warning me-1"><i class="bi bi-pencil"></i></a> <!-- Use $item -->
                        <form class="ms-1" action="{{ route('penukaran.destroy', $item->id) }}" method="POST" style="display:inline;"> <!-- Use $item -->
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" id="btn_delete" onclick="return confirm('Are you sure you want to delete this item?');"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Menampilkan informasi tambahan di bawah tabel -->
    <div class="row mb-3 d-flex justify-content-between">
        <div class="col-md-auto">
            Menampilkan {{ $penukaran->firstItem() }} hingga {{ $penukaran->lastItem() }} dari {{ $penukaran->total() }} data
        </div>
        <div class="col-md-auto text-end">
            {{ $penukaran->links() }}
        </div>
    </div>
</div>
@endsection
