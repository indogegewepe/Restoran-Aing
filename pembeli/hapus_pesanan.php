<?php
    include '../function.php';
    
    if(isset($_GET['id'])){
        $delete = mysqli_query($conn, "DELETE FROM detail_transaksi WHERE id_menu = '".$_GET['id']."' ");
        echo '<script>window.location="index.php"</script>';
    }
?>