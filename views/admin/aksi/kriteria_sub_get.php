<?php
$id  = $_GET['id'];
$qry = $pdo->GetWhere('tb_kriteria_sub', 'id_kriteria_sub', $id);
$row = $qry->fetch(PDO::FETCH_OBJ);

$result = [];
$result = [
    "id_kriteria_sub" => $row->id_kriteria_sub,
    "id_kriteria"     => $row->id_kriteria,
    "nama"            => $row->nama,
    "nilai"           => $row->nilai,
];

echo json_encode($result);
