<?php
$nma = strip_tags($_POST['nama']);
$deskripsi = strip_tags($_POST['deskripsi']);

$error = [];
foreach ($_POST as $key => $value) {
  if ($value == '') {
    $error[$key] = 'Kolom ini harus diisi.';
  }
  if (is_array($value)) {
    for ($c = 0; $c < count($value); $c++) {
      $check_value_arr = trim($value[$c]);
      if (empty($check_value_arr)) {
        $error[] = $c;
      }
    }
  }
}

if (count($error) != 0) {
  exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data gagal ditambahkan!', 'type' => 'error', 'button' => 'Ok!', 'errors' => $error)));
} else {
  if (empty($_POST['id_jenis_kulit'])) {
    $ins = $pdo->Insert("tb_jenis_kulit", ["nama", "deskripsi"], [$nma, $deskripsi]);
    if ($ins == 1) {
      exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data ditambah!', 'type' => 'success', 'button' => 'Ok!')));
    } else {
      exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data gagal ditambahkan!', 'type' => 'error', 'button' => 'Ok!')));
    }
  } else {
    $ida = strip_tags($_POST['id_jenis_kulit']);
    $upd = $pdo->Update("tb_jenis_kulit", 'id_jenis_kulit', $ida, ["nama", "deskripsi"], [$nma, $deskripsi]);
    if ($upd == 1) {
      exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data diubah.', 'type' => 'success', 'button' => 'Ok!')));
    } else {
      exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data tidak diubah.', 'type' => 'error', 'button' => 'Ok!')));
    }
  }
}
