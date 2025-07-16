<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistem Pendukung Keputusan" />
    <meta name="keywords" content="Sistem Pendukung Keputusan" />
    <meta name="author" content="Sistem Pendukung Keputusan" />
    <title>Sistem Pendukung Keputusan</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">

    <!-- begin:: icon -->
    <link rel="apple-touch-icon" href="./../assets/admin/images/icon/apple-touch-icon.png" sizes="180x180" />
    <link rel="icon" href="./../assets/admin/images/icon/favicon-32x32.png" type="image/x-icon" sizes="32x32" />
    <link rel="icon" href="./../assets/admin/images/icon/favicon-16x16.png" type="image/x-icon" sizes="16x16" />
    <link rel="icon" href="./../assets/admin/images/icon/favicon.ico" type="image/x-icon" />
    <!-- end:: icon -->

    <!-- begin:: global assets -->
    <link rel="stylesheet" href="./../assets/admin/css/normalize.css" />
    <link rel="stylesheet" href="./../assets/admin/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./../assets/admin/css/font-awesome.min.css" />
    <link rel="stylesheet" href="./../assets/admin/css/themify-icons.css" />
    <link rel="stylesheet" href="./../assets/admin/css/flag-icon.min.css" />
    <link rel="stylesheet" href="./../assets/admin/css/cs-skin-elastic.css" />
    <link rel="stylesheet" href="./../assets/admin/css/style.css" />
    <link rel="stylesheet" href="./../assets/admin/css/lib/vector-map/jqvmap.min.css" />
    <link rel="stylesheet" href="./../assets/admin/my_assets/my_css.css" />
    <!-- end:: global assets -->
</head>

<body class="bg-custom">
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                        <img class="align-content" src="images/logo.png" alt="">
                    </a>
                </div>
                <div class="login-form">
                    <form action="aksi/?aksi=register" method="post" id="form-register">
                        <div class="form-group">
                            <label>Nama&nbsp;*</label>
                            <input type="text" class="form-control form-control-sm" name="nama" id="nama" placeholder="Masukkan Nama" />
                            <small class="help-block form-text error"></small>
                        </div>
                        <div class="form-group">
                            <label>Email&nbsp;*</label>
                            <input type="email" class="form-control form-control-sm" name="email" id="email" placeholder="Masukkan Email" />
                            <small class="help-block form-text error"></small>
                        </div>
                        <div class="form-group">
                            <label>Telepon&nbsp;*</label>
                            <input type="text" class="form-control form-control-sm" name="telepon" id="telepon" placeholder="Masukkan Telepon" />
                            <small class="help-block form-text error"></small>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir&nbsp;*</label>
                            <input type="date" class="form-control form-control-sm" name="tgl_lahir" id="tgl_lahir" />
                            <small class="help-block form-text error"></small>
                        </div>
                        <div class="form-group">
                            <label>Tempat Lahir&nbsp;*</label>
                            <input type="text" class="form-control form-control-sm" name="tmp_lahir" id="tmp_lahir" placeholder="Masukkan Tempat Lahir" />
                            <small class="help-block form-text error"></small>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin&nbsp;*</label>
                            <select class="form-control form-control-sm" name="kelamin" id="kelamin">
                                <option value="">Pilih</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            <small class="help-block form-text error"></small>
                        </div>
                        <div class="form-group">
                            <label>Alamat&nbsp;*</label>
                            <textarea class="form-control form-control-sm" name="alamat" id="alamat" placeholder="Masukkan Alamat"></textarea>
                            <small class="help-block form-text error"></small>
                        </div>
                        <div class="form-group">
                            <label>Username&nbsp;*</label>
                            <input type="text" class="form-control form-control-sm" name="username" id="username" placeholder="Masukkan Username" />
                            <small class="help-block form-text error"></small>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Password&nbsp;*</label>
                                    <input type="password" name="password" id="password" class="form-control form-control-sm" placeholder="Masukkan Password">
                                    <small class="help-block form-text error"></small>
                                </div>
                                <div class="col-sm-6">
                                    <label>Konfirmasi Password&nbsp;*</label>
                                    <input type="password" name="password_confirm" id="password_confirm" class="form-control form-control-sm" placeholder="Ulangi Password">
                                    <small class="help-block form-text error"></small>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Daftar</button>
                        <div class="register-link m-t-15 text-center">
                            <p>Sudah punya akun ? Masuk di <a href="login">sini</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="./../assets/admin/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="./../assets/admin/js/popper.min.js"></script>
    <script src="./../assets/admin/js/plugins.js"></script>
    <script src="./../assets/admin/js/main.js"></script>
    <script src="./../assets/admin/js/lib/data-table/datatables.min.js"></script>
    <script src="./../assets/admin/js/sweetalert.min.js"></script>

    <script>
        let untukRegister = function() {
            $('#form-register').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    beforeSend: function() {
                        $('#add').attr('disabled', 'disabled');
                        $('#add').html('<i class="fa fa-spinner"></i> Waiting...');
                    },
                    success: function(response) {
                        if (response.type === 'success' || response.type === 'warning') {
                            swal({
                                title: response.title,
                                text: response.text,
                                icon: response.type,
                                button: response.button,
                            }).then((value) => {
                                location.reload();
                            });
                        } else {
                            $.each(response.errors, function(key, value) {
                                if (key) {
                                    if (($('#' + key).prop('tagName') === 'INPUT' || $('#' + key).prop('tagName') === 'TEXTAREA')) {
                                        $('#' + key).addClass('is-invalid');
                                        $('#' + key).parents('.form-group').find('.error').html(value);
                                    } else if ($('#' + key).prop('tagName') === 'SELECT') {
                                        $('#' + key).addClass('is-invalid');
                                        $('#' + key).parents('.form-group').find('.error').html(value);
                                    }
                                }
                            });

                            swal({
                                title: response.title,
                                text: response.text,
                                icon: response.type,
                                button: response.button,
                            });

                            $('#add').removeAttr('disabled');
                            $('#add').html('<i class="fa fa-plus"></i> Tambah');
                        }
                    }
                })
            });

            $(document).on('keyup', '#form-register input', function(e) {
                e.preventDefault();
                if ($(this).val() == '') {
                    $(this).removeClass('is-valid').addClass('is-invalid');
                    $(this).parents('.form-group').find('.error').html('Kolom ini harus diisi.');
                } else {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                    $(this).parents('.form-group').find('.error').html('');
                }
            });

            $(document).on('change', '#form-register select', function(e) {
                e.preventDefault();
                if ($(this).val() == '') {
                    $(this).removeClass('is-valid').addClass('is-invalid');
                    $(this).parents('.form-group').find('.error').html('Kolom ini harus diisi.');
                } else {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                    $(this).parents('.form-group').find('.error').html('');
                }
            });
        }();
    </script>
</body>

</html>