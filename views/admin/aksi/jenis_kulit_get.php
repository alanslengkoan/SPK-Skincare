<?php
$id  = $_GET['id'];
$sql = "SELECT tb_jenis_kulit.id_jenis_kulit, tb_jenis_kulit.nama, tb_jenis_kulit.deskripsi FROM tb_jenis_kulit WHERE tb_jenis_kulit.id_jenis_kulit = '$id'";
$qry = $pdo->Query($sql);
$row = $qry->fetch(PDO::FETCH_OBJ);

$result = [];
$result = [
    "id_jenis_kulit" => $row->id_jenis_kulit,
    "nama"           => $row->nama,
    "deskripsi"      => $row->deskripsi,
];

echo json_encode($result);