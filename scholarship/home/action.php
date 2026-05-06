<?php
include "../config.php";

    $id = $_SESSION['id'];

    date_default_timezone_set("Asia/Manila");
    $date = date("Y-m-d h:i:s A");

    if($_POST["action"] == "add_program"){

        if(!empty($_POST['title'])){

            $checkexst = mysqli_query($conn,"SELECT * FROM sch_program WHERE title='".$_POST['title']."'");
            $checkt=false;
            while($rowexst = mysqli_fetch_assoc($checkexst)){

                if($_POST['title'] == $rowexst['title']){
                    $_SESSION['msg'] = $_POST['title']." Scholarship Title Program Already Exist!";
                    $_SESSION['status'] = "error";
                    $checkt=true;
                }
            }if($checkt == false){
                mysqli_query($conn, "INSERT INTO sch_program values(null,'".$_POST['title']."')");
                                    
                $_SESSION['msg'] = "Add New Scholarship Program Successfully!";
                $_SESSION['status'] = "success";
            }
        }
    }

    if($_POST["action"] == "add_sch"){

        if(!empty($_POST['name']) && !empty($_POST['link']) && !empty($_POST['rqments']) 
        && !empty($_POST['qlfcation']) && !empty($_POST['sy'])){

            $schname = mysqli_query($conn,"SELECT * FROM sch_name");
            $checksch=false;
            while($rowschname = mysqli_fetch_assoc($schname)){

                if($rowschname['name'] == $_POST['name']){
                    $_SESSION['msg'] = $_POST['name']." Scholarship Already Exist!";
                    $_SESSION['status'] = "error";
                    $checksch=true;
                }
            }if($checksch == false){
                $link = mysqli_real_escape_string($conn,$_POST['link']);
                $rqments = mysqli_real_escape_string($conn,$_POST['rqments']);
                $qlfcation = mysqli_real_escape_string($conn,$_POST['qlfcation']);
                 mysqli_query($conn, "INSERT INTO sch_name values(null,'".$_POST['id']."','".$_POST['name']."','$link','$rqments','$qlfcation','".$_POST['sy']."','Unavailable')");

                $_SESSION['msg'] = "Add New Scholarship Successful!";
                $_SESSION['status'] = "success";
            }
        }
    }

    if($_POST["action"] == "add_announcement"){
        
        $title = mysqli_real_escape_string($conn,$_POST['title']);
        $message = mysqli_real_escape_string($conn,$_POST['message']);
        $link = mysqli_real_escape_string($conn,$_POST['link']);

     if(!empty($_POST['title']) && !empty($_POST['message']) && !empty($_POST['link'])){

            mysqli_query($conn, "INSERT INTO sch_ancmt values(null,'$title','$message','$link','$date')");
        
            $_SESSION['msg'] = "Add New Announcement Successful!";
            $_SESSION['status'] = "success";
    
            $act = "Scholarship Admin Add Announcement";
            $q = mysqli_query($conn,"INSERT INTO log values(null,'$date','$act','$id')");
            
            $studentlist=mysqli_query($conn, "SELECT * FROM student");
            while($rowstudent = mysqli_fetch_assoc($studentlist)){
                mysqli_query($conn,"INSERT INTO notification values(null,'".$rowstudent['id']."','Announcement','New Announcement Posted','','$date','')");
            }
        }
    }

    if($_POST["action"] == "chng_sch_info"){

        $upstudid = $_POST['userid'];
        $upfname = ucwords($_POST['fname']);
        $upmname = ucwords($_POST['mname']);
        $uplname = ucwords($_POST['lname']);
        $position = ucwords($_POST['position']);

        mysqli_query($conn,"UPDATE userdata SET username='$upstudid',fname='$upfname',mname='$upmname',lname='$uplname',status='$position' WHERE id='$id'");

        $_SESSION['msg']="Update Information Successful!";
        $_SESSION['status']="success";

        $act = "Scholarship Admin Update Account Information";
        mysqli_query($conn,"INSERT INTO log values(null,'$date','$act','$id')");
    }

    if($_POST["action"] == "update_schinfo"){

        mysqli_query($conn,"UPDATE sch_name SET 
        name='".$_POST['name']."',
        link='".$_POST['link']."',
        requirements='".$_POST['rqments']."',
        qualification='".$_POST['qlfcation']."',
        sy='".$_POST['sy']."',
        status='".$_POST['apform']."' WHERE id='".$_POST['id']."'");

        if($_POST['apform'] == 'Available'){
            $studentlist=mysqli_query($conn, "SELECT * FROM student");
            while($rowstudent = mysqli_fetch_assoc($studentlist)){
            mysqli_query($conn,"INSERT INTO notification values(null,'".$rowstudent['id']."','Scholarship','Application Form of ".$_POST['name']." is Available','','$date','0')");
            }
        }
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
               
                $_SESSION['msg']="Update Password Sucessful!";
                $_SESSION['status']="success";

                $act = "Scholarship Admin Update Account Password";
                $q = mysqli_query($conn,"INSERT INTO log values(null,'$date','$act','$id')");
            }else{
              
                $_SESSION['msg']="New Password & Confirm Password Dont Match!";
                $_SESSION['status']="error";
            }
        }else{
          
            $_SESSION['msg']="Current Password & New Password Dont Match!";
            $_SESSION['status']="error";
        }
    }

    if($_POST["action"] == "reset_pass"){

        $id = $_POST["user_id"];
        $username = md5($_POST["username"]);
    
        mysqli_query($conn,"UPDATE userdata SET pass='$username' WHERE id='$id'");
    
        $act = "Scholarship Admin reset password";
        $q = mysqli_query($conn,"INSERT INTO log values(null,'$date','$act','$id')");
    
    }

    if($_POST["action"] == "clear"){

        $check = mysqli_query($conn,"DELETE FROM log WHERE userid='$id'");
        if($check){
            $_SESSION['msg']="Clear Logs Successful!";
            $_SESSION['status']="success";
        }
    }
    if($_POST["action"] == "delete"){

        $program_id = $_POST['program_id'];
        $check = mysqli_query($conn, "DELETE FROM sch_program WHERE id='$program_id'");
        $check = mysqli_query($conn, "DELETE FROM sch_name WHERE scholarprogram_id='$program_id'");
        if($check){
            echo "Scholarship Program Deleted Successfully!";

        $act = "Scholarship Admin Delete Scholarship Program";
        $q = mysqli_query($conn,"INSERT INTO log values(null,'$date','$act','$id')");
        }
    }
    if($_POST["action"] == "delete_scholar"){

        $program_id = $_POST['program_id'];
        $check = mysqli_query($conn, "DELETE FROM sch_name WHERE id='$program_id'");
        if($check){
            echo "Scholarship Deleted Successfully!";

        $act = " Admin delete Scholarship";
        $q = mysqli_query($conn,"INSERT INTO log values(null,'$date','$act','$id')");

        }
    }
    if($_POST["action"] == "ancmt_delete"){

        $ancmt_id = $_POST['ancmt_id'];

        $query = mysqli_query($conn,"SELECT * FROM ancmt_images WHERE ancmt_id='$ancmt_id'");
        while($rowancmt=mysqli_fetch_assoc($query)){
            unlink($rowancmt["image_path"]);
        }

        mysqli_query($conn, "DELETE FROM sch_ancmt WHERE id='$ancmt_id'");
        mysqli_query($conn, "DELETE FROM ancmt_images WHERE ancmt_id='$ancmt_id'");
       
    }
    if($_POST["action"] == "img_delete"){

        $img_id = $_POST['img_id'];
        $img_path = $_POST['img_path'];

        mysqli_query($conn, "DELETE FROM sch_ancmtimg WHERE id='$img_id'");
        unlink($img_path);
    }

    if($_POST["action"]=="view_ancmt&image"){

        $ancmt_id = $_POST['ancmt_id'];

        $display = mysqli_query($conn, "SELECT * FROM sch_ancmt WHERE id='$ancmt_id'");
        $row=mysqli_fetch_assoc($display);
        

        $output ='

        <div class="col-md-6 pt-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" value="'.$row['title'].'" disabled>
        </div>
        <div class="col-md-12 pt-3">
          <label for="inputMessage">Message</label>
          <textarea class="form-control" rows="6" disabled>'.$row['message'].'</textarea>
        </div>
        <div class="col-md-6 pt-3">
            <label class="form-label">Link</label>
            <input type="text" class="form-control"  value="'.$row['link'].'" disabled>
        </div>
        <div class="col-md-6 pt-3">
            <label class="form-label">Date</label>
            <input type="text" class="form-control" value="'.$row['date'].'"   disabled>
        </div>
        <div class="col-md-6 pt-3">
          <label for="exampleInputFile">Images</label>
        </div>
        
    
      ';
      echo $output;

      $images =mysqli_query($conn,"SELECT * FROM sch_ancmtimg WHERE ancmt_id='$ancmt_id' ");

      $display='<div class="container"> 
      <div class="row">';
        while($rowimg = mysqli_fetch_assoc($images)){

            $output1='
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">'.$rowimg['file_name'].'</h3>
                                    <div class="card-tools">
                                        <button type="button" class="delete_image btn btn-tool" data-id="'.$rowimg['id'].'" data-lnk="'.$rowimg['image_path'].'" data-card-widget="remove"><i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body text-center">
                                    <img src="'.$rowimg['image_path'].'" alt="Unknown" class="gallery" width="253" height="200" style="border: 3px solid light;">
                                </div>
                            </div>
                        </div>
            ';
            echo $output1;
        }
        $display='   </div>
        </div>';
        echo $display;
    }

    if($_POST["action"] == "view_studfiles"){

        $stud_id = $_POST["stud_id"];

        $studinfo = mysqli_query($conn, "SELECT * FROM student WHERE id='$stud_id'");
        $rowinfo = mysqli_fetch_assoc($studinfo);
        $viewfilesinfo = mysqli_query($conn, "SELECT * FROM sch_files WHERE studid='$stud_id'");
        $rowfilesinfo=mysqli_fetch_assoc($viewfilesinfo);

        $output ='
        <div class="row">
            <div class="col-md-6 pt-3">
                <label class="form-label">Sender</label>
                <input type="text" class="form-control" value="'.$rowinfo['fname'].' '.$rowinfo['mname'].'. '.$rowinfo['lname'].'" disabled>
            </div>
            <div class="col-md-6 pt-3">
            <label for="inputMessage">Course</label>
            <input type="text"  class="form-control" value="'.$rowinfo['course'].'" disabled>
            </div>
            <div class="col-md-6 pt-3">
                <label class="form-label">Year & Section</label>
                <input type="text" class="form-control"  value="'.$rowinfo['year'].'-'.$rowinfo['section'].'" disabled>
            </div>
            <div class="col-md-6 pt-3">
                <label class="form-label">Scholarship</label>
                <input type="text" class="form-control"  value="'.$rowfilesinfo['sch_name'].'" disabled>
            </div>
            <div class="col-md-12 pt-3">
            <label for="exampleInputFile"><i class="far fa-file-alt"></i> Files</label>
            </div>
        </div>
      ';
      echo $output;
        $queryviewfiles = mysqli_query($conn, "SELECT * FROM sch_files WHERE studid='$stud_id' ORDER BY date DESC");

        $display='<div class="row col-12">';
        while($rowviewfiles=mysqli_fetch_assoc($queryviewfiles)){

            $output ='
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                        <i class="far fa-calendar-alt"></i> <label class="form-label">'.$rowviewfiles['date'].'</label>
                        </div>
                        <div class="card-body">
                        <a href="../../student/home/'.$rowviewfiles['file_path'].'"><i class="far fa-file-alt"></i> '.$rowviewfiles['file_name'].'</a>
                        </div>
                    </div>
                </div>
            ';
          echo $output;
        }
        $display='</div>';

        echo $display;
    }
    if($_POST["action"] == "assign_student_sent"){

        if(empty($_POST['id'])){
            echo "warning";
        }else{
            $array = explode (',', $_POST['id']);

            foreach($array as $value)
            {
                $newvalue = $value . PHP_EOL;
                $checkstudent = mysqli_query($conn,"SELECT * FROM sch_selectstudents WHERE studid='$newvalue'");
                if($rowvalue=mysqli_num_rows($checkstudent) > 0){
                    echo "success";
                    $insertstudent = mysqli_query($conn,"UPDATE sch_selectstudents SET status='1' WHERE studid='$newvalue'");
                }else{
                    echo "success";
                    $insertstudent = mysqli_query($conn,"INSERT INTO sch_selectstudents VALUE(null,'$newvalue','sent','1')");
                }
            }
        }
    }
    if($_POST["action"] == "unassign_student_sent"){

        if(empty($_POST['id'])){
            echo "warning";
        }else{
            $array = explode (',', $_POST['id']);

            foreach($array as $value)
            {
                $newvalue = $value . PHP_EOL;

                $insertstudent = mysqli_query($conn,"UPDATE sch_selectstudents SET status='0' WHERE studid='$newvalue'");
                $status=false;
                if($insertstudent){
                    $status = true;
                }

            }if($status){
                echo "success";
            }
        }
    }

    if($_POST["action"] == "delete_studfiles"){
        $studfiles = mysqli_query($conn,"UPDATE sch_files SET status='1' WHERE studid='".$_POST['stud_id']."'");
        $_SESSION['msg']="Delete Student Files Sucessful!";
        $_SESSION['status']="success";
    }

    if($_POST["action"] == "delete_notification"){

        if(empty( $_POST['id'])){
            echo "warning";
        }else{

        $array = explode (',',  $_POST['id']);
        foreach($array as $value)
            {
                $newvalue = $value . PHP_EOL;
                $deletenotif = mysqli_query($conn,"DELETE FROM sch_notif WHERE id='$newvalue'");
                if($deletenotif){
                    $check=true;
                }
            }
            if($check){
                echo "success";
            }
        } 
    }

    if($_POST["action"] == "view_notification"){

        $notifinfo = mysqli_query($conn,"SELECT * FROM sch_notif WHERE id='".$_POST['notifid']."'");
        $rownotif = mysqli_fetch_assoc($notifinfo);
        echo $rownotif['title'];
        $viewnotif = mysqli_query($conn,"UPDATE sch_notif SET status='1' WHERE id='".$_POST['notifid']."'");
    }

    if($_POST["action"] == "assign_student_sch"){
       
         if(empty($_POST['id'])){
            $_SESSION['msg']= " Checked the Box if you want to Assign Student";
            $_SESSION['status']="error";
        }else{
            $array = explode (',', $_POST['id']);

            foreach($array as $value)
            {
                $newvalue = $value . PHP_EOL;
                $checkstudent = mysqli_query($conn,"SELECT * FROM schname_studlist WHERE studid='$newvalue'");
                if($rowvalue=mysqli_num_rows($checkstudent) > 0){
                    $suc = true;
                    $insertstudent = mysqli_query($conn,"UPDATE schname_studlist SET status='1' WHERE studid='$newvalue'");
                }else{
                    $suc = false;
                    $insertstudent = mysqli_query($conn,"INSERT INTO schname_studlist VALUE(null,'$newvalue','".$_POST['schname_id']."','".$_POST['schprog_id']."','1')");
                }
            }if($suc){
                $_SESSION['msg']= " Student Already Assigned";
                $_SESSION['status']="error";
            }else{
                $_SESSION['msg']= "Student Assigned Successful";
                $_SESSION['status']="success";
            }
        }
    }

    if($_POST["action"] == "delete_schname_stud"){
      
      if(empty($_POST['id'])){

            $_SESSION['msg']= " Checked the Box if you want to Delete Student";
            $_SESSION['status']="error";

        }else{
            $array = explode (',', $_POST['id']);
            $suc1 = false;
            foreach($array as $value)
            {
                $newvalue = $value . PHP_EOL;
                $check = mysqli_query($conn, "DELETE FROM schname_studlist WHERE id='$newvalue'");
                $suc1 = true;
            }if($suc1){
                $_SESSION['msg']= " Student Delete Successful!";
                $_SESSION['status']="success";
            }
        }
    }
?>
