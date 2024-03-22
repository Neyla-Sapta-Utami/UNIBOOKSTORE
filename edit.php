<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #DEB887;
            margin: 0;
            padding: 0;
        }
    }

nav ul {
    list-style-type: none;
    padding: 0;
    text-align: center;
}

nav ul li {
    display: inline;
    margin: 0 10px;
}

nav ul li a {
    color: #000000;
    text-decoration: none;
}

        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            text-align: center;
        }

        input[type="text"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
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
<nav>
        <ul>
            <li><a href="admin.php">ADMIN</a></li>
        </ul>
    </nav>
<div class="container">
    <h2>Edit Buku</h2>
    <?php
    // Koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "data");

    // Periksa koneksi
    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    // Jika formulir edit dikirimkan
    if (isset($_POST['edit_buku'])) {
        $id_buku = $_POST['edit_buku'];

        // Ambil data buku yang akan diedit dari database
        $sql = "SELECT * FROM buku WHERE id_buku='$id_buku'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // Tampilkan formulir prapengisian dengan data buku yang sudah ada
            echo "<form action='update.php' method='POST'>";
            echo "<input type='hidden' name='id_buku' value='" . $row['id_buku'] . "'>";
            echo "<input type='text' name='nama_buku' value='" . $row['nama_buku'] . "' placeholder='Judul Buku' required><br>";
            echo "<input type='text' name='kategori' value='" . $row['kategori'] . "' placeholder='Kategori' required><br>";
            echo "<input type='text' name='harga' value='" . $row['harga'] . "' placeholder='Harga' required><br>";
            echo "<input type='text' name='stok' value='" . $row['stok'] . "' placeholder='Stok' required><br>";
            echo "<input type='text' name='penerbit' value='" . $row['penerbit'] . "' placeholder='Penerbit' required><br>";
            echo "<button type='submit' name='update_buku'>Update Buku</button>";
            echo "</form>";
        } else {
            echo "Buku tidak ditemukan.";
        }
    }

    mysqli_close($conn);
    ?>
</div>

</body>
</html>
