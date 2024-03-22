<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengadaan Buku</title>
    <style>
        /* CSS styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #DEB887;
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
        <h1>LAPORAN STOK BUKU</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">HOME</a></li>
            <li><a href="admin.php">ADMIN</a></li>
            <li><a href="pengadaan.php">PENGADAAN</a></li>
        </ul>
    </nav>
    <?php
    // Koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "data");

    // Periksa koneksi
    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    // Ambil data buku dengan sisa stok paling sedikit
    $sql = "SELECT nama_buku, penerbit, stok FROM buku ORDER BY stok ASC";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        //  data dalam tabel
        echo "<table border='1'>";
        echo "<tr><th>Judul Buku</th><th>Nama Penerbit</th><th>Sisa Stok</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["nama_buku"] . "</td>";
            echo "<td>" . $row["penerbit"] . "</td>";
            echo "<td>" . $row["stok"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Tidak ada buku yang perlu ditambah.";
    }

    mysqli_close($conn);
    ?>
</body>
</html>
