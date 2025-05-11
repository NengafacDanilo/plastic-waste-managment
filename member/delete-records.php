<?php
 require_once('../config.php');

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        //$q = "DELETE FROM contact WHERE id='$id'";
        $q = "UPDATE menber_records SET status=0 WHERE id='$id'";
        
        if(mysqli_query($con, $q)) {
            Header('Location: records.php');
        } else "Couldn't delete Record";
    }

    ?>