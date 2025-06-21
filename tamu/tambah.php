<?php
include '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'] ?? '';
    $telepon = $_POST['telepon'] ?? '';
    $instansi = $_POST['instansi'] ?? '';
    $departemen = $_POST['departemen'] ?? '';
    $petugas = $_POST['petugas'] ?? '';
    $keperluan = $_POST['keperluan'] ?? '';
    $tanggal = $_POST['tanggal'] ?? '';

    if (!$nama || !$tanggal || !$telepon || !$instansi || !$departemen || !$petugas || !$keperluan) {
        echo "<script>
            alert('Semua field harus diisi!');
            window.history.back();
        </script>";
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO tamu (nama, tanggal, keperluan, petugas, departemen, telepon, instansi) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $nama, $tanggal, $keperluan, $petugas, $departemen, $telepon, $instansi);

    if ($stmt->execute()) {
        // Redirect ke form_input.php dengan param success=1
        header("Location: form_input.php?success=1");
        exit;
    } else {
        echo "<script>
            alert('Gagal menyimpan: " . $stmt->error . "');
            window.history.back();
        </script>";
    }

    $stmt->close();
}
?>
