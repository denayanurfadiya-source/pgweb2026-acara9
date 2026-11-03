<?php
$namobj = $_POST['namobj'];
$koor_x = $_POST['koor_x'];
$koor_y = $_POST['koor_y'];
$wadmkc = $_POST['wadmkc'];

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

$stmt = $conn->prepare(
    "INSERT INTO nama_tabel (namobj, koor_x, koor_y, wadmkc)
     VALUES (?, ?, ?, ?)"
);
$stmt->bind_param("sdds", $namobj, $koor_x, $koor_y, $wadmkc);

if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    header("Location: ../index.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>