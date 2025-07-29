<?php
$nma = strip_tags($_POST['nama']);

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

foreach ($_FILES as $key => $value) {
    if ($value['name'] == '') {
        $error[$key] = 'Kolom ini harus diisi.';
    }
}

if (count($error) != 0) {
    exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data gagal ditambahkan!', 'type' => 'error', 'button' => 'Ok!', 'errors' => $error)));
} else {
    if (empty($_POST['id_alternatif'])) {
        // untuk format foto
        $formatGambar = array('jpeg', 'jpg', 'png');
        // untuk ukuran foto
        $ukuranGambar = 10 * 1024 * 1024;
        // untuk nama gambar
        $nmaGambar = $_FILES['inpgambar']['name'];
        $tmpGambar = $_FILES['inpgambar']['tmp_name'];
        $szeGambar = $_FILES['inpgambar']['size'];
        $errGambar = $_FILES['inpgambar']['error'];

        if ($errGambar == 0) {
            if ($szeGambar > $ukuranGambar) {
                exit(json_encode(array('title' => 'Peringatan!', 'text' => 'Ukuran Gambar terlalu besar!', 'type' => 'warning', 'button' => 'Ok!')));
            } else if (!in_array(pathinfo($nmaGambar, PATHINFO_EXTENSION), $formatGambar)) {
                exit(json_encode(array('title' => 'Peringatan!', 'text' => 'Ektensi gambar tidak sesuai yg diperbolehkan hanya jpeg, jpg dan png!', 'type' => 'warning', 'button' => 'Ok!')));
            } else if (file_exists("../../../assets/uploads/alternatif/" . $nmaGambar)) {
                exit(json_encode(array('title' => 'Peringatan!', 'text' => 'Nama Gambar sudah ada silahkan diganti!', 'type' => 'warning', 'button' => 'Ok!')));
            } else {
                $insert = $pdo->Insert("tb_alternatif", ["nama", "gambar"], [$nma, $nmaGambar]);
                if ($insert == 1) {
                    move_uploaded_file($tmpGambar, "../../../assets/uploads/alternatif/" . basename($nmaGambar));
                    exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data ditambah.', 'type' => 'success', 'button' => 'Ok!')));
                } else {
                    exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data gagal ditambah.', 'type' => 'error', 'button' => 'Ok!')));
                }
            }
        } else {
            exit(json_encode(array('title' => 'Gagal!', 'text' => 'Terjadi kesalahan pada gambar!', 'type' => 'error', 'button' => 'Ok!')));
        }
    } else {
        $ida = strip_tags($_POST['id_alternatif']);

        if (isset($_POST['ubah_gambar'])) {
            // mengecek nama gambar dari database
            $query  = $pdo->GetWhere('tb_alternatif', 'id_alternatif', $ida);
            $row    = $query->fetch(PDO::FETCH_OBJ);
            $nmaGambarDb = $row->gambar;

            // untuk format foto
            $formatGambar = array('jpeg', 'jpg', 'png');
            // untuk ukuran foto
            $ukuranGambar = 10 * 1024 * 1024;
            // untuk nama gambar
            $nmaGambar = $_FILES['inpgambar']['name'];
            $tmpGambar = $_FILES['inpgambar']['tmp_name'];
            $szeGambar = $_FILES['inpgambar']['size'];
            $errGambar = $_FILES['inpgambar']['error'];

            if ($errGambar == 0) {
                if ($szeGambar > $ukuranGambar) {
                    exit(json_encode(array('title' => 'Peringatan!', 'text' => 'Ukuran Gambar terlalu besar!', 'type' => 'warning', 'button' => 'Ok!')));
                } else if (!in_array(pathinfo($nmaGambar, PATHINFO_EXTENSION), $formatGambar)) {
                    exit(json_encode(array('title' => 'Peringatan!', 'text' => 'Ektensi gambar tidak sesuai yg diperbolehkan hanya jpeg, jpg dan png!', 'type' => 'warning', 'button' => 'Ok!')));
                } else if (file_exists("../../../assets/uploads/alternatif/" . $nmaGambar)) {
                    exit(json_encode(array('title' => 'Peringatan!', 'text' => 'Nama Gambar sudah ada silahkan diganti!', 'type' => 'warning', 'button' => 'Ok!')));
                } else {
                    $update = $pdo->Update("tb_alternatif", "id_alternatif", $ida, ["nama", "gambar"], [$nma, $nmaGambar]);

                    if ($update == 1) {
                        // menghapus foto yg tersimpan dalam file dan akan diganti
                        if ($nmaGambarDb != '' || $nmaGambarDb != null) {
                            if (file_exists("../../../assets/uploads/alternatif/" . $nmaGambarDb)) {
                                unlink("../../../assets/uploads/alternatif/" . $nmaGambarDb);
                            }
                        }
                        // upload gambar atau menyimpan gambar
                        move_uploaded_file($tmpGambar, "../../../assets/uploads/alternatif/" . basename($nmaGambar));
                        exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data diubah.', 'type' => 'success', 'button' => 'Ok!')));
                    } else {
                        exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data tidak diubah.', 'type' => 'error', 'button' => 'Ok!')));
                    }
                }
            } else {
                exit(json_encode(array('title' => 'Gagal!', 'text' => 'Terjadi kesalahan pada gambar!', 'type' => 'error', 'button' => 'Ok!')));
            }
        } else {
            $upd = $pdo->Update("tb_alternatif", 'id_alternatif', $ida, ["nama"], [$nma]);
            if ($upd == 1) {
                exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data diubah.', 'type' => 'success', 'button' => 'Ok!')));
            } else {
                exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data tidak diubah.', 'type' => 'error', 'button' => 'Ok!')));
            }
        }
    }
}
