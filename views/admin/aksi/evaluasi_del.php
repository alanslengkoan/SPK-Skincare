<?php
$id_jenis_kulit = $_POST['id_jenis_kulit'];
$id_alternatif = $_POST['id_alternatif'];

$sql2 = "DELETE FROM tb_evaluasi WHERE id_jenis_kulit = $id_jenis_kulit AND id_alternatif = $id_alternatif";
$qry2 = $pdo->Query($sql2);

if ($qry2) {
  exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data berhasil dihapus.', 'type' => 'success', 'button' => 'Ok!')));
} else {
  exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data tidak dapat dihapus.', 'type' => 'error', 'button' => 'Ok!')));
}
