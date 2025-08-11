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
            <a class="navbar-brand" href="#">Rarif Store</a>
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
    <header class="intro-header"></header>
    <!-- end:: header -->

    <!-- begin:: content -->
    <section class="content py-5">
        <div class="container">
            <h2 class="text-center mb-4">Tentang</h2>
            <hr class="intro-divider mb-5">

            <div class="row align-items-center mb-5">
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="./../assets/page/img/logo.jpg" alt="Tentang Kami" class="img-fluid rounded shadow">
                </div>
                <div class="col-md-6 text-justify">
                    <p>
                        Kami adalah perusahaan yang berfokus pada solusi perawatan kulit yang aman, alami, dan efektif.
                        Dengan tim ahli yang berdedikasi, kami berkomitmen untuk memberikan produk berkualitas tinggi
                        yang dirancang khusus untuk memenuhi kebutuhan kulit Anda.
                    </p>
                    <p>
                        Visi kami adalah menjadi pilihan utama dalam perawatan kulit dengan mengedepankan inovasi,
                        kualitas, dan kepuasan pelanggan. Kami percaya bahwa setiap orang berhak mendapatkan perawatan terbaik
                        untuk kulit mereka.
                    </p>
                </div>
            </div>

            <!-- Bagian Alamat dan Peta -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <h4>Alamat Kami</h4>
                    <p>
                        Jl. H. M Yasin Limpo No.6, Romangpolong<br>
                        Kec. Somba Opu, Kabupaten Gowa, Sulawesi Selatan 92113<br>
                        Indonesia
                    </p>
                    <p>
                        <strong>Telepon:</strong> +62 812-3456-7890<br>
                        <strong>Email:</strong> info@perusahaan.com
                    </p>
                </div>
                <div class="col-md-6">
                    <h4>Lokasi Kami</h4>
                    <div class="ratio ratio-16x9">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4806.3458725808!2d119.4933883!3d-5.2022071!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbee30004c57ec7%3A0xdda2e0029cfd58c4!2sRarif%20store!5e1!3m2!1sid!2sid!4v1754918267200!5m2!1sid!2sid"
                            width="600" height="450" style="border:0;"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
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