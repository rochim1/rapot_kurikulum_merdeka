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
        <div class="mb-4">
            <select class="form-select @error('') is-invalid @enderror" 
                    name="" 
                    required >
                <option value="">Pilih Kelompok</option>
                <option value=""></option>
            </select>
            @error('')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror     
        </div>

        <div class="mb-4">
            <select class="form-select @error('') is-invalid @enderror" 
                    name="" 
                    required 
                    disabled>
                <option value="">Pilih Projek</option>
                <option value=""></option>
            </select>
            @error('')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror 
        </div>
        

    </div>
</div>
@endsection
