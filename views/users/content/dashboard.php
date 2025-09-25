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
                Selamat datang <b>USERS</b> di Sistem Pendukung Keputusan Penentuan Skincare BPOM Berdasarkan Jenis Kulit Wajah Menggunakan Metode SMART.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <?php
                        $sql    = "SELECT tb_alternatif.id_alternatif, tb_alternatif.nama, tb_alternatif.gambar FROM tb_alternatif ORDER BY tb_alternatif.id_alternatif ASC";
                        $query  = $pdo->Query($sql);
                        $jumlah = $query->rowCount();
                        $no = 1;
                        if ($jumlah > 0) {
                            while ($row = $query->fetch(PDO::FETCH_OBJ)) { ?>
                                <div class="col-6 col-md-2 mb-3">
                                    <div class="product-card">
                                        <img src="../../assets/uploads/alternatif/<?= $row->gambar ?>" alt="<?= $row->nama; ?>">
                                        <div class="product-name"><?= $row->nama; ?></div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>