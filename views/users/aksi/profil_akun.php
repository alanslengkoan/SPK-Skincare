<?php
$id        = strip_tags($_POST['id_users_akun']);
$nama      = htmlspecialchars($_POST['nama'], ENT_QUOTES);
$email     = htmlspecialchars($_POST['email'], ENT_QUOTES);
$telepon   = htmlspecialchars($_POST['telepon'], ENT_QUOTES);
$tgl_lahir = htmlspecialchars($_POST['tgl_lahir'], ENT_QUOTES);
$tmp_lahir = htmlspecialchars($_POST['tmp_lahir'], ENT_QUOTES);
$kelamin   = htmlspecialchars($_POST['kelamin'], ENT_QUOTES);
$alamat    = htmlspecialchars($_POST['alamat'], ENT_QUOTES);
$username  = htmlspecialchars($_POST['username'], ENT_QUOTES);

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
    $upd1 = $pdo->Update('tb_users', 'id_users', $id, ["nama", "email", "username"], [$nama, $email, $username]);

    $upd2 = $pdo->Update('tb_member', 'id_users', $id, ["tgl_lahir", "tmp_lahir", "kelamin", "telepon", "alamat"], [$tgl_lahir, $tmp_lahir, $kelamin, $telepon, $alamat]);
    if ($upd1 == 1 && $upd2 == 1) {
        exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data telah diubah!', 'type' => 'success', 'button' => 'Ok!')));
    } else {
        exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data tidak diubah!', 'type' => 'error', 'button' => 'Ok!')));
    }
}
