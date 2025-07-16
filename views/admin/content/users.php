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
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Telepon</th>
                                        <th>Username</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Tempat Lahir</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody align="center">
                                    <?php
                                    $sql    = "SELECT u.id_users, u.nama, u.username, u.email, u.status, m.tgl_lahir, m.tmp_lahir, m.kelamin, m.telepon, m.alamat FROM tb_member AS m LEFT JOIN tb_users AS u ON u.id_users = m.id_users ORDER BY m.id_users";
                                    $query  = $pdo->Query($sql);
                                    $jumlah = $query->rowCount();
                                    $no = 1;
                                    if ($jumlah > 0) {
                                        while ($row = $query->fetch(PDO::FETCH_OBJ)) { ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $row->nama; ?></td>
                                                <td><?= $row->email; ?></td>
                                                <td><?= $row->telepon; ?></td>
                                                <td><?= $row->username; ?></td>
                                                <td><?= $row->tgl_lahir; ?></td>
                                                <td><?= $row->tmp_lahir; ?></td>
                                                <td><?= $row->kelamin; ?></td>
                                                <td><?= $row->alamat; ?></td>
                                                <td>
                                                    <button class="btn btn-warning btn-sm btn-action" type="button" id="res-pass" data-id="<?= $row->id_users ?>"><i class="fa fa-refresh"></i>&nbsp;Reset Password</button>&nbsp;
                                                    <button class="btn btn-primary btn-sm btn-action" type="button" id="sts" data-sts="<?= $row->status ?>" data-id="<?= $row->id_users ?>"><?= ($row->status == '1') ? '<i class="fa fa-check"></i>&nbsp;Aktif' : '<i class="fa fa-times"></i>&nbsp;Tidak aktif' ?></button>
                                                </td>
                                            </tr>
                                        <?php } ?>
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