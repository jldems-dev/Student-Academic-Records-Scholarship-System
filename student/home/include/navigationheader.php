<?php 
    include_once "../config.php";

    $level = isset($_SESSION['level']) ? $_SESSION['level']: null;
    if($level == null){
        header('location:../index.php');
    }else if($level != 'student'){
        header('location:../'.$level.'');
    }
    $id = $_SESSION['id'];//username ID
    $studid = $_SESSION['studid'];//usedata ID No.

    $myavatar = mysqli_query($conn, "SELECT * FROM userdata WHERE username='$id'");
    $rowavatar = mysqli_fetch_assoc($myavatar);
    $querystud=mysqli_query($conn,"SELECT * FROM student WHERE studid='$id'");
    $row=mysqli_fetch_assoc($querystud);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" name="viewport">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link href="../../fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="../../css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="../../css/adminlte.min.css">
  <link rel="stylesheet" href="../../css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../css/toastr.min.css">
  <link rel="stylesheet" href="../../css/toastr.css">
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="../../css/croppie.css" />
</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item">
        <a href="index.php" class="nav-link">Home</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
      <?php
          $mynotif1 = mysqli_query($conn,"SELECT * FROM notification WHERE studid='".$row['id']."' AND active = 0");
          $mynotif2 = mysqli_query($conn,"SELECT * FROM notification WHERE studid=0 AND active = 0");
          $mynorifrow = mysqli_num_rows($mynotif1);
          $mynorifrow1 = mysqli_num_rows($mynotif2);
      ?>
     <li class="nav-item dropdown">
        <a class="nav-link" href="logs.php"><i class="far fa-bell"></i><span class="badge badge-warning navbar-badge"><?php echo $mynorifrow+$mynorifrow1;?></span></a>
      </li>
      <a href="profile.php" class="navbar-brand pr-3 pl-3">
        <img src="<?php echo $rowavatar['ava_location'];?>" alt="None" class="brand-image img-circle elevation-3" style="width: 30px; height: 30px;">
      </a>
    </ul>
  </nav>

  <aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4 pt-5"  id="background-color">
    <a href="index.php" class="brand-link" id="background-color">
      <img src="img/sageRm-app.png" alt="None" class="brand-image img-circle elevation-3">
      <span class="brand-text font-weight-light" id="text-navbar">SAGeRM-As-APP</span>
    </a>
    <div class="sidebar mt-4">
      <div class="user-panel pb-3 mb-3 d-flex" >
          <div class="image">
            <img src="<?php echo $rowavatar['ava_location'];?>" class="img-circle elevation-2" alt="Empty">
          </div>
          <div class="info" >
            <a href="#" class="d-block" id="text-navbar"><?php echo $_SESSION['name'];?></a>
          </div>
      </div>
        <nav class="mt-2 mb-5" style="height: 50%;"> 
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <div class="card" id="index-color">
              <li class="nav-item my-2">
                <a href="index.php" class="nav-link" id="text-navbar"><i class="fa-solid fa-house-user" style="color: Tomato;"></i><p>&nbsp;&nbsp;Home</p></a>
              </li>
            </div>
            <div class="card"  id="index-color">
              <li class="nav-item my-2">
                <a href="logs.php" class="nav-link" id="text-navbar"><i class="fas fa-bell" style="color: Dodgerblue;"></i><p>&nbsp;&nbsp;Notifications</p></a>
              </li>
            </div>
            <div class="card"  id="index-color" >
              <li class="nav-item my-2">
                <a href="my_sent.php" class="nav-link" id="text-navbar"><i class="fas fa-paper-plane" style="color: orange;"></i><p>&nbsp;&nbsp;Sent</p></a>
              </li>
            </div>
            <div class="card"  id="index-color">
            <li class="nav-item my-2">
              <a href="profile.php" class="nav-link" id="text-navbar"><i class="fas fa-id-badge" style="color: Mediumslateblue;"></i><p>&nbsp;&nbsp;Profile</p></a>
            </li>
            </div>
            <div class="card"  id="index-color">
              <li class="nav-item my-2">
                <a href="settings.php" class="nav-link" id="text-navbar"><i class="fas fa-cog" style="color: yellow;"></i><p>&nbsp;&nbsp;Settings</p></a>
              </li>
            </div>
            <div class="card" id="index-color">
              <li class="nav-item my-2">
                <a href="../logout.php" class="nav-link" id="text-navbar"><i class="fas fa-sign-out-alt " style="color: red;"></i><p>&nbsp;&nbsp;Logout</p></a>
              </li>
            </div>
          </ul>
        </nav>
      </div>
  </aside>
</div>
<?php 
include "include/js.php";
?>