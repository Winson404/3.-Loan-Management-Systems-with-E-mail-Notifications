<?php 

	include 'config.php';
	session_start();

	if(isset($_POST['verify_code'])) {
		$code = $_POST['code'];

		$update = mysqli_query($conn, "UPDATE users SET verified='1' WHERE vkey='$code'");
		if($update) {
				$_SESSION['success']  = "You have successfully verified your email. Please login.";
	            header("Location: login_member.php");
		} else {
				$_SESSION['result'] = 'Incorrect verification code. Please try again'.$mail->ErrorInfo;
				header("Location: verify_email.php");
		}
	}

?>