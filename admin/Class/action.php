<?php

include "../../config.php";

date_default_timezone_set("Asia/Manila");
$date = date("Y-m-d h:i:s A");

$id = $_SESSION['uadminid'];

if($_POST['action']){

    if($_POST["action"] == "gradesheets"){
      
       switch($_POST['name']){
            case "1":
                $result = mysqli_query($conn, "UPDATE gradesheets SET class_standing='".$_POST['value']."' WHERE id='".$_POST['id']."'");
                if($result == true){
                    echo "Class Standing change value to ".$_POST['value']." successfull";
                }
            break;
            case "2":
                $result = mysqli_query($conn, "UPDATE gradesheets SET quizzes='".$_POST['value']."' WHERE id='".$_POST['id']."'");
                if($result == true){
                    echo "Quizzes change value to ".$_POST['value']." successfull";
                }
            break;
            case "3":
                $result = mysqli_query($conn, "UPDATE gradesheets SET practical_exam='".$_POST['value']."' WHERE id='".$_POST['id']."'");
                if($result == true){
                    echo "Practical Exam change value to ".$_POST['value']." successfull";
                }
            break;
            default:
            echo "Input Error!!";
       }
    }

    $act = "Admin Update Grade Sheets";
    $q = mysqli_query($conn,"INSERT INTO log values(null,'$date','$act','$id')");
}

if($_POST["action"] == "edit_class"){

    $classid = $_POST['id'];
    $name = $_POST['name'];
    $value = strtoupper($_POST['value']);

    if($name == "schedule"){

        mysqli_query($conn,"UPDATE class SET schedule='$value' WHERE sub_code='$classid'");
        echo "Update Schedule to $value Successfull";

        $act = "User Schedule Update $classid : $value";
        $q = mysqli_query($conn,"INSERT INTO log values(null,'$date','$act','$id')");
    }else if($name == 'time'){
        mysqli_query($conn,"UPDATE class SET time='$value' WHERE sub_code='$classid'");
        echo "Update Time to $value Successfull";
        $act = "User Time Update $classid : $value";
        $q = mysqli_query($conn,"INSERT INTO log values(null,'$date','$act','$id')");
    }
}
?>