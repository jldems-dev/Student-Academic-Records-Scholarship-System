<?php 
    include_once "../config.php";

    $level = isset($_SESSION['level']) ? $_SESSION['level']: null;
    if($level == null){
        header('location:../index.php');
    }

    $id = $_SESSION['id']; //userdata ID

    /* Announcement */
    $announcement = mysqli_query($conn, "SELECT * FROM sch_ancmt order by date DESC");
    /* Announcement */
     /* scholarship Program */
    $schprogram = mysqli_query($conn, "SELECT * FROM sch_program order by title ASC");
    /* scholarship Program */
    $querylog = mysqli_query($conn, "SELECT * FROM log WHERE userid='$id' ORDER BY date DESC");
    /* student */
    $masterlist = mysqli_query($conn, "SELECT * FROM student");
     /* student */
    $userinfo = mysqli_query($conn, "SELECT * FROM userdata WHERE id='$id'");
    $rowinfo = mysqli_fetch_array($userinfo);
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
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button"><i class="fas fa-expand-arrows-alt"></i></a>
      </li>
        <?php 
        $notifcount =mysqli_query($conn,"SELECT * FROM sch_notif WHERE status='0'");
        $rowcount=mysqli_num_rows($notifcount);
        ?>
      <li class="nav-item">
        <a class="nav-link" href="notification.php"><i class="fas fa-bell"></i><span class="badge badge-warning navbar-badge"><?php echo $rowcount;?></span>
        </a>
      </li>
      <li class="nav-item dropdown ">
        <a class="nav-link" data-toggle="dropdown" href="#">
        <img src="<?php echo $rowinfo['ava_location'];?>" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;"> 
        &nbsp;<b><?php echo $_SESSION['name'];?></b>  
        </a>
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
          <a href="profile.php" class="dropdown-item">
          <i class="fas fa-id-badge"></i> Account Profile
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
  <aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4 pb-5" id="card-header">
    <a href="../home/index.php" class="brand-link">
      <img src="../../img/sageRm-app.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"  id="text-title"><b>SAGeRM-As-APP</b></span>
    </a>
    <div  id="sch-sidebar">
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item my-2">
            <a href="index.php" class="nav-link" id="text-navbar"><img src="../../img/facultyhome.png" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;"><p> Home</p></a>
          </li>
          <li class="nav-item my-2">
            <a href="#" class="nav-link" id="text-navbar"><img src="../../img/schinfo.png" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;"><p> Scholarship Info. <i class="right fas fa-angle-left"></i></p></a>
            <ul class="nav nav-treeview ml-2 ">
                <li class="nav-item d-flex align-items-center">
                  <a href="scholarinfo.php" class="nav-link" id="text-navbar">
                    <p class="ml-2"><img src="../../img/schnme.png" alt="Logo" class="brand-image img-circle elevation-3" style="width: 25px;"> Scholarship Program</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="announcement.php" class="nav-link" id="text-navbar">
                    <p class="ml-2"><img src="../../img/sdannounce.png" alt="Logo" class="brand-image img-circle elevation-3" style="width: 25px;"> Announcement</p>
                  </a>
                </li>
            </ul>
          </li>
          <li class="nav-item my-2">
            <a href="student_list.php" class="nav-link" id="text-navbar"><img src="../../img/facultystud.png" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;"><p> Student List</p></a>
          </li>
          <li class="nav-item my-2">
            <a href="documentfiles.php" class="nav-link" id="text-navbar"><img src="../../img/schdocu.png" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;"><p> Student Documents</p></a>
          </li>
        </ul>
      </nav>
    </div>
    <p class="brand-link d-flex align-items-center">
      <img src="<?php echo $rowinfo['ava_location']?>" alt="Logo" class="brand-image img-circle elevation-3" style="width: 30px;">
      <span class="brand-text"><b><?php echo $rowinfo['lname'];?></b><br><small><?php echo $rowinfo['status'];?></small></span>
    </p>
    </div>
  </aside>
</div>
<?php 
include "include/js.php";
?>