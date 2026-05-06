<?php

include "../config.php";

    date_default_timezone_set("Asia/Manila");
    $date = date("Y-m-d h:i:s A");
    $id = $_SESSION['studid'];//usedata ID No.

if($_POST["action"] == "updateuser"){
        
 
    $upmname = ucwords($_POST['mname']);
    $upfname = ucwords($_POST['fname']);
    $uplname = ucwords($_POST['lname']);

    mysqli_query($conn,"UPDATE userdata SET fname='$upfname',mname='$upmname',lname='$uplname' WHERE id='$id'");
    $_SESSION['stats'] = "success";
    $_SESSION['message'] = "Update Account Successful!";
    $_SESSION['icon'] = "check";
}

if($_POST["action"] == "updatepass"){
        
    $currentPassword =  md5($_POST['currentPassword']);
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    $query = mysqli_query($conn, "SELECT * From userdata WHERE id='$id'");
    $row = mysqli_fetch_array($query);

    if($row['pass'] == $currentPassword){
        if($newPassword == $confirmPassword){
           $update_password=mysqli_query($conn,"UPDATE userdata SET pass= md5('$newPassword') WHERE id='$id'");
            echo"Update Password Sucessfully!!";

        }else{
            $_SESSION['stats'] = "warning";
            $_SESSION['message'] = "New Password & Confirm Password dont match!";
            $_SESSION['icon'] = "exclamation-triangle";
        }
    }else{
        $_SESSION['stats'] = "warning";
        $_SESSION['message'] = "Current Password & New Password dont match!";
        $_SESSION['icon'] = "exclamation-triangle";
    }
}

if($_POST["action"] == "clear"){

   $check = mysqli_query($conn,"DELETE FROM notification WHERE studid='".$_POST['studid']."'");
    
   $_SESSION['stats'] = "success";
    $_SESSION['message'] = "Clear Notifications Successful!";
    $_SESSION['icon'] = "check";

}
if(isset($_POST['action'])){
    if($_POST["action"] == "view_notification"){

        $norif_name = $_POST['norif_name'];
        $notif_id = $_POST['notif_id'];

        if($norif_name == 'Grade'){
           echo "Grade";
           mysqli_query($conn, "UPDATE notification SET active = 1 WHERE id='$notif_id'");
        }else if($norif_name == 'Announcement'){
            echo "Announcement";
            mysqli_query($conn, "UPDATE notification SET active = 1 WHERE id='$notif_id'");
        }else if($norif_name == 'Scholarship'){
            echo "Scholarship";
            mysqli_query($conn, "UPDATE notification SET active = 1 WHERE id='$notif_id'");
        }else if($norif_name == 'Request'){
            echo "Request";
            mysqli_query($conn, "UPDATE notification SET active = 1 WHERE id='$notif_id'");
        }
    }
}

if($_POST["action"] == "delete_all"){

    $id = $_POST["id"];
    $studid = $_POST["studid"];

   if(empty($id)){
            echo "warning";
    }else{
    $array = explode (',', $id);
      foreach($array as $value)
        {
            $newvalue = $value . PHP_EOL;

            $delete_all = mysqli_query($conn, "DELETE FROM sch_files  WHERE id='$newvalue' AND studid='$studid'");
            $delete_all = mysqli_query($conn, "DELETE FROM request WHERE id='$newvalue' AND studid='$studid'");
            if($delete_all){

                $_SESSION['stats'] = "success";
                $_SESSION['message'] = "Delete Selected Successful!";
                $_SESSION['icon'] = "check";
            }
        }
    }
}

if($_POST["action"] == "submit_appform"){

    $checkstatus = mysqli_query($conn, "SELECT * FROM sch_applctionform WHERE studid='".$_POST["id"]."' AND sch_nameid='".$_POST["schnameid"]."'");
    $row=mysqli_fetch_assoc($checkstatus);

    if($row['sy'] == $_POST['schsy']){
        echo "warning";
    }else{
        mysqli_query($conn, "INSERT INTO sch_notif Values (null,'New Applicant',' Submit Application Form for ".$_POST['schname']." Scholarship','$date','".$_POST["id"]."','0')");
        $check = mysqli_query($conn,"INSERT INTO sch_applctionform VALUES(null,
        '".$_POST["schnameid"]."','".$_POST["id"]."',
        '".$_POST["studid"]."','".$_POST["lname"]."',
        '".$_POST["gname"]."','".$_POST["xname"]."',
        '".$_POST["mname"]."','".$_POST["sex"]."',
        '".$_POST["bday"]."','".$_POST["course"]."',
        '".$_POST["year"]."','".$_POST["flname"]."',
        '".$_POST["fgname"]."','".$_POST["fmname"]."',
        '".$_POST["mlname"]."','".$_POST["mgname"]."',
        '".$_POST["mmname"]."','".$_POST["dswd"]."',
        '".$_POST["hshld"]."','".$_POST["brgy"]."',
        '".$_POST["zpcode"]."','".$_POST["ttafsem"]."',
        '".$_POST["ttassem"]."','".$_POST["dsblty"]."',
        '".$_POST["cn"]."','".$_POST["ed"]."','".$_POST["schsy"]."')");

        if($check){
            echo "success";
        }else{
            echo "error";
        }
    }
}

if($_POST["action"] == "sent_request"){

    $studentinfo = mysqli_query($conn, "SELECT * FROM student WHERE id='".$_POST['studid']."'");
    $rowistud=mysqli_fetch_assoc($studentinfo);
    $name = $rowistud['fname'].' '.$rowistud['mname'].'. '.$rowistud['lname'];

    mysqli_query($conn,"INSERT INTO request VALUES(null,'".$rowistud['id']."','Grades','".$rowistud['studid']."','".$name."','".$_POST['fgrades']."','".$_POST['sy']."','".$_POST['sem']."','".$rowistud['email']."','$date','0')");
    $_SESSION['stats'] = "success";
    $_SESSION['message'] = "Sent Request Successfull!";
    $_SESSION['icon'] = "check";
}

if($_POST["action"] == "view_profileimg"){
    $out = '<div class="py-3 px-3"> <a href="'.$_POST['src'].'" target="_blank"><img src="'.$_POST['src'].'" class="img-square"></a></div>';
    echo $out;
  
}
if($_POST["action"] == "view_postimage"){
    $ancmt = mysqli_query($conn, "SELECT * FROM sch_ancmtimg WHERE ancmt_id='".$_POST['anmctid']."'");
    while($rowancmtimg=mysqli_fetch_assoc($ancmt)){
        echo "<div class='py-3 px-3'><img src='../../scholarship/home/".$rowancmtimg['image_path']."' class='img-responsive' width='300' id='imageZoom'><hr></div>";
    }
}
?>