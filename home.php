<?php
include("koneksi.php");

function Likes($id_artikel)
{
    global $koneksi;
    $query = "UPDATE artikel SET likes = likes + 1 WHERE id_artikel = $id_artikel";
    mysqli_query($koneksi, $query);
}

function Dislikes($id_artikel)
{
    global $koneksi;
    $query = "UPDATE artikel SET dislikes = dislikes + 1 WHERE id_artikel = $id_artikel";
    mysqli_query($koneksi, $query);
}

function topviews()
{
    global $koneksi;
    $query_sidebar = mysqli_query($koneksi, "SELECT * FROM artikel ORDER BY jumlah_pelihat DESC LIMIT 5");
    return $query_sidebar;
}

function toplikes()
{
    global $koneksi;
    $query_sidebar_likes = mysqli_query($koneksi, "SELECT * FROM artikel ORDER BY likes DESC LIMIT 5");
    return $query_sidebar_likes;
}

if (isset($_POST["like"])) {
    $id_artikel = $_POST["like"];
    Likes($id_artikel);
} elseif (isset($_POST["dislike"])) {
    $id_artikel = $_POST["dislike"];
    Dislikes($id_artikel);
}

$query = mysqli_query($koneksi, "SELECT * FROM artikel ORDER BY id_artikel DESC");

if (!empty($_POST["cari"])) {
  $cari = $_POST['keyword'];
  $query = "SELECT * FROM artikel WHERE judul LIKE '%$cari%'";
  $query = mysqli_query($koneksi, $query);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BYRs News</title>
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <style>
    body {
      font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
      margin: 0;
      color: black;
    }

    nav {
      position: fixed;
      background-color: #2E4374;
      border-radius: 0;
      width: 100%;
      z-index: 1000;
    }

    .navbar-brand {
      font-size: 30px;
      cursor: default;
      color: white !important;
    }

    .navbar-nav li a:hover {
      color:  !important;
    }

    .tittle-halaman-awal {
      color: beige;
      font-weight: bold;
    }

    .tittle-halaman-akhir {
      color: brown;
    }

    .nav-item a:hover {
      color: burlywood !important;
      font-weight: 600;
    }

    .search input {
      color: white;
      border: 0.8px solid white;
      border-radius: 5px;
      padding: 5px;
      background-color: transparent;
    }

    h5 {
      font-weight: 700;
    }

    /* sidebar start */
    .sidebar {
      width: 25%;
      height: 100vh;
      position: fixed;
      top: 70px;
      box-shadow: 1px 3px 2px 0.1px gray;
      border: 1px solid #ccc;
      border-radius: 2px;
      padding: 16px;
      z-index: 1;
      background-color: white;
      overflow-y: auto;
    }

    .isi-sidebar {
      margin-top: 10px;
    }

    .isi-sidebar ul {
      list-style: none;
      padding: 0;
    }

    .isi-sidebar li {
      margin-bottom: 8px;
      border-bottom: 1px solid #ccc;
    }

    .isi-sidebar a {
      text-decoration: none;
      color: #2E4374;
      font-weight: bold;
    }

    .isi-sidebar a:hover {
      color: #2a3857;
    }

    .sidebar-views {
      font-size: 9px;
    }

    .brand-copyright {
      font-weight: 700;
      margin-top: 32px;
      color: black;
    }

    .brand-copyright:hover {
      color: #fff;
      text-shadow: #161616 1px 0 3px;
    }

    .social-icons {
      position: relative;
      width: 75px;
      bottom: 20px;
      left: 15px;
      display: flex;
      justify-content: space-between;
      margin-top: 0px;
    }

    .social-icons a {
      color: black;
      margin-right: 5px;
      text-decoration: none;
      font-size: 20px;
    }

    .social-icons a:hover {
      color: #2E4374;
    }

    /* sidebar end */

    .content-container {
      margin-left: 25%;
      padding: 20px;
      padding-top: 75px;
    }

    .header-content h1 {
      border: 1px solid;
      font-weight: 700;
      box-shadow: 1px 3px 5px 1px #2a3857;
      border-radius: 115px;
      width: 400px;
      text-align: center;
      padding: 10px;
      margin-left: auto;
      margin-right: auto;
      margin-top: 20px;
    }

    .conten {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-around;
    }

    .conten .gambar {
      float: right;
      margin-top: 11px;
      margin-right: 20px;
      width: 160px;
      height: 140px;
    }

    .isi-conten {
      color: black;
      font-size: 20px;
      width: 70%;
      margin-top: 4px;
    }

    table {
      border-collapse: separate;
      border-spacing: 8px;
      width: 100%;
    }

    td {
      border-right: 1px solid #ccc;
      border-bottom: 1px solid #ccc;
      border-radius: 0px;
      padding-left: 30px;
      padding-top: 10px;
      padding-bottom: 10px;
    }

    .table-row-link {
      cursor: pointer;
      text-decoration: none;
      color: #f5f5f5;
    }

    .judul {
      font-size: 20px;
      font-weight: 900;
    }

    .deskripsi {
      font-size: 15px;
    }

    .write-by {
      font-size: 13px;
    }

    .writer {
      font-size: 13px;
      color: gray;
    }

    .fa-solid {
      color: #2a3857;
    }

    button {
      border: none;
      background-color: white;
    }

    .views {
      color: black;
    }
  </style>
</head>

<body>
  <!-- Nav Start -->
  <nav class="navbar navbar-expand-lg fixed-top">
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
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admin.php" style="color: white;">Admin Page</a>
          </li>
        </ul>
      </div>
      <div class="search">
        <form action="" method="POST">
          <input class="keyword" type="text" name="keyword" id="" size='20' autofocus placeholder="Cari Artikel..."
            autocomplete="off">
          <input class="submit" type="submit" value="cari" name="cari">
        </form>
      </div>
    </div>
  </nav>
  <!-- Nav End -->

  <!-- Sidebar Start -->
  <!-- Most Views start -->
  <div class="sidebar">
    <h5>Paling Banyak Dilihat</h5>
    <div class="isi-sidebar">
      <ul>
        <?php
            $sidebar_query = topviews();
            while ($sideviews = $sidebar_query->fetch_assoc()) :
            ?>
        <li>
          <a href="artikel.php?id_artikel=<?= $sideviews['id_artikel'] ?>"><?= $sideviews['judul']?></a>
          <i class="fa-regular fa-eye" style="font-size: small; float:right; margin-top: 8px;"><span
              class='sidebar-views'><?= " " . $sideviews['jumlah_pelihat'] ?></span></i>
        </li>
        <?php endwhile; ?>
      </ul>
    </div>
    <!-- Most Views End -->

    <!-- Most Likes start -->
    <h5 style="margin-top: 24px;">Paling Banyak Dilike</h5>
    <div class="isi-sidebar">
      <ul>
        <?php
                $sidebar_query_likes = toplikes();
                while ($sidelikes = $sidebar_query_likes->fetch_assoc()) :
                ?>
        <li>
          <a href="artikel.php?id_artikel=<?= $sidelikes['id_artikel'] ?>"><?= $sidelikes['judul']?></a>
          <i class="fa-solid fa-thumbs-up"
            style="font-size: small; float:right; margin-top: 8px; color : #324057;"><span
              class='sidebar-likes'><?= " " . $sidelikes['likes'] ?></span></i>
        </li>
        <?php endwhile; ?>
      </ul>
      <!-- Contact start -->
      <a href="index.php" style="text-decoration : none;">
        <h6 class="brand-copyright">&copy;BYR's <span style="color : crimson;">News</span></h6>
      </a>
      <p style="font-size: 13px; color : #161616;position: relative; bottom : 4px; font-weight: 600;">Contact:
        byrn.uiy@email.com
      </p>
      <div class="social-icons">
        <a href="https://www.linkedin.com/in/brian-ajha-534611298/" class="medsos-icon"><i
            class='bx bxl-linkedin-square'></i></a>
        <a href="https://wa.link/x8uwzg" target="_blank" class="medsos-icon"><i class='bx bxl-whatsapp'></i></a>
        <a href="https://www.instagram.com/btyo.skzo/" target="_blank" class="medsos-icon"><i class="bx bxl-instagram"></i></a>
      </div>
      <!-- Contact End -->

    </div>
  </div>
  <!-- Most Likes end -->
  <!-- Sidebar End -->

  <!-- Conten Start -->
  <div class="content-container">
    <div class="header-content">
      <h1>Daftar Berita</h1>
    </div>
    <?php
    if ($query->num_rows > 0) {
      echo "<div class='conten'>";
      echo "<table class='table'>";
      while ($row = $query->fetch_assoc()) {
        $deskripsi = mb_strimwidth($row["deskripsi"], 0, 154, "...");
        echo "<tr>";
        echo "<td>";
        echo "<img class='gambar' src='ik/" . $row['gambar'] . "' alt='Image'>";
        echo "<a class='table-row-link' href='artikel.php?id_artikel=$row[id_artikel]'><div class='isi-conten'>" . "<span class='judul'>" . $row['judul'] . "</span>" . "<br>" . "<span class='deskripsi'>" . $deskripsi . "<br>" . "</span>" . "<span class='write-by'>" . 'Ditulis Oleh : ' . "</span>" . "<span class='writer'>" . $row['penulis'] . "</div>" . "<form method='POST' style='display: inline-block;'>" .
          "<button class='reaction' type='submit' name='like' value='" . $row['id_artikel'] . "'> <i class='fa-solid fa-thumbs-up'></i> " . $row['likes'] . "</button>" .
          "</form>" . "<form method='POST' style='display: inline-block;'>" .
          "<button class='reaction' type='submit' name='dislike' value='" . $row['id_artikel'] . "'> <i class='fa-solid fa-thumbs-down'></i> " . $row['dislikes'] . "</button>" .
          "</form>" . "<i class='fa-solid fa-eye'></i>" . ' ' . "<span class='views'>" . $row['jumlah_pelihat'] . "</span>";
        echo "</td>";
        echo "</tr>";
      }
      echo "</table>";
    }
    ?>
  </div>
  <!-- Conten End -->
</body>

</html>