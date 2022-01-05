<?php

require '../function.php';

//menu
$id = $_GET['id'];
$dataMenu =  mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM menu WHERE id_menu = $id"));

//transaksi
$idTransaksi = $_SESSION['id_transaksi'];

//detail transaksi
$qty = 1;
$dataDtransaksi = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM detail_transaksi WHERE id_transaksi = $idTransaksi AND id_menu = $id"));
$hitung = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM detail_transaksi WHERE id_transaksi = $idTransaksi AND id_menu = $id"));

if($hitung > 0){
    $qty_final = $qty+$dataDtransaksi['banyak'];
    echo $qty_final;

    $query = "UPDATE detail_transaksi 
    SET banyak = '$qty_final'
    WHERE id_transaksi = '$idTransaksi' AND id_menu = '$id'";
    $tambahpesanan = $conn->query($query);
    mysqli_query($conn, $query);
} else {
    $query = "INSERT INTO detail_transaksi VALUES('$idTransaksi', '$id', '$qty')";
    mysqli_query($conn, $query);
}

header('location:index.php');
?>