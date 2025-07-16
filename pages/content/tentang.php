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
    <link rel="stylesheet" type="text/css" href="./../assets/page/vendor/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="./../assets/page/vendor/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="./../assets/page/css/style.css" />
    <!-- end:: global assets -->
</head>

<body>
    <!-- begin:: navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Metode Smart</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item <?= ($_REQUEST['content'] == "index") ? 'active' : '' ?>">
                        <a class="nav-link" href="index">Home</a>
                    </li>
                    <li class="nav-item <?= ($_REQUEST['content'] == "tentang") ? 'active' : '' ?>">
                        <a class="nav-link" href="tentang">Tentang</a>
                    </li>
                    <li class="nav-item <?= ($_REQUEST['content'] == "register") ? 'active' : '' ?>">
                        <a class="nav-link" href="register">Daftar</a>
                    </li>
                    <li class="nav-item <?= ($_REQUEST['content'] == "login") ? 'active' : '' ?>">
                        <a class="nav-link" href="login">Masuk</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- end:: navbar -->

    <!-- begin:: header -->
    <header class="intro-header">
        <div class="container">
            <div class="intro-message">
                <h1>Metode Smart</h1>
                <h3>Sistem Pendukung Keputusan</h3>
                <hr class="intro-divider">
            </div>
        </div>
    </header>
    <!-- end:: header -->

    <!-- begin:: content -->
    <section class="content">
        <div class="container">
            <h2 class="text-center">Tentang</h2>
            <hr class="intro-divider">
            <p class="text-justify">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nisl ut aliquam aliquam, nunc nisl aliquet nunc,
                eget aliquam nisl nisl sit amet nunc. Sed euismod, nisl ut aliquam aliquam, nunc nisl aliquet nunc, eget aliquam nisl
                nisl sit amet nunc. Sed euismod, nisl ut aliquam aliquam, nunc nisl aliquet nunc, eget aliquam nisl nisl sit amet nunc.
                Sed euismod, nisl ut aliquam aliquam, nunc nisl aliquet nunc, eget aliquam nisl nisl sit amet nunc. Sed euismod, nisl
            </p>
        </div>
    </section>
    <!-- end:: content -->

    <!-- begin:: footer -->
    <footer>
        <div class="container">
            <ul class="list-inline">
                <li class="list-inline-item">
                    <a href="index">Home</a>
                </li>
                <li class="footer-menu-divider list-inline-item">&sdot;</li>
                <li class="list-inline-item">
                    <a href="tentang">Tentang</a>
                </li>
                <li class="footer-menu-divider list-inline-item">&sdot;</li>
                <li class="list-inline-item">
                    <a href="register">Daftar</a>
                </li>
                <li class="footer-menu-divider list-inline-item">&sdot;</li>
                <li class="list-inline-item">
                    <a href="login">Masuk</a>
                </li>
            </ul>
            <p class="copyright text-muted small">
            </p>
        </div>
    </footer>
    <!-- end:: footer -->

    <script src="./../assets/page/vendor/jquery/jquery.min.js"></script>
    <script src="./../assets/page/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./../assets/admin/my_assets/my_fun.js"></script>
</body>

</html>