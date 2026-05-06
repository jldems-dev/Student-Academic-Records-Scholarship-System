<?php

include "../config.php";

$id = $_SESSION['uadminid'];
$name = $_SESSION['level'];

if(isset($_POST["image"]))
{
 $data = $_POST["image"];

 $image_array_1 = explode(";", $data);

 $image_array_2 = explode(",", $image_array_1[1]);

 $data = base64_decode($image_array_2[1]);

 $imageName = 'profileimages/'.$name.'.png';

 file_put_contents($imageName, $data);

 $query = mysqli_query($conn,"UPDATE userdata SET ava_location='$imageName' WHERE id='$id'");

 $_SESSION['stats'] = "success";
 $_SESSION['message'] = "Change Profile Successfull!";
 $_SESSION['icon'] = "check";
}
?>
