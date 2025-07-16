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
                <li class="<?= ($_REQUEST['content'] == "alternatif") ? 'active' : '' ?>">
                    <a href="alternatif">
                        <i class="menu-icon fa fa-list"></i>
                        Alternatif
                    </a>
                </li>
                <li class="<?= ($_REQUEST['content'] == "kriteria") ? 'active' : '' ?>">
                    <a href="kriteria">
                        <i class="menu-icon fa fa-list"></i>
                        Kriteria
                    </a>
                </li>
                <li class="<?= ($_REQUEST['content'] == "kriteria_sub") ? 'active' : '' ?>">
                    <a href="kriteria_sub">
                        <i class="menu-icon fa fa-list"></i>
                        Kriteria Sub
                    </a>
                </li>
                <li class="<?= ($_REQUEST['content'] == "penilaian") ? 'active' : '' ?>">
                    <a href="penilaian">
                        <i class="menu-icon fa fa-list"></i>
                        Penilaian
                    </a>
                </li>
                <li class="<?= ($_REQUEST['content'] == "evaluasi") ? 'active' : '' ?>">
                    <a href="evaluasi">
                        <i class="menu-icon fa fa-list"></i>
                        Evaluasi
                    </a>
                </li>
                <li class="<?= ($_REQUEST['content'] == "algoritma") ? 'active' : '' ?>">
                    <a href="algoritma">
                        <i class="menu-icon fa fa-list"></i>
                        Algoritma
                    </a>
                </li>
                <h3 class="menu-title">Pustaka</h3>
                <li class="<?= ($_REQUEST['content'] == "users") ? 'active' : '' ?>">
                    <a href="users">
                        <i class="menu-icon fa fa-users"></i>
                        Users
                    </a>
                </li>
                <h3 class="menu-title">Laporan</h3>
                <li class="<?= ($_REQUEST['content'] == "riwayat") ? 'active' : '' ?>">
                    <a href="riwayat">
                        <i class="menu-icon fa fa-list"></i>
                        Hasil Konsultasi
                    </a>
                </li>
            </ul>
        </div>
        <!-- end:: sidebar -->
    </nav>
</aside>