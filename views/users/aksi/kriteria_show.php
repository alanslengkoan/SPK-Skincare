 <?php
    $id_kriteria = $_GET['id_kriteria'];

    $qry = $pdo->GetWhere('tb_kriteria_sub', 'id_kriteria', $id_kriteria);

    $response = [];
    while ($row = $qry->fetch(PDO::FETCH_OBJ)) {
        $response[] = [
            'nilai' => $row->nilai,
            'nama'  => $row->nama
        ];
    }

    exit(json_encode($response));
