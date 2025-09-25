   <?php
    $id_jenis_kulit = $_POST['id_jenis_kulit'];

    // untuk jenis kulit
    $sql_jenis_kulit = "SELECT id_jenis_kulit, nama FROM tb_jenis_kulit";
    $res_jenis_kulit = $pdo->Query($sql_jenis_kulit);
    $jenis_kulit     = [];
    while ($row_j = $res_jenis_kulit->fetch(PDO::FETCH_OBJ)) {
        $jenis_kulit[$row_j->id_jenis_kulit] = $row_j->nama;
    }

    // untuk alternatif
    $sql_alternatif = "SELECT id_alternatif, nama FROM tb_alternatif";
    $res_alternatif = $pdo->Query($sql_alternatif);
    $get_alternatif = [];
    while ($row_a = $res_alternatif->fetch(PDO::FETCH_OBJ)) {
        $get_alternatif[$row_a->id_alternatif] = $row_a->nama;
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

    // untuk evaluasi
    $sql_evaluasi = "SELECT * FROM tb_evaluasi WHERE id_jenis_kulit = $id_jenis_kulit ORDER BY id_alternatif, id_kriteria";
    $res_evaluasi = $pdo->Query($sql_evaluasi);
    $sample = [];
    while ($row_e = $res_evaluasi->fetch(PDO::FETCH_OBJ)) {
        if (!isset($sample[$row_e->id_alternatif])) {
            $sample[$row_e->id_alternatif] = [];
        }
        $sample[$row_e->id_alternatif][$row_e->id_kriteria] = $row_e->nilai;
    }

    $data = [];
    foreach ($sample as $key => $value) {
        $data[$key]['alternatif'] = $get_alternatif[$key];
        foreach ($value as $k => $v) {
            $data[$key][$k] = $v;
        }
    }

    if (isset($_POST['model_kriteria'])) {
        $id_kriteria = $_POST['id_kriteria'];
        $nilai = $_POST['nilai'];

        $filter = [];
        foreach ($id_kriteria as $key => $value) {
            if ($value != '' && $nilai[$key] != '') {
                $filter[$value] = $nilai[$key];
            }
        }

        $result = array_filter($data, function ($row) use ($filter) {
            foreach ($filter as $key => $val) {
                if (!isset($row[$key]) || $row[$key] != $val) {
                    return false;
                }
            }
            return true;
        });
    } else {
        $result = $data;
    }

    $get_id_alternatif = [];
    foreach ($result as $key => $value) {
        $get_id_alternatif[] = $key;
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
                       <div class="card-body">
                           <button class="btn btn-primary btn-block" type="button" data-bs-toggle="collapse" data-bs-target="#produkCard" aria-expanded="false" aria-controls="produkCard">
                               Tampilkan Proses Perhitungan
                           </button>
                       </div>
                   </div>

                   <div class="collapse" id="produkCard">
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
                                               <td><?= number_format($w[$key], 4, '.', '') ?></td>
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
                                                   <td><?= number_format($sample[$key][$k], 4, '.', '') ?></td>
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
                                               <td><?= number_format($c_min[$key], 4, '.', '') ?></td>
                                           <?php } ?>
                                       </tr>
                                       <tr>
                                           <td>Max</td>
                                           <?php foreach ($kriteria as $key => $value) { ?>
                                               <td><?= number_format($c_max[$key], 4, '.', '') ?></td>
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
                                                   <td><?= number_format($value[$i], 4, '.', '') ?></td>
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
                   </div>

                   <?php
                    arsort($perangkingan);
                    $index = key($perangkingan);
                    ?>

                   <div class="card">
                       <div class="card-header">
                           <h5>Perangkingan (Hasil Akhir)</h5>
                       </div>
                       <div class="card-body">
                           <h3>
                               Berdasarkan Hasil Analisis Algoritma maka diperoleh rekomendasi keputusan untuk jenis kulit <b><?= $jenis_kulit[$id_jenis_kulit] ?></b> yaitu <b><?= $alternatif[$index] ?></b> dengan nilai akhir <b><?= number_format($perangkingan[$index], 4, '.', '') ?></b>.
                           </h3>
                           <hr>
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
                                    foreach ($perangkingan as $key => $value) { ?>
                                       <?php if ($perangkingan[$key] >= 0.5) { ?>
                                           <tr>
                                               <td><?= $rank++ ?></td>
                                               <td><?= $alternatif[$key] ?></td>
                                               <td><?= number_format($perangkingan[$key], 4, '.', '') ?></td>
                                           </tr>
                                       <?php } ?>
                                   <?php } ?>
                               </tbody>
                           </table>
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