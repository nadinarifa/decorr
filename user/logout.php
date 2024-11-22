<?php
session_start();
session_destroy(); // Hapus semua sesi
header('Location: login_form.php'); // Arahkan ke halaman login
exit();
?>
