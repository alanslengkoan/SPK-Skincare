    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Hasil Algoritma</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li><a href="dashboard">Dashboard</a></li>
                        <li class="active">Hasil Algoritma</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <!-- begin:: tabel -->
                    <div class="card">
                        <div class="card-header">
                            <h5>Tabel</h5>
                        </div>
                        <div class="card-body">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead align="center">
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Telepon</th>
                                        <th>Tanggal Konsultasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody align="center">
                                    <?php
                                    $sql = "SELECT r.id_riwayat, r.tgl AS tgl_konsul, u.id_users, u.nama, u.email, m.tgl_lahir, m.tmp_lahir, m.kelamin, m.telepon, m.alamat FROM tb_riwayat AS r LEFT JOIN tb_member AS m ON m.id_member = r.id_member LEFT JOIN tb_users AS u ON u.id_users = m.id_users ORDER BY r.id_riwayat";
                                    $qry = $pdo->Query($sql);
                                    $sum = $qry->rowCount();
                                    $no  = 1;

                                    while ($row = $qry->fetch(PDO::FETCH_OBJ)) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $row->nama ?></td>
                                            <td><?= $row->email ?></td>
                                            <td><?= $row->telepon ?></td>
                                            <td><?= $row->tgl_konsul ?></td>
                                            <td>
                                                <a href="content/riwayat_cetak.php?id_riwayat=<?= $row->id_riwayat ?>" class="btn btn-info btn-sm btn-action" target="_blank"><i class="fa fa-print"></i>&nbsp;Cetak</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end:: tabel -->
                </div>
            </div>
        </div>
    </div>
    </div>