<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'config/koneksi.php';

if (isset($_POST['login'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = $_POST['password']; // plain password dari input form

  $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
  $user  = mysqli_fetch_assoc($query);

  if ($user && password_verify($password, $user['password'])) {
    // Simpan session
    $_SESSION['username'] = $user['username'];
    $_SESSION['role']     = $user['role'];
    $_SESSION['success']  = 'Berhasil login';

    // Redirect sesuai role
    if ($user['role'] === 'admin') {
      header("Location: admin/dashboard.php");
    } elseif ($user['role'] === 'resepsionis') {
      header("Location: resepsionis/dashboard.php");
    } else {
      $error = "Role tidak dikenali.";
    }
    exit();
  } else {
    $error = "Username atau password salah!";
  }
}
?>

<!-- HTML Login Form -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
  <form method="POST" class="bg-white p-8 rounded shadow-md w-96">
    <h2 class="text-2xl font-bold text-center mb-6">Login Sistem</h2>

    <?php if (isset($error)): ?>
      <div class="bg-red-100 text-red-700 p-2 rounded mb-4"><?= $error ?></div>
    <?php endif; ?>

    <input type="text" name="username" placeholder="Username" required class="w-full mb-3 p-2 border rounded" />
    <input type="password" name="password" placeholder="Password" required class="w-full mb-4 p-2 border rounded" />
    
    <button type="submit" name="login" class="w-full bg-orange-400 text-white py-2 rounded hover:bg-orange-500">Login</button>
  </form>
</body>
</html>
