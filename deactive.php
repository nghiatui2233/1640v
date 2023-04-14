<?php
    include('config.php');
    $ids = array();
    // $ids = implode(",",$_POST["id"]);
    $ids = $_POST["id"];
    
    
    // $deactive = "UPDATE inf SET active=0 where n_id IN(".$ids.")";
    $deactive = "UPDATE tbl_comment SET active=0 where comment_Id= ".$ids." ";
    
    $result = mysqli_query($conn,$deactive);
    echo mysqli_error($conn);

?>