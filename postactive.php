<?php
    include('config.php');
    $ids = array();
    // $ids = implode(",",$_POST["id"]);
    $ids = $_POST["id"];
    
    
    // $deactive = "UPDATE inf SET active=0 where n_id IN(".$ids.")";
    $deactive = "UPDATE tbl_post SET active=0 where post_Id= ".$ids." ";
    
    $result = mysqli_query($conn,$deactive);
    echo mysqli_error($conn);

?>