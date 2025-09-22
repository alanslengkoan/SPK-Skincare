
<?php
$id_users = strip_tags($_POST['id']);
$status   = strip_tags($_POST['status']);

if ($status == '1') {
    $upd = $pdo->Update("tb_users", "id_users", $id_users, ["status"], ['0']);

    if ($upd == 1) {
        exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data diubah.', 'type' => 'success', 'button' => 'Ok!')));
    } else {
        exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data tidak diubah.', 'type' => 'error', 'button' => 'Ok!')));
    }
} else {
    $upd = $pdo->Update("tb_users", "id_users", $id_users, ["status"], ['1']);

    if ($upd == 1) {
        exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data diubah.', 'type' => 'success', 'button' => 'Ok!')));
    } else {
        exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data tidak diubah.', 'type' => 'error', 'button' => 'Ok!')));
    }
}
