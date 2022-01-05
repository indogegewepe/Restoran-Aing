<?php
require '../function.php';

$id_transaksi = $_SESSION['id_transaksi'];

$dataTransaksi = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM transaksi WHERE id_transaksi = $id_transaksi"));
$idPembeli = $dataTransaksi['id_pembeli'];
$dataPembeli = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM pembeli WHERE id_pembeli = $idPembeli"));

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Detail Transaksi</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="nganu.css" rel="stylesheet">


</head>

<body class="bg-gradient-dark centerlogin">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-4">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Detail Transaksi</h1>
                            </div>

                            <!-- Menu Makanan -->
                            <div class="card shadow mb-4 animated--grow-in" aria-labelledby="headingMakanan">
                                <div class="card-header">
                                    <table class="table-borderless w-50" width="100%" cellspacing="0">
                                        <tr>
                                            <th>Nama Pembeli</th>
                                            <th>: <?php echo $dataPembeli['Nama']; ?></th>
                                        </tr>
                                        <tr>
                                            <td>No Meja</td>
                                            <td>: <?php echo $dataPembeli['noMeja']; ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Nama Menu</th>
                                                    <th>Harga</th>
                                                    <th>Banyak</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $id_transaksi = $_SESSION['id_transaksi'];
                                                $makanan = mysqli_query($conn, "SELECT * FROM detail_transaksi 
                                                        INNER JOIN menu ON menu.id_menu = detail_transaksi.id_menu 
                                                        WHERE detail_transaksi.id_transaksi = $id_transaksi");
                                                $total = 0;
                                                while ($row = mysqli_fetch_array($makanan)) {
                                                    $subtotal = $row['harga'] * $row['banyak'];
                                                    $total += $subtotal;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['nama_menu'] ?></td>
                                                        <td><?php echo "Rp." . number_format($row['harga'])  ?></td>
                                                        <td><?php echo $row['banyak'] ?></td>
                                                        <td><?php echo "Rp." . number_format($subtotal) ?></td>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <th colspan="3">Total Bayar</th>
                                                    <th><?php echo "Rp." . number_format($total) ?></th>
                                                </tr>
                                                <?php
                                                $query = "UPDATE transaksi SET total_transaksi = '$total' WHERE id_transaksi = '$id_transaksi'";
                                                mysqli_query($conn, $query);
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <a type="submit" href="../index.php" class="btn btn-danger btn-icon-split">
                                <span class="icon text-white">
                                    <i class="fas fa-times"></i>
                                </span>
                                <span class="text">Close</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>


</body>

</html>