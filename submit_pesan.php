<?php
// koneksi DB
$host = "localhost";
$user = "root"; 
$pass = "";     
$db   = "WrathCoffee";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}


$nama = $_POST['nama'] ?? '';
$email = $_POST['email'] ?? '';
$pesan = $_POST['pesan'] ?? '';


if(empty($nama) || empty($email) || empty($pesan)){
    echo "Data tidak lengkap!";
    exit;
}

// simpan ke DB
$stmt = $conn->prepare("INSERT INTO pesan (nama, email, pesan) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nama, $email, $pesan);

if($stmt->execute()){
    echo "Pesan berhasil dikirim!, silahkan kembali ke halaman utama kami";
}else{
    echo "Gagal mengirim pesan: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
