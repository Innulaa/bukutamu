<?php
$password = 'admin123'; // ganti dengan password asli yang kamu inginkan
$hashed = password_hash($password, PASSWORD_DEFAULT);
echo "Password asli: $password<br>";
echo "Hash-nya: $hashed";
?>
