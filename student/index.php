<?php 
include_once "config.php";

$now = time()-30;
$disable = '';

if(isset($_SESSION['attempt_again'])){

	if($now >= $_SESSION['attempt_again']){
		unset($_SESSION['attempt']);
		unset($_SESSION['attempt_again']);
	}
}
if(isset($_SESSION['attempt']) && $_SESSION['attempt'] >= 3 && $_SESSION['attempt'] >= 5){
	$disable = 'disabled';
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
    <div class="content-wrapper login-page" id="card-header1">
      <div class="login-box" id="admin-login-font">
        <div class="circle d-flex justify-content-center pb-4">
          <img src="../img/studenticons.png" alt="Avatar"class="center">
        </div>
        <div class="card-header text-center" >
          <a href="" class="h2" id="text-wshadow"><b>Student Academic Grades Login</b></a>
        </div>
        <div class="card-body">
          <p class="login-box-msg" id="text-wshadow">Login to start your session</p>
          <form action="login.php" method="post" >
            <?php
            if(isset($_SESSION["msg"])){ 
            ?>
                <label class="text-danger"><?= $_SESSION["msg"]; ?></label>&nbsp;
            <?php 
            unset($_SESSION["msg"]);
            }
            ?>
            <div class="input-group mt-3" >
              <input <?php echo $disable; ?>  type="tel"  placeholder="ID Number" class="form-control" name="user" maxlength="9" required>
                    <span class="input-group-text">
                    <i class="far fa-user"></i>
                    </span>
              </div>
            <div class="input-group mt-2">
              <input <?php echo $disable; ?>  type="password" placeholder="Password" class="form-control" name="pass" required>
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
              </div>
            </div>
            <div class="input-group mt-3">
              <button type="submit" <?php echo $disable; ?> class="btn btn-sm btn-block" name ="submit" id="index-color1">LOGIN</button>
            </div>
          </form>
        </div>
        <div class="text-center mt-3">
          <a href="request.php" class=""><span for="remember">Request to Admin</span></a>
        </div>
	  </div>
  </div>
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.bundle.min.js"></script>
  <script src="../js/adminlte.min.js"></script>
</body>
</html>