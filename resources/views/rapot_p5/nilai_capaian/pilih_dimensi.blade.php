@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">{{ $title }}</h4>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('rapot_p5_capaian_projek.index') }}" method="GET">
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Pilih Kelompok</label>
                <div class="col-sm-10">
                    <select class="form-select @error('id_kelompok_projek') is-invalid @enderror" 
                        name="id_kelompok_projek" 
                        id="id_kelompok_projek" 
                        required
                        onchange="this.form.submit()"
                    >
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
            </div>
            
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Pilih Projek</label>
                <div class="col-sm-10">
                    <select class="form-select @error('id_kelompok_projek_data_projek') is-invalid @enderror" 
                        name="id_kelompok_projek_data_projek" 
                        id="id_kelompok_projek_data_projek" 
                        required
                        onchange="this.form.submit()"
                    >
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
            </div>

            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Pilih Dimensi Profil</label>
                <div class="col-sm-10">
                    <select class="form-select @error('id_target_capaian') is-invalid @enderror" 
                        name="id_target_capaian" 
                        id="id_target_capaian" 
                        required
                        onchange="this.form.submit()"
                    >
                        <option value="">Pilih Dimensi Profil</option>
                        @foreach ($dataProjekTargetCapaian as $item)
                            <option value="{{ $item->targetCapaian->id_target_capaian }}" 
                                {{ request('id_target_capaian') == $item->targetCapaian->id_target_capaian ? 'selected' : '' }}
                            >
                                {{ $item->targetCapaian->dimensi }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_data_projek_target_capaian')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror   
                </div>
            </div>
        </form>

        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Pilih Elemen Profil</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" readonly value="Pilih Elemen Profil">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Pilih Sub Elemen Profil</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" readonly value="Pilih Sub Elemen Profil">
            </div>
        </div>
    </div>
</div>
@endsection
