
<?php
$id_users = strip_tags($_POST['id']);

$password = password_hash('12345678', PASSWORD_DEFAULT);

$upd = $pdo->Update("tb_users", "id_users", $id_users, ["password"], [$password]);

if ($upd == 1) {
    exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data diubah.', 'type' => 'success', 'button' => 'Ok!')));
} else {
    exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data tidak diubah.', 'type' => 'error', 'button' => 'Ok!')));
}
