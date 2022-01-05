<?php
    include '../function.php';
    
    if(isset($_GET['id'])){
        $delete = mysqli_query($conn, "DELETE FROM pegawai WHERE id_pegawai = '".$_GET['id']."' ");
        echo '<script>window.location="pegawai.php"</script>';
    }
?>