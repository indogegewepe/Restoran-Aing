<?php
require '../function.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pelanggan</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="nganu.css" rel="stylesheet">

    <!-- Data Table -->
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">


</head>

<body class="bg-gradient-success centerlogin">

    <div id="accordion">
        <div class="container">

            <div id="collapseMenu" class="card collapse show o-hidden border-0 shadow-lg my-5" data-parent="#accordion">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Menu</h1>
                                </div>
                                <!-- FORM -->
                                <div class="card-body m-1">
                                    <form action="" class="user" method="post">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Menu</th>
                                                        <th>Harga</th>
                                                        <th>Kategori</th>
                                                        <th>Pesan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $makanan = mysqli_query($conn, "SELECT * FROM menu");
                                                    while ($row = mysqli_fetch_array($makanan)) {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $row['nama_menu'] ?></td>
                                                            <td><?php echo "Rp. " . number_format($row['harga']) ?></td>
                                                            <td><?php echo $row['kategori'] ?></td>
                                                            <td>
                                                                <?php if ($row['ketersediaan'] == 'ada') { ?>
                                                                    <a type="button" name="tambahBanyak" href="javascript:delay('tambahpesanan.php?id=<?php echo $row['id_menu']; ?>', 1000)" class="btn btn-success btn-icon-split" onclick="myFunc()">
                                                                        <span class=" icon text-white">
                                                                            <i class="fas fa-plus"></i>
                                                                        </span>
                                                                        <span class="text mx-1">Pesan</span>
                                                                    </a>
                                                                <?php } else { ?>
                                                                    <a type="button" class="btn btn-secondary btn-icon-split disabled">
                                                                        <span class="icon text-white">
                                                                            <i class="fas fa-times"></i>
                                                                        </span>
                                                                        <span class="text mx-2">Habis</span>
                                                                    </a>
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </form>
                                    <button class="btn btn-primary" data-toggle="collapse" data-target="#collapseCart" aria-expanded="true" aria-controls="collapseCart">
                                        <span class="text">Cart</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu yang sudah diambil -->
        <div class="container" id="udahdiambil">
            <div div id="collapseCart" class="card collapse o-hidden border-0 shadow-lg my-5" data-parent="#accordion">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Menu yang sudah diambil</h1>
                                </div>
                                <!-- FORM -->
                                <div class="card-body">
                                    <form action="" class="user" method="post">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Menu</th>
                                                        <th>Harga</th>
                                                        <th>Banyak</th>
                                                        <th>Total</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $id_transaksi = $_SESSION['id_transaksi'];
                                                    $makanan = mysqli_query($conn, "SELECT * FROM detail_transaksi 
                                                            INNER JOIN menu ON menu.id_menu = detail_transaksi.id_menu 
                                                            WHERE detail_transaksi.id_transaksi = $id_transaksi");
                                                    while ($row = mysqli_fetch_array($makanan)) {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $row['nama_menu'] ?></td>
                                                            <td><?php echo "Rp." . number_format($row['harga']) ?></td>
                                                            <td><?php echo $row['banyak'] ?></td>
                                                            <td><?php echo "Rp." . number_format($row['harga'] * $row['banyak']) ?></td>
                                                            <td>
                                                                <a class="btn btn-danger" type="button" href="javascript:remove('hapus_pesanan.php?id=<?php echo $row['id_menu'] ?>#udahdiambil')">
                                                                    <span class=" icon text-white">
                                                                        <i class="fas fa-times"></i>
                                                                    </span>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="clearfix">
                                            <a href="detailTransaksi.php" class="btn btn-primary btn-icon-split float-right">
                                                <span class="icon text-white">
                                                    <i class="fas fa-check"></i>
                                                </span>
                                                <span class="text">Submit</span>
                                            </a>
                                            <button class="btn btn-primary" data-toggle="collapse" data-target="#collapseMenu" aria-expanded="true" aria-controls="collapseMenu">
                                                <span class="text">Menu</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function myFunc() {
            Swal.fire(
                'Oke',
                'Menu Berhasil Dipesan',
                'success'
            )
        }

        function delay(URL, time) {
            setTimeout(function() {
                window.location = URL
            }, time);
        }

        function remove(URL) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    window.location.href = URL
                }
            })
        }
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <script src="../js/pelanggan.js"></script>

    <!-- Data table -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js" crossorigin="anonymous"></script>
    <script src="../js/demo/datatables-demo.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>

</body>

</html>