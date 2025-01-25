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
        <form action="{{ route('rapot_p5_catatan_proses_projek.index') }}" method="GET">
            <!-- Dropdown Kelompok Projek -->
            <div class="mb-4">
                <label for="id_kelompok_projek" class="form-label">Pilih Kelompok</label>
                <select class="form-select @error('id_kelompok_projek') is-invalid @enderror" 
                        name="id_kelompok_projek" 
                        id="id_kelompok_projek" 
                        required
                        onchange="this.form.submit()">
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
            
            <!-- Dropdown Projek -->
            <div class="mb-4">
                <label for="id_kelompok_projek_data_projek" class="form-label">Pilih Projek</label>
                <select class="form-select @error('id_kelompok_projek_data_projek') is-invalid @enderror" 
                        name="id_kelompok_projek_data_projek" 
                        id="id_kelompok_projek_data_projek" 
                        required
                        onchange="this.form.submit()">
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
        </form>
        
    </div>
</div>
@endsection
