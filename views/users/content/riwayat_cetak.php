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

// untuk jenis_kulit
$sql_jenis_kulit = "SELECT id_jenis_kulit, nama FROM tb_jenis_kulit";
$res_jenis_kulit = $pdo->Query($sql_jenis_kulit);
$jenis_kulit     = [];
while ($row_j = $res_jenis_kulit->fetch(PDO::FETCH_OBJ)) {
    $jenis_kulit[$row_j->id_jenis_kulit] = $row_j->nama;
}

// untuk alternatif
$sql_alternatif = "SELECT id_alternatif, nama, gambar FROM tb_alternatif";
$res_alternatif = $pdo->Query($sql_alternatif);
$alternatif = [];
while ($row_a = $res_alternatif->fetch(PDO::FETCH_OBJ)) {
    $alternatif[$row_a->id_alternatif] = [
        "nama"   => $row_a->nama,
        "gambar" => $row_a->gambar,
    ];
}

// ambil data laporan
$id_riwayat     = $_GET['id_riwayat'];
$sqlRiwayat = "SELECT r.id_riwayat, r.hasil, r.id_jenis_kulit, u.nama, m.tgl_lahir, m.tmp_lahir, m.telepon FROM tb_riwayat AS r LEFT JOIN tb_member AS m ON m.id_member = r.id_member LEFT JOIN tb_users AS u ON u.id_users = m.id_users WHERE id_riwayat = '$id_riwayat'";
$resRiwayat     = $pdo->Query($sqlRiwayat);
$rowLaporan     = $resRiwayat->fetch(PDO::FETCH_OBJ);
$hasil_metode   = json_decode($rowLaporan->hasil, true);
$id_jenis_kulit = $rowLaporan->id_jenis_kulit;

$baseUrl  = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
$baseUrl .= "://{$_SERVER['HTTP_HOST']}";
$baseUrl .= rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');

$path     = parse_url($baseUrl, PHP_URL_PATH);
$parts    = explode('/', trim($path, '/'));
$firstTwo = array_slice($parts, 0, 1);
$base     = parse_url($baseUrl, PHP_URL_SCHEME) . '://' . parse_url($baseUrl, PHP_URL_HOST) . '/' . implode('/', $firstTwo);
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

    .kop-surat td {
        vertical-align: middle;
        text-align: center;
    }

    .kop-title {
        font-size: 16px;
        font-weight: bold;
    }

    .kop-subtitle {
        font-size: 14px;
    }
</style>
<!-- CSS -->

<div class="judul">
    <table class="kop-surat" align="center">
        <tr align="center" width="100%">
            <td>
                <img src="<?= $base . '/assets/page/img/logo.jpg' ?>" width="80" height="80" />
            </td>
            <td width="600">
                <p class="kop-title">Rarif Store</p>
                <p class="kop-subtitle">Jl. H. M Yasin Limpo No.6, Romangpolong Kec. Somba Opu, <br> Kabupaten Gowa, Sulawesi Selatan 92113 Indonesia</p>
                <p class="kop-subtitle">Email: info@domain.com | Telp: (021) 1234567</p>
            </td>
        </tr>
    </table>

    <hr>

    <br /><br />

    <h3>Detail User</h3>

    <br /><br />

    <table align="center" border="1">
        <tr>
            <td>Nama</td>
            <td><?= $rowLaporan->nama ?></td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td><?= $rowLaporan->tgl_lahir ?></td>
        </tr>
        <tr>
            <td>Tempat Lahir</td>
            <td><?= $rowLaporan->tmp_lahir ?></td>
        </tr>
        <tr>
            <td>No Telp</td>
            <td><?= $rowLaporan->telepon ?></td>
        </tr>
    </table>

    <br /><br />

    <h3>Hasil Konsultasi</h3>

    <br /><br />

    <?php
    arsort($hasil_metode);
    $index = key($hasil_metode);
    ?>

    <h4>
        Berdasarkan Hasil Analisis Algoritma maka diperoleh rekomendasi keputusan untuk jenis kulit <b><?= $jenis_kulit[$id_jenis_kulit] ?></b> yaitu <b><?= $alternatif[$index]['nama'] ?></b> dengan nilai akhir <b><?= $hasil_metode[$index] ?></b>.
    </h4>

    <br /><br />

    <table align="center" border="1">
        <thead>
            <tr>
                <th>Ranking</th>
                <th>Alternatif</th>
                <th>Gambar</th>
                <th>Poin</th>
            </tr>
        </thead>
        <tbody align="center">
            <?php
            $ranking = 1;
            foreach ($hasil_metode as $key => $value) { ?>
                <?php if ($value >= 0.5) { ?>
                    <tr>
                        <td><?= $ranking++ ?></td>
                        <td><?= $alternatif[$key]['nama'] ?></td>
                        <td><img src="<?= $base . '/assets/uploads/alternatif/' . $alternatif[$key]['gambar'] ?>" width="100" height="100" /></td>
                        <td><?= round($value, 4) ?></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php
// proses untuk menampilkan file pdf
$content = ob_get_clean();
include_once "./../../../vendors/html2pdf/html2pdf.class.php";
$html2pdf = new HTML2PDF('P', 'A4', 'en', 'utf-8');
$html2pdf->WriteHTML($content);
$html2pdf->Output('Cetak Riwayat.pdf');
?>