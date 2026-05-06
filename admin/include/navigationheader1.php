<?php 
    include_once "../../config.php";
    $level = isset($_SESSION['level']) ? $_SESSION['level']: null;
    
    if($level == null){
        header('location:../index.php');
    }else if($level != 'admin'){
        header('location:../'.$level.'');
    }

    $images = mysqli_query($conn, "SELECT * FROM userdata WHERE username='$level'");
    $row = mysqli_fetch_array($images);

    $id = $row['id']; //Userdata Admin ID
    $_SESSION['uadminid'] = $id;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <link href='https://fonts.googleapis.com/css?family=Staatliches' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>
  <link href='https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css' rel='stylesheet'>
  <link href="../../fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="../../css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="../../css/adminlte.min.css">
  <link rel="stylesheet" href="../../css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../css/bootstrap-4.min.css">
  <link rel="stylesheet" href="../../css/toastr.min.css">
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="../../css/croppie.css" />
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li  class="nav-item dropdown" >
        <a class="nav-link" data-widget="fullscreen" href="#" role="button"><i class="fas fa-expand-arrows-alt"></i></a>
      </li>
      <li class="nav-item dropdown ">
        <a class="nav-link" href="../request.php"><i class="fas fa-envelope-open-text elevation-3"></i><span class="badge badge-warning navbar-badge">
        <?php
              $request=mysqli_query($conn,"SELECT * FROM request WHERE status='0'");
              $row1=mysqli_num_rows($request);
              echo $row1;
          ?>
        </span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <img src="../<?php echo $row['ava_location']?>" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;"> 
          &nbsp;<?php echo $_SESSION['name'];?> 
        </a>
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
          <a href="../profile.php" class="dropdown-item">
          <i class="fas fa-id-badge"></i> Account Profile
          </a>
          <div class="dropdown-divider"></div>
          <a href="../logs.php" class="dropdown-item">
          <i class="fas fa-bell"></i> Logs
          </a>
          <div class="dropdown-divider"></div>
          <a href="../../logout.php" class="dropdown-item">
          <i class="fas fa-sign-out-alt"></i> Logout
          </a>
        </div>
      </li>
    </ul>
  </nav>
  
  <aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4 pb-5" id="card-header">
    <a href="../../admin/index.php" class="brand-link">
      <img src="../../img/sageRm-app.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light" id="text-title"><b>SAGeRM-As-APP</b> </span>
    </a>
   
    <div id="admin-sidebar">
      <div class="sidebar">
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item my-2">
              <a href="../index.php" class="nav-link" id="arrow-back"><img src="../../img/facultyhome.png" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;"><p>&nbsp;&nbsp;Home</p></a>
            </li>
            <li class="nav-item my-2">
              <a href="../Class/index.php" class="nav-link" id="arrow-back"><img src="../../img/class.png" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;"><p>&nbsp;&nbsp;Class</p></a>
            </li>
            <li class="nav-item my-2">
              <a href="../Faculty/index.php" class="nav-link" id="arrow-back"><img src="../../img/teacher.png" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;"><p>&nbsp;&nbsp;Faculty</p></a>
            </li>
            <li class="nav-item my-2">
              <a href="../Students/index.php" class="nav-link" id="arrow-back"><img src="../../img/facultystud.png" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;"><p>&nbsp;&nbsp;Student</p></a>
            </li>
            <li class="nav-item my-2">
              <a href="../Subjects/index.php" class="nav-link" id="arrow-back"><img src="../../img/facultysub.png" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;"><p>&nbsp;&nbsp;Subject</p></a>
            </li>
            <li class="nav-item my-2">
              <a href="../Courses/index.php" class="nav-link" id="arrow-back"><img src="../../img/course.png" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;"><p>&nbsp;&nbsp;Course</p></a>
            </li>
            <li class="nav-item my-2">
              <a href="../Department/index.php" class="nav-link" id="arrow-back"><img src="../../img/department.png" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;"><p>&nbsp;&nbsp;Department</p></a>
            </li>
            <li class="nav-item my-2">
              <a href="../User/index.php" class="nav-link" id="arrow-back"><img src="../../img/user-account.png" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;"><p>&nbsp;&nbsp;Manage User Account</p></a>
            </li>
          </ul>
        </nav>
      </div>
      <a class="brand-link d-flex align-items-center">
        <img src="../<?php echo $row['ava_location']?>" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;">
        <span class="brand-text"><b><?php echo $_SESSION['page'];?></b><br><small><?php echo $row['status'];?></small></span>
      </a>
    </div>
  </aside>
</div>
<?php 
include "../include/js1.php";
?>