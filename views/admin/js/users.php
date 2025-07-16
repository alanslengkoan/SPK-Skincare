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

    let untukResetPassData = function() {
        $(document).on('click', '#res-pass', function() {
            var ini = $(this);
            swal({
                title: "Apakah Anda yakin ingin mereset password?",
                text: "Akun yang telah direset tidak dapat dikembalikan!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((del) => {
                if (del) {
                    $.ajax({
                        type: "post",
                        url: "aksi/?aksi=users_pass",
                        dataType: 'json',
                        data: {
                            id: ini.data('id')
                        },
                        beforeSend: function() {
                            ini.attr('disabled', 'disabled');
                            ini.html('<i class="fa fa-spinner"></i>&nbsp;Menunggu');
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

    let untukStatusData = function() {
        $(document).on('click', '#sts', function() {
            var id = $(this).data('id');
            var sts = $(this).data('sts');
            $.ajax({
                type: "post",
                url: "aksi/?aksi=users_status",
                dataType: 'json',
                data: {
                    id: id,
                    status: sts
                },
                success: function(data) {
                    swal({
                        title: data.title,
                        text: data.text,
                        icon: data.type,
                        button: data.button,
                    }).then((value) => {
                        location.reload();
                    });
                }
            });
        });
    }();
</script>