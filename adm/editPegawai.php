<?php
require '../function.php';

// edit pegawai
$id = $_GET['id'];

if (isset($_POST["submit"])) {
    $nama = $_POST["nama"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $alamat = $_POST["alamat"];
    $jenisPegawai = $_POST["jenisPegawai"];

    //update database
    mysqli_query($conn,"UPDATE pegawai SET nama_pegawai = '$nama', jenisKelamin = '$gender', jenisPegawai = '$jenisPegawai',
        email = '$email', alamat = '$alamat', `password` = '$password'  
        WHERE id_pegawai = '$id'");
    header(("Location: pegawai.php"));
}

// Display selected user data based on id
// Getting id from url
$pegawaiBefore = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM pegawai WHERE id_pegawai = '$id'"));

// $result = mysqli_query($conn, "SELECT * FROM pegawai WHERE id_pegawai='$id'");
// while ($user_data = mysqli_fetch_array($result)) {
//     $nama = $user_data["nama_pegawai"];
//     $gender = $user_data["jenisKelamin"];
//     $email = $user_data["email"];
//     $password = $user_data["password"];
//     $alamat = $user_data["alamat"];
//     $jenisPegawai = $user_data["jenisPegawai"];
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Edit Pegawai</title>

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
                    <div class="col-lg-6 d-none d-lg-block bg-register-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Edit Pegawai</h1>
                                </div>
                                <!-- FORM -->
                                <form action="" class="user" method="post">
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="id_pegawai" placeholder="Id Pegawai" value="<?= $pegawaiBefore['id_pegawai']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="nama" class="form-control" placeholder="Nama" required value="<?= $pegawaiBefore['nama_pegawai']; ?>">
                                    </div>
                                    <div class="text-center my-3">
                                        <?php if ($pegawaiBefore['jenisKelamin'] == 'Laki-laki') { ?>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="lk" value="Laki-laki" required checked>
                                            <label class="form-check-label" for="lk">Laki-laki</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="pr" value="Perempuan">
                                            <label class="form-check-label" for="pr">Perempuan</label>
                                        </div>
                                        <?php } else { ?>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="lk" value="Laki-laki" required>
                                            <label class="form-check-label" for="lk">Laki-laki</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="pr" value="Perempuan" checked>
                                            <label class="form-check-label" for="pr">Perempuan</label>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Email" required value="<?= $pegawaiBefore['email']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" placeholder="Password" required value="<?= $pegawaiBefore['password']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="alamat" name="alamat" class="form-control" placeholder="Alamat" required value="<?= $pegawaiBefore['alamat']; ?>">
                                    </div>
                                    <div class="text-center my-3">
                                        <?php if ($pegawaiBefore['jenisPegawai'] == 'Admin') { ?>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenisPegawai" id="adm" value="Admin" required checked>
                                            <label class="form-check-label" for="adm">Admin</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenisPegawai" id="ksr" value="Kasir">
                                            <label class="form-check-label" for="ksr">Kasir</label>
                                        </div>
                                        <?php } else { ?>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenisPegawai" id="adm" value="Admin" required>
                                            <label class="form-check-label" for="adm">Admin</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenisPegawai" id="ksr" value="Kasir" required checked>
                                            <label class="form-check-label" for="ksr">Kasir</label>
                                        </div>
                                        <?php } ?>
                                    </div>

                                    <button class="btn btn-primary btn-user btn-block" name="submit">
                                        Update Data
                                    </button>
                                </form>
                            </div>
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

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Data table -->
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="../js/demo/datatables-demo.js"></script>

</body>

</html>