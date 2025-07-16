    <script src="./../../assets/admin/js/lib/data-table/datatables.min.js"></script>
    <script src="./../../assets/admin/js/sweetalert.min.js"></script>

    <script>
        let untukFormAkun = function() {
            $('#form-akun').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    method: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    beforeSend: function() {
                        $('#btn-akun').attr('disabled', 'disabled');
                        $('#btn-akun').html('<i class="fa fa-spinner"></i> Waiting...');
                    },
                    success: function(response) {
                        if (response.type === 'success') {
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

                            $('#btn-akun').removeAttr('disabled');
                            $('#btn-akun').html('<i class="fa fa-edit"></i>&nbsp;Ubah');
                        }
                    }
                });
            });

            $(document).on('keyup', '#form-akun input', function(e) {
                e.preventDefault();
                if ($(this).val() == '') {
                    $(this).removeClass('is-valid').addClass('is-invalid');
                    $(this).parents('.form-group').find('.error').html('Kolom ini harus diisi.');
                } else {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                    $(this).parents('.form-group').find('.error').html('');
                }
            });

            $(document).on('keyup', '#form-akun textarea', function(e) {
                e.preventDefault();
                if ($(this).val() == '') {
                    $(this).removeClass('is-valid').addClass('is-invalid');
                    $(this).parents('.form-group').find('.error').html('Kolom ini harus diisi.');
                } else {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                    $(this).parents('.form-group').find('.error').html('');
                }
            });


            $(document).on('change', '#form-akun select', function(e) {
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

        let untukFormSecurity = function() {
            $('#form-security').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    method: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    beforeSend: function() {
                        $('#btn-security').attr('disabled', 'disabled');
                        $('#btn-security').html('<i class="fa fa-spinner"></i> Waiting...');
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

                            $('#btn-security').removeAttr('disabled');
                            $('#btn-security').html('<i class="fa fa-edit"></i>&nbsp;Ubah');
                        }
                    }
                });
            });

            $(document).on('keyup', '#form-security input', function(e) {
                e.preventDefault();
                if ($(this).val() == '') {
                    $(this).removeClass('is-valid').addClass('is-invalid');
                    $(this).parents('.form-group').find('.error').html('Kolom ini harus diisi.');
                } else {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                    $(this).parents('.form-group').find('.error').html('');
                }
            });

            $(document).on('change', '#form-security select', function(e) {
                e.preventDefault();
                if ($(this).val() == '') {
                    $(this).removeClass('is-valid').addClass('is-invalid');
                    $(this).parents('.form-group').find('.error').html('Kolom ini harus diisi.');
                } else {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                    $(this).parents('.form-group').find('.error').html('');
                }
            });

            $(document).on('keyup', '#password_baru_lagi', function() {
                var passnm = $('#password_baru').val();
                var passwd = $(this).val();

                if (passnm != passwd) {
                    $('.pesan').css('color', 'red').html('Password tidak sesuai!');
                    return false;
                } else {
                    $('.pesan').css('color', 'green').html('Password sesuai!');
                    return true;
                }
            });
        }();
    </script>