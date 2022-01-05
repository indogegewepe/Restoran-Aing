<?php
require '../function.php';
require '../cekSesiLogin.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Transaksi</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Data Table -->
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet" crossorigin="anonymous" />

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
</head>



<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-id-card"></i>
                </div>
                <div class="sidebar-brand-text mx-3"><?php echo $_SESSION["jenisPegawai"] ?></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Menu -->
            <li class="nav-item">
                <a class="nav-link" href="menu.php">
                    <i class="fas fa-utensils"></i>
                    <span>Menu</span></a>
            </li>

            <!-- Nav Item - Pegawai -->
            <li class="nav-item">
                <a class="nav-link" href="pegawai.php">
                    <i class="fas fa-user"></i>
                    <span>Pegawai</span></a>
            </li>

            <!-- Nav Item - Transaksi -->
            <li class="nav-item active">
                <a class="nav-link" href="transaksi.php">
                    <i class="fas fa-cash-register"></i>
                    <span>Transaksi</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Toggler Sidebar -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow show">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['name']; ?></span>
                                <img class="img-profile rounded-circle" src="../img/undraw_profile_2.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content 1 -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tabel Transaksi</h1>
                    <p class="mb-4">Hasil transaksi harian</p>

                    <!-- DataTables Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Belum Lunas</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama Pembeli</th>
                                            <th>Total</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $belum_bayar = mysqli_query($conn, "SELECT * FROM transaksi INNER JOIN pembeli 
                                                        ON transaksi.id_pembeli = pembeli.id_pembeli 
                                                        WHERE id_pegawai IS NULL");
                                        while ($row = mysqli_fetch_array($belum_bayar)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $row['Nama'] ?></td>
                                                <td><?php echo "Rp." . number_format($row['total_transaksi']) ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-icon-split" data-toggle="modal" data-target="#detail1<?php echo $row['id_transaksi']; ?>">
                                                        <span class="icon text-white">
                                                            <i class="fas fa-plus"></i>
                                                        </span>
                                                        <span class="text">Lihat Detail</span>
                                                    </button>
                                                    <!-- Detail Menu Modal -->
                                                    <div class="modal fade" id="detail1<?php echo $row['id_transaksi']; ?>" tabindex="-1" role="dialog" aria-labelledby="detail1<?php echo $row['id_transaksi']; ?>" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $row['Nama'] ?></h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-bordered" width="100%" cellspacing="0">
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
                                                                                $id_transaksi = $row['id_transaksi'];
                                                                                $total = 0;
                                                                                $makanan = mysqli_query($conn, "SELECT * FROM detail_transaksi 
                                                                                        INNER JOIN menu ON menu.id_menu = detail_transaksi.id_menu 
                                                                                        WHERE detail_transaksi.id_transaksi = $id_transaksi");
                                                                                while ($row_detail = mysqli_fetch_array($makanan)) {
                                                                                    $subtotal = $row_detail['harga'] * $row_detail['banyak'];
                                                                                    $total += $subtotal;
                                                                                ?>
                                                                                    <tr>
                                                                                        <td><?php echo $row_detail['nama_menu'] ?></td>
                                                                                        <td><?php echo "Rp." . number_format($row_detail['harga'])  ?></td>
                                                                                        <td><?php echo $row_detail['banyak'] ?></td>
                                                                                        <td><?php echo "Rp." . number_format($subtotal) ?></td>
                                                                                    </tr>
                                                                                <?php } ?>
                                                                                <tr>
                                                                                    <th>Total Bayar</th>
                                                                                    <th></th>
                                                                                    <th></th>
                                                                                    <th><?php echo "Rp." . number_format($total) ?></th>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <a type="button" href="lunasin.php?<?php echo 'id=' . $row['id_transaksi'] ?>" class="btn btn-success btn-icon-split">
                                                                        <span class="icon text-white">
                                                                            <i class="fas fa-plus"></i>
                                                                        </span>
                                                                        <span class="text">Lunas</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

                <hr style="width: 95%; border-top: 2px solid rgba(0, 0, 0, 0.3);">

                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Lunas</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered display" id="dataTable1" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama Pembeli</th>
                                            <th>Total</th>
                                            <th>Tanggal</th>
                                            <th>Kasir</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sudah_bayar = mysqli_query($conn, "SELECT * FROM transaksi INNER JOIN pembeli 
                                                        ON transaksi.id_pembeli = pembeli.id_pembeli 
                                                        WHERE id_pegawai IS NOT NULL");
                                        while ($row = mysqli_fetch_array($sudah_bayar)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $row['Nama'] ?></td>
                                                <td><?php echo "Rp." . number_format($row['total_transaksi']) ?></td>
                                                <td><?php echo $row['tanggal_transaksi'] ?></td>
                                                <td><?php echo $_SESSION['name'] ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-icon-split" data-toggle="modal" data-target="#detail2<?php echo $row['id_transaksi']; ?>">
                                                        <span class="icon text-white">
                                                            <i class="fas fa-plus"></i>
                                                        </span>
                                                        <span class="text">Lihat Detail</span>
                                                    </button>
                                                    <!-- Detail Menu Modal -->
                                                    <div class="modal fade" id="detail2<?php echo $row['id_transaksi']; ?>" tabindex="-1" role="dialog" aria-labelledby="detail2<?php echo $row['id_transaksi']; ?>" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $row['Nama'] ?></h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-bordered" width="100%" cellspacing="0">
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
                                                                                $id_transaksi = $row['id_transaksi'];
                                                                                $total = 0;
                                                                                $makanan = mysqli_query($conn, "SELECT * FROM detail_transaksi 
                                                                                        INNER JOIN menu ON menu.id_menu = detail_transaksi.id_menu 
                                                                                        WHERE detail_transaksi.id_transaksi = $id_transaksi");
                                                                                while ($row_detail = mysqli_fetch_array($makanan)) {
                                                                                    $subtotal = $row_detail['harga'] * $row_detail['banyak'];
                                                                                    $total += $subtotal;
                                                                                ?>
                                                                                    <tr>
                                                                                        <td><?php echo $row_detail['nama_menu'] ?></td>
                                                                                        <td><?php echo "Rp." . number_format($row_detail['harga'])  ?></td>
                                                                                        <td><?php echo $row_detail['banyak'] ?></td>
                                                                                        <td><?php echo "Rp." . number_format($subtotal) ?></td>
                                                                                    </tr>
                                                                                <?php } ?>
                                                                                <tr>
                                                                                    <th>Total Bayar</th>
                                                                                    <th></th>
                                                                                    <th></th>
                                                                                    <th><?php echo "Rp." . number_format($total) ?></th>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <a type="button" href="" class="btn btn-danger btn-icon-split">
                                                                        <span class="icon text-white">
                                                                            <i class="fas fa-times"></i>
                                                                        </span>
                                                                        <span class="text">Close</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- End of Main Content 1 -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Basis Data 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../logout.php">Logout</a>
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

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="../js/demo/datatables-demo.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
</body>

</html>