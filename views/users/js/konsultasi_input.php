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
        $(document).on('change', 'input[name="model_kriteria"]', function() {
            if ($(this).val() === 'spesifik') {
                $('#content_spesifik').show();
                $('#content_semua').hide();
            } else if ($(this).val() === 'semua') {
                $('#content_semua').show();
                $('#content_spesifik').hide();
            }
        });

        $(document).on('change', '#id_kriteria_spesifik', function(e) {
            e.preventDefault();
            getSubKriteria($(this).val());
        });

        function getSubKriteria(id_kriteria) {
            $.ajax({
                method: 'get',
                url: "aksi/?aksi=kriteria_show",
                data: {
                    id_kriteria: id_kriteria
                },
                dataType: 'json',
                beforeSend: function() {
                    $('#nilai_spesifik').empty();
                    $('#nilai_spesifik').append('<option value="">Loading...</option>');
                },
                success: function(response) {
                    $('#nilai_spesifik').empty();
                    $('#nilai_spesifik').append('<option value="">- Pilih -</option>');
                    for (let i = 0; i < response.length; i++) {
                        $('#nilai_spesifik').append(new Option(response[i].nama, response[i].nilai));
                    }
                }
            });
        }
    </script>