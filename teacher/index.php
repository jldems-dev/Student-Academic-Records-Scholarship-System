<?php 
include "config.php";
$now = time()-30;
$disable = '';

if(isset($_SESSION['attempt_again'])){

	if($now >= $_SESSION['attempt_again']){
		unset($_SESSION['attempt']);
		unset($_SESSION['attempt_again']);
	}
}
if(isset($_SESSION['attempt']) && $_SESSION['attempt'] >= 3){
	$disable = 'disabled';
}
$disableall = '';
if(isset($_SESSION['attempt_again1'])){

	if($now >= $_SESSION['attempt_again1']){
		unset($_SESSION['attempt1']);
		unset($_SESSION['attempt_again1']);
	}
}
if(isset($_SESSION['attempt1']) && $_SESSION['attempt1'] >= 5){

	echo "<script>alert('Your account has permanent blocked based on your ID number. Due to multiple inputs please contact administrator to enabled your account thank you!');</script>";
	$disableall = 'disabled';
}
if(isset($_SESSION['level'])){
	header('location: home');
}
?>
<!DOCTYPE html>
<html lang= "en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href='https://fonts.googleapis.com/css?family=Staatliches' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>
  <link href="../fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href = "../css/bootsrap5/bootstrap.min.css">
	<link rel="stylesheet" href="../css/all.min.css">
	<link rel="stylesheet" href="../css/adminlte.min.css">
	<link rel="stylesheet" href="../css/style.css">

</head>
<body class="hold-transition layout-top-nav" >
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
        <a href="" class="navbar-brand">
          <img src="../img/sageRm-app.png" alt="Logo" class="brand-image img-circle elevation-3">
          <span class="brand-text font-weight-light"><b> Student Academic E-record Manager with Android Support Application</b></span>
        </a>
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <ul class="navbar-nav float-right ml-auto pr-4">
            <li class="nav-item dropdown">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fas fa-sign-in-alt"></i> Login Type</a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                  <li><a href="../index.php" class="dropdown-item"><img src="../img/admin.png" witdh="32px" height="32px"> Admin</a></li>
                  <li><a href="../teacher/index.php" class="dropdown-item"><img src="../img/faculty.png" witdh="32px" height="32px"> Faculty Login</a></li>
                  <li><a href="../scholarship/index.php" class="dropdown-item"><img src="../img/scholarshipicon.png" witdh="32px" height="32px"> Scholarship Office Login</a></li>
                  <li><a href="../student/index.php" class="dropdown-item"><img src="../img/studenticons.png" witdh="32px" height="32px">Student Login</a></li>
              </ul>
            </li>
          </ul>
        </div>
    </nav>
    <div class="content-wrapper login-page" id="faculty-background">
      <div class="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <div class="login-box" >
                <div class="circle d-flex justify-content-center pb-4">
                  <img src="../img/faculty.png" alt="Avatar" class="center">
                </div>
                <div class="card" id="admin-card">
                  <div class="card-header text-center" id="text-wshadow">
                    <a href="index.php" class="h3" id="admin-login-font"><b>Faculty Login</b></a>
                  </div>
                  <div class="card-body">
                  <p class="login-box-msg" id="text-wshadow">Login to start your session</p>
                    <form action="login.php" method="post">
                      <?php 
                      if(isset($_SESSION['error'])){
                      ?>
                        <label class="text-danger"><?= $_SESSION["error"]; ?></label>&nbsp;
                      <?php
                      unset($_SESSION['error']);
                      }
                      ?>
                      <?php
                      if(isset($_SESSION["login"])){ 
                      ?>
                          <label class="text-danger"><?= $_SESSION["login"]; ?></label>&nbsp;
                      <?php 
                      unset($_SESSION["login"]);
                      }
                      ?>
                      <div class="input-group mb-3">
                        <input <?php echo $disableall; ?> type="tel"  placeholder="ID number" class="form-control" maxlength="11" name="user" id="user" required>
                        <span class="input-group-text" id="basic-addon1" style="color: orange;"><i class="fas fa-user"></i></span>
                      </div>
                      
                      <div class="input-group mb-3">
                        <input <?php echo $disableall; ?> type="password" placeholder="Password" class="form-control" name="pass" id="pass" required>
                        <span class="input-group-text" id="basic-addon1" style="color: green;"><i class="fas fa-lock"></i></span>
                      </div>
                      <div class="input-group mb-3">
                        <button type="submit" class="btn btn-secondary btn-sm elevation-3" <?php echo $disable; ?> <?php echo $disableall; ?> name ="submit"><i class="fas fa-sign-in-alt"></i> LOGIN </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.bundle.min.js"></script>
  <script src="../js/adminlte.min.js"></script>
</body>
</html>