<?php
ob_start();
// untuk router
include_once '../../../configs/library/my_root.php';
// autoload class
spl_autoload_register('autoLoadClass');
// untuk memanggil class sql
$pdo = new sql;
// untuk class my_login
$mylog = new my_login;
// untuk class my_function
$myfun = new my_function;

// untuk alternatif
$sql_alternatif = "SELECT id_alternatif, nama FROM tb_alternatif";
$res_alternatif = $pdo->Query($sql_alternatif);
$alternatif = [];
while ($row_a = $res_alternatif->fetch(PDO::FETCH_OBJ)) {
    $alternatif[$row_a->id_alternatif] = $row_a->nama;
}

// ambil data laporan
$id_riwayat   = $_GET['id_riwayat'];
$qryLaporan   = $pdo->GetWhere('tb_riwayat', 'id_riwayat', $id_riwayat);
$rowLaporan   = $qryLaporan->fetch(PDO::FETCH_OBJ);
$hasil_metode = json_decode($rowLaporan->hasil, true);
?>

<!-- CSS -->
<style media="screen">
    .judul {
        padding: 4mm;
        text-align: center;
    }

    .nama {
        text-decoration: underline;
        font-weight: bold;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        margin-top: 0;
        margin-bottom: 5px;
    }

    h3 {
        font-family: times;
    }

    p {
        margin: 0;
    }
</style>
<!-- CSS -->

<div class="judul">
    <table align="center">
        <tr>
            <td width="600" align="center">
                <h4>SISTEM PENDUKUNG KEPUTUSAN METODE SMART</h4>
            </td>
        </tr>
    </table>

    <hr>

    <br /><br />

    <h3>Hasil Konsultasi</h3>

    <br /><br />

    <table align="center" border="1">
        <thead>
            <tr>
                <th>Ranking</th>
                <th>Alternatif</th>
                <th>Poin</th>
            </tr>
        </thead>
        <tbody align="center">
            <?php
            arsort($hasil_metode);
            $index = key($hasil_metode);

            $ranking = 1;
            foreach ($hasil_metode as $key => $value) { ?>
                <tr>
                    <td><?= $ranking++ ?></td>
                    <td><?= $alternatif[$key] ?></td>
                    <td><?= $value ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <br /><br />

    <p>
        Berdasarkan Hasil perhitungan Metode Smart, Alternatif <b><?= $alternatif[$index] ?></b> dengan nilai akhir <b><?= $hasil_metode[$index] ?></b> adalah Peringkat 1.
    </p>
</div>

<?php
// proses untuk menampilkan file pdf
$content = ob_get_clean();
include_once "./../../../vendors/html2pdf/html2pdf.class.php";
$html2pdf = new HTML2PDF('P', 'A4', 'en', 'utf-8');
$html2pdf->WriteHTML($content);
$html2pdf->Output('Cetak Riwayat.pdf');
?>