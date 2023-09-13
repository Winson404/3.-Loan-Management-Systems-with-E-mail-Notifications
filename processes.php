<?php 
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'vendor/PHPMailer/src/Exception.php';
	require 'vendor/PHPMailer/src/PHPMailer.php';
	require 'vendor/PHPMailer/src/SMTP.php';

	session_start();
	include 'config.php';

	// ADMIN / EMPLOYER LOGIN
	if(isset($_POST['employer_login'])) {
		$email    = $_POST['email'];
		$password = md5($_POST['password']);

		$check = mysqli_query($conn, "SELECT * FROM employees WHERE email='$email' AND password='$password' AND user_type=1");

		if(mysqli_num_rows($check)===1) {

			$row = mysqli_fetch_array($check);
			if($row['email'] === $email && $row['password'] === $password) {
				$_SESSION['admin_id'] = $row['emp_Id'];
				header("Location: Admin/dashboard.php");
			} else {
        	    $_SESSION['message'] = "Password is incorrect. Please try again.";
			    $_SESSION['text'] = "Please try again.";
			    $_SESSION['status'] = "error";
				header("Location: login.php?page=employee");
			}
		} else {
			$_SESSION['message'] = "Password is incorrect. Please try again.";
		    $_SESSION['text'] = "Please try again.";
		    $_SESSION['status'] = "error";
			header("Location: login.php?page=employee");
         }
	}




	// MEMBER / USER LOGIN
	if(isset($_POST['member_login'])) {
		$email    = $_POST['email'];
		$password = md5($_POST['password']);

		$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$password' AND verified=1");

		if(mysqli_num_rows($check)===1) {

			$row = mysqli_fetch_array($check);
			if($row['email'] === $email && $row['password'] === $password) {
				$_SESSION['user_id'] = $row['user_Id'];
				header("Location: Member/dashboard.php");
			} else {

				$update = mysqli_query($conn, "UPDATE users SET users_status=1 WHERE email='$email'");
				if($update) {
					$_SESSION['message'] = "Password is incorrect. Please try again.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: login.php?page=member");
				} else {
					$_SESSION['message'] = "Password is incorrect. Please try again.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: login.php?page=member");
				}
			}
			
		} else {
				$_SESSION['message'] = "Password is incorrect. Please try again.";
			    $_SESSION['text'] = "Please try again.";
			    $_SESSION['status'] = "error";
				header("Location: login.php?page=member");
         }
	}	







	// MEMBER REGISTRATION
	if(isset($_POST['register_member'])) {

		$firstname       = $_POST['firstname'];
		$middlename      = $_POST['middlename'];
		$lastname        = $_POST['lastname'];
		$suffix          = $_POST['suffix'];
		$gender          = $_POST['gender'];
		$dob             = $_POST['dob'];
		$age             = $_POST['age'];
		$address         = $_POST['address'];
		$email           = $_POST['email'];
		$contact         = $_POST['contact'];
		$password        = md5($_POST['password']);
		$cpassword       = md5($_POST['cpassword']);
		$date_registered = date('Y-m-d');
		$key             = uniqid();
		$file            = basename($_FILES["fileToUpload"]["name"]);


		$check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
		if(mysqli_num_rows($check_email)===1) {
			$_SESSION['message']  = "Email is already taken.";
		    $_SESSION['text'] = "Please try again.";
		    $_SESSION['status'] = "error";
			header("Location: register_member.php");
		} else {

			if($password != $cpassword) {
				$_SESSION['message']  = "Password does not matched.";
			    $_SESSION['text'] = "Please try again.";
			    $_SESSION['status'] = "error";
				header("Location: register_member.php");
			} else {

				  // Check if image file is a actual image or fake image
		          $target_dir = "images-member/";
		          $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		          $uploadOk = 1;
		          $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        

                  // Allow certain file formats
                  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                  	$_SESSION['message']  = "Only JPG, JPEG, PNG & GIF files are allowed.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: register_member.php");
                  	$uploadOk = 0;
                  }

                  // Check if $uploadOk is set to 0 by an error
                  elseif ($uploadOk == 0) {
                  	$_SESSION['message']  = "Your file was not uploaded.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: register_member.php");
                  // if everything is ok, try to upload file
                  } else {

                      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                     	
                      	$save = mysqli_query($conn, "INSERT INTO users (firstname, middlename, lastname, suffix, gender, dob, age, address, email, contact, password, image, date_registered, vkey) VALUES ('$firstname', '$middlename', '$lastname', '$suffix', '$gender', '$dob', '$age', '$address', '$email', '$contact', '$password', '$file','$date_registered', '$key')");

                            if($save) {

                            	$email_to_send = $email;
							    $subject = 'Email verification';
							    $message = '<h3>Congratulations!</h3>
								<p>Good day sir/maam '.$firstname.', thank you for your registration. Please verify your email.</p>
								<h4>Your verification code:<b> '.$key.'</b></h4>
								<a href="http://localhost/PROJECT%205.%20Loan%20Management%20Systems%20with%20E-mail%20Notifications/verify_email.php?code='.$key.'">Click here to verify</a>';
						    	// $message = 'Please verify your email.';

                            	$mail = new PHPMailer(true);                            
							    try {
							        //Server settings
							        $mail->isSMTP();                                     
							        $mail->Host = 'smtp.gmail.com';                      
							        $mail->SMTPAuth = true;                             
							        $mail->Username = 'goodsamaritan2k20@gmail.com';     
							        $mail->Password = 'duxkxivrezeuguqe';             
							        $mail->SMTPOptions = array(
							            'ssl' => array(
							            'verify_peer' => false,
							            'verify_peer_name' => false,
							            'allow_self_signed' => true
							            )
							        );                         
							        $mail->SMTPSecure = 'ssl';                           
							        $mail->Port = 465;                                   

							        //Send Email
							        $mail->setFrom('goodsamaritan2k20@gmail.com');
							        
							        //Recipients
							        $mail->addAddress($email);              
							        $mail->addReplyTo('goodsamaritan2k20@gmail.com');
							        
							        //Content
							        $mail->isHTML(true);                                  
							        $mail->Subject = $subject;
							        $mail->Body    = $message;

							        $mail->send();
									
							      	$_SESSION['message']  = "Registration successful. Please verify your email.";
								    $_SESSION['text'] = "Registration successful";
								    $_SESSION['status'] = "success";
									header("Location: verify_register_member.php");


								    } catch (Exception $e) {
									    $_SESSION['message'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
									    $_SESSION['text'] = "Please try again.";
									    $_SESSION['status'] = "error";
										header("Location: register_member.php");
								    }

                            } else {
                                $_SESSION['message'] = "Something went wrong while saving your information.";
							    $_SESSION['text'] = "Please try again.";
							    $_SESSION['status'] = "error";
								header("Location: register_member.php");
                            }
                      } else {
                            $_SESSION['message'] = "There was an error uploading your file.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: register_member.php");
                      }
			}

		}

	}
}






// EMPLOYER REGISTRATION
	if(isset($_POST['register_employer'])) {

		$firstname       = $_POST['firstname'];
		$middlename      = $_POST['middlename'];
		$lastname        = $_POST['lastname'];
		$suffix          = $_POST['suffix'];
		$gender          = $_POST['gender'];
		$dob             = $_POST['dob'];
		$age             = $_POST['age'];
		$address         = $_POST['address'];
		$email           = $_POST['email'];
		$contact         = $_POST['contact'];
		$password        = md5($_POST['password']);
		$cpassword       = md5($_POST['cpassword']);
		$date_registered = date('Y-m-d');
		$file            = basename($_FILES["fileToUpload"]["name"]);


		$check_email = mysqli_query($conn, "SELECT * FROM employees WHERE email='$email'");
		if(mysqli_num_rows($check_email)===1) {
			$_SESSION['message']  = "Email is already taken.";
		    $_SESSION['text'] = "Please try again.";
		    $_SESSION['status'] = "error";
			header("Location: register_employee.php");
		} else {

			if($password != $cpassword) {
				$_SESSION['message']  = "Password does not matched.";
			    $_SESSION['text'] = "Please try again.";
			    $_SESSION['status'] = "error";
				header("Location: register_employee.php");
			} else {

				  // Check if image file is a actual image or fake image
		          $target_dir = "images-employees/";
		          $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		          $uploadOk = 1;
		          $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        

                  // Allow certain file formats
                  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                  	$_SESSION['message']  = "Only JPG, JPEG, PNG & GIF files are allowed.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: register_employee.php");
                  	$uploadOk = 0;
                  }

                  // Check if $uploadOk is set to 0 by an error
                  elseif ($uploadOk == 0) {
                  	$_SESSION['message']  = "Your file was not uploaded.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: register_employee.php");
                  // if everything is ok, try to upload file
                  } else {

                      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                     	
                      	$save = mysqli_query($conn, "INSERT INTO employees (firstname, middlename, lastname, suffix, gender, dob, age, address, email, contact, password, image, date_registered) VALUES ('$firstname', '$middlename', '$lastname', '$suffix', '$gender', '$dob', '$age', '$address', '$email', '$contact', '$password', '$file','$date_registered')");

                            if($save) {
	                            $_SESSION['message']  = "Registration successful. Please login.";
							    $_SESSION['text'] = "Registration successful";
							    $_SESSION['status'] = "success";
								header("Location: register_employee.php");                               
                            } else {
                              	$_SESSION['message'] = "Something went wrong while saving your information.";
							    $_SESSION['text'] = "Please try again.";
							    $_SESSION['status'] = "error";
								header("Location: register_employee.php");
                            }
                      } else {
                            $_SESSION['message'] = "There was an error uploading your file.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: register_employee.php");
                      }
			}

		}

	}
}


?>