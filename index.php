<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ADD8E6; /* Ganti dengan kode warna biru (misalnya biru muda) */
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
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
            background-color: #fff;
        }

        form {
            text-align: center;
            margin-top: 20px;
        }

        input[type="text"] {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
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
    </style>
</head>
<body>
    <header>
        <h1>UNIBOOKSTORE</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">HOME</a></li>
            <li><a href="admin.php">ADMIN</a></li>
            <li><a href="pengadaan.php">PENGADAAN</a></li>
        </ul>
    </nav>
    <form action="search.php" method="GET"> 
        <input type="text" name="search" placeholder="Search by book name">
        <button type="submit">Search</button>
    </form>
    <?php
    // Connection to database
    $conn = mysqli_connect("localhost", "root", "", "data");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve data from database
    $sql = "SELECT * FROM buku";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Display data
        echo "<table border='1'>";
        //struktur tabel
        echo "<tr><th>ID Buku</th><th>Kategori</th><th>Nama Buku</th><th>Harga</th><th>Stok</th><th>Penerbit</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["id_buku"] . "</td>";
            echo "<td>" . $row["kategori"] . "</td>";
            echo "<td>" . $row["nama_buku"] . "</td>";
            echo "<td>" . $row["harga"] . "</td>";
            echo "<td>" . $row["stok"] . "</td>";
            echo "<td>" . $row["penerbit"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    mysqli_close($conn);
    ?>
</body>
</html>
