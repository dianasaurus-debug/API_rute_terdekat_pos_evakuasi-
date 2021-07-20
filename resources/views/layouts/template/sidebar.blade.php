<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="../assets/img/logo-small.png">
            </div>
        </a>
        <a href="{{ route('dashboard') }}" class="simple-text logo-normal">
            Web Admin
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ (request()->routeIs('user*') || request()->routeIs('bpbd*')) ? 'active' : '' }}">
                <a href="{{ route('user.index') }}">
                    <i class="nc-icon nc-circle-10"></i>
                    <p>Data User</p>
                </a>
            </li>
            <li class="{{ request()->routeIs('desa*') ? 'active' : '' }}">
                <a href="{{ route('desa.index') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>Data Desa</p>
                </a>
            </li>
            <li class="{{ request()->routeIs('kecamatan*') ? 'active' : '' }}">
                <a href="{{ route('kecamatan.index') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>Data Kecamatan</p>
                </a>
            </li>
            <li class="{{ request()->routeIs('posko*') ? 'active' : '' }}">
                <a href="{{ route('posko.index') }}">
                    <i class="nc-icon nc-bullet-list-67"></i>
                    <p>Posko Evakuasi</p>
                </a>
            </li>
            <li class="{{ request()->routeIs('riwayat*') ? 'active' : '' }}">
                <a href="{{ route('riwayat.index', 'banjir') }}">
                    <i class="nc-icon nc-single-copy-04"></i>
                    <p>Riwayat Bencana</p>
                </a>
            </li>
            <li class="{{ request()->routeIs('laban*') ? 'active' : '' }}">
                <a href="{{ route('laban.index') }}">
                    <i class="nc-icon nc-tile-56"></i>
                    <p>Laporan Bantuan</p>
                </a>
            </li>
            <li class="{{ request()->routeIs('laben*') ? 'active' : '' }}">
                <a href="{{ route('laben.index') }}">
                    <i class="nc-icon nc-paper"></i>
                    <p>Laporan Bencana</p>
                </a>
            </li>
            <li class="active-pro {{ request()->routeIs('sop*') ? 'active' : '' }}">
                <a href="{{ route('sop.index', 'banjir') }}">
                    <i class="nc-icon nc-spaceship"></i>
                    <p>SOP BPBD</p>
                </a>
            </li>
        </ul>
    </div>
</div>
