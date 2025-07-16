<?php
$idk = strip_tags($_POST['id_kriteria']);
$nam = strip_tags($_POST['nama']);
$nil = strip_tags($_POST['nilai']);

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
  if (empty($_POST['id_kriteria_sub'])) {
    $ins = $pdo->Insert("tb_kriteria_sub", ["id_kriteria", "nama", "nilai"], [$idk, $nam, $nil]);
    if ($ins == 1) {
      exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data ditambah!', 'type' => 'success', 'button' => 'Ok!')));
    } else {
      exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data gagal ditambahkan!', 'type' => 'error', 'button' => 'Ok!')));
    }
  } else {
    $idks = strip_tags($_POST['id_kriteria_sub']);
    $upd = $pdo->Update('tb_kriteria_sub', 'id_kriteria_sub', $idks, ["id_kriteria", "nama", "nilai"], [$idk, $nam, $nil]);
    if ($upd == 1) {
      exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data diubah!', 'type' => 'success', 'button' => 'Ok!')));
    } else {
      exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data gagal diubah!', 'type' => 'error', 'button' => 'Ok!')));
    }
  }
}
