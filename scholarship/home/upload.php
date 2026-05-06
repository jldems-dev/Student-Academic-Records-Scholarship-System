<?php
include "../config.php";

if($_FILES["files"]["name"] != ''){

  $ancmtid = $_POST['ancmtid'];

  $targetDir = "anctmimages/";
  $allowTypes = array('jpg','png','jpeg','gif'); 
  $fileNames = array_filter($_FILES['files']['name']);

  if(!empty($fileNames)){
    foreach($_FILES['files']['name'] as $key=>$val){
      $fileName = basename($_FILES['files']['name'][$key]);
      $targetFilePath = $targetDir . $fileName;
      $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        if(in_array($fileType, $allowTypes)){
          if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){
           
            mysqli_query($conn, "INSERT INTO sch_ancmtimg (ancmt_id, file_name, image_path) VALUES ('$ancmtid','$fileName','$targetFilePath')");

            $_SESSION['msg'] = "Upload Images Successful";
            $_SESSION['status'] = "success";
           
          }
        }else{
          $_SESSION['msg'] = "Invalid File Type Only: jpg,png,jpeg,gif";
          $_SESSION['status'] = "error";
        }
    } 
  }else{
    $_SESSION['msg'] = "Choose Images File";
    $_SESSION['status'] = "error";
  }
}
?>