<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #DEB887;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .success {
            color: #4CAF50;
            margin-bottom: 20px;
        }

        .error {
            color: #f44336;
            margin-bottom: 20px;
        }

        button[type="submit"] {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

<div class="container">
    <?php
    // Koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "data");

    // Periksa koneksi
    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    // Jika formulir update_buku dikirimkan
    if (isset($_POST['update_buku'])) {
        $id_buku = $_POST['id_buku'];
        $nama_buku = $_POST['nama_buku'];
        $kategori = $_POST['kategori'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];
        $penerbit = $_POST['penerbit'];

        // Update data buku ke dalam database
        $sql = "UPDATE buku SET nama_buku='$nama_buku', kategori='$kategori', harga='$harga', stok='$stok', penerbit='$penerbit' WHERE id_buku='$id_buku'";
        if (mysqli_query($conn, $sql)) {
            echo "<p class='success'>Data buku berhasil diperbarui!</p>";
        } else {
            echo "<p class='error'>Error: " . $sql . "<br>" . mysqli_error($conn) . "</p>";
        }
    }

    mysqli_close($conn);
    ?>
    <button onclick="window.history.back()">Kembali</button>
</div>

</body>
</html>
