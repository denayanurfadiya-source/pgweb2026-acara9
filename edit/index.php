<!DOCTYPE html>
<html>
<body>
<h2>Form Edit</h2>
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

$id = (int) $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM titik_perumahan WHERE ogc_fid = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<form action='edit.php' onsubmit='return validateForm(event)' method='post'>";
    while ($row = $result->fetch_assoc()) {
        echo "<input type='hidden' name='ogc_fid' value='" . $row['ogc_fid'] . "'>";
        echo "<label for='nam'>Nama Objek:</label><br>";
        echo "<input type='text' id='nam' name='namobj' value='" . htmlspecialchars($row['namobj'], ENT_QUOTES) . "'><br>";
        echo "<label for='x'>Koordinat X (Longitude):</label><br>";
        echo "<input type='text' id='x' name='koor_x' value='" . $row['koor_x'] . "'><br>";
        echo "<label for='y'>Koordinat Y (Latitude):</label><br>";
        echo "<input type='text' id='y' name='koor_y' value='" . $row['koor_y'] . "'><br>";
        echo "<label for='kec'>Kecamatan:</label><br>";
        echo "<input type='text' id='kec' name='wadmkc' value='" . htmlspecialchars($row['wadmkc'], ENT_QUOTES) . "'><br><br>";
    }
    echo "<input type='submit' value='Submit'>";
    echo "</form>";
} else {
    echo "Data tidak ditemukan.";
}
$conn->close();
?>

<p id="informasi" style="color:red;"></p>

<script>
function validateForm(event) {
  let nam = document.getElementById("nam").value.trim();
  let x   = document.getElementById("x").value.trim();
  let y   = document.getElementById("y").value.trim();
  let kec = document.getElementById("kec").value.trim();
  let text = "";

  if (nam === "") {
    text += "Nama objek tidak boleh kosong.<br>";
  }
  if (x === "" || isNaN(x) || x < -180 || x > 180) {
    text += "Koordinat X harus angka antara -180 sampai 180.<br>";
  }
  if (y === "" || isNaN(y) || y < -90 || y > 90) {
    text += "Koordinat Y harus angka antara -90 sampai 90.<br>";
  }
  if (kec === "" || !/^[A-Za-z\s]+$/.test(kec)) {
    text += "Kecamatan harus diisi dan hanya berisi huruf.<br>";
  }

  document.getElementById("informasi").innerHTML = text;

  if (text !== "") {
    event.preventDefault();
    return false;
  }
  return true;
}
</script>
</body>
</html>