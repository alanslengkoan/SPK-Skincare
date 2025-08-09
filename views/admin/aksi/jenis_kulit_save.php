<?php
function jsonResponse($title, $text, $type, $button = 'Ok!', $extra = [])
{
    echo json_encode(array_merge([
        'title' => $title,
        'text'  => $text,
        'type'  => $type,
        'button' => $button
    ], $extra), JSON_UNESCAPED_UNICODE);
    exit;
}

function sanitizeInput($key)
{
    return trim(strip_tags(filter_input(INPUT_POST, $key, FILTER_SANITIZE_STRING)));
}

function validateRequiredFields($post, $files)
{
    $error = [];
    foreach ($post as $key => $value) {
        if (is_array($value)) {
            foreach ($value as $c => $v) {
                if (trim($v) === '') {
                    $error["{$key}_{$c}"] = 'Kolom ini harus diisi.';
                }
            }
        } elseif (trim($value) === '') {
            $error[$key] = 'Kolom ini harus diisi.';
        }
    }

    foreach ($files as $key => $value) {
        if (empty($value['name'])) {
            $error[$key] = 'Kolom ini harus diisi.';
        }
    }
    return $error;
}

function uploadImage($fileKey, $targetDir)
{
    $formatGambar = ['jpeg', 'jpg', 'png'];
    $ukuranGambar = 10 * 1024 * 1024;

    if (!isset($_FILES[$fileKey])) {
        return [false, 'File tidak ditemukan.'];
    }

    $file = $_FILES[$fileKey];
    $ext  = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if ($file['error'] !== UPLOAD_ERR_OK) {
        return [false, 'Terjadi kesalahan saat upload gambar.'];
    }
    if ($file['size'] > $ukuranGambar) {
        return [false, 'Ukuran gambar terlalu besar!'];
    }
    if (!in_array($ext, $formatGambar)) {
        return [false, 'Ekstensi gambar tidak diperbolehkan!'];
    }

    $namaBaru = 'gambar_' . date('Ymd_His') . '_' . substr(md5(uniqid()), 0, 6) . '.' . $ext;
    $path = rtrim($targetDir, '/') . '/' . $namaBaru;

    if (!move_uploaded_file($file['tmp_name'], $path)) {
        return [false, 'Gagal memindahkan file.'];
    }
    return [true, $namaBaru];
}

// =================== MAIN LOGIC ===================

$nma       = sanitizeInput('nama');
$deskripsi = sanitizeInput('deskripsi');
$error     = validateRequiredFields($_POST, $_FILES);

$baseDirUpload = "../../../assets/uploads/jenis_kulit";

if (!empty($error)) {
    jsonResponse('Gagal!', 'Data gagal ditambahkan!', 'error', 'Ok!', ['errors' => $error]);
}

if (empty($_POST['id_jenis_kulit'])) {
    list($success, $result) = uploadImage('inpgambar', $baseDirUpload);
    if (!$success) {
        jsonResponse('Peringatan!', $result, 'warning');
    }

    $insert = $pdo->Insert("tb_jenis_kulit", ["nama", "deskripsi", "gambar"], [$nma, $deskripsi, $result]);
    if ($insert) {
        jsonResponse('Berhasil!', 'Data ditambah.', 'success');
    } else {
        jsonResponse('Gagal!', 'Data gagal ditambah.', 'error');
    }
} else {
    $ida = sanitizeInput('id_jenis_kulit');

    if (isset($_POST['ubah_gambar'])) {
        $query = $pdo->GetWhere('tb_jenis_kulit', 'id_jenis_kulit', $ida);
        $row   = $query->fetch(PDO::FETCH_OBJ);
        $oldFile = $row->gambar ?? '';

        list($success, $result) = uploadImage('inpgambar', $baseDirUpload);
        if (!$success) {
            jsonResponse('Peringatan!', $result, 'warning');
        }

        $update = $pdo->Update("tb_jenis_kulit", "id_jenis_kulit", $ida, ["nama", "deskripsi", "gambar"], [$nma, $deskripsi, $result]);
        if ($update) {
            if (!empty($oldFile) && file_exists($baseDirUpload . '/' . $oldFile)) {
                unlink($baseDirUpload . '/' . $oldFile);
            }
            jsonResponse('Berhasil!', 'Data diubah.', 'success');
        } else {
            jsonResponse('Gagal!', 'Data tidak diubah.', 'error');
        }
    } else {
        $upd = $pdo->Update("tb_jenis_kulit", 'id_jenis_kulit', $ida, ["nama", "deskripsi"], [$nma, $deskripsi]);
        if ($upd) {
            jsonResponse('Berhasil!', 'Data diubah.', 'success');
        } else {
            jsonResponse('Gagal!', 'Data tidak diubah.', 'error');
        }
    }
}
