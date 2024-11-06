<ul class="menu-inner py-1">
    <li class="menu-item">
        <a href="{{ url('') }}" class="menu-link">
            <i class='menu-icon tf-icons bx bxs-dashboard'></i>
            <div data-i18n="Analytics">Dashboard</div>
        </a>
    </li>

    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Profil</span>
    </li>
    <li class="menu-item 
        @php
            if(Request::is('')) {
                echo 'active open';
            }
        @endphp
        ">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon bi bi-building"></i>
            <div data-i18n="Account Settings">Profil</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item">
                <a href="{{ url('') }}" class="menu-link">
                    <div data-i18n="Account">Sekolah</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ url('') }}" class="menu-link">
                    <div data-i18n="Notifications">Kepala Sekolah</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ url('') }}" class="menu-link">
                    <div data-i18n="Connections">Tanggal TTD</div>
                </a>
            </li>
        </ul>
    </li>
    <li class="menu-item 
        @php
            if(Request::is('')) {
                echo 'active open';
            }
        @endphp
        ">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class='menu-icon bi bi-people'></i>
            <div data-i18n="Account Settings">Database</div>
        </a>
        <ul class="menu-sub">
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
