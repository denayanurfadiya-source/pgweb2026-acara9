<?php
// Sesuaikan dengan setting MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "latihan";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM titik_perumahan";
$result = $conn->query($sql);

echo "<a href='input/index.html'>Input</a><br><br>";

if ($result->num_rows > 0) {
    echo "<table border='1px'><tr>
            <th>OGC FID</th>
            <th>Nama Objek</th>
            <th>Koordinat X</th>
            <th>Koordinat Y</th>
            <th>Kecamatan</th>
            <th colspan='2'>Aksi</th>
          </tr>";

    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td align='right'>" . $row["ogc_fid"] . "</td>" .
                 "<td>" . htmlspecialchars($row["namobj"]) . "</td>" .
                 "<td>" . $row["koor_x"] . "</td>" .
                 "<td>" . $row["koor_y"] . "</td>" .
                 "<td>" . htmlspecialchars($row["wadmkc"]) . "</td>" .
                 "<td><a href='delete.php?id=" . $row["ogc_fid"] . "'>hapus</a></td>" .
                 "<td><a href='edit/index.php?id=" . $row["ogc_fid"] . "'>edit</a></td>" .
              "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>