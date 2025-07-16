<?php
$id  = $_GET['id'];
$sql = "SELECT tb_alternatif.id_alternatif, tb_alternatif.nama FROM tb_alternatif WHERE tb_alternatif.id_alternatif = '$id'";
$qry = $pdo->Query($sql);
$row = $qry->fetch(PDO::FETCH_OBJ);

$result = [];
$result = [
    "id_alternatif" => $row->id_alternatif,
    "nama"          => $row->nama,
];

echo json_encode($result);
