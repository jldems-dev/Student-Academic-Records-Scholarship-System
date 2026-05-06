<?php
include "../../config.php";

if($_POST['value']){
    
$id = $_POST['value'];
$classid = $_POST['classid'];

mysqli_query($conn,"UPDATE class SET sy='$id' WHERE id='$classid'");
echo "Selected Subject School Year: $id";
}
?>