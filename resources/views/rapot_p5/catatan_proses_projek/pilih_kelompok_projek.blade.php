@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h4 class="mb-md-0">{{ $title }}</h4>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Pilih Kelompok</label>
            <div class="col-sm-10">
                <form action="{{ route('rapot_p5_catatan_proses_projek.index') }}" method="GET">
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
                </form>            
            </div>
        </div>
          
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Pilih Projek</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" disabled value="Pilih Projek">
            </div>
        </div>
    </div>
</div>
@endsection
