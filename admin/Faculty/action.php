<?php

include "../../config.php";

date_default_timezone_set("Asia/Manila");
$date = date("Y-m-d h:i:s A");

$id = $_SESSION['uadminid']; //admin userdata ID

if($_POST['action'] == "add_faculty")
{
    if(!empty($_POST['fname']) && 
    !empty($_POST['mname']) && 
    !empty($_POST['lname']) && 
    !empty($_POST['status']) && 
    !empty($_POST['email']) && 
    !empty($_POST['gender']) && 
    !empty($_POST['facultyid']) && 
    !empty($_POST['dpment'])){

        $first_name = ucwords($_POST['fname']);
        $middle_name = ucwords($_POST['mname']);
        $last_name = ucwords($_POST['lname']);
        $status = $_POST['status'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $facultyid = $_POST['facultyid'];
        $dpment = ucwords($_POST['dpment']);
        $password = md5($facultyid);

        $result = mysqli_query($conn,"SELECT * FROM teacher");
        $check = false;
        while($row = mysqli_fetch_assoc($result)){

            if($facultyid == $row['teachid']){

                $_SESSION['msg']="Faculty ID Already Exist!";
                $_SESSION['status']="error";
                $check = true;
            }else if($email == $row['email']){

                $_SESSION['msg']="Email Already Exist!";
                $_SESSION['status']="error";
                $check = true;
            }else if($first_name == $row['fname'] && $middle_name == $row['mname'] && $last_name == $row['lname']){
                $check = true;
                $_SESSION['msg']="Facuty New add Already Exist!";
                $_SESSION['status']="error";
            }
        }if($check){

        }else{
                $_SESSION['msg']="New Facuty add Successful & Automatically add Account!";
                $_SESSION['status']="success";

                mysqli_query($conn,"INSERT INTO userdata values(null,'$facultyid', '$password','$first_name','$middle_name','$last_name','faculty','Enabled','profileimages/default.png')");
                mysqli_query($conn,"INSERT INTO teacher values(null,(SELECT id FROM userdata WHERE username='$facultyid'),'$facultyid','$first_name','$middle_name','$last_name','$email','$dpment','$gender','$status','(MTWTHF) 0:00-0:00 AM/PM')"); 

                $name = $first_name.' '.$middle_name.'. '.$last_name;
                $act = "Admin Add New Faculty: $name";
                $q = mysqli_query($conn,"INSERT INTO log values(null,'$date','$act','$id')");
        }
    }
}

    if($_POST["action"] == "add_account"){

        $userdata = mysqli_query($conn,"SELECT * FROM userdata");
        $usecheck = false;
        while($rowuserdata = mysqli_fetch_assoc($userdata)){

            if($_POST['faculty_id'] == $rowuserdata['username']){
                
                $usecheck = true;
            }
        }
        if($usecheck){

            $_SESSION['msg']="Facuty Account Already Exist!";
            $_SESSION['status']="error";

        }else{
            $password = md5($_POST['faculty_id']);
            mysqli_query($conn,"INSERT INTO userdata values('".$_POST['dbid']."','".$_POST['faculty_id']."', '$password','".$_POST['fname']."','".$_POST['mname']."','".$_POST['lname']."','faculty','Enabled','profileimages/default.png')");
            
            $_SESSION['msg']="Add Facuty Account Successful!";
            $_SESSION['status']="success";
        }

    }

    if($_POST["action"] == "change"){
        
        $id = $_POST['teach_id'];
        $upstudid = $_POST['upteachid'];
        $upfname = ucwords($_POST['upfname']);
        $upmname = ucwords($_POST['upmname']);
        $uplname = ucwords($_POST['uplname']);
        $updpment = ucwords($_POST['updpment']);
        $upgender = $_POST['upgender'];
        $upemail = $_POST['upemail'];
        $upstatus = $_POST['upstatus'];

        mysqli_query($conn,"UPDATE teacher SET teachid='$upstudid',fname='$upfname',mname='$upmname',lname='$uplname',email='$upemail',department='$updpment',gender='$upgender',status='$upstatus' WHERE id='$id'");
        
        $_SESSION['msg']="Update Faculty Successful!";
        $_SESSION['status']="success";

        $name = $upfname.' '.$upmname.'. '.$uplname;
        $act = "Admin Update Faculty: $name";
        $q = mysqli_query($conn,"INSERT INTO log values(null,'$date','$act','$id')"); 
    }  

    if($_POST["action"] == "delete"){

        $teacher_id = $_POST["teacher_id"];
        $teacherschid = $_POST["teacherschid"];

        mysqli_query($conn, "DELETE FROM teacher WHERE id = '$teacher_id'");
        mysqli_query($conn, "DELETE FROM userdata WHERE username = '$teacherschid'");

        $act = "Admin Delete Faculty & User Account Faculty ID#: $teacherschid";
        $q = mysqli_query($conn,"INSERT INTO log values(null,'$date','$act','$id')");
    }
    if($_POST["action"] == "add_subjects"){

        
       $facultyid = $_POST["facultyid"];
        $idn = $_POST["id"]; 

        if(empty($idn)){
            echo "warning";
        }else{
            
            $array = explode (',', $idn);

            foreach($array as $value)
            {
                $newvalue = $value . PHP_EOL;

                $checkfacultysubject = mysqli_query($conn, "SELECT * FROM class WHERE teachid='$facultyid' AND subid='$newvalue'");

                if($rowfacultysubject=mysqli_num_rows($checkfacultysubject) > 0){
                    $checlassingsub = true;
                }else{
                    $checlassingsub = false;
                    $fetchsubjectcode = mysqli_query($conn,"SELECT * FROM subject WHERE id='$newvalue'");
                    while($rowfetch = mysqli_fetch_assoc($fetchsubjectcode)){
                        $assignsubjects = mysqli_query($conn,"INSERT INTO class (id,sub_code, subid,teachid,schedule,time) VALUES(null,'".$rowfetch['code']."','$newvalue','$facultyid','../../../','0:00-0:00')");

                        $term = array('Prelim','Midterm','Prefinal','Final');

                        foreach($term as $termvalue){
                            $newterm = $termvalue.PHP_EOL;
                            $newterm = trim($newterm); 
                            mysqli_query($conn,"INSERT INTO teachergradesheets (subid,teachid,term) VALUES('$newvalue','$facultyid','$newterm')");
                            mysqli_query($conn,"INSERT INTO teachertoggole (subid,teachid,pt1,pt2,pt3,pt4,pt5,quiz1,quiz2,quiz3,quiz4,quiz5,term) VALUES('$newvalue','$facultyid','collapse1','collapse','collapse','collapse','collapse','collapse1','collapse','collapse','collapse','collapse','$newterm')");
                            mysqli_query($conn,"INSERT INTO teacher_label (subid,teachid,term) VALUES('$newvalue','$facultyid','$newterm')");
                        }
                    }
                }
            }
            if($checlassingsub){
                echo "error";
            }else{
                echo "success";
            }
        }
    }

    if($_POST["action"] == "delete_faculty_subject"){
        mysqli_query($conn, "DELETE FROM class WHERE subid='".$_POST["subjectid"]."' AND teachid='".$_POST["facultyid"]."'");
        mysqli_query($conn, "DELETE FROM teachergradesheets WHERE subid='".$_POST["subjectid"]."' AND teachid='".$_POST["facultyid"]."'");
        mysqli_query($conn, "DELETE FROM teachertoggole WHERE subid='".$_POST["subjectid"]."' AND teachid='".$_POST["facultyid"]."'");
        mysqli_query($conn, "DELETE FROM teacher_label WHERE subid='".$_POST["subjectid"]."' AND teachid='".$_POST["facultyid"]."'");
    }
?>