<?php
include('../../config.php');

if($_POST["action"]){

    if($_POST["action"] == "reset_pass"){

        $user_id = $_POST["user_id"];
        $username = md5($_POST["username"]);

        mysqli_query($conn,"UPDATE userdata SET pass='$username' WHERE id='$user_id'");

        $query = mysqli_query($conn,"SELECT * FROM userdata WHERE id = '$user_id'"); 
        $row = mysqli_fetch_assoc($query);
        $fname = $row['fname'];
        $lname = $row['lname'];
        $act = "Student $fname $lname reset password";
        $date = date('m-d-Y h:i:s A');
        $q = mysqli_query($conn,"INSERT INTO log values(null,'$date','$act')");

    }
    if($_POST["action"] == "delete"){

        $user_id = $_POST["user_id"];
        mysqli_query($conn, "DELETE FROM userdata WHERE id = '$user_id'");

        $query1 = mysqli_query($conn,"SELECT * FROM userdata WHERE id = '$user_id'");
        $row2 = mysqli_fetch_assoc($query1);
        
        $fname = $row2['fname'];
        $lname = $row2['lname'];
        $act = "Deleted User $fname $lname";
        $date = date('m-d-Y h:i:s A');
        $q = mysqli_query($conn,"INSERT INTO log values(null,'$date','$act')");

    }
    if($_POST["action"] == "status"){

        $user_id = $_POST["user_id"];
        $status = $_POST["status"];

        if($status == "Enabled"){

            $check = mysqli_query($conn,"UPDATE userdata SET status='Enabled' WHERE id='$user_id'");
            if($check){
                echo "Enabled Student Successful";
            }
        }
        if($status == "Disabled"){
            $check = mysqli_query($conn,"UPDATE userdata SET status='Disabled' WHERE id='$user_id'");
            if($check){
               echo "Disabled Student Successful";
            }
        }


    }
}   
?>