<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4 mt-2" href="javascript:void(0)">
            <i class="bi bi-list mt-n1"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex" id="navbar-collapse">
        <div class="mt-3">
            @if (session('id_tahun_ajaran'))
                @php
                    $tahunAjaran = \App\Models\TahunAjaran::find(session('id_tahun_ajaran'));
                @endphp
                @if ($tahunAjaran)
                    <h5><span class="fw-bold me-2">Kelas :</span> 
                        <span class="fst-italic small">
                            {{ session('kelas') }} 
                            ({{ $tahunAjaran->tahun_ajaran_awal }}/{{ $tahunAjaran->tahun_ajaran_akhir }})
                            -
                            {{ $tahunAjaran->semester }}
                        </span>
                    </h5>
                @else
                    <p><strong>Tahun Ajaran: </strong> Data tidak ditemukan.</p>
                @endif
            @else
                <p><strong>Tahun Ajaran: </strong> Tidak tersedia.</p>
            @endif
        </div>

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow mt-sm-n5 mt-md-n5 mt-lg-n5 mt-xl-0 mt-xxl-0"
                    href="#" data-bs-toggle="dropdown">
                    <span class="mr-2 d-lg-inline text-gray-600 small fw-bold">
                        {{ auth()->user()->name }}      
                        <i class="bi bi-chevron-down mt-n1"></i>
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('profil_user.index') }}">
                            <i class="bi bi-person">
                                <span class="align-middle ps-1 fst-normal pt-n1">Profil</span>
                            </i> 
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <form id="btn_logout_form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" id="btn_logout" class="btn btn-danger col-12">Logout</button>
                        </form> 
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
