<?php
include("koneksi.php");

$query = mysqli_query($koneksi, "SELECT * FROM artikel ORDER BY id_artikel DESC");

if (!empty($_POST["cari"])) {
    $cari = $_POST['keyword'];
    $query = "SELECT * FROM artikel WHERE judul LIKE '%" . $cari . "%'";
    $query = mysqli_query($koneksi, $query);
}

if (!empty($_GET["aksi"]) && $_GET["aksi"] == 'delete') {
    $id_artikel = $_GET['id_artikel'];
    $query = "DELETE FROM artikel WHERE id_artikel = $id_artikel";
    $eksekusi = mysqli_query($koneksi, $query);

    if ($eksekusi) {
        header("location:admin.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
    integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
  </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <style>
    body {
      font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
      color: black;
    }

    nav {
      position: fixed;
      background-color: #2E4374;
      border-radius: 0px;
    }

    .navbar-brand {
      font-size: 30px;
      cursor: default;
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
      coloe: white;
      border: 0.8px solid white;
      border-radius: 5px;
      padding: 5px;
      background-color: transparent;
    }

    .tambah button {
      position: relative;
      left: 3px;
      top: 3px;
      border-radius: 10px;
      background-color: #2E4374;
    }

    .tambah a {
      text-decoration: none;
      color: white;
    }

    .tambah button:hover {
      background-color: #2a3857;
      font-size: 17px;
    }

    .header-content h1 {
      border: 1px solid;
      box-shadow: 1px 3px 5px 0.4px #2a3857;
      border-radius: 115px;
      width: 900px;
      font-weight: 700;
      text-align: center;
      padding: 10px;
      position: relative;
      left: 185px;
      top: 20px;
    }

    .conten {
      margin-top: 30px;
      margin-left: 88px;
      width: 85%;
    }

    .conten .gambar {
      float: left;
      margin-top: 5px;
      margin-right: 10px;
      width: 150px;
      height: 150px;
    }

    .isi-conten {
      font-size: 20px;
      margin-left: 210px;
    }

    .search input {
      color: white;
      border: 0.8px solid white;
      border-radius: 5px;
      padding: 5px;
      background-color: transparent;
    }

    table {
      position: relative;
      top: 10px;
      border-collapse: separate;
      border-spacing: 8px;
      border-radius: 10px;
      width: 100%;
      padding: 0px;
    }

    td,
    td {
      border: 1px solid #2E4374;
      box-shadow: 3px 5px 15px #161616;
      padding-left: 30px;
      padding-top: 10px;
      padding-bottom: 10px;
    }

    .table-row-link {
      cursor: pointer;
      text-decoration: none;
      color: black;
    }

    .judul {
      font-weight: 600;
    }

    .write-by {
      font-size: 13px;
    }

    .penulis {
      font-size: 13px;
      color: gray;
    }

    .fa-regular {
      display: block;
      float: right;
      font-size: 25px;
      margin-left: 30px;
    }

    .fa-solid {
      position: relative;
      float: right;
      font-size: 24px;
      right: 53px;
    }

    .fa-regular:hover {
      font-size: 30px;
    }

    .fa-solid:hover {
      font-size: 29px;
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
      <div class="tambah">
        <button><a href="tambah.php">tambah</a></button>
      </div>
      <div class="collapse navbar-collapse" id="navbarNavDrlopdown">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="home.php" style="color: white;">Home</a>
          </li>
        </ul>
      </div>
      <div class="search">
        <form action="" method="POST">
          <input class="keyword" type="text" name="keyword" id="" size='20' autofocus placeholder="Cari Artikel..."
            autocomplete="off">
          <input class="submit" type="submit" value="Cari" name="cari">
        </form>
      </div>
    </div>
  </nav>

  <div class="header-content">
    <h1>Halaman Admin</h1>
    </h1>
  </div>
  <?php
        if ($query->num_rows > 0) {
            echo "<div class='conten'>";
            echo "<table>";
            while ($row = $query -> fetch_assoc()) {
                $deskripsi = mb_strimwidth($row["deskripsi"], 0, 150, "...");
                echo "<tr>";
                echo "<td>";
                echo "<img class='gambar' src='ik/" . $row['gambar'] . "' alt='Image'>";
                echo "<a class='table-row-link' href='artikel.php?id_artikel=$row[id_artikel]'><div class='isi-conten'>" . "<span class='judul'>" . $row['judul'] . "</span>" . "<br>" . $deskripsi . "</a> <br> <br>" . "<span class='write-by'> Ditulis oleh :" . "</span>" . "  " . "<span class='penulis'>" . $row['penulis'] . "</span>";
                echo "<a href='ubah.php?id_artikel=$row[id_artikel]'><i class='fa-solid fa-pen' style='color: #2E4374;'></i></a>";
                echo "<a href='?aksi=delete&id_artikel=$row[id_artikel]'><i class='fa-regular fa-square-minus' style='color: #2E4374;'></i></a>";
                echo "";
                echo "</div>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    ?>

</body>

</html>