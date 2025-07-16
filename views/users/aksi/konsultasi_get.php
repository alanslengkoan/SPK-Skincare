<?php
$id   = $_GET['id'];
$qry1 = $pdo->GetWhere('tb_evaluasi', 'id_alternatif', $id);
$qry2 = $pdo->GetWhere('tb_evaluasi', 'id_alternatif', $id);

$result = [];
$row = $qry1->fetch(PDO::FETCH_OBJ);
$result['id_alternatif'] = $row->id_alternatif;

$cow = 0;
while ($rows = $qry2->fetch(PDO::FETCH_OBJ)) {
    $result['nilai_' . $cow++] = $rows->nilai;
}

echo json_encode($result);
