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
				if($row['level'] == "student"){
					if($password === $row['pass']){
						
						$_SESSION['level'] = $row['level'];
						$_SESSION['id'] = $row['username'];
						$_SESSION['studid'] = $row['id'];
						$_SESSION['name'] = $row['fname'].' '.$row['lname'];

						header('location: home');
					}else{
						$_SESSION['msg'] = 'Incorrect Password';
						$_SESSION['attempt'] +=1;
						if($_SESSION['attempt'] == 5){
							$_SESSION['attempt_again'] = time();
							$_SESSION['msg'] = "Your Account Permanent Blocked";
							mysqli_query($conn,"UPDATE userdata SET status='Disabled' WHERE username='$username'");
						}
					}
				
				}else{
					$_SESSION['msg'] = "Invalid Username or Password!";
				}
			}else{
				$_SESSION['msg'] = "Your Account is Disabled!!";
			}
		}else{

			$_SESSION['msg'] = "Invalid Username or Password!";
			$_SESSION['attempt'] += 1;
			if($_SESSION['attempt'] == 3){
				$_SESSION['attempt_again'] = time(); 
				$_SESSION['msg'] = "Input field blocked. Please reload after 30 sec";
			} 
		}
	}
	header('location: index.php');
?>