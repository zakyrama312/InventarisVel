<aside class="left-sidebar" id="sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="./index.html" class="text-nowrap logo-img">
                {{-- <img src="{{ asset('/')}}assets/images/logos/dark-logo.svg" width="180" alt="" /> --}}
                <img src="{{ asset('/')}}assets/images/logos/ventera.png" width="180" alt="">
                {{-- <h3 class="brand">Inventaris Vel</h3> --}}
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Beranda</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ url('dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                @if( Auth::user()->role == 'admin')

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Menu</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ url('pengguna') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-users"></i>
                        </span>
                        <span class="hide-menu">Pengguna</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ url('jurusan') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-article"></i>
                        </span>
                        <span class="hide-menu">Jurusan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ url('kondisi') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-check"></i>
                        </span>
                        <span class="hide-menu">Kondisi</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ url('ruang') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-wallpaper"></i>
                        </span>
                        <span class="hide-menu">Ruang</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ url('kategori') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-cards"></i>
                        </span>
                        <span class="hide-menu">Kategori</span>
                    </a>
                </li>

                @endif
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Transaksi</span>
                </li>
                @if(Auth::user()->role == 'admin')

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ url('barang-masuk') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-file-description"></i>
                        </span>
                        <span class="hide-menu">Barang Masuk</span>
                    </a>
                </li>


                @endif
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ url('peminjaman') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-books"></i>
                        </span>
                        <span class="hide-menu">Peminjaman Barang</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ url('permintaan') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-books"></i>
                        </span>
                        <span class="hide-menu">Permintaan Barang</span>
                    </a>
                </li>

                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'kaprodi')

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Laporan</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="javascript:void(0);" aria-expanded="false" data-bs-toggle="collapse"
                        data-bs-target="#keadaanSubmenu">
                        <i class="ti ti-dots nav-small-cap-icon"></i>
                        <span class="hide-menu">Lap. Data Ruang</span>
                        <i class="ti ti-chevron-down toggle-arrow ms-auto"></i> <!-- Ikon panah -->
                    </a>
                    <ul id="keadaanSubmenu" class="collapse sidebar-submenu">
                        @php
                        $idJurusan = Auth::user()->prodi_id;
                        $ruang = \App\Models\Ruang::where('prodi_id', $idJurusan)->get();
                        @endphp

                        @foreach ($ruang as $r)
                        <li>
                            <a class="sidebar-link" href="{{ route('ruang.show', $r->slug) }}">
                                <span class="hide-menu">{{ $r->nama_ruang }}</span>
                            </a>
                        </li>
                        @endforeach

                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ url('laporan-barang-masuk') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-file-description"></i>
                        </span>
                        <span class="hide-menu">Lap. Barang Masuk</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ url('laporan-peminjaman-barang') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-file-description"></i>
                        </span>
                        <span class="hide-menu">Lap. Peminjaman Barang</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ url('laporan-permintaan-barang') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-file-description"></i>
                        </span>
                        <span class="hide-menu">Lap. Permintaan Barang</span>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>