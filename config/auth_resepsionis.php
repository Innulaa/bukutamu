<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'resepsionis') {
  header("Location: ../login.php");
  exit();
}
