<?php 
    include "../config.php";

    $level = isset($_SESSION['level']) ? $_SESSION['level']: null;

    if($level == null){
      header('location:../index.php');
      }
      
      $id = $_SESSION['id']; //userdata ID
      $images = mysqli_query($conn, "SELECT * FROM userdata WHERE id='$id'");
      $row1 = mysqli_fetch_array($images);

      $teachinfo = mysqli_query($conn, "SELECT * FROM teacher WHERE teachid='".$row1['username']."'");
      $row = mysqli_fetch_array($teachinfo);
      $newid = $row['id'];//teacher info  ID
      $_SESSION['dbid'] = $newid;//teacher info ID
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <link href='https://fonts.googleapis.com/css?family=Staatliches' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>
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
<body class="hold-transition sidebar-mini layout-fixed" >
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown ">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button"><i class="fas fa-expand-arrows-alt"></i></a>
      </li>
      <li class="nav-item dropdown ">
        <a class="nav-link" data-toggle="dropdown" href="my_profile.php">
        <img src="<?php echo $row1['ava_location']?>" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;">
        &nbsp;<b><?php echo $_SESSION['name']; ?></b> 
        </a>
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
          <a href="settings.php" class="dropdown-item">
          <i class="fas fa-cog"></i> Profile Settings
          </a>
          <div class="dropdown-divider"></div>
          <a href="logs.php" class="dropdown-item">
          <i class="fas fa-bell"></i> Logs
          </a>
          <div class="dropdown-divider"></div>
          <a href="../logout.php" class="dropdown-item">
          <i class="fas fa-sign-out-alt"></i> Logout
          </a>
        </div>
      </li>
    </ul>
  </nav>
  
  <aside class="main-sidebar  sidebar-dark-primary elevation-4 pb-5">
    <a href="../home/index.php" class="brand-link" id="card-header">
      <img src="../../img/sageRm-app.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light" id="text-title">SAGeRM-As-APP</span>
    </a>
    <div  id="faculty-sidebar">
      <div class="sidebar" >
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item my-2">
              <a href="index.php" class="nav-link" id="text-navbar"><img src="../../img/facultyhome.png" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;"><p>&nbsp;&nbsp;Home</p></a>
            </li>
            <li class="nav-item my-2">
              <a href="my_subject.php" class="nav-link" id="text-navbar"><img src="../../img/facultysub.png" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;"><p>&nbsp;&nbsp;My Subject</p></a>
            </li>
            <li class="nav-item my-2">
              <a href="my_student.php" class="nav-link" id="text-navbar"><img src="../../img/facultystud.png" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;"><p>&nbsp;&nbsp;My Student</p></a>
            </li>
            <li class="nav-item my-2">
              <a href="my_profile.php" class="nav-link" id="text-navbar"><img src="../../img/facultyprofile.png" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;"><p>&nbsp;&nbsp;My Profile</p></a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </aside>
</div>
<?php 
include "include/js.php";
?>
