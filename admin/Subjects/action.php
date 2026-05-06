<?php
    include "../../config.php";

    date_default_timezone_set("Asia/Manila");
    $date = date("Y-m-d h:i:s A");

    $id = $_SESSION['uadminid']; // admin userdata ID

if($_POST['action']){

    if($_POST['action'] == "add_subject_record"){

        if(!empty($_POST['course']) && !empty($_POST['year']) && !empty($_POST['semester'])){

            $result = mysqli_query($conn,"SELECT * FROM  subject_record");
            $check = false;
            while($row = mysqli_fetch_assoc($result)){
                if($_POST['course'] == $row['course'] && $_POST['year'] == $row['year'] && $_POST['semester'] == $row['semester']){
                    $check = true;
                }
            }
            if($check){

                $_SESSION['msg']="Record Newly Add Already Exist!";
                $_SESSION['status']="error";

            }else{
                mysqli_query($conn,"INSERT INTO subject_record VALUES(null,'".$_POST['course']."','".$_POST['year']."','".$_POST['semester']."')");
            
                $_SESSION['msg']="New Record Add Successful!";
                $_SESSION['status']="success";

                $act = "Admin Add New Subject Record: ".$_POST['course']." - ".$_POST['year']." - ".$_POST['semester']." Semester";
                $q = mysqli_query($conn,"INSERT INTO log values(null,'$date','$act','$id')");
            }
        }
    }
    if($_POST["action"] == "update_subject_record"){

        $result = mysqli_query($conn,"SELECT * FROM  subject_record");
        $check = false;
        while($row = mysqli_fetch_assoc($result)){
            if($_POST['upcourse'] == $row['course'] && $_POST['upyear'] == $row['year'] && $_POST['upsemester'] == $row['semester']){
                $check = true;
            }
        }
        if($check){
            $_SESSION['msg']="Record Update Already Exist!";
            $_SESSION['status']="error";
        }else{
            
            mysqli_query($conn,"UPDATE subject_record SET course='".$_POST['upcourse']."',year='".$_POST['upyear']."', semester='".$_POST['upsemester']."' WHERE id='".$_POST['record_id']."'");

            $_SESSION['msg']="Update Record Successful";
            $_SESSION['status']="success";
    
           
            $act = "Admin Update Subject Record: ".$_POST['upcourse']." - ".$_POST['upyear']." - ".$_POST['upsemester']." Semester";
            $q = mysqli_query($conn,"INSERT INTO log values(null,'$date','$act','$id')");
        }
    } 

    if($_POST["action"] == "delete_record"){


        mysqli_query($conn, "DELETE FROM subject_record WHERE id = '".$_POST['recordid']."'");
        mysqli_query($conn, "DELETE FROM subject WHERE subrecord_id = '".$_POST['recordid']."'");

        $act = "Admin Delete Subject Record";
        $q = mysqli_query($conn,"INSERT INTO log values(null,'$date','$act','$id')");
    }

    if($_POST['action'] == "add_subj"){

        if(!empty($_POST['title']) && !empty($_POST['subcode']) && !empty($_POST['credits']) && !empty($_POST['unit'])){

            $title = ucwords($_POST['title']);
            $sub_code = strtoupper($_POST['subcode']);

            $result = mysqli_query($conn,"SELECT * FROM  subject");
            $check = false;
            while($row = mysqli_fetch_assoc($result)){
                if($_POST['subcode'] == $row['code'] && $_POST['title'] == $row['title']){
                    $check = true;
                }
            }if($check){
                $_SESSION['msg']="Subject Already Exist!";
                $_SESSION['status']="error";
            }else{
                $_SESSION['msg']="New Subject Add Successful!";
                $_SESSION['status']="success";
                mysqli_query($conn,"INSERT INTO subject VALUES(null,'".$_POST['recordid']."','$sub_code','$title','".$_POST['course']."','".$_POST['year']."','".$_POST['semester']."','".$_POST['unit']."','".$_POST['credits']."')");
                
                $name = $_POST['subcode'].' '.$title;
                $act = "Admin Assign Subject $name";
                $q = mysqli_query($conn,"INSERT INTO log values(null,'$date','$act','$id')");
            } 
        }
    }

    if($_POST["action"] == "update_subject"){
      
        $uptitle = ucwords($_POST['uptitle']);
        $upsubcode = strtoupper($_POST['upsubcode']);

        mysqli_query($conn,"UPDATE subject SET code='$upsubcode',title='$uptitle',unit='".$_POST['upunit']."',credit='".$_POST['upcredit']."' WHERE id='". $_POST['sub_id']."'");

        $_SESSION['msg']="Update Subject Successful";
        $_SESSION['status']="success";

        $name = $_POST['upsubcode'].' '.$uptitle;
        $act = "Admin Update Subject $name";
        $q = mysqli_query($conn,"INSERT INTO log values(null,'$date','$act','$id')");

    }

    if($_POST["action"] == "delete_subject"){

        mysqli_query($conn, "DELETE FROM subject WHERE id = '".$_POST['subject_id']."'");

        $act = "Admin Delete Subject";
        $q = mysqli_query($conn,"INSERT INTO log values(null,'$date','$act','$id')");
    }
}
?>