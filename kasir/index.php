<?php
require '../function.php';
require '../cekSesiLogin.php';
require '../configurasi.php';

$dateNow = date("Y/m/d");
$monthNow = date("Y/m");
$yearNow = date("Y");

// pendapatan bulanan
$pendbBulanan = mysqli_query(
    $conn,
    "SELECT DATE_FORMAT(tanggal_transaksi,'%Y/%m') AS tahun_bulan, SUM(total_transaksi) AS jumlah_bulanan
    FROM transaksi
    GROUP BY DATE_FORMAT(tanggal_transaksi,'%Y/%m');"
);
$total_bulanan = 0;
while ($row = mysqli_fetch_assoc($pendbBulanan)) {
    if ($row['tahun_bulan'] == $monthNow) $total_bulanan += $row['jumlah_bulanan'];
}

// pendapatan bulanan untuk grafik
$pendBulananGraf = mysqli_query(
    $conn,
    "SELECT SUM(IF( MONTH(tanggal_transaksi) = 01, total_transaksi, 0)) AS bulan1,
            SUM(IF( MONTH(tanggal_transaksi) = 02, total_transaksi, 0)) AS bulan2,
            SUM(IF( MONTH(tanggal_transaksi) = 03, total_transaksi, 0)) AS bulan3,
            SUM(IF( MONTH(tanggal_transaksi) = 04, total_transaksi, 0)) AS bulan4,
            SUM(IF( MONTH(tanggal_transaksi) = 05, total_transaksi, 0)) AS bulan5,
            SUM(IF( MONTH(tanggal_transaksi) = 06, total_transaksi, 0)) AS bulan6,
            SUM(IF( MONTH(tanggal_transaksi) = 07, total_transaksi, 0)) AS bulan7,
            SUM(IF( MONTH(tanggal_transaksi) = 08, total_transaksi, 0)) AS bulan8,
            SUM(IF( MONTH(tanggal_transaksi) = 09, total_transaksi, 0)) AS bulan9,
            SUM(IF( MONTH(tanggal_transaksi) = 10, total_transaksi, 0)) AS bulan10,
            SUM(IF( MONTH(tanggal_transaksi) = 11, total_transaksi, 0)) AS bulan11,
            SUM(IF( MONTH(tanggal_transaksi) = 12, total_transaksi, 0)) AS bulan12 
            FROM transaksi WHERE YEAR(tanggal_transaksi) = '$yearNow';"
);
// SELECT DATE_FORMAT(tanggal_transaksi,'%m') AS bulan
//     FROM transaksi
//     WHERE YEAR(tanggal_transaksi) = 2021

$arrPendBulananGraf = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
while ($row = mysqli_fetch_assoc($pendBulananGraf)) {
    $arrPendBulananGraf[0] = $row['bulan1'];
    $arrPendBulananGraf[1] = $row['bulan2'];
    $arrPendBulananGraf[2] = $row['bulan3'];
    $arrPendBulananGraf[3] = $row['bulan4'];
    $arrPendBulananGraf[4] = $row['bulan5'];
    $arrPendBulananGraf[5] = $row['bulan6'];
    $arrPendBulananGraf[6] = $row['bulan7'];
    $arrPendBulananGraf[7] = $row['bulan8'];
    $arrPendBulananGraf[8] = $row['bulan9'];
    $arrPendBulananGraf[9] = $row['bulan10'];
    $arrPendBulananGraf[10] = $row['bulan11'];
    $arrPendBulananGraf[11] = $row['bulan12'];
}
$i = 0;
$dataBulanan = "";
while ($i < 12) {
    if ($i == 11) $dataBulanan .= $arrPendBulananGraf[$i];
    else $dataBulanan .= $arrPendBulananGraf[$i] . ',';
    $i += 1;
}


// total pendapatan
$penTotal = mysqli_query($conn, "SELECT total_transaksi FROM transaksi WHERE total_transaksi > 0");
$total_pendapatan = 0;
while ($row = mysqli_fetch_assoc($penTotal)) {
    $total_pendapatan += $row['total_transaksi'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

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
            <li class="nav-item active">
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
            <li class="nav-item">
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

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Perbulan) Card Example -->
                        <div class="col-l-2 col-md-6 mb-2">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Pendapatan Bulan Ini</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo "Rp." . number_format($total_bulanan) ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-search-dollar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Tahunan) Card Example -->
                        <div class="col-l-2 col-md-6 mb-2">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Pendapatan</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo "Rp." . number_format($total_pendapatan); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl col-lg">
                            <div class="card border-left-primary shadow mb-4">
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="col mr-2">
                                        <div class="text-lg font-weight-bold text-primary text-uppercase mb-3">
                                            Pendapatan Pertahun</div>
                                    </div>
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

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

        <script>
            // Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#858796';

            function number_format(number, decimals, dec_point, thousands_sep) {
                // *     example: number_format(1234.56, 2, ',', ' ');
                // *     return: '1 234,56'
                number = (number + '').replace(',', '').replace(' ', '');
                var n = !isFinite(+number) ? 0 : +number,
                    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                    s = '',
                    toFixedFix = function(n, prec) {
                        var k = Math.pow(10, prec);
                        return '' + Math.round(n * k) / k;
                    };
                // Fix for IE parseFloat(0.55).toFixed(0) = 0;
                s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
                if (s[0].length > 3) {
                    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                }
                if ((s[1] || '').length < prec) {
                    s[1] = s[1] || '';
                    s[1] += new Array(prec - s[1].length + 1).join('0');
                }
                return s.join(dec);
            }

            // Area Chart Example
            var ctx = document.getElementById("myAreaChart");
            var myLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                        label: "Pendapatan",
                        lineTension: 0.3,
                        backgroundColor: "rgba(78, 115, 223, 0.3)",
                        borderColor: "rgb(78, 115, 223)",
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointBorderColor: "rgba(78, 115, 223, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        data: [<?php echo $dataBulanan ?>],
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            left: 10,
                            right: 25,
                            top: 25,
                            bottom: 0
                        }
                    },
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'date'
                            },
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                maxTicksLimit: 7
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                maxTicksLimit: 5,
                                padding: 10,
                                // Include a dollar sign in the ticks
                                callback: function(value, index, values) {
                                    return 'Rp.' + number_format(value);
                                }
                            },
                            gridLines: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2]
                            }
                        }],
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        titleMarginBottom: 10,
                        titleFontColor: '#6e707e',
                        titleFontSize: 14,
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        intersect: false,
                        mode: 'index',
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem, chart) {
                                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                return 'Pendapatan: Rp.' + number_format(tooltipItem.yLabel);
                            }
                        }
                    }
                }
            });
        </script>
</body>

</html>