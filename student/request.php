<?php 
include "config.php";

if(isset($_POST['submit'])){

  $email = $_POST['email'];
  $name = $_POST['name'];
  $studid = $_POST['studid'];
  $message = $_POST['message'];

  $request = mysqli_query($conn,"SELECT * FROM request WHERE studid='$studid'");
  $rowrequest = mysqli_fetch_assoc($request);

    if($rowrequest['type'] == 'Account'){
      $_SESSION['msg'] = "Invalid!! Only One Per Account!";
    }else{
      $studentinfo = mysqli_query($conn, "SELECT * FROM student WHERE studid='$studid'");
      $check1 = false;
      while($rowstudinfo=mysqli_fetch_assoc($studentinfo)){
        
        if($rowstudinfo['studid'] == $studid){
          $check1 = true;
          $id = $rowstudinfo['id'];
        }
      }
       if($check1){
        date_default_timezone_set("Asia/Manila");
        $date = date("Y-m-d h:i:s A");
        mysqli_query($conn,"INSERT INTO request VALUES(null,'$id','Account','$studid','$name','$message','','','$email','$date','0')");
        $_SESSION['msg'] = "Submit Request Successful!";
      }else{
        $_SESSION['msg'] = "Invalid Student ID No.!";
      } 
    }
}
?>
<!DOCTYPE html>
<html lang= "en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href = "../css/bootsrap5/bootstrap.min.css">
	<link rel="stylesheet" href="../css/all.min.css">
	<link rel="stylesheet" href="../css/adminlte.min.css">
	<link rel="stylesheet" href="../css/style.css">

</head>
<body class="hold-transition login-page" id="index-color">
<div class="login-box">
  <div class="login-logo">
    <a href="request.php"><b>Account Request Form</b></a>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
        <?php
        if(isset($_SESSION["msg"])){ 
        ?>
            <label class="text-danger"><?= $_SESSION["msg"]; ?></label>&nbsp;
        <?php 
        unset($_SESSION["msg"]);
        }
        ?>
      <form action="request.php" method="post">
        <div class="form-group mb-3">
            <label for="inputName">School Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" required>
        </div>
        <div class="form-group mb-3">
          <label for="inputName">Name</label>
          <input type="name" class="form-control" name="name" id="name" placeholder="Enter Name" required>
        </div>
        <div class="form-group mb-3">
          <label for="inputName">School ID Number</label>
          <input type="tel" class="form-control" maxlength="9" name="studid" id="studid" placeholder="xx-xxxx-x" required> 
        </div>
        <div class="form-group">
          <label for="inputMessage">Concern Message</label>
          <textarea id="inputMessage" class="form-control" rows="4" name="message" id="message" maxlength="90" required></textarea>
        </div>
        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fas fa-paper-plane"></i> Submit</button>
            <button type="submit" onclick="location.href='index.php'" class="btn btn-primary btn-sm"><i class="fas fa-sign-in-alt"></i> Login Form</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php

?>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="../js/adminlte.min.js"></script>
</body>
</html>