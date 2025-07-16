<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="./">
                METODE SMART
            </a>
            <a class="navbar-brand hidden" href="./">
                METODE SMART
            </a>
        </div>
        <!-- begin:: sidebar -->
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="<?= ($_REQUEST['content'] == "dashboard") ? 'active' : '' ?>">
                    <a href="dashboard">
                        <i class="menu-icon fa fa-dashboard"></i>
                        Dashboard
                    </a>
                </li>
                <h3 class="menu-title">Master</h3>
                <li class="<?= ($_REQUEST['content'] == "penilaian") ? 'active' : '' ?>">
                    <a href="penilaian">
                        <i class="menu-icon fa fa-list"></i>
                        Penilaian
                    </a>
                </li>
                <h3 class="menu-title">Pustaka</h3>
                <li class="<?= ($_REQUEST['content'] == "konsultasi") ? 'active' : '' ?>">
                    <a href="konsultasi">
                        <i class="menu-icon fa fa-list"></i>
                        Konsultasi
                    </a>
                </li>
                <li class="<?= ($_REQUEST['content'] == "konsultasi_hasil") ? 'active' : '' ?>">
                    <a href="konsultasi_hasil">
                        <i class="menu-icon fa fa-list"></i>
                        Hasil Konsultasi
                    </a>
                </li>
                <h3 class="menu-title">Laporan</h3>
                <li class="<?= ($_REQUEST['content'] == "riwayat") ? 'active' : '' ?>">
                    <a href="riwayat">
                        <i class="menu-icon fa fa-list"></i>
                        Riwayat
                    </a>
                </li>
            </ul>
        </div>
        <!-- end:: sidebar -->
    </nav>
</aside>