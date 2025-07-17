<?php
$id_a  = strip_tags($_POST['id_alternatif']);
$id_jk = strip_tags($_POST['id_jenis_kulit']);
$id_k  = array_map("strip_tags", $_POST['id_kriteria']);
$nil   = array_map("strip_tags", $_POST['nilai']);

$error = [];
foreach ($_POST as $key => $value) {
    if ($value == '') {
        $error[$key] = 'Kolom ini harus diisi.';
    }
    if (is_array($value)) {
        for ($c = 0; $c < count($value); $c++) {
            $check_value_arr = trim($value[$c]);
            if (empty($check_value_arr)) {
                $error['nilai_' . $c] = 'Kolom ini harus diisi.';
            }
        }
    }
}

if (count($error) != 0) {
    exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data gagal ditambahkan!', 'type' => 'error', 'button' => 'Ok!', 'errors' => $error)));
} else {
    if ($_POST['action'] === 'add') {
        // tambah
        for ($i = 0; $i < count($id_k); $i++) {
            $pdo->Insert("tb_evaluasi", ["id_jenis_kulit", "id_alternatif", "id_kriteria", "nilai"], [$id_jk, $id_a, $id_k[$i], $nil[$i]]);
        }
        exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data ditambah.', 'type' => 'success', 'button' => 'Ok!')));
    } else {
        // ubah
        for ($i = 0; $i < count($id_k); $i++) {
            $sql = "UPDATE tb_evaluasi SET nilai = $nil[$i] WHERE id_kriteria = $id_k[$i] AND id_alternatif = '$id_a' AND id_jenis_kulit = '$id_jk'";
            $qry = $pdo->Query($sql);
        }
        exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data diubah.', 'type' => 'success', 'button' => 'Ok!')));
    }
}
