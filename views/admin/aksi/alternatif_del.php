<?php
$id = $_POST['id'];
$query  = $pdo->GetWhere('tb_alternatif', 'id_alternatif', $id);
$row    = $query->fetch(PDO::FETCH_OBJ);
$nmaGambarDb = $row->gambar;
// menghapus foto yg tersimpan dalam file dan akan diganti
if ($nmaGambarDb != '' || $nmaGambarDb != null) {
    if (file_exists("../../../assets/uploads/alternatif/" . $nmaGambarDb)) {
        unlink("../../../assets/uploads/alternatif/" . $nmaGambarDb);
    }
}

$del = $pdo->Delete("tb_alternatif", "id_alternatif", $id);
if ($del == 1) {
  exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data berhasil dihapus.', 'type' => 'success', 'button' => 'Ok!')));
} else {
  exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data tidak dapat dihapus.', 'type' => 'error', 'button' => 'Ok!')));
}
