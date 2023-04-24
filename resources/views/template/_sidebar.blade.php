<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-menu">
            <ul class="menu mt-4">
                <li class="sidebar-title">Menu</li>

                {{-- TU --}}
                @if(auth()->user()->role == 'tu')
                    <li class="sidebar-item {{ Request::url() == url('/dashboard-tu') ? 'active' : ' ' }}">
                        <a href="{{ route('dashboard.tu') }}" class='sidebar-link'>
                            <i class="bi bi-grid-fill fa-lg"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ Request::url() == url('/users') ? 'active' : ' ' }}">
                        <a href="{{ route('users.index') }}" class='sidebar-link'>
                            <i class="fa-solid fa-user fa-lg"></i>
                            <span>Pegawai</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ Request::url() == url('/surat-masuk') ? 'active' : ' ' }}">
                        <a href="{{ url('/surat-masuk') }}" class='sidebar-link'>
                            <i class="fa-solid fa-envelope fa-lg"></i>
                            <span>Surat Masuk</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ Request::url() == url('/surat-keluar') ? 'active' : ' ' }}">
                        <a href="{{ url('/surat-keluar') }}" class='sidebar-link'>
                            <i class="fa-solid fa-envelope-open lg"></i>
                            <span>Surat Keluar</span>
                        </a>
                    </li>
                @endif

                {{-- Kepala --}}
                @if(auth()->user()->role == 'kepala')
                    <li class="sidebar-item {{ Request::url() == url('/dashboard-kepala') ? 'active' : ' ' }}">
                        <a href="{{ url('dashboard-kepala') }}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ Request::url() == url('/disposisi') ? 'active' : ' ' }}">
                        <a href="{{ url('/disposisi') }}" class='sidebar-link'>
                            <i class="fa-solid fa-envelope fa-lg"></i>
                            <span>Disposisi</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ Request::url() == url('/kepala/surat-masuk') ? 'active' : ' ' }}">
                        <a href="{{ url('/kepala/surat-masuk') }}" class='sidebar-link'>
                            <i class="fa-solid fa-envelope fa-lg"></i>
                            <span>Surat Masuk</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ Request::url() == url('/kepala/surat-keluar') ? 'active' : ' ' }}">
                        <a href="{{ url('/kepala/surat-keluar') }}" class='sidebar-link'>
                            <i class="fa-solid fa-envelope-open lg"></i>
                            <span>Surat Keluar</span>
                        </a>
                    </li>
                @endif

                {{-- Pegawai --}}
                @if(auth()->user()->role == 'pegawai')
                    <li class="sidebar-item {{ Request::url() == url('/dashboard-pegawai') ? 'active' : ' ' }}">
                        <a href="{{ url('dashboard-pegawai') }}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ Request::url() == url('/disposisi-pegawai') ? 'active' : ' ' }}">
                        <a href="{{ url('/disposisi-pegawai') }}" class='sidebar-link'>
                            <i class="fa-solid fa-envelope fa-lg"></i>
                            <span>Disposisi</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ Request::url() == url('/pegawai/surat-keluar') ? 'active' : ' ' }}">
                        <a href="{{ url('/pegawai/surat-keluar') }}" class='sidebar-link'>
                            <i class="fa-solid fa-envelope-open lg"></i>
                            <span>Surat Keluar</span>
                        </a>
                    </li>
                @endif

                <li class="sidebar-item">
                    <a href="{{ route('logout') }}" class='sidebar-link'>
                        <i class="fa-solid fa-right-from-bracket fa-lg"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
