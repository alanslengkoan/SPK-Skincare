<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Evaluasi</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="dashboard">Dashboard</a></li>
                    <li class="active">Evaluasi</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <!-- begin:: form -->
                <div class="card">
                    <div class="card-header">
                        <strong>Form</strong>
                    </div>
                    <form class="form-horizontal" action="aksi/?aksi=evaluasi_save" id="form-add-upd">
                        <!-- begin:: id -->
                        <input type="hidden" name="action" id="action" value="add" />
                        <!-- end:: id -->

                        <div class="card-body card-block">
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="nama" class=" form-control-label">Jenis Kulit&nbsp;*</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="id_jenis_kulit" id="id_jenis_kulit" class="form-control form-control-sm">
                                        <option value="">- Pilih -</option>
                                        <?php
                                        $query = $pdo->GetAll('tb_jenis_kulit', 'id_jenis_kulit');
                                        while ($row = $query->fetch(PDO::FETCH_OBJ)) { ?>
                                            <option value="<?= $row->id_jenis_kulit ?>"><?= $row->nama ?></option>
                                        <?php } ?>
                                    </select>
                                    <small class="help-block form-text error"></small>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="nama" class=" form-control-label">Alternatif&nbsp;*</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="id_alternatif" id="id_alternatif" class="form-control form-control-sm">
                                        <option value="">- Pilih -</option>
                                        <?php
                                        $query = $pdo->GetAll('tb_alternatif', 'id_alternatif');
                                        while ($row = $query->fetch(PDO::FETCH_OBJ)) { ?>
                                            <option value="<?= $row->id_alternatif ?>"><?= $row->nama ?></option>
                                        <?php } ?>
                                    </select>
                                    <small class="help-block form-text error"></small>
                                </div>
                            </div>
                            <?php
                            $query1 = $pdo->GetAll('tb_kriteria', 'id_kriteria');
                            $row = 0;
                            while ($row_k = $query1->fetch(PDO::FETCH_OBJ)) { ?>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="bobot" class=" form-control-label"><?= $row_k->nama ?>&nbsp;*</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="hidden" name="id_kriteria[]" value="<?= $row_k->id_kriteria ?>" />
                                        <select name="nilai[]" id="nilai_<?= $row++ ?>" class="form-control form-control-sm">
                                            <option value="">- Pilih -</option>
                                            <?php
                                            $query2 = $pdo->GetWhere('tb_kriteria_sub', 'id_kriteria', $row_k->id_kriteria);
                                            while ($row_s = $query2->fetch(PDO::FETCH_OBJ)) { ?>
                                                <option value="<?= $row_s->nilai ?>"><?= $row_s->nama ?></option>
                                            <?php } ?>
                                        </select>
                                        <small class="help-block form-text error"></small>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="card-footer">
                            <button type="submit" name="add" id="add" class="btn btn-success btn-sm">
                                <i class="fa fa-plus"></i> Tambah
                            </button>
                        </div>
                    </form>
                </div>
                <!-- end:: form -->

                <?php
                // untuk alternatif
                $sql_alternatif = "SELECT * FROM tb_alternatif";
                $res_alternatif = $pdo->Query($sql_alternatif);
                $alternatif     = [];
                while ($row_a = $res_alternatif->fetch(PDO::FETCH_OBJ)) {
                    $alternatif[$row_a->id_alternatif] = $row_a->nama;
                }

                // untuk kriteria
                $sql_kriteria = "SELECT * FROM tb_kriteria";
                $res_kriteria = $pdo->Query($sql_kriteria);
                $kriteria     = [];
                while ($row_k = $res_kriteria->fetch(PDO::FETCH_OBJ)) {
                    $kriteria[$row_k->id_kriteria] = $row_k->nama;
                }

                // untuk kriteria sub
                $sql_kriteria_sub = "SELECT * FROM tb_kriteria_sub";
                $res_kriteria_sub = $pdo->Query($sql_kriteria_sub);
                $kriteria_sub     = [];
                while ($row_s = $res_kriteria_sub->fetch(PDO::FETCH_OBJ)) {
                    $kriteria_sub[$row_s->id_kriteria][$row_s->nilai] = $row_s->nama;
                }

                // untuk evaluasi
                $sql_evaluasi = "SELECT * FROM tb_evaluasi ORDER BY id_alternatif, id_kriteria";
                $res_evaluasi = $pdo->Query($sql_evaluasi);
                $evaluasi     = [];
                while ($row_e = $res_evaluasi->fetch(PDO::FETCH_OBJ)) {
                    $evaluasi[$row_e->id_alternatif][$row_e->id_kriteria] = $row_e->nilai;
                }
                ?>

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
                                    <th>Alternatif</th>
                                    <?php foreach ($kriteria as $key => $value) { ?>
                                        <th><?= $value ?></th>
                                    <?php } ?>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody align="center">
                                <?php
                                $no = 1;
                                foreach ($evaluasi as $key => $value) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $alternatif[$key] ?></td>
                                        <?php
                                        foreach ($value as $k => $v) { ?>
                                            <td><?= $kriteria_sub[$k][$v] ?></td>
                                        <?php } ?>
                                        <td>
                                            <button class="btn btn-primary btn-sm btn-action" id="upd" data-id="<?= $key ?>"><i class="fa fa-edit"></i> Ubah</button>&nbsp;
                                            <button class="btn btn-danger btn-sm btn-action" id="del" data-id="<?= $key ?>"><i class="fa fa-trash"></i> Hapus</button>
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