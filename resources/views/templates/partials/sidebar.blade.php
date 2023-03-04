<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <div class="navigation-left">
            <li class="nav-item {{Request::is('/') ? 'active' : '' }}">
                <a class="nav-item-hold" href="{{route('dashboard')}}">
                    <i class="nav-icon i-Bar-Chart"></i>
                    <span class="nav-text">Dashoard</span>
                </a>
                <div class="triangle"></div>
            </li>
            @can('Admin')
            <li class="nav-item {{Request::is('pendaftaran') ? 'active' : '' }}">
                <a class="nav-item-hold" href="{{route('pendaftaran.index')}}">
                    <i class="nav-icon i-Administrator"></i>
                    <span class="nav-text">Pendaftaran</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{Request::is('divisi') ? 'active' : '' }}">
                <a class="nav-item-hold" href="{{route('divisi.index')}}">
                    <i class="nav-icon i-File-Clipboard-File--Text"></i>
                    <span class="nav-text">Divisi</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item {{Request::is('mahasiswa') ? 'active' : '' }}">
                <a class="nav-item-hold" href="{{route('mahasiswa.index')}}">
                    <i class="nav-icon i-Find-User"></i>
                    <span class="nav-text">Mahasiswa</span>
                </a>
                <div class="triangle"></div>
            </li>
            @endcan
        </div>
    </div>
    <div class="sidebar-overlay"></div>
</div>