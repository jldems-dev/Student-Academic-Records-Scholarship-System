<?php

include "../../config.php";

if($_POST['action']){

    if($_POST["action"] == "add_column_pt"){
        $togglept=mysqli_query($conn,"SELECT * FROM teachertoggole WHERE teachid='".$_POST['id']."'");
        while($rowtog=mysqli_fetch_assoc($togglept)){

            if($_POST['toggle'] == $rowtog['pt2']){
                
                $update = mysqli_query($conn,"UPDATE teachertoggole SET pt2='collapse1' WHERE teachid='".$_POST['id']."' AND subid='".$_POST['subid']."' AND term='".$_POST['term']."'");
            }else if($_POST['toggle'] == $rowtog['pt3']){
                
                $update = mysqli_query($conn,"UPDATE teachertoggole SET pt3='collapse1' WHERE teachid='".$_POST['id']."' AND subid='".$_POST['subid']."' AND term='".$_POST['term']."'");
            }else if($_POST['toggle'] == $rowtog['pt4']){
                
                $update = mysqli_query($conn,"UPDATE teachertoggole SET pt4='collapse1' WHERE teachid='".$_POST['id']."' AND subid='".$_POST['subid']."' AND term='".$_POST['term']."'");
            }else if($_POST['toggle'] == $rowtog['pt5']){
                $update = mysqli_query($conn,"UPDATE teachertoggole SET pt5='collapse1' WHERE teachid='".$_POST['id']."' AND subid='".$_POST['subid']."' AND term='".$_POST['term']."'");
            }
        }
    }

    if($_POST["action"] == "add_column_quiz"){
        $togglept=mysqli_query($conn,"SELECT * FROM teachertoggole WHERE teachid='".$_POST['id']."'");
        while($rowtog=mysqli_fetch_assoc($togglept)){

        if($_POST['toggle'] == $rowtog['quiz2']){
            
            $update = mysqli_query($conn,"UPDATE teachertoggole SET quiz2='collapse1' WHERE teachid='".$_POST['id']."' AND subid='".$_POST['subid']."' AND term='".$_POST['term']."'");
        }else if($_POST['toggle'] == $rowtog['quiz3']){
            
            $update = mysqli_query($conn,"UPDATE teachertoggole SET quiz3='collapse1' WHERE teachid='".$_POST['id']."' AND subid='".$_POST['subid']."' AND term='".$_POST['term']."'");
        }else if($_POST['toggle'] == $rowtog['quiz4']){
            
            $update = mysqli_query($conn,"UPDATE teachertoggole SET quiz4='collapse1' WHERE teachid='".$_POST['id']."' AND subid='".$_POST['subid']."' AND term='".$_POST['term']."'");
        }else if($_POST['toggle'] == $rowtog['quiz5']){
            
            $update = mysqli_query($conn,"UPDATE teachertoggole SET quiz5='collapse1' WHERE teachid='".$_POST['id']."' AND subid='".$_POST['subid']."' AND term='".$_POST['term']."'");
        }
    }
    }
}
?>