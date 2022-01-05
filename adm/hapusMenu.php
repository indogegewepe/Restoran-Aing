<?php
    include '../function.php';
    
    if(isset($_GET['id'])){
        $delete = mysqli_query($conn, "DELETE FROM menu WHERE id_menu = '".$_GET['id']."' ");
        echo '<script>window.location="menu.php"</script>';
    }
?>