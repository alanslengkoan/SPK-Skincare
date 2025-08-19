 <div class="breadcrumbs">
     <div class="col-sm-4">
         <div class="page-header float-left">
             <div class="page-title">
                 <h1>Konsultasi</h1>
             </div>
         </div>
     </div>
     <div class="col-sm-8">
         <div class="page-header float-right">
             <div class="page-title">
                 <ol class="breadcrumb text-right">
                     <li><a href="dashboard">Dashboard</a></li>
                     <li class="active">Konsultasi</li>
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
                     <form class="form-horizontal" action="konsultasi_hasil" method="post">
                         <div class="card-body card-block">
                             <div class="row form-group">
                                 <div class="col col-md-3">
                                     <label for="id_jenis_kulit" class=" form-control-label">Jenis Kulit&nbsp;*</label>
                                 </div>
                                 <div class="col-12 col-md-9">
                                     <select name="id_jenis_kulit" id="id_jenis_kulit" required class="form-control form-control-sm">
                                         <option value="">- Pilih -</option>
                                         <?php
                                            $query = $pdo->GetAll('tb_jenis_kulit', 'id_jenis_kulit');
                                            while ($row = $query->fetch(PDO::FETCH_OBJ)) { ?>
                                             <option value="<?= $row->id_jenis_kulit ?>"><?= $row->nama ?></option>
                                         <?php } ?>
                                     </select>
                                 </div>
                             </div>
                             <p>
                                 Jika anda ingin mengetahui skincare berdasarkan jenis kulit anda, anda dapat memilih jenis kulit lalu klik Proses.
                             </p>
                             <p>
                                 Pilih model kriteria yang ingin digunakan.
                                 Jika memilih <strong>Spesifik</strong>, Anda dapat menambahkan kriteria pendukung seperti
                                 kandungan, harga, rating, dan jumlah penjualan.
                                 Jika memilih <strong>Semua</strong>, maka sistem akan menampilkan semua data tanpa filter kriteria.
                             </p>
                             <div class="row form-group">
                                 <div class="col col-md-3">
                                     <label class="form-control-label">Model Kriteria</label>
                                 </div>
                                 <div class="col-12 col-md-9">
                                     <div class="form-check form-check-inline">
                                         <input class="form-check-input" type="radio" name="model_kriteria" id="spesifik" value="spesifik">
                                         <label class="form-check-label" for="spesifik">Spesifik</label>
                                     </div>
                                     <div class="form-check form-check-inline">
                                         <input class="form-check-input" type="radio" name="model_kriteria" id="semua" value="semua">
                                         <label class="form-check-label" for="semua">Semua</label>
                                     </div>
                                 </div>
                             </div>

                             <div id="content_spesifik" style="display:none;">
                                 <div class="row form-group">
                                     <div class="col col-md-3">
                                         <label for="id_kriteria_spesifik" class=" form-control-label">Pilih Kriteria</label>
                                     </div>
                                     <div class="col-12 col-md-9">
                                         <select name="id_kriteria_spesifik" id="id_kriteria_spesifik" class="form-control form-control-sm">
                                             <option value="">- Pilih -</option>
                                             <?php
                                                $query = $pdo->GetAll('tb_kriteria', 'id_kriteria');
                                                while ($row = $query->fetch(PDO::FETCH_OBJ)) { ?>
                                                 <option value="<?= $row->id_kriteria ?>"><?= $row->nama ?></option>
                                             <?php } ?>
                                         </select>
                                     </div>
                                 </div>
                                 <div class="row form-group">
                                     <div class="col col-md-3">
                                         <label for="nilai_spesifik" class=" form-control-label">Pilih Sub Kriteria</label>
                                     </div>
                                     <div class="col-12 col-md-9">
                                         <select name="nilai_spesifik" id="nilai_spesifik" class="form-control form-control-sm">
                                             <option value="">- Pilih -</option>
                                         </select>
                                     </div>
                                 </div>
                             </div>
                             <div id="content_semua" style="display:none;">
                                 <?php
                                    $query1 = $pdo->GetAll('tb_kriteria', 'id_kriteria');
                                    $row = 0;
                                    while ($row_k = $query1->fetch(PDO::FETCH_OBJ)) { ?>
                                     <div class="row form-group">
                                         <div class="col col-md-3">
                                             <label for="bobot" class=" form-control-label"><?= $row_k->nama ?></label>
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
                         </div>
                         <div class="card-footer">
                             <button type="submit" name="add" id="add" class="btn btn-success btn-sm">
                                 <i class="fa fa-plus"></i> Proses
                             </button>
                         </div>
                     </form>
                 </div>
                 <!-- end:: form -->
             </div>
         </div>
     </div>
 </div>
 </div>