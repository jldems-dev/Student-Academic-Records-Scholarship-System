<?php
	include "../config.php";

	if(isset($_POST['submit'])){

		if(!isset($_SESSION['attempt'])){
			$_SESSION['attempt'] = 0;
		}
		$username = $_POST['user'];
		$password = md5($_POST['pass']);

		$r = mysqli_query($conn,"SELECT * FROM userdata WHERE username='$username'");
		
		if(mysqli_num_rows($r) > 0){
		
			$row = mysqli_fetch_assoc($r);
			if($row['status'] === "Enabled"){
				if($row['level'] == "faculty"){
					if($password === $row['pass']){
						
						$_SESSION['level'] = $row['level'];
						$_SESSION['id'] = $row['id'];
						$_SESSION['username'] = $row['username'];
						$_SESSION['name'] = $row['fname'].' '.$row['mname'].'. '.$row['lname'];

						header('location: home');
					}else{
						$_SESSION['error'] = 'Incorrect Password';

							$_SESSION['attempt1'] += 1;
						if($_SESSION['attempt1'] == 5){
							$_SESSION['attempt_again1'] = time();
							$_SESSION['error'] = "Your Account Permanent Blocked";
							mysqli_query($conn,"UPDATE userdata SET status='Disabled' WHERE username='$username'");
						}
						if($_SESSION['attempt1'] == 3){
							$_SESSION['error'] = "!!Warning!!".PHP_EOL."Five Consecutive Invalid Password Your Account Automatically Disabled..";
						}
					}
				}else{
					$_SESSION['error'] = "Invalid Username or Password!";
				}
			}else{
				$_SESSION['error'] = "Your Account is Disabled!!";
			}
		}else{

			$_SESSION['error'] = "Invalid Username or Password!";
			$_SESSION['attempt'] += 1;
			if($_SESSION['attempt'] == 3){
				$_SESSION['attempt_again'] = time(); 
				$_SESSION['error'] = "Please Wait after 30 sec Due to Consecutive Invalid Username & Password";
			} 
		}
	}
	header('location: index.php');
?>