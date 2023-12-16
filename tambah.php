<?php
include_once("koneksi.php");

if (!empty($_POST['submit'])) {
    
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $deskripsi = $_POST['deskripsi'];
    $views = 0;
    $gambar = $_FILES['gambar']['name'];
    $size_gambar = $_FILES['gambar']['size'];
    $error_img = $_FILES['gambar']['error'];
    $tmp_name = $_FILES['gambar']['tmp_name'];
    $video = $_POST['video'];
    $dafpus = $_POST['daftar_pustaka'];

    if ($error_img === 4) {
        echo "<script>alert('Pilih Gambar Terlebih Dahulu!!')</script>";
    } else {
        $ekstensi_gambarvalid = ['jpg', 'png', 'jpeg'];
        $ekstensi_gambar = pathinfo($gambar, PATHINFO_EXTENSION);
        $ekstensi_gambar = strtolower($ekstensi_gambar);

        if (!in_array($ekstensi_gambar, $ekstensi_gambarvalid)) {
            echo "<script>alert('File Anda Bukanlah Sebuah Gambar!!')</script>";
        } elseif ($size_gambar > 1000000) {
            echo "<script>alert('Ukuran file Gambar Terlalu Besar!!')</script>";
        } else {
            $gambar_baru = uniqid() . '.' . $ekstensi_gambar;
            move_uploaded_file($tmp_name, 'ik/' . $gambar_baru);

            $query = "INSERT INTO artikel (judul, deskripsi, jumlah_pelihat, penulis, gambar, video, daftar_pustaka) VALUES ('$judul', '$deskripsi', '$views', '$penulis', '$gambar_baru', '$video', '$dafpus')";
            if (mysqli_query($koneksi, $query)) {
                header("location:home.php");
                exit;
            } else {
                echo "<script>alert('Gagal Menambahkan!!')</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BYR's News</title>
    <script src="https://cdn.tiny.cloud/1/aq37vou6o6fl7r2lfo92721t18z6173r03hevnh6qpu52i0f/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <style>
        * {
            margin: 0;
            box-sizing: border-box;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            background-color: #f6f8fa;
        }
        .container-add {
            width: 70%;
            background-color: #fff;
            color: #333;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header-add {
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .input-box {
            margin-bottom: 20px;
        }
        .input-box label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
        }
        .input-box input,.input-box textarea {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .input-box textarea {
            height: 150px;
        }
        .submit-button {
            background-color: #2E4374;
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .submit-button:hover {
            background-color: #2a3857;
        }
    </style>
</head>

<body>
    <div class="container-add">
        <h1 class="header-add">Tambah Artikel</h1>
        <form class="form-add" action="" method="POST" enctype='multipart/form-data' name="form-add" onsubmit="submitForm()">
            <div class="input-box">
                <label for="judul">Judul:</label>
                <input type="text" name="judul" id="judul" placeholder="Masukkan Judul.." required>
            </div>
            <div class="input-box">
                <label for="penulis">Penulis:</label>
                <input type="text" name="penulis" id="penulis" placeholder="Masukkan Nama Penulis.." required>
            </div>
            <div class="input-box">
                <label for="gambar">Gambar:</label>
                <input type="file" name="gambar" id="gambar">
            </div>
            <div class="input-box">
                <label for="deskripsi">Deskripsi:</label>
                <textarea name="deskripsi" id="deskripsi" placeholder="Masukkan Deskripsi.." ></textarea>
            </div>
            <div class="input-box">
                <label for="video">Video:</label>
                <input type="text" name="video" id="video" placeholder="Masukkan URL Video...">
            </div>
            <div class="input-box">
                <label for="daftar_pustaka">Daftar Pustaka:</label>
                <textarea name="daftar_pustaka" id="daftar_pustaka" cols="10" rows="2" placeholder="Masukkan Daftar Pustaka"></textarea>
            </div>
            <input class="submit-button" type="submit" value="Posting" name="submit">
        </form>
    </div>
</body>

<script>
  tinymce.init({
    selector: 'textarea',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    setup: function (editor) {
      editor.on('init', function () {
        editor.focus();
      });
    },
    extended_valid_elements: 'span/i[*],i[*]',
  });

  function submitForm() {
    tinymce.triggerSave(); 
    document.forms['form-add'].submit();
  }
</script>


</html>

