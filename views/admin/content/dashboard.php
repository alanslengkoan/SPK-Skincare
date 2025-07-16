    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li class="active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content mt-3">
        <div class="col-sm-12">
            <div class="alert  alert-success alert-dismissible fade show" role="alert">
                Selamat datang <b>ADMIN</b> di sistem pendukung keputusan Metode Smart.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Sistem Pendukung Keputusan Metode Smart</h3>
                    <p class="text-minify">
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="fa fa-list text-success border-success"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Alternatif</div>
                            <div class="stat-digit">
                                <?php
                                $qry_alternatif = $pdo->GetAll('tb_alternatif', 'id_alternatif');
                                $sum_alternatif = $qry_alternatif->rowCount();
                                echo $sum_alternatif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="fa fa-list text-primary border-primary"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Kriteria</div>
                            <div class="stat-digit">
                                <?php
                                $qry_kriteria = $pdo->GetAll('tb_kriteria', 'id_kriteria');
                                $sum_kriteria = $qry_kriteria->rowCount();
                                echo $sum_kriteria;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="fa fa-list text-warning border-warning"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Kriteria Sub</div>
                            <div class="stat-digit">
                                <?php
                                $qry_kriteria_sub = $pdo->GetAll('tb_kriteria_sub', 'id_kriteria_sub');
                                $sum_kriteria_sub = $qry_kriteria_sub->rowCount();
                                echo $sum_kriteria_sub;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="fa fa-list text-info border-info"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Penilaian</div>
                            <div class="stat-digit">
                                <?php
                                $qry_kriteria_sub = $pdo->GetAll('tb_kriteria_sub', 'id_kriteria_sub');
                                $sum_kriteria_sub = $qry_kriteria_sub->rowCount();
                                echo $sum_kriteria_sub;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="fa fa-list text-danger border-danger"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Evaluasi</div>
                            <div class="stat-digit">
                                <?php
                                $qry_evaluasi = $pdo->GetAll('tb_evaluasi', 'id_evaluasi');
                                $sum_evaluasi = $qry_evaluasi->rowCount();
                                echo $sum_evaluasi;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib"><i class="fa fa-users text-default border-default"></i></div>
                        <div class="stat-content dib">
                            <div class="stat-text">Users</div>
                            <div class="stat-digit">
                                <?php
                                $qry_users = $pdo->GetWhere('tb_users', 'level', 'users');
                                $sum_users = $qry_users->rowCount();
                                echo $sum_users;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>