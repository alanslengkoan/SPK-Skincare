 <div class="breadcrumbs">
   <div class="col-sm-4">
     <div class="page-header float-left">
       <div class="page-title">
         <h1>Penilaian</h1>
       </div>
     </div>
   </div>
   <div class="col-sm-8">
     <div class="page-header float-right">
       <div class="page-title">
         <ol class="breadcrumb text-right">
           <li><a href="dashboard">Dashboard</a></li>
           <li class="active">Penilaian</li>
         </ol>
       </div>
     </div>
   </div>
 </div>

 <div class="content mt-3">
   <div class="animated fadeIn">
     <div class="row">
       <!-- begin:: tabel -->
       <?php
        $query1 = $pdo->GetAll('tb_kriteria', 'id_kriteria');
        while ($row_k = $query1->fetch(PDO::FETCH_OBJ)) { ?>
         <div class="col-lg-6">
           <div class="card">
             <div class="card-header">
               <h5>Tabel Kriteria <?= $row_k->nama ?></h5>
             </div>
             <div class="card-body">
               <table class="table table-striped table-bordered data-table">
                 <thead align="center">
                   <tr>
                     <th>No</th>
                     <th>Nama</th>
                     <th>Nilai</th>
                   </tr>
                 </thead>
                 <tbody align="center">
                   <?php
                    $query2 = $pdo->GetWhere('tb_kriteria_sub', 'id_kriteria', $row_k->id_kriteria);
                    $row = 0;
                    while ($row_s = $query2->fetch(PDO::FETCH_OBJ)) { ?>
                     <tr>
                       <td><?= ++$row ?></td>
                       <td><?= $row_s->nama ?></td>
                       <td><?= $row_s->nilai ?></td>
                     </tr>
                   <?php } ?>
                 </tbody>
               </table>
             </div>
           </div>
         </div>
       <?php } ?>
       <!-- end:: tabel -->
     </div>
   </div>
 </div>
 </div>