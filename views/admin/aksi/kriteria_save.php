<?php
$nma = strip_tags($_POST['nama']);
$bot = strip_tags($_POST['bobot']);
$tip = strip_tags($_POST['tipe']);

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
  if (empty($_POST['id_kriteria'])) {
    $ins = $pdo->Insert("tb_kriteria", ["nama", "bobot", "tipe"], [$nma, $bot, $tip]);
    if ($ins == 1) {
      exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data ditambah!', 'type' => 'success', 'button' => 'Ok!')));
    } else {
      exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data gagal ditambahkan!', 'type' => 'error', 'button' => 'Ok!')));
    }
  } else {
    $idk = strip_tags($_POST['id_kriteria']);
    $upd = $pdo->Update('tb_kriteria', 'id_kriteria', $idk, ['nama', 'bobot', 'tipe'], [$nma, $bot, $tip]);
    if ($upd == 1) {
      exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data diubah.', 'type' => 'success', 'button' => 'Ok!')));
    } else {
      exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data tidak diubah.', 'type' => 'error', 'button' => 'Ok!')));
    }
  }
}
