<?php

include "../config.php";

date_default_timezone_set("Asia/Manila");

$dbid = $_SESSION['dbid']; //teacher information ID
$id = $_SESSION['id']; //userdata ID

$date = date("Y-m-d h:i:s A");

if($_POST["action"] == "updateuser"){
    
    $upmname = ucwords($_POST['mname']);
    $upfname = ucwords($_POST['fname']);
    $uplname = ucwords($_POST['lname']);

    mysqli_query($conn,"UPDATE userdata SET fname='$upfname',mname='$upmname',lname='$uplname' WHERE id='$id'");

    $_SESSION['msg'] = "Update User Account Information Successfully";
    $_SESSION['status'] = "success";

    $act = "User Account Information Update";
    $q = mysqli_query($conn,"INSERT INTO log values(null,'$date','$act','$id')");

}

if($_POST["action"] == "updatepass"){
        
    $currentPassword =  md5($_POST['currentPassword']);
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    $query = mysqli_query($conn, "SELECT * From userdata WHERE id='$id'");
    $row = mysqli_fetch_array($query);
    $db_password = $row ['pass'];
    if($db_password == $currentPassword){
        if($newPassword == $confirmPassword){
           $update_password=mysqli_query($conn,"UPDATE userdata SET pass= md5('$newPassword') WHERE id='$id'");
            $_SESSION['msg'] = "Update Password Sucessful!";
            $_SESSION['status'] = "success";

            $act = "User Account Password Update";
            $q = mysqli_query($conn,"INSERT INTO log values(null,'$date','$act','$id')");
        }else{
            $_SESSION['msg'] = "New Password & Confirm Password dont match!";
            $_SESSION['status'] = "error";
        }
    }else{
        $_SESSION['msg'] = "Current Password & New Password dont match!";
            $_SESSION['status'] = "error";
    }
}
if($_POST["action"] == "update_constime"){

    $teachid = $_POST['id'];
    $value = $_POST['value'];

    mysqli_query($conn,"UPDATE teacher SET consultation_time='$value' WHERE id='$teachid'");

    echo "Update Consultation Time to $value";

    $act = "User Consultation Time Update : $value";
    $q = mysqli_query($conn,"INSERT INTO log values(null,'$date','$act','$id')");
   
}

if($_POST["action"] == "clear"){

    mysqli_query($conn,"DELETE FROM log WHERE userid='$id'");

    $_SESSION['msg'] = "Clear Logs Successful!";
    $_SESSION['status'] = "success";

}


if($_POST["action"] == "view_allspreed"){

    $fetchdata = mysqli_query($conn,"SELECT * FROM student_subjects WHERE subid='".$_POST['subjectid']."'");


    $output = '<div class="table-responsive pt-3 p-0">
    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th>'.$_POST['subjeccode'].'</th>
                <th>Class Standing 40%</th>
                <th>Quizzes 20%</th>
                <th>P.E 40%</th>
                <th>Computation</th>
            </tr>
        </thead>
        <tbody>';
    while ($row111 = mysqli_fetch_assoc($fetchdata)) {

        print_r($row111['studid']);
      $studentlist = mysqli_query($conn,"SELECT * FROM student WHERE id='".$row111['studid']."'");
      while ($row11=mysqli_fetch_assoc($studentlist)) {

        $gradesheet=mysqli_query($conn,"SELECT * FROM student_prelim WHERE studid='".$row11['id']."' AND subid='".$_POST['subjectid']."'");
        
        $output = '
                                <tr>
                                    <td>
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th>Student Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <td>'.$row11['lname'].' '.$row11['mname'].'. '.$row11['fname'].'</td>
                                        </tbody>
                                    </table>
                                    </td>
                                    <td>
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th>Assignment 5%</th>
                                                <th>Recitation 10%</th>
                                                <th>Output 25%</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    </td>
                                    <td>
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th>Quizzes 20%</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    </td>
                                    <td>
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th>Written Exam</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    </td>
                                    <td>
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th>A</th>
                                                <th>R</th>
                                                <th>O</th>
                                                <th>Q</th>
                                                <th>W</th>
                                                <th>Prelim</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    </td>
                                </tr>';
                  
      }
      echo $output;
    }
    $output ='      </tbody>
                </table>
            </div>';

    echo $output;

}
?>