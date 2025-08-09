<?php
$id = strip_tags($_POST['id_users_akun']);
$nm = strip_tags($_POST['nama']);
$em = strip_tags($_POST['email']);
$us = strip_tags($_POST['username']);

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
    $upd = $pdo->Update('tb_users', 'id_users', $id, ["nama", "email", "username"], [$nm, $em, $us]);
    if ($upd == 1) {
        exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data telah diubah!', 'type' => 'success', 'button' => 'Ok!')));
    } else {
        exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data tidak diubah!', 'type' => 'error', 'button' => 'Ok!')));
    }
}
