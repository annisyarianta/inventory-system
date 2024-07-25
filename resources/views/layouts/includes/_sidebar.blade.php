<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li><a href="/dashboardatk" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a>
                </li>
                <li><a href="/daftar" class=""><i class="lnr lnr-layers"></i> <span>Daftar Barang</span></a>
                </li>
                <li><a href="/masukga" class=""><i class="lnr lnr-download"></i> <span>Barang Masuk</span></a>
                </li>
                <li><a href="/keluarga" class=""><i class="lnr lnr-upload"></i> <span>Barang Keluar</span></a>
                </li>
                {{-- <li><a href="/laporan" class=""><i class="lnr lnr-file-empty"></i> <span>Laporan</span></a>
                </li> --}}
                <li>
                    <a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-menu"></i>
                        <span>Laporan</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="subPages" class="collapse ">
                        <ul class="nav">
                            <li><a href="/laporan/excel">Laporan Excel</a></li>
                            <li><a href="/laporan/pdf">Laporan PDF</a></li>
                        </ul>
                    </div>
                </li>
                <li><a href="/barangga" class=""><i class="lnr lnr-database"></i> <span>Master Data</span></a>
                </li>
                <li><a href="/unit" class=""><i class="lnr lnr-users"></i> <span>Unit</span></a>
                </li>
                {{-- <li>
                    <a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-menu"></i>
                        <span>Lokasi Penyimpanan</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="subPages" class="collapse ">
                        <ul class="nav">
                            <li><a href="/lokasi">Edit Lokasi</a></li>
                            @foreach ($lokasi_barang as $lokasi)
                            <li><a href="/lokasi/{{$lokasi->id}}/list">{{$lokasi->NamaLokasi}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </li> --}}
            </ul>
        </nav>
    </div>
</div>