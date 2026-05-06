<?php

include "../../config.php";

if(isset($_POST["image"]))
{
 $data = $_POST["image"];
$dpmnt_id = $_POST['dpment_id'];
$dpmnt_name = $_POST['dpment_name'];

 $image_array_1 = explode(";", $data);

 $image_array_2 = explode(",", $image_array_1[1]);

 $data = base64_decode($image_array_2[1]);

 $imageName = '../../img/'.$dpmnt_name.'.png';

 file_put_contents($imageName, $data);

 $query = mysqli_query($conn,"UPDATE department SET logo_path='$imageName' WHERE id='$dpmnt_id'");

 $_SESSION['stats'] = "success";
 $_SESSION['message'] = "Upload Logo Department Successful!";
 $_SESSION['icon'] = "check";
}
?>
