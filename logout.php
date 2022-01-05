<?php
session_start();
session_destroy();
header('location: http://localhost/loginRegister/Halaman%20awal/login.php');
?>