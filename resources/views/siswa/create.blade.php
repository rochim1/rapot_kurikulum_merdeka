@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4 text-center">Tambah Data Penukaran</h4>
{{ $jml_kembalian }}

    <form id="myForm" action="{{ route('penukaran.store') }}" method="POST" autocomplete="off">
        @csrf
        <div class="form-group mb-3">
            <label for="jml_penukaran">Jumlah Penukaran<span class="text-danger fs-5">*</span></label>
            <input type="number" class="form-control @error('jml_penukaran') is-invalid @enderror" id="jml_penukaran" name="jml_penukaran" value="{{ old('jml_penukaran') }}" autofocus required>
            @error('jml_penukaran')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <label for="jml_bayar">Jumlah Bayar<span class="text-danger fs-5">*</span></label>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Rp.</span>
            <input type="text" class="form-control jml_bayar @error('jml_bayar') is-invalid @enderror" id="jml_bayar" name="jml_bayar" value="{{ old('jml_bayar') }}" required>
            @error('jml_bayar')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="text-end">
            <a href="{{ route('penukaran.index') }}" type="submit" class="btn btn-danger me-1">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
@endsection
