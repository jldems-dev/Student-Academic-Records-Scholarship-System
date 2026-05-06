<?php
    include "../../config.php";

    date_default_timezone_set("Asia/Manila");
    $date = date("Y-m-d h:i:s A");

    $id = $_SESSION['uadminid']; //admin userdata ID

if($_POST["action"]){

    if($_POST["action"] == "add_student"){

        if(!empty($_POST['studid']) &&
        !empty($_POST['fname']) && 
        !empty($_POST['mname']) && 
        !empty($_POST['lname']) && 
        !empty($_POST['course']) && 
        !empty($_POST['section']) && 
        !empty($_POST['year']) && 
        !empty($_POST['gender']) && 
        !empty($_POST['email']))
        {
            $studid = $_POST['studid'];
            $first_name = ucwords($_POST['fname']);
            $middle_name = ucwords($_POST['mname']);
            $last_name = ucwords($_POST['lname']);
            $course = ucwords($_POST['course']);
            $section = ucwords($_POST['section']);
            $year = $_POST['year'];
            $gender = $_POST['gender'];
            $email = $_POST['email'];
            $password = md5($studid);
            
            $result = mysqli_query($conn,"SELECT * FROM  student");
            $checkadd = false; 
            while($checkexist = mysqli_fetch_assoc($result)){

                if($studid == $checkexist['studid']){
                    $checkadd = true;
                    $_SESSION['msg']="Student ID# Already Exist!";
                    $_SESSION['status']="error";
                }
                else if($email == $checkexist['email']){
                    $checkadd = true;
                    $_SESSION['msg']="Student Email Already Exist!";
                    $_SESSION['status']="error";
                }
                else if($first_name == $checkexist['fname'] && $middle_name == $checkexist['mname'] && $last_name == $checkexist['lname']){
                    $checkadd = true;
                    $_SESSION['msg']="Student New Add Already Exist!";
                    $_SESSION['status']="error";
                }
            }if($checkadd){
               
                }else{
                    $_SESSION['msg']="New Student Add Successful & Automatically Add Account!";
                    $_SESSION['status']="success";

                mysqli_query($conn,"INSERT INTO userdata values(null,'$studid','$password','$first_name','$middle_name','$last_name','student','Enabled','profileimages/default.png')");
                mysqli_query($conn,"INSERT INTO student values(null,(SELECT id FROM userdata WHERE username='$studid'),'$studid','$first_name','$middle_name','$last_name','$course','$year','$section','$gender','$email')");
    
                $name = $first_name.' '.$middle_name.'. '.$last_name;
                $act = "Admin Add New Student: $name";
                $q = mysqli_query($conn,"INSERT INTO log values(null,'$date','$act','$id')");
            }
        }
    }

    if($_POST["action"] == "add_account"){

        $userdata = mysqli_query($conn,"SELECT * FROM userdata WHERE level='student'");

        $usecheck = false;
        while($rowuserdata = mysqli_fetch_assoc($userdata)){

            if($_POST['stud_id'] == $rowuserdata['username']){
                
                $usecheck = true;
            }
        }
        if($usecheck){

            $_SESSION['msg']="Student Account Already Exist!";
            $_SESSION['status']="error";

        }else{
            $password = md5($_POST['stud_id']);
            mysqli_query($conn,"INSERT INTO userdata values('".$_POST['dbid']."','".$_POST['stud_id']."', '$password','".$_POST['fname']."','".$_POST['mname']."','".$_POST['lname']."','student','Enabled','profileimages/default.png')");
            
            $_SESSION['msg']="Add Student Account Successful!";
            $_SESSION['status']="success";
        }

    }

    if($_POST["action"] == "change"){
      
        $upstudid = $_POST['upstudid'];
        $upfname = ucwords($_POST['upfname']);
        $upmname = ucwords($_POST['upmname']);
        $uplname = ucwords($_POST['uplname']);
        $upcourse = $_POST['upcourse'];
        $upyear = $_POST['upyear'];
        $upemail = $_POST['upemail'];
        $upgender = $_POST['upgender'];
        $upsection = $_POST['upsection'];

       mysqli_query($conn,"UPDATE student SET studid='$upstudid',fname='$upfname',mname='$upmname',lname='$uplname',course='$upcourse',year='$upyear',gender='$upgender',email='$upemail',section='$upsection' WHERE id='".$_POST['stud_id']."'");
    
        $_SESSION['msg']="Update Student Successful";
        $_SESSION['status']="success";

        $name = $upfname.' '.$upmname.'. '.$uplname;
        $act = "Admin Update Student: $name";
        $q = mysqli_query($conn,"INSERT INTO log values(null,'$date','$act','$id')");
    }

    if($_POST["action"] == "delete"){

        $query1 = mysqli_query($conn,"SELECT * FROM student WHERE id = '".$_POST['id']."'");
        $row2 = mysqli_fetch_assoc($query1);

        mysqli_query($conn, "DELETE FROM student WHERE id = '".$_POST['id']."'");
        mysqli_query($conn, "DELETE FROM userdata WHERE username = '".$_POST['stud_id']."'");
           
        $name = $row2['fname']." ".$row2['mname'].". ".$row2['lname'];
        $act = "Admin Delete Student $name & Account";
        $q = mysqli_query($conn,"INSERT INTO log values(null,'$date','$act','$id')");
    }

    if($_POST['action'] == "add_stud_record"){

        if(!empty($_POST['sy']) && !empty($_POST['year']) && !empty($_POST['sem'])){

            $checkrecord = mysqli_query($conn, "SELECT * FROM student_record WHERE studid='".$_POST['studid']."'");
            while($rowrecord = mysqli_fetch_assoc($checkrecord)){

                if($_POST['sem'] == $rowrecord['sem'] && $_POST['sy'] == $rowrecord['sy'] && $_POST['year'] == $rowrecord['stud_year']){
                    $check = true;
                }
            }
            if($check){
                $_SESSION['msg']= $_POST['year']." ".$_POST['sem']." ".$_POST['sy']." Academic Grades Record of Student Already Exist";
                $_SESSION['status']="error";
            }else{
                mysqli_query($conn,"INSERT INTO student_record VALUES(null,'".$_POST['year']."','".$_POST['sem']."','".$_POST['sy']."','".$_POST['studid']."','unrelease')");
                $_SESSION['msg']="New Academic Grades Record of Student Add Successfully!";
                $_SESSION['status']="success";

                $act = "Admin Add Student Grades Record ";
                $q = mysqli_query($conn,"INSERT INTO log values(null,'$date','$act','$id')");
            }
        }
    }

    if($_POST['action'] == "uprecord"){

        $checkrecord = mysqli_query($conn, "SELECT * FROM student_record WHERE studid='".$_POST['studid']."'");
        while($rowrecord = mysqli_fetch_assoc($checkrecord)){

            if($_POST['upsem'] == $rowrecord['sem'] && $_POST['upsy'] == $rowrecord['sy'] && $_POST['upyear'] == $rowrecord['stud_year']){
               $check = true;
            }
        }
        if($check){
            $_SESSION['msg']= $_POST['upsem']." ".$_POST['upsy']." Academic Grades Record of Student Already Exist";
            $_SESSION['status']="error";
        }else{
            mysqli_query($conn,"UPDATE student_record SET stud_year='".$_POST['upyear']."', sem='".$_POST['upsem']."',sy='".$_POST['upsy']."' WHERE id='".$_POST['recordid']."'");
            $_SESSION['msg']="Update Academic Grades Record of Student Successfully!";
            $_SESSION['status']="success";
        }
    }

    if($_POST["action"] == "deleterecord"){

        $recordid = $_POST["recordid"];

        $student_subjects = mysqli_query($conn, "SELECT * FROM student_subjects WHERE stud_recordid='$recordid'");
        mysqli_query($conn, "DELETE FROM student_record WHERE id = '$recordid'");
        while($rowstudsub = mysqli_fetch_assoc($student_subjects)){
            mysqli_query($conn, "DELETE FROM student_subjects WHERE studid = '".$rowstudsub['studid']."' AND stud_recordid='$recordid'");
            mysqli_query($conn, "DELETE FROM student_prelim WHERE studid = '".$rowstudsub['studid']."' AND subid='".$rowstudsub['subid']."'");
            mysqli_query($conn, "DELETE FROM student_midterm WHERE studid = '".$rowstudsub['studid']."' AND subid='".$rowstudsub['subid']."'");
            mysqli_query($conn, "DELETE FROM student_prefinal WHERE studid = '".$rowstudsub['studid']."' AND subid='".$rowstudsub['subid']."'");
            mysqli_query($conn, "DELETE FROM student_final WHERE studid = '".$rowstudsub['studid']."' AND subid='".$rowstudsub['subid']."'");
        }
    }

    if($_POST["action"] == "add_subjects"){

        $studentid = $_POST["studentid"];
        $idn = $_POST["id"];
        $sy = $_POST["sy"];
        $sem = $_POST["sem"];

        if(empty($idn)){
            $_SESSION['msg']= " Checked the Box if you want to Assign Subjects";
            $_SESSION['status']="error";
        }else{
            
            $array = explode (',', $idn);

            foreach($array as $value)
            {
                $newvalue = $value . PHP_EOL;

                $check = mysqli_query($conn,"SELECT * FROM student_subjects WHERE studid='$studentid' AND subid='$newvalue'");
                
                if($rowcount = mysqli_num_rows($check) > 0){
                    $check1 = true;
                }else{
                    $check1 = false;
                $assignsubjects = mysqli_query($conn,"INSERT INTO student_subjects (id,studid,stud_recordid,subid,sem,sy) VALUES(null,'$studentid','".$_POST["recordid"]."','$newvalue','$sem','$sy')");
                mysqli_query($conn , "INSERT INTO student_prelim (studid, subid,sy) VALUES ('$studentid','$newvalue','$sy')");
                mysqli_query($conn , "INSERT INTO student_midterm (studid, subid,sy) VALUES ('$studentid','$newvalue','$sy')");
                mysqli_query($conn , "INSERT INTO student_prefinal (studid, subid,sy) VALUES ('$studentid','$newvalue','$sy')");
                mysqli_query($conn , "INSERT INTO student_final (studid, subid,sy) VALUES ('$studentid','$newvalue','$sy')");
                }
            }
            if($check1){
                $_SESSION['msg']= " Subject Already Assigned to the Student";
                $_SESSION['status']="error";
            }else{
                $_SESSION['msg']= "Subject Assigned Successful to the Student";
                $_SESSION['status']="success";
            }
        }
    }

    if($_POST["action"] == "deletesubject"){

        $subjectid = $_POST["subjectid"];
        $studid = $_POST["studid"];

        mysqli_query($conn, "DELETE FROM student_subjects WHERE studid = '$studid' AND subid='$subjectid'");
        mysqli_query($conn, "DELETE FROM student_prelim WHERE studid = '$studid' AND subid='$subjectid'");
        mysqli_query($conn, "DELETE FROM student_midterm WHERE studid = '$studid' AND subid='$subjectid'");
        mysqli_query($conn, "DELETE FROM student_prefinal WHERE studid = '$studid' AND subid='$subjectid'");
        mysqli_query($conn, "DELETE FROM student_final WHERE studid = '$studid' AND subid='$subjectid'");

    }

    if($_POST["action"] == "release_student"){

        if($_POST['average'] < 75){
            echo "warning";
        }else{
            echo "success";
            mysqli_query($conn,"UPDATE student_record SET status='release' WHERE id='".$_POST['recordid']."'");
        }
    }
}
?>