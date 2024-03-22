<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color:#CD5C5C;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            margin-bottom: 20px;
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
        form {
            text-align: center;
            margin-top: 20px;
        }

        input[type="text"], select {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            margin-bottom: 10px;
        }

        button {
            padding: 8px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #555;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <header>
        <h1>ADMIN</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">HOME</a></li>
            <li><a href="admin.php">ADMIN</a></li>
            <li><a href="pengadaan.php">PENGADAAN</a></li>
        </ul>
    </nav>
    <form action="admin.php" method="POST">
        <h2>Tambah Buku</h2>
        <input type="text" name="nama_buku" placeholder="Judul Buku" required>
        <input type="text" name="kategori" placeholder="Kategori" required>
        <input type="text" name="harga" placeholder="Harga" required>
        <input type="text" name="stok" placeholder="Stok" required>
        <input type="text" name="penerbit" placeholder="Penerbit" required>
        <button type="submit" name="tambah_buku">Tambah Buku</button>
    </form>

    <?php
    // Koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "data");

    // Periksa koneksi
    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    // Tambah Buku
    if (isset($_POST['tambah_buku'])) {
        $nama_buku = $_POST['nama_buku'];
        $kategori = $_POST['kategori'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];
        $penerbit = $_POST['penerbit'];

        // Masukkan buku baru ke dalam database
        $sql = "INSERT INTO buku (nama_buku, kategori, harga, stok, penerbit) VALUES ('$nama_buku', '$kategori', '$harga', '$stok', '$penerbit')";
        if (mysqli_query($conn, $sql)) {
            echo "<p>Buku berhasil ditambahkan!</p>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Hapus Buku
    if (isset($_POST['hapus_buku'])) {
        $id_buku = $_POST['hapus_buku'];

        $sql = "DELETE FROM buku WHERE id_buku='$id_buku'";
        if (mysqli_query($conn, $sql)) {
            echo "<p>Buku berhasil dihapus!</p>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Ambil data dari database
    $sql = "SELECT * FROM buku";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {

        // Tampilkan data dalam tabel
        echo "<table border='1'>";
        echo "<tr><th>ID Buku</th><th>Kategori</th><th>Judul Buku</th><th>Harga</th><th>Stok</th><th>Penerbit</th><th>Aksi</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["id_buku"] . "</td>";
            echo "<td>" . $row["kategori"] . "</td>";
            echo "<td>" . $row["nama_buku"] . "</td>";
            echo "<td>" . $row["harga"] . "</td>";
            echo "<td>" . $row["stok"] . "</td>";
            echo "<td>" . $row["penerbit"] . "</td>";

            // Tombol edit
            echo "<td><form action='edit.php' method='POST'><button type='submit' name='edit_buku' value='" . $row["id_buku"] . "'>Edit</button></form></td>";

            // Form delete
            echo "<td><form action='admin.php' method='POST'><button type='submit' name='hapus_buku' value='" . $row["id_buku"] . "'>Hapus</button></form></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "0 hasil";
    }

    mysqli_close($conn);
