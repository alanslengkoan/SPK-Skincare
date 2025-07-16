<?php
$id_users         = $myfun->get_id_otomatis('tb_users', 'id_users');
$nama             = htmlspecialchars($_POST['nama'], ENT_QUOTES);
$email            = htmlspecialchars($_POST['email'], ENT_QUOTES);
$telepon          = htmlspecialchars($_POST['telepon'], ENT_QUOTES);
$tgl_lahir        = htmlspecialchars($_POST['tgl_lahir'], ENT_QUOTES);
$tmp_lahir        = htmlspecialchars($_POST['tmp_lahir'], ENT_QUOTES);
$kelamin          = htmlspecialchars($_POST['kelamin'], ENT_QUOTES);
$alamat           = htmlspecialchars($_POST['alamat'], ENT_QUOTES);
$username         = htmlspecialchars($_POST['username'], ENT_QUOTES);
$password         = htmlspecialchars($_POST['password'], ENT_QUOTES);
$password_confirm = htmlspecialchars($_POST['password_confirm'], ENT_QUOTES);
$level            = 'users';
$status           = '1';

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
    if ($password != $password_confirm) {
        exit(json_encode(array('title' => 'Gagal!', 'text' => 'Password yang Anda masukkan tidak sama!', 'type' => 'warning', 'button' => 'Ok!')));
    } else {
        $passhash = password_hash($password_confirm, PASSWORD_DEFAULT);

        $ins1 = $pdo->Insert("tb_users", ["id_users", "nama", "email", "username", "password", "level", "status"], [$id_users, $nama, $email, $username, $passhash, $level, $status]);

        $ins2 = $pdo->Insert("tb_member", ["id_users", "tgl_lahir", "tmp_lahir", "kelamin", "telepon", "alamat"], [$id_users, $tgl_lahir, $tmp_lahir, $kelamin, $telepon, $alamat]);

        if ($ins1 == 1 && $ins2 == 1) {
            exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Anda telah terdaftar, silahkan login!', 'type' => 'success', 'button' => 'Ok!')));
        } else {
            exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data yang Anda masukkan tidak dapat diproses!', 'type' => 'error', 'button' => 'Ok!')));
        }
    }
}
