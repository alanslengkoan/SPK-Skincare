<?php
// untuk token mencegah terjadi perulangan
if (!isset($_SESSION['token'])) {
    $_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(26));
}

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
    // untuk proses masuk
    if ($_SESSION['token'] == $_POST['_token_form']) {
        $username = htmlspecialchars($_POST['username'], ENT_QUOTES);
        $password = htmlspecialchars($_POST['password'], ENT_QUOTES);
        $check    = isset($_POST['ingat_saya']) ? $_POST['ingat_saya'] : '';

        $query = $pdo->Query("SELECT * FROM tb_users WHERE username = '$username'");
        $data  = $query->fetch(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            if ($data->status == 1) {
                if (password_verify($password, $data->password)) {
                    // untuk mengecek level user
                    if ($data->level == 'admin') {
                        // set session
                        $_SESSION['id_users'] = $data->id_users;
                        $_SESSION['login']    = true;
                        // untuk mengenerate session id
                        session_regenerate_id();
                        // mengecek ingat saya
                        if ($check) {
                            setcookie('id_users', $data->id_users, time() + 3600, '/', $_SERVER['SERVER_NAME']);
                            setcookie('key', $_SESSION['token'], time() + 3600, '/', $_SERVER['SERVER_NAME']);
                        }

                        exit(json_encode(array('status' => true, 'link' => '../views/admin/dashboard')));
                    } else if ($data->level == 'users') {
                        // set session
                        $_SESSION['id_users'] = $data->id_users;
                        $_SESSION['login']    = true;
                        // untuk mengenerate session id
                        session_regenerate_id();
                        // mengecek ingat saya
                        if ($check) {
                            setcookie('id_users', $data->id_users, time() + 3600, '/', $_SERVER['SERVER_NAME']);
                            setcookie('key', $_SESSION['token'], time() + 3600, '/', $_SERVER['SERVER_NAME']);
                        }

                        exit(json_encode(array('status' => true, 'link' => '../views/users/dashboard')));
                    }
                } else {
                    exit(json_encode(array('title' => 'Gagal!', 'text' => 'Username atau Password yang Anda masukkan Salah!', 'type' => 'warning', 'button' => 'Sip!')));
                }
            } else {
                exit(json_encode(array('title' => 'Gagal!', 'text' => 'Username atau Password yang Anda masukkan Salah!', 'type' => 'warning', 'button' => 'Sip!')));
            }
        } else {
            exit(json_encode(array('title' => 'Gagal!', 'text' => 'Username atau Password yang Anda masukkan Salah!', 'type' => 'warning', 'button' => 'Sip!')));
        }
    } else {
        exit(json_encode(array('title' => 'Gagal!', 'text' => 'Jangan nakal.', 'type' => 'warning', 'button' => 'Sip!')));
    }
}
