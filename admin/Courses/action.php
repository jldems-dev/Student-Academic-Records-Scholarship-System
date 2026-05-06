<?php

include "../../config.php";

date_default_timezone_set("Asia/Manila");
$date = date("Y-m-d h:i:s A");

$id = $_SESSION['uadminid']; //admin userdata ID

if($_POST['action']){

    if($_POST['action'] == "add_course"){

        if(!empty($_POST['course']) && !empty($_POST['fullcourse'])){

            $course = strtoupper($_POST['course']);
            $fullcourse = ucwords($_POST['fullcourse']);

            $result = mysqli_query($conn,"SELECT * FROM  course");
            $check=false;
            while($row = mysqli_fetch_assoc($result)){

                if($course == $row['course_name']){
                    $check=true;
                   
                }else if($fullcourse == $row['full_course_name']){
                    $check=true;
                }
            }
            if($check){
                $_SESSION['msg']="Course Add Already Exist!";
                $_SESSION['status']="error";
            }else{
                mysqli_query($conn,"INSERT INTO course values(null,'$course','$fullcourse')");
    
                $_SESSION['msg']="New Course Add Successful!";
                $_SESSION['status']="success";
    
                $name = $course.'-'.$fullcourse;
                $act = "Admin Add New Course: $name";
                $q = mysqli_query($conn,"INSERT INTO log values(null,'$date','$act','$id')");
            }
        }
    }

    if($_POST["action"] == "change"){
      
        $course_id = $_POST['course_id'];
        $upcourse = strtoupper($_POST['upcourse']);
        $upfullcourse = ucwords($_POST['upfullcourse']);

        $check = mysqli_query($conn,"UPDATE course SET course_name='$upcourse',full_course_name='$upfullcourse' WHERE id='$course_id'");

        if($check == true){

            $_SESSION['msg']="Update Course Successful!";
            $_SESSION['status']="success";

            $name = $upcourse.' - '.$upfullcourse;

            $act = "Admin Update Course: $name";
            $q = mysqli_query($conn,"INSERT INTO log values(null,'$date','$act','$id')");

        }else{
            $_SESSION['msg']="Update Course Unsuccessful!";
            $_SESSION['status']="success";
        }
    }

   if($_POST["action"] == "delete"){

        $course_id = $_POST["course_id"];

        $query1 = mysqli_query($conn,"SELECT * FROM course WHERE id = '$course_id'");
        $row2 = mysqli_fetch_assoc($query1);

        mysqli_query($conn, "DELETE FROM course WHERE id = '$course_id'");


        $name = $row2['course_name'].' - '.$row2['full_course_name'];
        $act = "Admin Delete Course: $name";
        $q = mysqli_query($conn,"INSERT INTO log values(null,'$date','$act','$id')");
    }
}
?>