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
                             <div class="row form-group">
                                 <div class="col col-md-3">
                                     <label for="id_kriteria" class=" form-control-label">Pilih Kriteria</label>
                                 </div>
                                 <div class="col-12 col-md-9">
                                     <select name="id_kriteria" id="id_kriteria" class="form-control form-control-sm">
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
                                     <label for="nilai" class=" form-control-label">Pilih Sub Kriteria</label>
                                 </div>
                                 <div class="col-12 col-md-9">
                                     <select name="nilai" id="nilai" class="form-control form-control-sm">
                                         <option value="">- Pilih -</option>
                                     </select>
                                 </div>
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