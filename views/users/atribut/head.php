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
    <link rel="apple-touch-icon" href="./../../assets/admin/images/icon/apple-touch-icon.png" sizes="180x180" />
    <link rel="icon" href="./../../assets/admin/images/icon/favicon-32x32.png" type="image/x-icon" sizes="32x32" />
    <link rel="icon" href="./../../assets/admin/images/icon/favicon-16x16.png" type="image/x-icon" sizes="16x16" />
    <link rel="icon" href="./../../assets/admin/images/icon/favicon.ico" type="image/x-icon" />
    <!-- end:: icon -->

    <!-- begin:: global assets -->
    <link rel="stylesheet" href="./../../assets/admin/css/normalize.css" />
    <link rel="stylesheet" href="./../../assets/admin/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./../../assets/admin/css/font-awesome.min.css" />
    <link rel="stylesheet" href="./../../assets/admin/css/themify-icons.css" />
    <link rel="stylesheet" href="./../../assets/admin/css/flag-icon.min.css" />
    <link rel="stylesheet" href="./../../assets/admin/css/cs-skin-elastic.css" />
    <link rel="stylesheet" href="./../../assets/admin/css/style.css" />
    <link rel="stylesheet" href="./../../assets/admin/my_assets/my_css.css" />
    <!-- end:: global assets -->

    <?php
    $content = (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_REQUEST['content'])) ? str_replace('-', '_', $_REQUEST['content']) : $_REQUEST['content'];
    if (file_exists('css/' . $content . '.php')) {
        switch ($content) {
            case $content:
                include_once 'css/' . str_replace('-', '_', $content) . '.php';
                break;
        }
    }
    ?>

</head>