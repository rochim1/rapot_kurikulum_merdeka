@extends('layouts.app')

@section('content')
<div class="container"> 
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                        <h5 class="card-title text-primary">Selamat Datang {{ Auth::user()->name }} ! 🎉</h5>
                            <p class="mb-4">
                                @if (auth()->user()->hasRole('admin'))
                                    <p class="mb-3">{{ __('Anda berhasil login sebagai Administrator!') }}</p>
                                @else
                                    <p class="mb-3">{{ __('Anda berhasil login sebagai Wali Kelas!') }}</p>
                                @endif
                            </p>
                        <div class="mt-4">
                            <a href="{{ route('logout') }}" 
                            class="btn btn-danger"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                        <img src="{{ asset('img/man-with-laptop-light.png') }}" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (auth()->user()->hasRole('walas'))
        <div class="row">
            <!-- Card untuk Jumlah Siswa -->
            <div class="col-md-6 mt-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Siswa</h5>
                        <p class="card-text">
                            <strong>{{ $jumlahSiswa }}</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
