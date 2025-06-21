<?php
require 'koneksi.php';

$username = 'admin';
$password = password_hash('admin123', PASSWORD_DEFAULT); // Ganti sesuai keinginan

$query = "INSERT INTO admin (username, password) VALUES (?, ?)";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "ss", $username, $password);
mysqli_stmt_execute($stmt);

echo "Admin berhasil ditambahkan.";
