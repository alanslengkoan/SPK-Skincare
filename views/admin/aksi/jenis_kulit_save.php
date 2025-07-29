<?php
$nma = strip_tags($_POST['nama']);
$deskripsi = strip_tags($_POST['deskripsi']);

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
    if (empty($_POST['id_jenis_kulit'])) {
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
                exit(json_encode(array('title' => 'Peringatan!', 'text' => 'Format Gambar tidak didukung!', 'type' => 'warning', 'button' => 'Ok!')));
            } else if (file_exists("../../../assets/uploads/jenis_kulit/" . $nmaGambar)) {
                exit(json_encode(array('title' => 'Peringatan!', 'text' => 'Nama Gambar sudah ada silahkan diganti!', 'type' => 'warning', 'button' => 'Ok!')));
            } else {
                $insert = $pdo->Insert("tb_jenis_kulit", ["nama", "deskripsi", "gambar"], [$nma, $deskripsi, $nmaGambar]);
                if ($insert == 1) {
                    move_uploaded_file($tmpGambar, "../../../assets/uploads/jenis_kulit/" . basename($nmaGambar));
                    exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data ditambah!', 'type' => 'success', 'button' => 'Ok!')));
                } else {
                    exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data gagal ditambahkan!', 'type' => 'error', 'button' => 'Ok!')));
                }
            }
        } else {
            exit(json_encode(array('title' => 'Gagal!', 'text' => 'Terjadi kesalahan pada gambar!', 'type' => 'error', 'button' => 'Ok!')));
        }
    } else {
        $ida = strip_tags($_POST['id_jenis_kulit']);

        if (isset($_POST['ubah_gambar'])) {
            $query  = $pdo->GetWhere('tb_jenis_kulit', 'id_jenis_kulit', $ida);
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
                    exit(json_encode(array('title' => 'Peringatan!', 'text' => 'Format Gambar tidak didukung!', 'type' => 'warning', 'button' => 'Ok!')));
                } else if (file_exists("../../../assets/uploads/jenis_kulit/" . $nmaGambar)) {
                    exit(json_encode(array('title' => 'Peringatan!', 'text' => 'Nama Gambar sudah ada silahkan diganti!', 'type' => 'warning', 'button' => 'Ok!')));
                } else {
                    $upd = $pdo->Update("tb_jenis_kulit", 'id_jenis_kulit', $ida, ["nama", "deskripsi", "gambar"], [$nma, $deskripsi, $nmaGambar]);
                    if ($upd == 1) {
                        move_uploaded_file($tmpGambar, "../../../assets/uploads/jenis_kulit/" . basename($nmaGambar));
                        exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data diubah.', 'type' => 'success', 'button' => 'Ok!')));
                    } else {
                        exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data tidak diubah.', 'type' => 'error', 'button' => 'Ok!')));
                    }
                }
            } else {
                exit(json_encode(array('title' => 'Gagal!', 'text' => 'Terjadi kesalahan pada gambar!', 'type' => 'error', 'button' => 'Ok!')));
            }
        } else {
            $upd = $pdo->Update("tb_jenis_kulit", 'id_jenis_kulit', $ida, ["nama", "deskripsi"], [$nma, $deskripsi]);
            if ($upd == 1) {
                exit(json_encode(array('title' => 'Berhasil!', 'text' => 'Data diubah.', 'type' => 'success', 'button' => 'Ok!')));
            } else {
                exit(json_encode(array('title' => 'Gagal!', 'text' => 'Data tidak diubah.', 'type' => 'error', 'button' => 'Ok!')));
            }
        }
    }
}
