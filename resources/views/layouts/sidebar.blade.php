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

    <li class="menu-item {{ Request::is('kelas*') ? 'active' : '' }}">
        <a href="{{ route('kelas.index') }}" class="menu-link">
            <i class="menu-icon bi bi-building"></i>
            <div data-i18n="Analytics">Kelas</div>
        </a>
    </li>

    <li class="menu-item {{ Request::is('mata_pelajaran*') ? 'active' : '' }}">
        <a href="{{ route('mata_pelajaran.index') }}" class="menu-link">
            <i class="menu-icon bi bi-building"></i>
            <div data-i18n="Analytics">Mata Pelajaran</div>
        </a>
    </li>

    <li class="menu-item {{ Request::is('data-ekstrakulikuler*') ? 'active' : '' }}">
        <a href="{{ route('data-ekstrakulikuler') }}" class="menu-link">
            <i class="menu-icon bi bi-building"></i>
            <div data-i18n="Analytics">Ekstrakulikuler</div>
        </a>
    </li>

    <li class="menu-item {{ Request::is('data-guru*') ? 'active' : '' }}">
        <a href="{{ route('data-guru') }}" class="menu-link">
            <i class="menu-icon bi bi-building"></i>
            <div data-i18n="Analytics">Guru</div>
        </a>
    </li>

    <li class="menu-item {{ Request::is('kelola_kelas*') ? 'active' : '' }}">
        <a href="{{ route('kelola_kelas.index') }}" class="menu-link">
            <i class="menu-icon bi bi-building"></i>
            <div data-i18n="Analytics">Kelola Kelas</div>
        </a>
    </li>

    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Wali Kelas</span>
    </li>
    <li class="menu-item {{ Request::is('tujuan_pembelajaran*') ? 'active' : '' }}">
        <a href="{{ route('tujuan_pembelajaran.index') }}" class="menu-link">
            <i class="menu-icon bi bi-building"></i>
            <div data-i18n="Analytics">Tujuan Pembelajaran</div>
        </a>
    </li>

    <li class="menu-item 
        @php
            if(Request::is('rapot*')) {
                echo 'active open';
            }
        @endphp
        ">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bi bi-file-earmark-text"></i>
            <div data-i18n="Account Settings">Rapot</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ Request::is('rapot_nilai') ? 'active' : '' }}">
                <a href="{{ route('rapot_nilai.index') }}" class="menu-link">
                    <div data-i18n="Account">Nilai</div>
                </a>
            </li>
            <li class="menu-item {{ Request::is('rapot_kehadiran') ? 'active' : '' }}">
                <a href="{{ route('rapot_kehadiran.index') }}" class="menu-link">
                    <div data-i18n="Notifications">Kehadiran</div>
                </a>
            </li>
            <li class="menu-item {{ Request::is('rapot_ekstrakulikuler*') ? 'active' : '' }}">
                <a href="{{ route('rapot_ekstrakulikuler.index') }}" class="menu-link">
                    <div data-i18n="Connections">Ekstrakulikuler</div>
                </a>
            </li>
            <li class="menu-item {{ Request::is('rapot_catatan_wali_kelas*') ? 'active' : '' }}">
                <a href="{{ route('rapot_catatan_wali_kelas.index') }}" class="menu-link">
                    <div data-i18n="Connections">Catatan Wali Kelas</div>
                </a>
            </li>
        </ul>
    </li>
</ul>
