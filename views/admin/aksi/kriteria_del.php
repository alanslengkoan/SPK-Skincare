<?php
$id = $_POST['id'];
$del = $pdo->Delete("tb_kriteria", "id_kriteria", $id);
if ($del == 1) {
  exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data berhasil dihapus.', 'type' => 'success', 'button' => 'Ok!')));
} else {
  exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data tidak dapat dihapus.', 'type' => 'error', 'button' => 'Ok!')));
}
