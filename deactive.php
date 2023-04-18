<?php
    include('config.php');
    $ids = array();
    $ids = $_POST["id"];
    
    
    $deactive = "UPDATE tbl_comment SET active=0 where comment_Id= ".$ids." ";
    
    $result = mysqli_query($conn,$deactive);
    echo mysqli_error($conn);

?>
