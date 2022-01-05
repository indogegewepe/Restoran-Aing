<?php
session_start();

// membuat koneksi ke database
$conn = mysqli_connect("localhost", "root","","db-restoran");

$result = $conn->query("SELECT id_pegawai FROM pegawai ORDER BY id_pegawai DESC LIMIT 1");
$lastId = "";
while ($row = mysqli_fetch_assoc($result)) {
    $lastId = $row["id_pegawai"];
}
$pieces = explode("-", $lastId);
$id = (int)$pieces[1] + 1;
$newId = "AX-".str_pad((string)$id, 4, "0", STR_PAD_LEFT);

function test_input($dataIn) {
    $dataIn = trim($dataIn);
    $dataIn = stripslashes($dataIn);
    $dataIn = htmlspecialchars($dataIn);
    return $dataIn;
}

// jika ada input pegawai baru
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset ($_POST["insertPegawai"])) {
        $nama = test_input($_POST["nama"]);
        $gender = test_input($_POST["gender"]);
        $email = test_input($_POST["email"]);
        $password = test_input($_POST["password"]);
        $alamat = test_input($_POST["alamat"]);
        $jenisPegawai = test_input($_POST["jenisPegawai"]);
        
        //insert database
        $conn->query("INSERT INTO pegawai(`id_pegawai`, `nama_pegawai`,`jenisKelamin`, `jenisPegawai`, `email`, `password`, alamat) VALUES('$newId','$nama', '$gender', '$jenisPegawai', '$email', '$password', '$alamat');");
        header("location:adm/pegawai.php");
	}
    if (isset($_POST["insertMenu"])) {
        $nama = test_input($_POST['nama']);
        $harga = test_input($_POST['harga']);
        $kategori = test_input($_POST['kategori']);

        // $query = "INSERT INTO menu VALUES('',$nama,$harga,$kategori,'ada')";
        // mysqli_query($conn, $query);
        $conn->query("INSERT INTO menu VALUES('','$nama','$harga','$kategori','ada');");
        header("location:adm/menu.php");
    }
}


//input data pembeli
if( isset($_POST["submit"])){
    $nama = htmlspecialchars($_POST["Nama"]);
    $noMeja = htmlspecialchars($_POST["noMeja"]);
    // id transaksi
    $idTransaksi = $_POST["idTransaksi"];
    
    // id pembeli
    $pembeli = mysqli_query($conn, "SELECT id_pembeli FROM pembeli ORDER BY id_pembeli DESC LIMIT 1");
    $dummy = mysqli_fetch_assoc($pembeli);
    $NEWid = $dummy['id_pembeli'];
    if(is_null($NEWid)){
        $NEWid = 1;
    } else {
        $NEWid += 1;
    }

    if($nama != null AND $noMeja != null)
    {
        // fungsi untuk menginputkan data
        $query = "INSERT INTO pembeli(id_pembeli,Nama,noMeja)
        VALUES ('$NEWid','$nama','$noMeja')";
        $query1 = "INSERT INTO transaksi(id_transaksi,id_pembeli)
        VALUES ('$idTransaksi','$NEWid')";

        $cek = mysqli_query($conn,$query);
        $cek1 = mysqli_query($conn,$query1);
        $_SESSION['id_transaksi'] = $idTransaksi;
        $_SESSION['id_pembeli'] = $NEWid;
        header("Location: pembeli/index.php");
    }
}

?>