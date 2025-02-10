<?php
header('Content-Type: application/json');

// Konfigurasi koneksi ke database
$servername = "localhost";      // atau nama host server MySQL Anda
$username   = "root";           // ganti dengan username MySQL Anda
$password   = "";               // ganti dengan password MySQL Anda (jika ada)
$dbname     = "monitoring_polusi";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}


// Ambil data dari tabel sensor_data (urutkan berdasarkan waktu)
$sql = "SELECT mq2, mq7, waktu FROM sensor_data ORDER BY waktu ASC";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();

// Kembalikan data dalam format JSON
echo json_encode($data);
?>
