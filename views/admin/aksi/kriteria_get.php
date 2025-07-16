<?php
$id  = $_GET['id'];
$qry = $pdo->GetWhere('tb_kriteria', 'id_kriteria', $id);
$row = $qry->fetch(PDO::FETCH_OBJ);

$result = [];
$result = [
    "id_kriteria" => $row->id_kriteria,
    "nama"        => $row->nama,
    "bobot"       => $row->bobot,
    "tipe"        => $row->tipe,
];

echo json_encode($result);
