   <?php
    $id_jenis_kulit = $_POST['id_jenis_kulit'];
    $id_kriteria = $_POST['id_kriteria'];
    $nilai = $_POST['nilai'];

    // untuk jenis kulit
    $sql_jenis_kulit = "SELECT id_jenis_kulit, nama FROM tb_jenis_kulit";
    $res_jenis_kulit = $pdo->Query($sql_jenis_kulit);
    $jenis_kulit     = [];
    while ($row_j = $res_jenis_kulit->fetch(PDO::FETCH_OBJ)) {
        $jenis_kulit[$row_j->id_jenis_kulit] = $row_j->nama;
    }

    // untuk kriteria
    $sql_kriteria = "SELECT id_kriteria, nama, bobot, tipe FROM tb_kriteria";
    $res_kriteria = $pdo->Query($sql_kriteria);
    $kriteria     = [];
    $nma_kriteria = [];
    while ($row_k = $res_kriteria->fetch(PDO::FETCH_OBJ)) {
        $kriteria[$row_k->id_kriteria] = [
            'nama'  => $row_k->nama,
            'bobot' => $row_k->bobot,
            'tipe'  => $row_k->tipe
        ];
        $nma_kriteria[$row_k->id_kriteria] = $row_k->nama;
    }

    // filter
    $where = "";
    foreach ($id_kriteria as $key => $value) {
        if ($nilai[$key] != "") {
            $where .= "nilai = $nilai[$key] OR ";
        }
    }

    // ambil alternatif
    $sql_id_alternatif = "SELECT id_alternatif FROM tb_evaluasi WHERE id_jenis_kulit = $id_jenis_kulit AND (" . substr($where, 0, -3) . ")";
    $res_id_alternatif = $pdo->Query($sql_id_alternatif);
    $get_id_alternatif = [];
    while ($row_e = $res_id_alternatif->fetch(PDO::FETCH_OBJ)) {
        $get_id_alternatif[] = $row_e->id_alternatif;
    }

    if (count($get_id_alternatif) == 0) {
        echo "<script>alert('Data tidak ditemukan'); window.location.href = 'konsultasi';</script>";
        exit;
    }

    // untuk alternatif
    $sql_alternatif = "SELECT id_alternatif, nama FROM tb_alternatif WHERE id_alternatif IN (" . implode(",", $get_id_alternatif) . ")";
    $res_alternatif = $pdo->Query($sql_alternatif);
    $alternatif     = [];
    $nma_alternatif = [];
    while ($row_a = $res_alternatif->fetch(PDO::FETCH_OBJ)) {
        $alternatif[$row_a->id_alternatif] = $row_a->nama;
        $nma_alternatif[$row_a->id_alternatif]['alternatif'] = $row_a->nama;
    }

    // untuk evaluasi
    $sql_evaluasi = "SELECT * FROM tb_evaluasi WHERE id_jenis_kulit = $id_jenis_kulit AND id_alternatif IN (" . implode(",", $get_id_alternatif) . ") ORDER BY id_alternatif, id_kriteria";
    $res_evaluasi = $pdo->Query($sql_evaluasi);
    $sample = [];
    while ($row_e = $res_evaluasi->fetch(PDO::FETCH_OBJ)) {
        if (!isset($sample[$row_e->id_alternatif])) {
            $sample[$row_e->id_alternatif] = [];
        }
        $sample[$row_e->id_alternatif][$row_e->id_kriteria] = $row_e->nilai;
    }

    $jumlah_kriteria = count($kriteria);
    ?>

   <div class="breadcrumbs">
       <div class="col-sm-4">
           <div class="page-header float-left">
               <div class="page-title">
                   <h1>Algoritma</h1>
               </div>
           </div>
       </div>
       <div class="col-sm-8">
           <div class="page-header float-right">
               <div class="page-title">
                   <ol class="breadcrumb text-right">
                       <li><a href="dashboard">Dashboard</a></li>
                       <li class="active">Algoritma</li>
                   </ol>
               </div>
           </div>
       </div>
   </div>

   <div class="content mt-3">
       <div class="animated fadeIn">
           <div class="row">
               <div class="col-lg-12">
                   <div class="card">
                       <div class="card-header">
                           <h5>Normalisasi Bobot Kriteria</h5>
                       </div>
                       <div class="card-body">
                           <table class="table table-striped table-bordered table-hover">
                               <thead align="center">
                                   <tr>
                                       <th>Kriteria</th>
                                       <th>Bobot Kriteria</th>
                                       <th>Normalisasi Bobot Kriteria</th>
                                   </tr>
                               </thead>
                               <tbody align="center">
                                   <?php
                                    $bobot = array();
                                    foreach ($kriteria as $k => $vk) {
                                        $bobot[$k] = $vk['bobot'];
                                    }
                                    $jml_bobot = array_sum($bobot);
                                    $w = array();
                                    foreach ($bobot as $k => $b) {
                                        $w[$k] = $b / $jml_bobot;
                                    }
                                    ?>

                                   <?php foreach ($nma_kriteria as $key => $value) { ?>
                                       <tr>
                                           <td><?= $value ?></td>
                                           <td><?= $bobot[$key] ?></td>
                                           <td><?= round($w[$key], 4) ?></td>
                                       </tr>
                                   <?php } ?>
                               </tbody>
                           </table>
                       </div>
                   </div>

                   <div class="card">
                       <div class="card-header">
                           <h5>Inisialisasi Bobot</h5>
                       </div>
                       <div class="card-body">
                           <table class="table table-striped table-bordered table-hover">
                               <thead align="center">
                                   <tr>
                                       <th>Alternatif</th>
                                       <?php foreach ($nma_kriteria as $key => $value) { ?>
                                           <th><?= $value ?></th>
                                       <?php } ?>
                                   </tr>
                               </thead>
                               <tbody align="center">
                                   <?php foreach ($nma_alternatif as $key => $value) { ?>
                                       <tr>
                                           <td><?= $value['alternatif'] ?></td>
                                           <?php foreach ($kriteria as $k => $v) { ?>
                                               <td><?= $sample[$key][$k] ?></td>
                                           <?php } ?>
                                       </tr>
                                   <?php } ?>
                               </tbody>
                           </table>
                       </div>
                   </div>

                   <?php
                    //-- inisialisasi variabel array tranpose_d untuk menyimpan data tranpose dari data sample
                    $tranpose_d = array();
                    foreach ($alternatif as $a => $v) {
                        foreach ($kriteria as $k => $v_k) {
                            if (!isset($tranpose_d[$k])) $tranpose_d[$k] = array();
                            $tranpose_d[$k][$a] = $sample[$a][$k];
                        }
                    }
                    //-- inisialisasi variabel array c_max dan c_min
                    $c_max = array();
                    $c_min = array();
                    //-- mencari nilai max dan min utk tiap-tiap kriteria
                    foreach ($kriteria as $k => $v) {
                        $c_max[$k] = max($tranpose_d[$k]);
                        $c_min[$k] = min($tranpose_d[$k]);
                    }
                    ?>

                   <div class="card">
                       <div class="card-header">
                           <h5>Min dan Max</h5>
                       </div>
                       <div class="card-body">
                           <table class="table table-striped table-bordered table-hover">
                               <thead align="center">
                                   <tr>
                                       <th>Tipe</th>
                                       <?php foreach ($kriteria as $key => $value) { ?>
                                           <th><?= $value['nama'] ?></th>
                                       <?php } ?>
                                   </tr>
                                   <tr>
                                       <td>Min</td>
                                       <?php foreach ($kriteria as $key => $value) { ?>
                                           <td><?= $c_min[$key] ?></td>
                                       <?php } ?>
                                   </tr>
                                   <tr>
                                       <td>Max</td>
                                       <?php foreach ($kriteria as $key => $value) { ?>
                                           <td><?= $c_max[$key] ?></td>
                                       <?php } ?>
                                   </tr>
                               </thead>
                           </table>
                       </div>
                   </div>

                   <?php
                    //-- inisialisasi variabel array U
                    $U = array();
                    //-- menghitung nilai utility utk masing-masing alternatif dan kriteria
                    foreach ($kriteria as $k => $v) {
                        foreach ($alternatif as $a => $a_v) {
                            if (!isset($U[$a])) $U[$a] = array();
                            if ($kriteria[$k]['tipe'] == 'benefit') {
                                //-- perhitungan nilai utility untuk benefit criteria
                                $U[$a][$k] = ($sample[$a][$k] - $c_min[$k]) == 0 ? 0 : ($sample[$a][$k] - $c_min[$k]) / ($c_max[$k] - $c_min[$k]);
                                $nma_alternatif[$a][$k] = ($sample[$a][$k] - $c_min[$k]) == 0 ? 0 : ($sample[$a][$k] - $c_min[$k]) / ($c_max[$k] - $c_min[$k]);
                            } else {
                                //-- perhitungan nilai utility untuk cost criteria
                                $U[$a][$k] = ($c_max[$k] - $sample[$a][$k]) == 0 ? 0 : ($c_max[$k] - $sample[$a][$k]) / ($c_max[$k] - $c_min[$k]);
                                $nma_alternatif[$a][$k] = ($c_max[$k] - $sample[$a][$k]) == 0 ? 0 : ($c_max[$k] - $sample[$a][$k]) / ($c_max[$k] - $c_min[$k]);
                            }
                        }
                    }
                    ?>
                   <div class="card">
                       <div class="card-header">
                           <h5>Menghitung Nilai Utility</h5>
                       </div>
                       <div class="card-body">
                           <table class="table table-striped table-bordered table-hover">
                               <thead align="center">
                                   <tr>
                                       <th>Alternatif</th>
                                       <?php foreach ($nma_kriteria as $key => $value) { ?>
                                           <th><?= $value ?></th>
                                       <?php } ?>
                                   </tr>
                               </thead>
                               <tbody align="center">
                                   <?php foreach ($nma_alternatif as $key => $value) { ?>
                                       <tr>
                                           <td><?= $value['alternatif'] ?></td>
                                           <?php for ($i = 1; $i <= $jumlah_kriteria; $i++) { ?>
                                               <td><?= round($value[$i]) ?></td>
                                           <?php } ?>
                                       </tr>
                                   <?php } ?>
                               </tbody>
                           </table>
                       </div>
                   </div>
                   <?php
                    $perangkingan = array();
                    foreach ($U as $a => $a_u) {
                        $perangkingan[$a] = 0;
                        foreach ($a_u as $k => $u) {
                            $perangkingan[$a] += $u * $w[$k];
                        }
                    }
                    ?>
                   <div class="card">
                       <div class="card-header">
                           <h5>Hasil</h5>
                       </div>
                       <div class="card-body">
                           <table class="table table-striped table-bordered table-hover">
                               <thead align="center">
                                   <tr>
                                       <th>Nama</th>
                                       <th>Hasil</th>
                                   </tr>
                               </thead>
                               <tbody align="center">
                                   <?php foreach ($perangkingan as $key => $value) { ?>
                                       <tr>
                                           <td><?= $alternatif[$key] ?></td>
                                           <td><?= round($perangkingan[$key], 4) ?></td>
                                       </tr>
                                   <?php } ?>
                               </tbody>
                           </table>
                       </div>
                   </div>
                   <div class="card">
                       <div class="card-header">
                           <h5>Perangkingan (Hasil Akhir)</h5>
                       </div>
                       <div class="card-body">
                           <table class="table table-striped table-bordered table-hover">
                               <thead align="center">
                                   <tr>
                                       <th>Peringkat</th>
                                       <th>Nama</th>
                                       <th>Hasil</th>
                                   </tr>
                               </thead>
                               <tbody align="center">
                                   <?php
                                    $rank = 1;
                                    arsort($perangkingan);
                                    $index = key($perangkingan);
                                    foreach ($perangkingan as $key => $value) { ?>
                                       <?php if ($perangkingan[$key] > 0.5) { ?>
                                           <tr>
                                               <td><?= $rank++ ?></td>
                                               <td><?= $alternatif[$key] ?></td>
                                               <td><?= round($perangkingan[$key], 4) ?></td>
                                           </tr>
                                       <?php } ?>
                                   <?php } ?>
                               </tbody>
                           </table>
                           Berdasarkan Hasil Analisis Algoritma maka diperoleh rekomendasi keputusan untuk jenis kulit <b><?= $jenis_kulit[$id_jenis_kulit] ?></b> yaitu <b><?= $alternatif[$index] ?></b> dengan nilai akhir <b><?= round($perangkingan[$index], 4) ?></b>.
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
   </div>

   <?php
    $hasil_metode = json_encode($perangkingan);
    $member       = $pdo->GetWhere('tb_member', 'id_users', $_SESSION['id_users']);
    $rowMember    = $member->fetch(PDO::FETCH_OBJ);

    $pdo->Insert("tb_riwayat", ["id_member", "id_jenis_kulit", "hasil", "tgl"], [$rowMember->id_member, $id_jenis_kulit, $hasil_metode, date('Y-m-d')]);
    ?>