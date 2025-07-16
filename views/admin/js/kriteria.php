    <script src="./../../assets/admin/js/lib/data-table/datatables.min.js"></script>
    <script src="./../../assets/admin/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="./../../assets/admin/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="./../../assets/admin/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="./../../assets/admin/js/lib/data-table/jszip.min.js"></script>
    <script src="./../../assets/admin/js/lib/data-table/pdfmake.min.js"></script>
    <script src="./../../assets/admin/js/lib/data-table/vfs_fonts.js"></script>
    <script src="./../../assets/admin/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="./../../assets/admin/js/lib/data-table/buttons.print.min.js"></script>
    <script src="./../../assets/admin/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="./../../assets/admin/js/lib/data-table/datatables-init.js"></script>
    <script src="./../../assets/admin/js/sweetalert.min.js"></script>

    <script>
        $('#data-table').DataTable();

        let untukTambahData = function() {
            $('#form-add-upd').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    method: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    beforeSend: function() {
                        $('#add').attr('disabled', 'disabled');
                        $('#add').html('<i class="fa fa-spinner"></i> Waiting...');
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

                            $('#add').removeAttr('disabled');
                            $('#add').html('<i class="fa fa-plus"></i> Tambah');
                        }
                    }
                })
            });

            $(document).on('keyup', '#form-add-upd input', function(e) {
                e.preventDefault();
                if ($(this).val() == '') {
                    $(this).removeClass('is-valid').addClass('is-invalid');
                    $(this).parents('.form-group').find('.error').html('Kolom ini harus diisi.');
                } else {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                    $(this).parents('.form-group').find('.error').html('');
                }
            });

            $(document).on('change', '#form-add-upd select', function(e) {
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

        let untukUbahData = function() {
            $(document).on('click', '#upd', function(e) {
                var ini = $(this);

                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: "aksi/?aksi=kriteria_get",
                    data: {
                        id: ini.data('id')
                    },
                    beforeSend: function() {
                        ini.attr('disabled', 'disabled');
                        ini.html('<i class="fa fa-spinner"></i>&nbsp;Menunggu...');
                    },
                    success: function(response) {
                        $('#id_kriteria').attr('name', 'id_kriteria');

                        $.each(response, function(key, value) {
                            if (key) {
                                if (($('#' + key).prop('tagName') === 'INPUT' || $('#' + key).prop('tagName') === 'TEXTAREA')) {
                                    $('#' + key).val(value);
                                } else if ($('#' + key).prop('tagName') === 'SELECT') {
                                    $('#' + key).val(value);
                                }
                            }
                        });

                        $('#add').html('<i class="fa fa-edit"></i> Ubah');
                        ini.removeAttr('disabled');
                        ini.html('<i class="fa fa-edit"></i>&nbsp;Ubah');
                    }
                });
            });
        }();

        let untukHapusData = function() {
            $(document).on('click', '#del', function() {
                var ini = $(this);

                swal({
                    title: "Apakah Anda yakin ingin menghapusnya?",
                    text: "Data yang telah dihapus tidak dapat dikembalikan!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((del) => {
                    if (del) {
                        $.ajax({
                            type: "post",
                            url: "aksi/?aksi=kriteria_del",
                            dataType: 'json',
                            data: {
                                id: ini.data('id'),
                            },
                            beforeSend: function() {
                                ini.attr('disabled', 'disabled');
                                ini.html('<i class="fa fa-spinner"></i>&nbsp;Menunggu...');
                            },
                            success: function(response) {
                                swal({
                                    title: response.title,
                                    text: response.text,
                                    icon: response.type,
                                    button: response.button,
                                }).then((value) => {
                                    location.reload();
                                });
                            }
                        });
                    } else {
                        return false;
                    }
                });
            });
        }();
    </script>