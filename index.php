<?php
// include_once 'config.php';
require 'function.php';
$result = $conn->query("SELECT id_transaksi FROM transaksi ORDER BY id_transaksi DESC LIMIT 1");
$row = mysqli_fetch_assoc($result);
$lastIdTransaksi = $row["id_transaksi"];
if(is_null($lastIdTransaksi)){
    $lastIdTransaksi = 1;
} else {
    $lastIdTransaksi += 1;
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

    <title>Pelanggan</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/nganu.css" rel="stylesheet">

</head>

<body class="bg-gradient-success centerlogin">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Silahkan Isi Formulir</h1>
                            </div>
                            <!-- FORM -->
                            <form action="" class="user" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="Name" placeholder="Nama" name="Nama" required>
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-user" id="tableNumber" placeholder="Nomor Meja" name="noMeja" required>
                                </div>
                                <input type="number" name="idTransaksi" value="<?php echo $lastIdTransaksi; ?>" hidden>
                                <button class="btn btn-success btn-user btn-block" name="submit">
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="js/demo/chart-bar-demo.js"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="js/demo/datatables-demo.js"></script>
</body>

</html>