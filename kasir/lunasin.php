<?php
require "../function.php";
$tanggal_transaksi = date("Y-m-d");
$id_transaksi = $_GET['id'];
echo $id_transaksi;
$id_pegawai = $_SESSION['id_pegawai'];
echo $id_pegawai;
$query = "UPDATE transaksi SET id_pegawai = '$id_pegawai', tanggal_transaksi = '$tanggal_transaksi' WHERE id_transaksi = '$id_transaksi'";
mysqli_query($conn, $query);
header("location:transaksi.php");

?>