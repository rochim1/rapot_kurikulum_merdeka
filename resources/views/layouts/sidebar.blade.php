<ul class="menu-inner py-1">
    <li class="menu-item {{ Request::is('home') ? 'active' : '' }}">
        <a href="{{ route('home') }}" class="menu-link">
            <i class="menu-icon bi bi-building"></i>
            <div data-i18n="Analytics">Dashboard</div>
        </a>
    </li>

    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Master</span>
    </li>

    <li class="menu-item {{ Request::is('tahun_ajaran*') ? 'active' : '' }}">
        <a href="{{ route('tahun_ajaran.index') }}" class="menu-link">
            <i class="menu-icon bi bi-building"></i>
            <div data-i18n="Analytics">Tahun Ajaran</div>
        </a>
    </li>
   
    <li class="menu-item {{ Request::is('siswa*') ? 'active' : '' }}">
        <a href="{{ route('siswa.index') }}" class="menu-link">
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
        <a href="{{ route('mata_pelajaran.index') }}" class="menu-link">
            <i class="menu-icon bi bi-building"></i>
            <div data-i18n="Analytics">Mata Pelajaran</div>
        </a>
    </li>

    <li class="menu-item {{ Request::is('kelas*') ? 'active' : '' }}">
        <a href="{{ route('kelas.index') }}" class="menu-link">
            <i class="menu-icon bi bi-building"></i>
            <div data-i18n="Analytics">Kelas</div>
        </a>
    </li>

    <li class="menu-item {{ Request::is('rapot*') ? 'active' : '' }}">
        <a href="{{ route('rapot.index') }}" class="menu-link">
            <i class="menu-icon bi bi-building"></i>
            <div data-i18n="Analytics">Rapot</div>
        </a>
    </li>

    <li class="menu-item">
        <ul class="menu-sub">
            <li class="menu-item">
                <a href="{{ route('data-guru')}}" class="menu-link">
                    <div data-i18n="Account">Guru</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('rapot.index') }}" class="menu-link">
                    <div data-i18n="Account">Wali Kelas</div>
                </a>
            </li>
        </ul>
    </li>
</ul>
