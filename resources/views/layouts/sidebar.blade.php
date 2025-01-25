<ul class="menu-inner py-1">
    <li class="menu-item {{ Request::is('home') ? 'active' : '' }}">
        <a href="{{ route('home') }}" class="menu-link">
            <i class="menu-icon ri-dashboard-line"></i>
            <div data-i18n="Analytics">Dashboard</div>
        </a>
    </li>
    @if (Auth::user()->hasRole('admin'))
        <li class="menu-header small text-uppercase fw-bold">
            <span class="menu-header-text">Master</span>
        </li>

        <li class="menu-item {{ Request::is('profil_sekolah*') ? 'active' : '' }}">
            <a href="{{ route('profil_sekolah.index') }}" class="menu-link">
                <i class="menu-icon ri-school-line"></i>
                <div data-i18n="Analytics">Data Sekolah</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('tahun_ajaran*') ? 'active' : '' }}">
            <a href="{{ route('tahun_ajaran.index') }}" class="menu-link">
                <i class="menu-icon ri-calendar-2-line"></i>
                <div data-i18n="Analytics">Tahun Ajaran</div>
            </a>
        </li>
    
        <li class="menu-item {{ Request::is('siswa*') ? 'active' : '' }}">
            <a href="{{ route('siswa.index') }}" class="menu-link">
                <i class="menu-icon ri-graduation-cap-line"></i>
                <div data-i18n="Analytics">Siswa</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('kelas*') ? 'active' : '' }}">
            <a href="{{ route('kelas.index') }}" class="menu-link">
                <i class="menu-icon ri-list-indefinite"></i>
                <div data-i18n="Analytics">Kelas</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('mata_pelajaran*') ? 'active' : '' }}">
            <a href="{{ route('mata_pelajaran.index') }}" class="menu-link">
                <i class="menu-icon ri-book-shelf-line"></i>
                <div data-i18n="Analytics">Mata Pelajaran</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('data-ekstrakulikuler*') ? 'active' : '' }}">
            <a href="{{ route('data-ekstrakulikuler') }}" class="menu-link">
                <i class="menu-icon ri-list-indefinite"></i>
                <div data-i18n="Analytics">Ekstrakulikuler</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('data-guru*') ? 'active' : '' }}">
            <a href="{{ route('data-guru') }}" class="menu-link">
                <i class="menu-icon ri-presentation-line"></i>
                <div data-i18n="Analytics">Guru</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('kelola_kelas*') ? 'active' : '' }}">
            <a href="{{ route('kelola_kelas.index') }}" class="menu-link">
                <i class="menu-icon ri-list-settings-line"></i>
                <div data-i18n="Analytics">Kelola Kelas</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase fw-bold">
            <span class="menu-header-text">Rapot P5</span>
        </li>
        <li class="menu-item {{ Request::is('target_capaian*') ? 'active' : '' }}">
            <a href="{{ route('target_capaian.index') }}" class="menu-link">
                <i class="menu-icon ri-list-indefinite"></i>
                <div data-i18n="Analytics">Target Capaian</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('data_projek*') ? 'active' : '' }}">
            <a href="{{ route('data_projek.index') }}" class="menu-link">
                <i class="menu-icon ri-list-indefinite"></i>
                <div data-i18n="Analytics">Data Projek</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('kelompok_projek*') ? 'active' : '' }}">
            <a href="{{ route('kelompok_projek.index') }}" class="menu-link">
                <i class="menu-icon ri-list-indefinite"></i>
                <div data-i18n="Analytics">Kelompok Projek</div>
            </a>
        </li>
    @endif

    @if (Auth::user()->hasRole('walas'))
        <li class="menu-header small text-uppercase fw-bold">
            <span class="menu-header-text">Master</span>
        </li>
        <li class="menu-item {{ Request::is('siswa*') ? 'active' : '' }}">
            <a href="{{ route('siswa.index') }}" class="menu-link">
                <i class="menu-icon ri-graduation-cap-line"></i>
                <div data-i18n="Analytics">Siswa</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('mata_pelajaran*') ? 'active' : '' }}">
            <a href="{{ route('mata_pelajaran.index') }}" class="menu-link">
                <i class="menu-icon ri-book-shelf-line"></i>
                <div data-i18n="Analytics">Mata Pelajaran</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('ekstrakulikuler*') ? 'active' : '' }}">
            <a href="{{ route('ekstrakulikuler.index') }}" class="menu-link">
                <i class="menu-icon ri-list-indefinite"></i>
                <div data-i18n="Analytics">Ekstrakulikuler</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase fw-bold">
            <span class="menu-header-text">Wali Kelas</span>
        </li>
        <li class="menu-item {{ Request::is('tujuan_pembelajaran*') ? 'active' : '' }}">
            <a href="{{ route('tujuan_pembelajaran.index') }}" class="menu-link">
                <i class="menu-icon ri-trophy-line"></i>
                <div data-i18n="Analytics">Tujuan Pembelajaran</div>
            </a>
        </li>
        <li class="menu-item 
            @php
                if(Request::is('rapot_nilai')) {
                    echo 'active open';
                } else if(Request::is('rapot_nilai')) {
                    echo 'active open';
                } else if(Request::is('rapot_kehadiran')) {
                    echo 'active open';
                } else if(Request::is('rapot_ekstrakulikuler')) {
                    echo 'active open';
                } else if(Request::is('rapot_catatan_wali_kelas')) {
                    echo 'active open';
                } else if(Request::is('rapot_naik_kelas')) {
                    echo 'active open';
                } else if(Request::is('rapot_ttd')) {
                    echo 'active open';
                } else if(Request::is('rapot_cetak')) {
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
                    @php
                        $tahunAjaran = \App\Models\TahunAjaran::find(session('id_tahun_ajaran'));
                    @endphp
                    @if ($tahunAjaran->semester == 'Genap')
                        <li class="menu-item {{ Request::is('rapot_naik_kelas*') ? 'active' : '' }}">
                            <a href="{{ route('rapot_naik_kelas.index') }}" class="menu-link">
                                <div data-i18n="Connections">Naik Kelas</div>
                            </a>
                        </li>
                    @endif
                <li class="menu-item {{ Request::is('rapot_ttd') ? 'active' : '' }}">
                    <a href="{{ route('rapot_ttd.index') }}" class="menu-link">
                        <div data-i18n="Account">Tanda Tangan</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('rapot_cetak') ? 'active' : '' }}">
                    <a href="{{ route('rapot_cetak.index') }}" class="menu-link">
                        <div data-i18n="Account">Cetak</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item 
            @php
                if(Request::is('rapot_nilai')) {
                    echo 'active open';
                } else if(Request::is('rapot_nilai')) {
                    echo 'active open';
                } else if(Request::is('rapot_kehadiran')) {
                    echo 'active open';
                } else if(Request::is('rapot_ekstrakulikuler')) {
                    echo 'active open';
                } else if(Request::is('rapot_catatan_wali_kelas')) {
                    echo 'active open';
                } else if(Request::is('rapot_naik_kelas')) {
                    echo 'active open';
                } else if(Request::is('rapot_ttd')) {
                    echo 'active open';
                } else if(Request::is('rapot_cetak')) {
                    echo 'active open';
                }
            @endphp
            ">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bi bi-file-earmark-text"></i>
                <div data-i18n="Account Settings">Rapot P5</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::is('rapot_p5_capaian_projek') ? 'active' : '' }}">
                    <a href="{{ route('rapot_p5_capaian_projek.index') }}" class="menu-link">
                        <div data-i18n="Account">Capaian Projek</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('rapot_p5_catatan_proses_projek') ? 'active' : '' }}">
                    <a href="{{ route('rapot_p5_catatan_proses_projek.index') }}" class="menu-link">
                        <div data-i18n="Notifications">Catatan Proses Projek</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('rapot_p5_cetak*') ? 'active' : '' }}">
                    <a href="{{ route('rapot_p5_cetak.index') }}" class="menu-link">
                        <div data-i18n="Connections">Cetak</div>
                    </a>
                </li>
            </ul>
        </li>
    @endif
</ul>
