<?php
// untuk token mencegah terjadi perulangan
if (!isset($_SESSION['token'])) {
	$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(26));
}
?>

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

					<!-- begin:: notifikasi -->
					<?php if (isset($_GET['akses'])) { ?>
						<div class="alert alert-warning" role="alert">
							Anda harus <strong>Login</strong> terlebih dahulu untuk mengakses!
						</div>
					<?php } else if (isset($_GET['ubah_password'])) { ?>
						<div class="alert alert-success" role="alert">
							Ubah Password Berhasil !
						</div>
					<?php } else if (isset($_GET['ubah_password_gagal'])) { ?>
						<div class="alert alert-danger" role="alert">
							Ubah Password Gagal !
						</div>
					<?php } ?>
					<!-- end:: notifikasi -->

					<form action="aksi/?aksi=login" id="form-login" method="post">
						<input type="hidden" name="_token_form" value="<?= $_SESSION['token']; ?>">

						<div class="form-group">
							<label>Username</label>
							<input type="text" class="form-control form-control-sm" name="username" id="username" placeholder="Username" />
							<small class="help-block form-text error"></small>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control form-control-sm" name="password" id="password" placeholder="Password" />
							<small class="help-block form-text error"></small>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="ingat_saya" />&nbsp;<span>Ingat saya!</span>
							</label>
						</div>
						<button type="submit" name="masuk" id="masuk" class="btn btn-success btn-flat m-b-30 m-t-30">Masuk</button>
						<div class="register-link m-t-15 text-center">
							<p>Belum punya akun ? Daftar di <a href="register">sini</a></p>
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
		let untukLogin = function() {
			$('#form-login').submit(function(e) {
				e.preventDefault();

				$.ajax({
					method: $(this).attr('method'),
					url: $(this).attr('action'),
					data: $(this).serialize(),
					dataType: 'json',
					beforeSend: function() {
						$('#masuk').attr('disabled', 'disabled');
						$('#masuk').html('Menunggu...');
					},
					success: function(response) {
						if (response.status == true) {
							window.location = response.link;
						} else if (response.type === 'success' || response.type === 'warning') {
							swal({
								title: response.title,
								text: response.text,
								icon: response.type,
								button: response.button,
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
						}

						$('#masuk').removeAttr('disabled');
						$('#masuk').html('Masuk');
					}
				})
			});

			$(document).on('keyup', '#form-login input', function(e) {
				e.preventDefault();
				if ($(this).val() == '') {
					$(this).removeClass('is-valid').addClass('is-invalid');
					$(this).parents('.form-group').find('.error').html('Kolom ini harus diisi.');
				} else {
					$(this).removeClass('is-invalid').addClass('is-valid');
					$(this).parents('.form-group').find('.error').html('');
				}
			});

			$(document).on('change', '#form-login select', function(e) {
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