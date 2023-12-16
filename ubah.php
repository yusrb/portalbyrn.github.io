<?php
include("koneksi.php");

if (!empty($_POST)) {
    $id_artikel = $_POST['id_artikel'];
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $deskripsi = $_POST['deskripsi'];
    $views = 0;
    $gambar = $_FILES['gambar']['name'];
    $size_gambar = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmp_name = $_FILES['gambar']['tmp_name'];
    $video = $_POST['video'];
    $dafpus = $_POST['daftar_pustaka'];

    if ($error === 4) {
        echo "<script>alert('Pilih Gambar Terlebih Dahulu!!')</script>";
    } else {
        $ektensi_gambarvalid = ['jpg', 'png', 'jpeg'];
        $ekstensi_gambar = explode('.', $gambar);
        $ekstensi_gambar = strtolower(end($ekstensi_gambar));

        if (!in_array($ekstensi_gambar, $ektensi_gambarvalid)) {
            echo "<script>alert('File Anda Bukanlah Sebuah Gambar!!')</script>";
        } elseif ($size_gambar > 1000000) {
            echo "<script>alert('Ukuran Gambar Terlalu Besar!!')</script>";
        } else {
            $gambar_baru = uniqid() . '.' . $ekstensi_gambar;
            move_uploaded_file($tmp_name, 'ik/' . $gambar_baru);
            $query = "UPDATE artikel SET judul = '$judul', deskripsi = '$deskripsi', penulis = '$penulis', gambar = '$gambar_baru' , video = '$video' , daftar_pustaka = '$dafpus'
                        WHERE id_artikel = '$id_artikel'";
            $eksekusi = mysqli_query($koneksi, $query);

            if ($eksekusi) {
                header("location:home.php");
            } else {
                echo "Kesalahan Pada Data Anda";
            }
        }
    }
}

if (!empty($_GET["id_artikel"])) {
    $id_artikel = $_GET["id_artikel"];
    $query = "SELECT * FROM artikel WHERE id_artikel = $id_artikel";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BYR's News</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@2.20.1/dist/editorjs.min.css">
    <script src="https://cdn.tiny.cloud/1/aq37vou6o6fl7r2lfo92721t18z6173r03hevnh6qpu52i0f/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
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
            min-height: 100vh;
            margin: 0;
            background-color: #f6f8fa;
        }

        .container-ubah {
            width: 70%;
            background-color: #fff;
            color: #333;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header-ubah {
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

        .input-box input,
        .input-box textarea {
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
    <div class="container-ubah">
        <h1 class="header-ubah">Ubah Artikel</h1>
        <form class="form-add" action="" method="POST" enctype='multipart/form-data' name="form-add"
            onsubmit="submitForm()">
            <input type="hidden" name="id_artikel" value='<?= $id_artikel; ?>'>
            <div class="input-box">
                <label for="judul">Judul:</label>
                <input type="text" name="judul" id="judul" value="<?= $data['judul'] ?>" placeholder="Masukkan Judul.."
                    required>
            </div>
            <div class="input-box">
                <label for="penulis">Penulis:</label>
                <input type="text" name="penulis" id="penulis" value="<?= $data['penulis'] ?>"
                    placeholder="Masukkan Nama Penulis.." required>
            </div>
            <div class="input-box">
                <label for="deskripsi">Deskripsi:</label>
                <textarea name="deskripsi" id="deskripsi" placeholder="Masukkan Deskripsi.."
                    required><?= $data['deskripsi']; ?></textarea>
            </div>
            <div class="input-box">
                <label for="gambar">Gambar:</label>
                <img src="ik/<?= $data['gambar']?>" alt="" width="200px">
                <input type="file" name="gambar" id="gambar" value="<?= $data['gambar']; ?>">
            </div>
            <div class="input-box">
                <label for="video">Video:</label>
                <iframe src="https://www.youtube.com/embed/<?= $data['video'] ?>" width='200px'></iframe>
                <input type="text" name="video" id="video" placeholder="Masukkan URL Video..." value="<?= $data['video'] ?>">
            </div>
            <div class="input-box">
                <label for="daftar_pustaka">Daftar Pustaka:</label>
                <textarea name="daftar_pustaka" id="daftar_pustaka" cols="10" rows="2" placeholder="Masukkan Daftar Pustaka"><?= $data['daftar_pustaka']?></textarea>
            </div>
            <input class="submit-button" type="submit" value="Posting" name="submit">
        </form>
    </div>

    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            setup: function (editor) {
                editor.on('init', function () {
                    editor.focus();
                });
            }
        });

        function submitForm() {
            tinymce.triggerSave();
            document.forms['form-add'].submit();
        }
    </script>
</body>

</html>