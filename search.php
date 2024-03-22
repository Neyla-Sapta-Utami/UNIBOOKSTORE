<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <style>
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
            margin-bottom: 20px; /* Added margin */
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
            background-color: #fff; /* Added background color */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Added box shadow */
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

        tr:hover { /* Added hover effect */
            background-color: #ddd;
        }

        .no-results {
            text-align: center;
            font-size: 18px;
            color: #555;
            margin-top: 50px; /* Added margin */
        }
    </style>
</head>
<body>
    <header>
        <h1>HASIL</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">HOME</a></li>
        </ul>
    </nav>
    <?php
    if (isset($_GET['search'])) {
        $search = $_GET['search'];

        // Connection to database
        $conn = mysqli_connect("localhost", "root", "", "data");

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Retrieve data from database
        $sql = "SELECT * FROM buku WHERE nama_buku LIKE '%$search%'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Display data in a table
            echo "<table border='1'>";
            // struktur tabel search
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
            echo "<p class='no-results'>No results found.</p>"; // Inform user if no results found
        }

        mysqli_close($conn);
    }
    ?>
</body>
</html>
