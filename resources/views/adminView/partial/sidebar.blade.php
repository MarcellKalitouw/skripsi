            <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" 
                        href="{{ route(session()->get('tipe') == 'Pengusaha' ? 'dashboard.pengusaha' : 'dashboard.admin' ) }}"
                                aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                    class="hide-menu">Dashboard</span></a></li>
                        <li class="list-divider"></li>

                        <li class="nav-small-cap"><span class="hide-menu">Produk</span></li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                                    class="hide-menu">Produk </span></a>
                            <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                <li class="sidebar-item"> 
                                    <a class="sidebar-link" href="{{route('produk.index')}}"
                                        aria-expanded="false">
                                        <i class="fas fa-table"></i>
                                        <span
                                            class="hide-menu">Produk
                                        </span>
                                    </a>
                                </li>

                                <li class="sidebar-item"> 
                                    <a class="sidebar-link" href="{{route('kategori_produk.index')}}"
                                        aria-expanded="false">
                                        <i class="fas fa-table"></i>
                                        <span
                                            class="hide-menu">Kategori Produk
                                        </span>
                                    </a>
                                </li>
                                <li class="sidebar-item"> 
                                    <a class="sidebar-link" href="{{route('satuan_produk.index')}}"
                                        aria-expanded="false">
                                        <i class="fas fa-table"></i>
                                        <span
                                            class="hide-menu">Satuan Produk
                                        </span>
                                    </a>
                                </li>
                                <li class="sidebar-item"> 
                                    <a class="sidebar-link" href="{{route('paket.index')}}"
                                        aria-expanded="false">
                                        <i class="fas fa-table"></i>
                                        <span
                                            class="hide-menu">Paket
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                         
                        @if (session()->get('tipe') != 'Pengusaha')
                            <li class="list-divider"></li>
                            <li class="nav-small-cap"><span class="hide-menu">Pengusaha</span></li>
                            
                            <li class="sidebar-item"> 
                                <a class="sidebar-link" href="{{route('pengusaha.index')}}"
                                    aria-expanded="false">
                                    <i class="fas fa-table"></i>
                                    <span
                                        class="hide-menu">Data Pengusaha
                                    </span>
                                </a>
                            </li>    
                        @else
                            
                        @endif
                        

                        
                        @if (session()->get('tipe') != 'Pengusaha')
                            <li class="list-divider"></li>

                            <li class="nav-small-cap"><span class="hide-menu">Pelanggan</span></li>
                            
                            <li class="sidebar-item"> 
                                <a class="sidebar-link" href="{{route('pelanggan.index')}}"
                                    aria-expanded="false">
                                    <i class="fas fa-table"></i>
                                    <span
                                        class="hide-menu">Data Pelanggan
                                    </span>
                                </a>
                            </li>    
                        @else
                            
                        @endif

                        {{-- <li class="list-divider"></li>

                        <li class="nav-small-cap"><span class="hide-menu">Pelanggan</span></li>
                        
                         <li class="sidebar-item"> 
                            <a class="sidebar-link" href="{{route('pelanggan.index')}}"
                                aria-expanded="false">
                                <i class="fas fa-table"></i>
                                <span
                                    class="hide-menu">Data Pelanggan
                                </span>
                            </a>
                        </li> --}}

                        
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Transaksi</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                                    class="hide-menu">Transaksi </span></a>
                            <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                <li class="sidebar-item"> 
                                    <a class="sidebar-link" href="{{route('shipping.index')}}"
                                        aria-expanded="false">
                                        <i class="fas fa-table"></i>
                                        <span
                                            class="hide-menu">Shipping
                                        </span>
                                    </a>
                                </li>
                                <li class="sidebar-item"> 
                                    <a class="sidebar-link" href="{{route('transaksi.index')}}"
                                        aria-expanded="false">
                                        <i class="fas fa-table"></i>
                                        <span
                                            class="hide-menu">Transaksi
                                        </span>
                                    </a>
                                </li>
                                <li class="sidebar-item"> 
                                    <a class="sidebar-link" href="{{route('status.index')}}"
                                        aria-expanded="false">
                                        <i class="fas fa-table"></i>
                                        <span
                                            class="hide-menu">Status Proses
                                        </span>
                                    </a>
                                </li>
                                <li class="sidebar-item"> 
                                    <a class="sidebar-link" href="{{route('status_transaksi.index')}}"
                                        aria-expanded="false">
                                        <i class="fas fa-table"></i>
                                        <span
                                            class="hide-menu">Status Transaksi
                                        </span> 
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="list-divider"></li>
                        
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('logout') }}"
                                aria-expanded="false"><i data-feather="log-out" class="feather-icon"></i><span
                                    class="hide-menu">Logout</span></a></li>
                    </ul>
                </nav>