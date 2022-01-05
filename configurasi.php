<?php

// cek login, terdaftar apa kagak
if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // cocokin dengan database, cari ada atau enggak tuh data
    $cekdatabase = mysqli_query($conn, "SELECT * FROM pegawai where email='$email' and password='$password'");
    // hitung jumlah data
    $hitung = mysqli_num_rows($cekdatabase);

    if($hitung>0){
        $_SESSION['log'] = 'True';
        $cekAdmin = mysqli_query($conn, "SELECT * FROM pegawai WHERE email = '$email'");
        $cekAdminFINAL = mysqli_fetch_assoc($cekAdmin);
        $_SESSION["jenisPegawai"] = $cekAdminFINAL["jenisPegawai"];
        $_SESSION['id_pegawai'] = $cekAdminFINAL['id_pegawai'];
        $_SESSION['email'] = $email;

        $cekNama = mysqli_query($conn, "SELECT nama_pegawai FROM pegawai WHERE email = '$email'");
        $cekNamaFINAL = mysqli_fetch_assoc($cekNama);
        $_SESSION['name'] = $cekNamaFINAL["nama_pegawai"];


        if($cekAdminFINAL["jenisPegawai"] == "Admin")
        {
            // sesuaikan
            header("Location: http://localhost/Mywork/TugasAkhir/baru%20banget/Halaman%20awal/adm/index.php");
        }else
        {
            // sesuaikan 
            header("Location: http://localhost/Mywork/TugasAkhir/baru%20banget/Halaman%20awal/kasir/index.php");
        }
    } else {
        header('location:login.php');
    }
}



?>