<?php
$id  = strip_tags($_POST['id_users_security']);
$pl  = strip_tags($_POST['password_lama']);
$pb  = strip_tags($_POST['password_baru']);
$pbl = strip_tags($_POST['password_baru_lagi']);

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
    if (password_verify($pl, $rowLog->password)) {
        if ($pb == $pbl) {
            $ph  = password_hash($pb, PASSWORD_DEFAULT);
            $upd = $pdo->Update('tb_users', 'id_users', $id, ["password"], [$ph]);
            if ($upd == 1) {
                exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Password berhasil diubah.', 'type' => 'success', 'button' => 'Ok!')));
            } else {
                exit(json_encode(array('title' => 'Gagal!', 'text' => 'Password gagal diubah.', 'type' => 'warning', 'button' => 'Ok!')));
            }
        } else {
            exit(json_encode(array('title' => 'Gagal!', 'text' => 'Password baru yang Anda masukkan tidak sama!', 'type' => 'warning', 'button' => 'Ok!')));
        }
    } else {
        exit(json_encode(array('title' => 'Gagal!', 'text' => 'Password lama yang Anda masukkan tidak sama!', 'type' => 'warning', 'button' => 'Ok!')));
    }
}
