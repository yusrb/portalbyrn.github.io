<?php
include_once("koneksi.php");
$id = $_GET['id_artikel'];
$query = mysqli_query($koneksi, "SELECT * FROM artikel WHERE id_artikel = '$id'");

while ($data = mysqli_fetch_array($query)) {
    $id_artikel = $data['id_artikel'];
    $judul = $data['judul'];
    $deskripsi = wordwrap($data['deskripsi'], 150, "<br>", true);
    $views = $data['jumlah_pelihat'];
    $penulis = $data['penulis'];
    $gambar = $data['gambar'];
    $video = $data['video'];
    $dafpus = $data['daftar_pustaka'];

    $pelihat = mysqli_query($koneksi, "UPDATE artikel SET jumlah_pelihat = jumlah_pelihat + 1 WHERE id_artikel='$id_artikel'");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        .nama-page {
            color: crimson;
        }

        nav {
            position: fixed;
            top: 0px;
            background-color: #2E4374;
            border-radius: 0px;
            height: 71px;
        }

        .navbar-brand {
            font-size: 30px;
            cursor: default;
            margin-bottom: 15px;
        }

        .tittle-halaman-awal {
            color: beige;
            font-weight: bold;
        }

        .tittle-halaman-akhir {
            color: brown;
        }

        .nav-item {
            margin-bottom: 15px;
            font-size: 18px;
        }
        
        .nav-item a:hover {
            color: burlywood !important;
            font-weight: 600;
        }
        
        .penulis {
            font-size: 15px;
            text-align: center;
            margin-left: 40px;
        }

        .nama,
        .tanggal {
            color: gray;
        }
        
        .conten {
            height: auto;
            width: 68%;
            font-size: 20px;
            margin-left: 61px;
        }

        .conten p {
            margin-top: 20px;
            width: 100%;
            margin-bottom: 15px;
        }

        .tittle-conten {
            cursor: default;
            font-weight: 700;
            margin-left: 70px;
            margin-top: 20px;
            text-align: center;
        }

        .img {
            height: 350px;
            width: 830px;
            margin-left: 59px;
            border: 1px solid white;
        }

        .header-sidebar {
            width: 101%;
            background-color: #2E4374;
            border-bottom: 2.1px dotted #ccc;
            border-radius: 8px;
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 0px;
            height: 40px;
            padding: 7px;
            color: white;
            cursor: default;
        }

        .sidebar {
            width: 22%;
            border-left: 5px solid;
            float: right;
            position: sticky;
            top: 70px;
            margin-right: 26px;
            box-shadow: 1px 3px 2px 1px gray;
            text-align: right;
            border: 1px solid white;
            border-radius: 20px;
        }

        .isi-sidebar ul {
            position: relative;
            bottom: 8px;
        }

        .isi-sidebar a {
            text-align: center;
            margin-right: 30px;
            text-decoration: none;
            color: black;
            display: block;
            padding: 1px;
            padding-bottom: 2px;
            border-bottom: 1px solid #ccc;
        }

        .isi-sidebar a:hover {
            color: #2E4374;
        }

        .lampiran_video {
            font-size: 18px;
            font-weight: 500;
            margin-left: 60px;
        }

        iframe {
            margin-left: 70px;
            margin-top: 5px;
            width: 50vh;
            height: 40vh;
        }

        .views {
            position: relative;
            text-align: center;
            margin-top: 30px;
            margin-bottom: 50px;
        }

        .open-dafpus {
            position: relative;
            top: 38px;
            margin-left:67px;
        }

        .daftar_pustaka {
            margin-top: 40px;
            width: 50%;
            margin-left: 120px;
            margin-bottom: 70px;
        }

        .logo-footer,
        li,
        a {
            text-align: center;
            position: relative;
            top: 7px;
            display: inline;
            list-style-type: none;
        }

        .brand-akhir-footer {
            color: crimson;
        }

        .footer-container {
            background-color: #2E4374;
            color: white;
            padding: 20px;
            bottom: 0;
            width: 100%;
            box-shadow: 0px -2px 10px rgba(0, 0, 0, 0.1);
        }

        .copyright-brand {
            font-size: 16px;
            font-weight: 800;
        }

        .footer-container p {
            margin: 0;
        }

        .social-icons {
            margin-top: 10px;
        }

        .social-icons a {
            color: white;
            margin-right: 11px;
            text-decoration: none;
            font-size: 20px;
        }

        .social-icons a:hover {
            color: #FFD700;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" style="color: white;"><span class="tittle-halaman-awal">BYR's</span><span
                    class="tittle-halaman-akhir">News</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="home.php" style="color: white;">Home</a>
                </ul>
            </div>
        </div>
    </nav>

    <div class="header-conten">
        <h1 class='tittle-conten'><?= $judul ?></h1>
        <p class='penulis'>Ditulis : <span class='nama'><?= $penulis ?></span> , Tanggal : <span
                class='tanggal'><?= date("d,F o") ?></span></p>
        <hr>
    </div>

    <div class='sidebar'>
        <div class='header-sidebar'>
            <h5>Rangkuman Lainnya</h5>
        </div>
        <div class='isi-sidebar'>
            <ul>
                <?php
            $query_sidebar = mysqli_query($koneksi, "SELECT * FROM artikel WHERE id_artikel != '$id_artikel'");
            while ($sidedata = mysqli_fetch_array($query_sidebar)) :
            ?>
                <li>
                    <a href="artikel.php?id_artikel=<?= $sidedata['id_artikel'] ?>"><?= $sidedata['judul'] ?></a>
                </li>
                <?php endwhile; ?>
            </ul>
        </div>
    </div>
    <!-- Main content container -->
    <div class='main-container'>
        <img class='img' src='ik/<?= $gambar ?>'>
        <div class='conten'>
            <?= $deskripsi ?>
        </div>
        <br>
        <span class="lampiran_video">Lampiran :</span> <br>
        <iframe src="https://www.youtube.com/embed/<?= $video; ?>" width='200px'></iframe>
    </div>
    
    <span class="open-dafpus">Daftar Pustaka :</span>
    <div class="daftar_pustaka">
         <?= $dafpus ?>
    </div>
</body>

<footer class="footer-container">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p class="copyright-brand">&copy;BYR's <span class="brand-akhir-footer">News</span><span style="font-size : 8px; position : relative; bottom : 5px; left : 2px;">2023</span></p>
            </div>
            <div class="col-md-6 text-md-end">
                <p>Contact: byrn.uiy@email.com</p>
                <div class="social-icons">
                    <a href="https://www.linkedin.com/in/brian-ajha-534611298/" class="medsos-icon"><i class='bx bxl-linkedin-square'></i></a>
                    <a href="https://wa.link/x8uwzg" class="medsos-icon"><i class='bx bxl-whatsapp' ></i></a>
                    <a href="https://www.instagram.com/btyo.skzo/" class="medsos-icon"><i class="bx bxl-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>

</html>