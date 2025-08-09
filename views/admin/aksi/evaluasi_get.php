<?php
$id_jenis_kulit = $_GET['id_jenis_kulit'];
$id_alternatif = $_GET['id_alternatif'];

$sql2 = "SELECT * FROM tb_evaluasi WHERE id_jenis_kulit = $id_jenis_kulit AND id_alternatif = $id_alternatif";
$qry2 = $pdo->Query($sql2);

$result = [];

$result['id_jenis_kulit'] = $id_jenis_kulit;
$result['id_alternatif']  = $id_alternatif;

$cow = 0;
while ($rows = $qry2->fetch(PDO::FETCH_OBJ)) {
    $result['nilai_' . $cow++] = $rows->nilai;
}

echo json_encode($result);
