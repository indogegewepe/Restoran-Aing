<?php
require '../function.php';

$id = $_GET['id'];

if (isset($_POST["submit"])) {
    $nama_menu = $_POST['nama'];
    $harga = $_POST['harga'];
    $ketersediaan = $_POST['ketersediaan'];

    mysqli_query($conn, "UPDATE menu SET nama_menu = '$nama_menu', harga = $harga, ketersediaan = '$ketersediaan' WHERE id_menu = $id");
    header(("Location: menu.php"));
}


// Display selected user data based on id
// Getting id from url
// Ambil data dari id sebelumnya

$menuBefore = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM menu WHERE id_menu = $id"));

// echo $_POST['nama'];
// echo $_POST['ketersediaan'];
// echo $_POST['harga'];

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Edit Menu</title>

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
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Edit Menu</h1>
                            </div>
                            <!-- FORM -->
                            <form action="" class="user" method="post">
                                <div class="form-group">
                                    <input type="text" name="nama" class="form-control" placeholder="Nama menu" value="<?= $menuBefore["nama_menu"]; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <input type="number" name="harga" class="form-control" placeholder="Harga" value="<?= $menuBefore["harga"]; ?>" readonly>
                                </div>
                                <div class="text-center my-3">
                                    <?php if ($menuBefore["ketersediaan"] == 'ada') { ?>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="ketersediaan" id="ada" value="ada" required checked>
                                            <label class="form-check-label" for="ada">Ada</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="ketersediaan" id="habis" value="habis">
                                            <label class="form-check-label" for="habis">Habis</label>
                                        </div>
                                    <?php } else { ?>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="ketersediaan" id="ada" value="ada" required>
                                            <label class="form-check-label" for="ada">Ada</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="ketersediaan" id="habis" value="habis" checked>
                                            <label class="form-check-label" for="habis">Habis</label>
                                        </div>
                                    <?php } ?>
                                </div>
                                <input type="hidden" name="submit" value="<?php echo $_GET['id']; ?>">
                                <button class="btn btn-primary btn-user btn-block" name="submit">
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

    <!-- Data table -->
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="../js/demo/datatables-demo.js"></script>

</body>

</html>