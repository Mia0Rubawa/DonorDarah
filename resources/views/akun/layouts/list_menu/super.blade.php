<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item @if (Route::is('super.dashboard.*')) active @endif">
    <a class="nav-link" href="{{ route('super.dashboard.index') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Master Data
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item @if (Route::is('super.master_data.*')) active @endif">
    <a class="nav-link @if (!Route::is('super.master_data.*')) collapsed @endif " href="#" data-toggle="collapse"
        data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Master Data</span>
    </a>
    <div id="collapseTwo" class="collapse @if (Route::is('super.master_data.*')) show @endif" aria-labelledby="headingTwo"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Daftar :</h6>
            <a class="collapse-item @if (Route::is('super.master_data.penyakit.*')) active @endif"
                href="{{ route('super.master_data.penyakit.index') }}">Penyakit</a>
            <a class="collapse-item @if (Route::is('super.master_data.gol_darah.*')) active @endif"
                href="{{ route('super.master_data.gol_darah.index') }}">Golongan Darah</a>
            <a class="collapse-item @if (Route::is('super.master_data.jenis_kelamin.*')) active @endif"
                href="{{ route('super.master_data.jenis_kelamin.index') }}">Jenis Kelamin</a>
            <a class="collapse-item @if (Route::is('super.master_data.rhesus.*')) active @endif"
                href="{{ route('super.master_data.rhesus.index') }}">Rhesus</a>
            <a class="collapse-item @if (Route::is('super.master_data.pekerjaan.*')) active @endif"
                href="{{ route('super.master_data.pekerjaan.index') }}">Pekerjaan</a>
        </div>
    </div>
</li>


<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>
