<?php
    include "../config.php";

    date_default_timezone_set("Asia/Manila");
    $date = date("Y-m-d h:i:s A");

    $id = $_SESSION['uadminid']; //admin userdata ID

if($_POST["action"] == "updateadmin"){

    $upfname = ucwords($_POST['fname']);
    $upmname = ucwords($_POST['mname']);
    $uplname = ucwords($_POST['lname']);
    $position = ucwords($_POST['position']);

        $check = mysqli_query($conn,"UPDATE userdata SET fname='$upfname',mname='$upmname', lname='$uplname', status='$position' WHERE id='$id'");

        $_SESSION['msg']="Update Admin Information Successful";
        $_SESSION['status']="success";
        
        $act = "Admin Update Account Information";
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

            $_SESSION['msg']="Update Password Successful";
            $_SESSION['status']="success";

            $act = "Admin Update Account Password";
            $q = mysqli_query($conn,"INSERT INTO log values(null,'$date','$act','$id')");
            
            session_destroy();
        }else{
            $_SESSION['msg']="New Password & Confirm Password dont match!";
            $_SESSION['status']="error";
        }
    }else{
        $_SESSION['msg']="Current Password & New Password dont match!";
        $_SESSION['status']="error";
    }
}

if($_POST["action"] == "reset_pass"){

    $username = md5("admin");
    mysqli_query($conn,"UPDATE userdata SET pass='$username' WHERE id='$id'");

    $act = "Admin reset password";
    $q = mysqli_query($conn,"INSERT INTO log values(null,'$date','$act','$id')");

}
if($_POST["action"] == "view_message"){

    $requestid = $_POST["requestid"];
   
   $message = mysqli_query($conn, "SELECT * FROM request WHERE id='$requestid'");
   $row=mysqli_fetch_assoc($message);
   $update = mysqli_query($conn,"UPDATE request SET status='1' WHERE id='$requestid'");

   $output ='
   <p>
    <b>Student ID#: </b>'.$row['studid'].'<br>
    <b>From: </b>'.$row['student_fullname'].'<br>
    <b>Data & Time: </b>'.$row['date'].'<br>
    <b>Email: </b>'.$row['student_email'].'<br>
    <div class="dropdown-divider"></div>
    ';
    if($row['type'] == 'Account'){
        $output .='<b>Request Message</b><br>
        '.$row['student_request'].'';
    }
    if($row['type'] == 'Grades'){
        $output .='
        <b>Request Message</b><br>
        Final Grades: '.$row['student_request'].'<br>
        Year: '.$row['sy'].'<br>
        Semester: '.$row['semester'].'
        ';
    }
    $output .='
   </p>
   <div class="dropdown-divider mt-5"></div>
   <div class="form-group">
        <button type="submit" class="btn btn-danger btn-sm float-right" data-dismiss="modal"><i class="fas fa-times-circle"></i></button>
        <button type="submit"  name="delete_request" id="delete_request" class="delete_request btn btn-sm btn-danger" data-id="'.$requestid.'"><i class="fas fa-trash-alt"></i> Delete </button>
    </div>
   ';
   echo $output;

   if($row['status'] == 0){
    $studentid = mysqli_query($conn,"SELECT * FROM student WHERE studid='".$row['studid']."'");
    $rowstudid=mysqli_fetch_assoc($studentid);

   mysqli_query($conn,"INSERT INTO notification VALUES(null,'".$rowstudid['id']."','Request','Your Request Have Been Recieve By Admin','','$date','0')");
   }
}
if($_POST["action"] == "delete_request"){

    $requestid = $_POST["requestid"];
   
   $message = mysqli_query($conn, "DELETE FROM request WHERE id='$requestid'");
   echo "success";
}
if($_POST["action"] == "delete_all"){

    $id = $_POST["id"];
   
    if(empty($id)){
            echo "warning";
    }else{

    $array = explode (',', $id);
      foreach($array as $value)
        {
            $newvalue = $value . PHP_EOL;
            $delete_all = mysqli_query($conn, "DELETE FROM request WHERE id='$newvalue'");
            if($delete_all){
                $check=true;
            }
        }
        if($check){
            echo "success";
        }
    } 
}
if($_POST["action"] == "clear"){

    mysqli_query($conn,"DELETE FROM log WHERE userid='$id'");

    $_SESSION['msg'] = "Clear Logs Successful!";
    $_SESSION['status'] = "success";
}
if($_POST["action"] == "add_member"){

    if(!empty($_POST['fname']) && !empty($_POST['mname']) && !empty($_POST['lname'])  && !empty($_POST['status'])){
        $check = mysqli_query($conn,"SELECT * FROM userdata WHERE level='admin'");
        $checkstrue = false;
        while($rowcheck=mysqli_fetch_assoc($check)){
            if($_POST['fname'] == $rowcheck['fname'] && $_POST['lname'] == $rowcheck['lname'] && $_POST['mname'] == $rowcheck['mname']){
                $checkstrue=true;
            }

        }
        if($checkstrue){
            $_SESSION['msg'] = "New Admin Add Already Exist!";
            $_SESSION['status'] = "error";
        }else{
            $_SESSION['msg'] = "New Admin Add Successful!";
            $_SESSION['status'] = "success";

            $password = md5($_POST['fname']);
            $position = ucwords($_POST['status']);
            mysqli_query($conn,"INSERT INTO userdata VALUES(null,'".$_POST['fname']."','$password','".$_POST['fname']."','".$_POST['mname']."','".$_POST['lname']."','admin','$position','profileimages/default.png')");
        }
    }
}
?>