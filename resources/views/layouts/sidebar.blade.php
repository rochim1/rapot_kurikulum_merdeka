<ul class="menu-inner py-1">
    <li class="menu-item {{ Request::is('home') ? 'active' : '' }}">
        <a href="{{ url('/home') }}" class="menu-link">
            <i class="menu-icon bi bi-building"></i>
            <div data-i18n="Analytics">Dashboard</div>
        </a>
    </li>

    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Master</span>
    </li>
   
    <li class="menu-item {{ Request::is('siswa*') ? 'active' : '' }}">
        <a href="{{ url('/siswa') }}" class="menu-link">
            <i class="menu-icon bi bi-building"></i>
            <div data-i18n="Analytics">Siswa</div>
        </a>
    </li>

    <li class="menu-item {{ Request::is('data-guru*') ? 'active' : '' }}">
        <a href="{{ route('data-guru') }}" class="menu-link">
            <i class="menu-icon bi bi-building"></i>
            <div data-i18n="Analytics">Guru</div>
        </a>
    </li>
    <li class="menu-item {{ Request::is('mata_pelajaran*') ? 'active' : '' }}">
        <a href="{{ url('/mata_pelajaran') }}" class="menu-link">
            <i class="menu-icon bi bi-building"></i>
            <div data-i18n="Analytics">Mata Pelajaran</div>
        </a>
    </li>

    <li class="menu-item {{ Request::is('kelas*') ? 'active' : '' }}">
        <a href="{{ url('/kelas') }}" class="menu-link">
            <i class="menu-icon bi bi-building"></i>
            <div data-i18n="Analytics">Kelas</div>
        </a>
    </li>

    <li class="menu-item {{ Request::is('tahun_ajaran*') ? 'active' : '' }}">
        <a href="{{ url('/tahun_ajaran') }}" class="menu-link">
            <i class="menu-icon bi bi-building"></i>
            <div data-i18n="Analytics">Tahun Ajaran</div>
        </a>
    </li>

    <li class="menu-item">
        <a href="{{ url('') }}" class="menu-link">
            <i class="menu-icon bi bi-building"></i>
            <div data-i18n="Analytics">Rapor</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item">
                <a href="{{ route('data-guru')}}" class="menu-link">
                    <div data-i18n="Account">Guru</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ url('') }}" class="menu-link">
                    <div data-i18n="Account">Wali Kelas</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ url('') }}" class="menu-link">
                    <div data-i18n="Notifications">Murid</div>
                </a>
            </li>
        </ul>
    </li>

    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Laporan</span>
    </li>
    <li class="menu-item">
        <a href="{{ url('') }}" class="menu-link">
            <i class="menu-icon bi bi-journal-text"></i>
            <div data-i18n="Basic">Cetak Rapor</div>
        </a>
    </li>
</ul>
