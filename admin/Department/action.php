<?php
include "../../config.php";

date_default_timezone_set("Asia/Manila");
$date = date("Y-m-d h:i:s A");

$id = $_SESSION['uadminid']; //admin userdata ID

if($_POST['action']){

    if($_POST['action'] == "add_dpment"){

        $dpment = strtoupper($_POST['dpment']);
        $dp_dscrption = ucwords($_POST['dp_dscrption']);

        $result = mysqli_query($conn,"SELECT * FROM  department");
        $check = false;
        while($row=mysqli_fetch_assoc($result)){

            if($dpment == $row['dp_name']){
                $check1 = true;
             }else if($dp_dscrption == $row['dp_description']){
                $check1 = true;
             }
        }
        if($check1){
            $_SESSION['msg']="Department Add Alreadt Exist!";
            $_SESSION['status']="error";
        }else{
            mysqli_query($conn,"INSERT INTO department values(null,'$dpment','$dp_dscrption','')");
     
            $_SESSION['msg']="New Department Add Successful!";
            $_SESSION['status']="success";
            
            $name = $dpment.'-'.$dp_dscrption;
            $act = "Admin Add New Department: $name";
            $q = mysqli_query($conn,"INSERT INTO log values(null,'$date','$act','$id')");
        }
    }

    if($_POST["action"] == "update_dpment"){
      
        $dpment_id = $_POST['dpment_id'];
        $updpment = strtoupper($_POST['updpment']);
        $updp_dscrption = ucwords($_POST['updp_dscrption']);

        $result = mysqli_query($conn,"SELECT * FROM  department");
        $check = false;
        while($row=mysqli_fetch_assoc($result)){

            if($dpment == $row['dp_name']){
                $check = true;
             }else if($dp_dscrption == $row['dp_description']){
                $check = true;
             }
        }
        if($check){

            $_SESSION['msg']="Department Add Alreadt Exist!";
            $_SESSION['status']="error";

        }else{

            mysqli_query($conn,"UPDATE department SET dp_name='$updpment', dp_description='$updp_dscrption' WHERE id='$dpment_id'");
           
            $_SESSION['msg']="Update Department Successful!";
            $_SESSION['status']="success";

            $name = $updpment.' - '.$updp_dscrption;
            $act = "Admin Update Department: $name";
            $q = mysqli_query($conn,"INSERT INTO log values(null,'$date','$act','$id')");
        }
    }

   if($_POST["action"] == "delete_dp"){

        mysqli_query($conn, "DELETE FROM department WHERE id = '".$_POST["dpid"]."'");
        unlink($_POST['lgpth']);

        $query1 = mysqli_query($conn,"SELECT * FROM department WHERE id = '".$_POST["dpid"]."'");
        $row2 = mysqli_fetch_assoc($query1);

        $name = $row2['dp_name'].' - '.$row2['dp_description'];
        $act = "Admin Delete Department: $name";
        $q = mysqli_query($conn,"INSERT INTO log values(null,'$date','$act','$id')");
    }
}
?>