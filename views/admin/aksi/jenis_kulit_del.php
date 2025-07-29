<?php
$id = $_POST['id'];
$query  = $pdo->GetWhere('tb_jenis_kulit', 'id_jenis_kulit', $id);
$row    = $query->fetch(PDO::FETCH_OBJ);
$nmaGambarDb = $row->gambar;
// menghapus foto yg tersimpan dalam file dan akan diganti
if ($nmaGambarDb != '' || $nmaGambarDb != null) {
    if (file_exists("../../../assets/uploads/jenis_kulit/" . $nmaGambarDb)) {
        unlink("../../../assets/uploads/jenis_kulit/" . $nmaGambarDb);
    }
}

$del = $pdo->Delete("tb_jenis_kulit", "id_jenis_kulit", $id);
if ($del == 1) {
  exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data berhasil dihapus.', 'type' => 'success', 'button' => 'Ok!')));
} else {
  exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data tidak dapat dihapus.', 'type' => 'error', 'button' => 'Ok!')));
}
