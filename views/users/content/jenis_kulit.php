 <div class="breadcrumbs">
     <div class="col-sm-4">
         <div class="page-header float-left">
             <div class="page-title">
                 <h1>Jenis Kulit</h1>
             </div>
         </div>
     </div>
     <div class="col-sm-8">
         <div class="page-header float-right">
             <div class="page-title">
                 <ol class="breadcrumb text-right">
                     <li><a href="dashboard">Dashboard</a></li>
                     <li class="active">Jenis Kulit</li>
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
                                     <th>Deskripsi</th>
                                     <th>Gambar</th>
                                 </tr>
                             </thead>
                             <tbody align="center">
                                 <?php
                                    $sql    = "SELECT tb_jenis_kulit.id_jenis_kulit, tb_jenis_kulit.nama, tb_jenis_kulit.deskripsi, tb_jenis_kulit.gambar FROM tb_jenis_kulit ORDER BY tb_jenis_kulit.id_jenis_kulit ASC";
                                    $query  = $pdo->Query($sql);
                                    $jumlah = $query->rowCount();
                                    $no = 1;
                                    if ($jumlah > 0) {
                                        while ($row = $query->fetch(PDO::FETCH_OBJ)) { ?>
                                         <tr>
                                             <td><?= $no++; ?></td>
                                             <td><?= $row->nama; ?></td>
                                             <td><?= $row->deskripsi; ?></td>
                                             <td>
                                                 <img src="../../assets/uploads/jenis_kulit/<?= $row->gambar ?>" width="100" height="100" />
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