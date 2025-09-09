
<?php
// Konfigurasi database
$host = "localhost";     // ganti sesuai hostmu
$user = "root";          // username database
$pass = "";              // password database
$dbname = "wrathcoffee"; // nama database

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$nama = isset($_POST['nama']) ? $_POST['nama'] : '';
$jumlah = isset($_POST['jumlah']) ? intval($_POST['jumlah']) : 0;
$total = isset($_POST['total']) ? intval($_POST['total']) : 0;

if(empty($nama) || $jumlah <= 0 || $total <= 0){
    echo "Pesanan kosong atau data tidak valid!";
    exit;
}

// Simpan ke database
$stmt = $conn->prepare("INSERT INTO pesanan (nama, jumlah, total) VALUES (?, ?, ?)");
$stmt->bind_param("sii", $nama, $jumlah, $total);

if($stmt->execute()){
    echo "Pesanan berhasil dikirim!";
} else {
    echo "Terjadi kesalahan: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
