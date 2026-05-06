<?php
include "../config.php";
date_default_timezone_set("Asia/Manila");
if($_FILES["files"]["name"] != ''){

  $schname=$_POST['schname'];
  $studid=$_POST['studid'];

  $targetDir = "studentfiles/";
  $allowTypes = array('jpg','png','jpeg','gif','bmp' , 'pdf' , 'doc','docx'); 
  $fileNames = array_filter($_FILES['files']['name']);

  if(!empty($fileNames)){
    foreach($_FILES['files']['name'] as $key=>$val){
      $fileName = basename($_FILES['files']['name'][$key]);
      $targetFilePath = $targetDir . $fileName;
      $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        if(in_array($fileType, $allowTypes)){

          if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){
            
            $date = date("Y-m-d H:i:s");
            $insert = mysqli_query($conn, "INSERT INTO sch_files Values (null,'$studid','$schname','$fileName','$targetFilePath','$date','0')");
            $insert = mysqli_query($conn, "INSERT INTO sch_notif Values (null,'Student Sent Files',' Sent Files for $schname Scholarship','$date','$studid','0')");

            if($insert){
              $_SESSION['stats'] = "success";
              $_SESSION['message'] = "Sent Files Successfull!";
              $_SESSION['icon'] = "check";
            }
          }
        }else{
          $_SESSION['stats'] = "warning";
          $_SESSION['message'] = "Invalid File Extention!";
          $_SESSION['icon'] = "exclamation-triangle";
        }
    }
  }else{
    $_SESSION['stats'] = "warning";
    $_SESSION['message'] = "Choose Files";
    $_SESSION['icon'] = "exclamation-triangle";
  }
}
?>