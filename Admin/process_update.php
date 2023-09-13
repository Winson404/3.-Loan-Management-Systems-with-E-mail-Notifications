<?php 
session_start();
include '../config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/PHPMailer/src/Exception.php';
require '../vendor/PHPMailer/src/PHPMailer.php';
require '../vendor/PHPMailer/src/SMTP.php';

// UPDATE EMPLOYEE
if(isset($_POST['update_employer'])) {

	$id              = $_POST['emp_Id'];
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

	$update = mysqli_query($conn, "UPDATE employees SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', gender='$gender', dob='$dob', age='$age', address='$address', email='$email', contact='$contact' WHERE emp_Id='$id'");
    if($update) {
		$_SESSION['message']  = "Employee information has been updated.";
	  	$_SESSION['text'] = "Updated successfully";
	    $_SESSION['status'] = "success";
		header("Location: staff.php"); 
	} else {
		$_SESSION['message']  = "Something went wrong while updating the information.";
	    $_SESSION['text'] = "Please try again.";
	    $_SESSION['status'] = "error";
		header("Location: staff.php");
	}
}



// UPDATE PHOTO OF EMPLOYEE
if(isset($_POST['update_emp_photo'])) {
  $ids    = $_POST['emp_Id'];
  $file  = basename($_FILES["fileToUpload"]["name"]);

  // Check if image file is a actual image or fake image
  $target_dir = "../images-employees/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
	    $_SESSION['message']  = "Only JPG, JPEG, PNG & GIF files are allowed.";
    $_SESSION['text'] = "Please try again.";
    $_SESSION['status'] = "error";
	header("Location: staff.php");
  $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  elseif ($uploadOk == 0) {
  	$_SESSION['message']  = "Your file was not uploaded.";
    $_SESSION['text'] = "Please try again.";
    $_SESSION['status'] = "error";
	header("Location: staff.php");
  // if everything is ok, try to upload file
  } else {

      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
     	
      	$save = mysqli_query($conn, "UPDATE employees SET image='$file' WHERE emp_Id='$ids'");
        if($save) {
			$_SESSION['message']  = "Profile has been updated.";
		  	$_SESSION['text'] = "Updated successfully";
		    $_SESSION['status'] = "success";
			header("Location: staff.php"); 
		} else {
			$_SESSION['message']  = "Something went wrong while uploading the photo.";
		    $_SESSION['text'] = "Please try again.";
		    $_SESSION['status'] = "error";
			header("Location: staff.php");
		}
      } else {
            $_SESSION['message'] = "There was an error uploading your file.";
		    $_SESSION['text'] = "Please try again.";
		    $_SESSION['status'] = "error";
			header("Location: staff.php");
      }
  }
}




// CHANGE PASSWORD EMPLOYEE
if(isset($_POST['change_password_emp'])) {

	$emp_Id          = $_POST['emp_Id'];
	$OldPassword     = md5($_POST['OldPassword']);
	$NewPassword     = md5($_POST['NewPassword']);
	$ConfirmPassword = md5($_POST['ConfirmPassword']);

	$check_old_password = mysqli_query($conn, "SELECT * FROM employees WHERE password='$OldPassword' AND emp_Id='$emp_Id'");

	// CHECK IF THERE IS MATCHED PASSWORD IN THE DATABASE COMPARED TO THE ENTERED OLD PASSWORD
	if(mysqli_num_rows($check_old_password) === 1 ) {
		// COMPARE BOTH NEW AND CONFIRM PASSWORD
		if($NewPassword != $ConfirmPassword) {
				$_SESSION['message']  = "Password does not matched. Please try again";
			  	$_SESSION['text'] = "Please try again";
			    $_SESSION['status'] = "error";
				header("Location: staff.php"); 
		} else {
			$update_password = mysqli_query($conn, "UPDATE employees SET password='$NewPassword' WHERE emp_Id='$emp_Id' ");

			if($update_password) {
				$_SESSION['message']  = "Password has been changed.";
			  	$_SESSION['text'] = "Updated successfully";
			    $_SESSION['status'] = "success";
				header("Location: staff.php"); 
			} else {
				$_SESSION['message']  = "Something went wrong while changing the password.";
			  	$_SESSION['text'] = "Please try again";
			    $_SESSION['status'] = "error";
				header("Location: staff.php"); 
			}
		}
	} else {
		$_SESSION['message']  = "Old password is incorrect.";
	  	$_SESSION['text'] = "Please try again";
	    $_SESSION['status'] = "error";
		header("Location: staff.php"); 
	}
}



// CHANGE PASSWORD EMPLOYEE USING THE NAVBAR: CHANGE PASSWORD
if(isset($_POST['password_emp'])) {

	$emp_Id          = $_POST['emp_Id'];
	$OldPassword     = md5($_POST['OldPassword']);
	$NewPassword     = md5($_POST['NewPassword']);
	$ConfirmPassword = md5($_POST['ConfirmPassword']);

	$check_old_password = mysqli_query($conn, "SELECT * FROM employees WHERE password='$OldPassword' AND emp_Id='$emp_Id'");
	// CHECK IF THERE IS MATCHED PASSWORD IN THE DATABASE COMPARED TO THE ENTERED OLD PASSWORD
	if(mysqli_num_rows($check_old_password) === 1 ) {
		// COMPARE BOTH NEW AND CONFIRM PASSWORD
		if($NewPassword != $ConfirmPassword) {
				$_SESSION['message']  = "Password does not matched.";
			  	$_SESSION['text'] = "Please try again";
			    $_SESSION['status'] = "error";
				header("Location: admin_change_pass.php"); 
		} else {
			$update_password = mysqli_query($conn, "UPDATE employees SET password='$NewPassword' WHERE emp_Id='$emp_Id' ");
			if($update_password) {
				$_SESSION['message']  = "Password has been changed.";
			  	$_SESSION['text'] = "Changed successfully";
			    $_SESSION['status'] = "success";
				header("Location: admin_change_pass.php"); 
			} else {
				$_SESSION['message']  = "Something went wrong while changing the password.";
			  	$_SESSION['text'] = "Please try again";
			    $_SESSION['status'] = "error";
				header("Location: admin_change_pass.php"); 
			}
		}
	} else {
		$_SESSION['message']  = "Old password is incorrect.";
	  	$_SESSION['text'] = "Please try again";
	    $_SESSION['status'] = "error";
		header("Location: admin_change_pass.php"); 
	}
}




// UPDATE MEMBER
if(isset($_POST['update_member'])) {
	$id              = $_POST['user_Id'];
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

	$update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', gender='$gender', dob='$dob', age='$age', address='$address', email='$email', contact='$contact' WHERE user_Id='$id'");

	if($update) {
        $_SESSION['message']  = "Employee information has been updated.";
	  	$_SESSION['text'] = "Updated successfully";
	    $_SESSION['status'] = "success";
		header("Location: users.php");                             
    } else {
      	$_SESSION['message'] = "Something went wrong while updating the information.";
	  	$_SESSION['text'] = "Please try again.";
	    $_SESSION['status'] = "error";
		header("Location: users.php");      
    }
}




// UPDATE PHOTO OF MEMBER
if(isset($_POST['update_mem_photo'])) {
	  $ids    = $_POST['user_Id'];
	  $file  = basename($_FILES["fileToUpload"]["name"]);

	  // Check if image file is a actual image or fake image
      $target_dir = "../images-member/";
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
      	$_SESSION['message']  = "Only JPG, JPEG, PNG & GIF files are allowed.";
	  	$_SESSION['text'] = "Please try again.";
	    $_SESSION['status'] = "error";
		header("Location: users.php");
      $uploadOk = 0;
      }

      // Check if $uploadOk is set to 0 by an error
      elseif ($uploadOk == 0) {
        $_SESSION['message']  = "Your file was not uploaded.";
	  	$_SESSION['text'] = "Please try again.";
	    $_SESSION['status'] = "error";
		header("Location: users.php");    
      // if everything is ok, try to upload file
      } else {

          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          	$save = mysqli_query($conn, "UPDATE users SET image='$file' WHERE user_Id='$ids'");
            if($save) {
                $_SESSION['message']  = "Profile has been updated.";
			  	$_SESSION['text'] = "Updated successfully";
			    $_SESSION['status'] = "success";
				header("Location: users.php");                                
            } else {
              	$_SESSION['message'] = "Something went wrong while uploading the photo.";
			  	$_SESSION['text'] = "Please try again.";
			    $_SESSION['status'] = "error";
				header("Location: users.php");    
            }
          } else {
                $_SESSION['message'] = "There was an error uploading your file.";
			  	$_SESSION['text'] = "Please try again.";
			    $_SESSION['status'] = "error";
				header("Location: users.php");     
          }
	  }
}




// CHANGE PASSWORD MEMBER
if(isset($_POST['change_password_mem'])) {

	$user_Id         = $_POST['user_Id'];
	$OldPassword     = md5($_POST['OldPassword']);
	$NewPassword     = md5($_POST['NewPassword']);
	$ConfirmPassword = md5($_POST['ConfirmPassword']);

	$check_old_password = mysqli_query($conn, "SELECT * FROM users WHERE password='$OldPassword' AND user_Id='$user_Id'");
	// CHECK IF THERE IS MATCHED PASSWORD IN THE DATABASE COMPARED TO THE ENTERED OLD PASSWORD
	if(mysqli_num_rows($check_old_password) === 1 ) {
		// COMPARE BOTH NEW AND CONFIRM PASSWORD
		if($NewPassword != $ConfirmPassword) {
				$_SESSION['message']  = "Password does not matched. Please try again";
			  	$_SESSION['text'] = "Please try again.";
			    $_SESSION['status'] = "error";
				header("Location: users.php");
		} else {
			$update_password = mysqli_query($conn, "UPDATE users SET password='$NewPassword' WHERE user_Id='$user_Id' ");
			if($update_password) {
				$_SESSION['message']  = "Password has been changed.";
			  	$_SESSION['text'] = "Changed successfully";
			    $_SESSION['status'] = "success";
				header("Location: users.php");
			} else {
				$_SESSION['message']  = "Something went wrong while changing the password.";
			  	$_SESSION['text'] = "Please try again.";
			    $_SESSION['status'] = "error";
				header("Location: users.php");
			}
		}
	} else {
		$_SESSION['message']  = "Old password is incorrect.";
	  	$_SESSION['text'] = "Please try again.";
	    $_SESSION['status'] = "error";
		header("Location: users.php");
	}
}




// UPDATE LOAN TYPE
if(isset($_POST['update_loan_type'])) {

	$id          = $_POST['loan_Id'];
	$name        = $_POST['name'];
	$description = $_POST['description'];
	$file        = basename($_FILES["fileToUpload"]["name"]);

	if(empty($file)) {
		$update = mysqli_query($conn, "UPDATE loan_types SET loan_name='$name', loan_description='$description' WHERE loan_Id='$id'");
		if($update) {
            $_SESSION['message']  = "Loan type has been updated.";
		  	$_SESSION['text'] = "Updated successfully";
		    $_SESSION['status'] = "success";
			header("Location: loan_type.php");                  
        } else {
          	$_SESSION['message'] = "Something went wrong while updating the information.";
		  	$_SESSION['text'] = "Please try again.";
		    $_SESSION['status'] = "error";
			header("Location: loan_type.php");  
        }
	} else {

	  	// Check if image file is a actual image or fake image
        $target_dir = "../images-loan/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        $_SESSION['message']  = "Only JPG, JPEG, PNG & GIF files are allowed.";
	  	$_SESSION['text'] = "Please try again.";
	    $_SESSION['status'] = "error";
		header("Location: loan_type.php"); 
        $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        elseif ($uploadOk == 0) {
        $_SESSION['message']  = "Your file was not uploaded.";
	  	$_SESSION['text'] = "Please try again.";
	    $_SESSION['status'] = "error";
		header("Location: loan_type.php"); 
        // if everything is ok, try to upload file
        } else {

            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        		$update = mysqli_query($conn, "UPDATE loan_types SET loan_name='$name', loan_description='$description', loan_image='$file' WHERE loan_Id='$id'");

				if($update) {
		            $_SESSION['message']  = "Loan type has been updated.";
				  	$_SESSION['text'] = "Updated successfully";
				    $_SESSION['status'] = "success";
					header("Location: loan_type.php");                             
		        } else {
		          $_SESSION['exists'] = "Something went wrong while updating the information. Please try again.";
		          header("Location: loan_type.php");
		        }
            } else {
              	$_SESSION['message'] = "There was an error uploading your file.";
			  	$_SESSION['text'] = "Please try again.";
			    $_SESSION['status'] = "error";
				header("Location: loan_type.php"); 
            }
		}

	}
}



// UPDATE LOAN TYPE
if(isset($_POST['update_plan'])) {

	$id       = $_POST['plan_Id'];
	$loan_Id  = $_POST['loan_Id'];
	$plan     = $_POST['plan'];
	// $interest = $_POST['interest'];
	// $penalty  = $_POST['penalty'];

	$update = mysqli_query($conn, "UPDATE loan_plans SET plan_loan_type_Id='$loan_Id', plan='$plan' WHERE plan_Id='$id'");
	if($update) {
        $_SESSION['message']  = "Plan has been updated.";
	  	$_SESSION['text'] = "Updated successfully";
	    $_SESSION['status'] = "success";
		header("Location: loan_plans.php");       
    } else {
      	$_SESSION['message'] = "Something went wrong while updating the information. Please try again.";
	  	$_SESSION['text'] = "Please try again.";
	    $_SESSION['status'] = "error";
		header("Location: loan_plans.php"); 
    }
}



// UDPATE STATUS OF MEMBER LOAN APPLICATION
if(isset($_POST['approve_loan'])) {

	include 'smsAPIController.php';
	$id             = $_POST['loan_list_Id'];

	$receiver       = $_POST['receiver'];
	$message        = 'Good day Maam/Sir, your loan application has been APPROVED.';
	$smsAPICode     = "TR-ERWIN075714_PI6HP";
	$smsAPIPassword = "%ge{cl211q";
	$send = new ItextMoController();
	$send->itexmo($receiver, $message, $smsAPICode, $smsAPIPassword);
	

	if($send == false) {
		$_SESSION['message']  = "No response from the server.";
	  	$_SESSION['text'] = "Please try again";
	    $_SESSION['status'] = "error";
		header("Location: loan_list_pending.php"); 
	// UNCOMMENT THE CODE BELOW TO STILL APPROVE USER'S ACCOUNT EVEN IT CANNOT SEND SMS NOTIFICATION
	################################################################################################ 
	//   $update = mysqli_query($con, "UPDATE user SET Status='Confirmed' WHERE Id='$user_id' ");

	// if($update) {

	// 		$_SESSION['success']  = "User's account has been approved.";
	//     header("Location: manage_users.php");

	// } else {

	//     $_SESSION['exists']  = "There was an error approving this user's account.";
	//     header("Location: manage_users.php");
	// }

	} elseif ($send == true) {
			
		$update = mysqli_query($conn, "UPDATE loan_list SET status='1' WHERE loan_list_Id='$id'");
		if($update) {

			$name                   = $_POST['name'];
			$user_email             = $_POST['user_email'];
			$user_Id                = $_POST['user_Id'];
			$loan_name              = $_POST['loan_name'];
			$amount                 = $_POST['amount'];
			$monthly_payable_amount = $_POST['monthly_payable_amount'];
			$total_amount_to_pay    = $_POST['total_amount_to_pay'];
			$plan                   = $_POST['plan'];

			$email   = $user_email ;
		    $subject = 'Approved loan application!';
		    $message = '<h3>Congratulations!</h3>
						<p>Good day sir/maam '.$name.', your loan application has now been approved.<br> You can now visit us for your transaction. Thank you!</p>
						<label for=""><b>Loan application details</b></label>
						<table class="table table-bordered" style="width: auto;">
							<thead>
								<tr>
									<th>Type of loan: </th>
									<td>'.$loan_name.'</td>
								</tr>
								<tr>
									<th>Selected plan: </th>
									<td> '.$plan.' </td>
								</tr>
								<tr>
									<th>Amount: </th>
									<td>₱ '.$amount.' </td>
								</tr>
								<tr>
									<th>Total amount to pay: </th>
									<td>₱ '.$total_amount_to_pay.'</td>
								</tr>
								<tr>
									<th>Monthly payable amount: </th>
									<td>₱ '.$monthly_payable_amount.'</td>
								</tr>
							</thead>
						</table>';

						//Load composer's autoloader

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
						
			     		$_SESSION['message']  = "You have successfully approved member loan application.";
					  	$_SESSION['text'] = "Approved successfully";
					    $_SESSION['status'] = "success";
						header("Location: loan_list_pending.php"); 

				    } catch (Exception $e) {
				    	$_SESSION['message']  = "Message could not be sent. Mailer Error: ".$mail->ErrorInfo;
					  	$_SESSION['text'] = "Please try again";
					    $_SESSION['status'] = "error";
						header("Location: loan_list_pending.php"); 
				    }

	      } else {
	        $_SESSION['message'] = "Something went wrong while approving the application.";
		  	$_SESSION['text'] = "Please try again";
		    $_SESSION['status'] = "error";
			header("Location: loan_list_pending.php"); 
	      }
		} else {

			$_SESSION['message']  = "Something went wrong.";
		  	$_SESSION['text'] = "Please try again";
		    $_SESSION['status'] = "error";
			header("Location: loan_list_pending.php"); 

	      // UNCOMMENT THE CODE BELOW TO STILL APPROVE USER'S ACCOUNT EVEN IT CANNOT SEND SMS NOTIFICATION
	  		################################################################################################ 
	      // $update = mysqli_query($con, "UPDATE user SET Status='Confirmed' WHERE Id='$user_id' ");

	      // if($update) {

	      // 		$_SESSION['success']  = "User's account has been approved.";
	      //     header("Location: manage_users.php");

	      // } else {

	      //     $_SESSION['exists']  = "There was an error approving this user's account.";
	      //     header("Location: manage_users.php");
	      // }

		}
}



// RELEASE LOAN
if(isset($_POST['release_loan'])) {

		$id             = $_POST['loan_list_Id'];
		$payment        = $_POST['payment_Id'];
		$released_date  = date('Y-m-d');
		$date_today     = strtotime(date('Y-m-d'));
		$next_paid_date = date('Y-m-d', strtotime('+1 month', $date_today));

		$update = mysqli_query($conn, "UPDATE loan_list SET status=2, date_released='$released_date' WHERE loan_list_Id='$id'");
		if($update) {
        	$update2 = mysqli_query($conn, "UPDATE payment SET payment_status='ON', next_paid_date='$next_paid_date' WHERE payment_Id='$payment'");
	        if($update2) {

				$due_date = mysqli_query($conn, "SELECT next_paid_date FROM payment WHERE payment_Id='$payment'");
				$row = mysqli_fetch_array($due_date);

					$name                   = $_POST['name'];
					$user_email             = $_POST['user_email'];
					$user_Id                = $_POST['user_Id'];
					$loan_name              = $_POST['loan_name'];
					$amount                 = $_POST['amount'];
					$monthly_payable_amount = $_POST['monthly_payable_amount'];
					$total_amount_to_pay    = $_POST['total_amount_to_pay'];
					$plan                   = $_POST['plan'];

					$email   = $user_email ;
				    $subject = 'Released loan application!';
				    $message = '<h3>Congratulations!</h3>
								<p>Good day sir/maam '.$name.', we have successfully released your fund.<br> Please refer to the date below for your first due date payment. Thank you!</p>
								<label for=""><b>Loan application details</b></label>
								<table class="table table-bordered" style="width: auto;">
									<thead>
										<tr>
											<th>Type of loan: </th>
											<td>'.$loan_name.'</td>
										</tr>
										<tr>
											<th>Selected plan: </th>
											<td> '.$plan.' </td>
										</tr>
										<tr>
											<th>Amount: </th>
											<td>₱ '.$amount.' </td>
										</tr>
										<tr>
											<th>Total amount to pay: </th>
											<td>₱ '.$total_amount_to_pay.'</td>
										</tr>
										<tr>
											<th>Total monthly payment: </th>
											<td>₱ '.$monthly_payable_amount.'</td>
										</tr>
									</thead>
								</table> 
								<p>Due date: '.$row['next_paid_date'].'</p>
								';

								//Load composer's autoloader

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
								
					     		$_SESSION['message']  = "You have successfully released member application.";
							  	$_SESSION['text'] = "Released successfully";
							    $_SESSION['status'] = "success";
								header("Location: view_loan_list_approved.php"); 

						    } catch (Exception $e) {
						    	$_SESSION['message']  = "Message could not be sent. Mailer Error: ".$mail->ErrorInfo;
							  	$_SESSION['text'] = "Please try again";
							    $_SESSION['status'] = "error";
								header("Location: view_loan_list_approved.php"); 
						    }
		      } else {
		        $_SESSION['message']  = "Something went wrong while approving the application.";
			  	$_SESSION['text'] = "Please try again";
			    $_SESSION['status'] = "error";
				header("Location: view_loan_list_approved.php"); 
		      }                              
    } else {
      	$_SESSION['message'] = "Something went wrong while approving the application.";
	  	$_SESSION['text'] = "Please try again";
	    $_SESSION['status'] = "error";
		header("Location: view_loan_list_approved.php"); 
    }
}



// REJECT APPLICATION
if(isset($_POST['reject_application'])) {

	$id  = $_POST['loan_list_Id'];

	$update = mysqli_query($conn, "UPDATE loan_list SET status='3' WHERE loan_list_Id='$id'");
	if($update) {
  	$name                   = $_POST['name'];
	$user_email             = $_POST['user_email'];
	$user_Id                = $_POST['user_Id'];
	$loan_name              = $_POST['loan_name'];
	$amount                 = $_POST['amount'];
	$monthly_payable_amount = $_POST['monthly_payable_amount'];
	$total_amount_to_pay    = $_POST['total_amount_to_pay'];
	$plan                   = $_POST['plan'];

	$email   = $user_email ;
    $subject = 'Rejected loan application!';
    $message = '<h3>Sorry!</h3>
				<p>Good day sir/maam '.$name.', we have rejected your loan application due to some reason we have in our management. Hoping for your understanding. Thank you!</p> ';

				//Load composer's autoloader

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
				
	     		$_SESSION['message']  = "You have rejected members application.";
			  	$_SESSION['text'] = "Rejected successfully";
			    $_SESSION['status'] = "success";
				header("Location: loan_list_pending.php");  

		    } catch (Exception $e) {
		    	$_SESSION['message']  = "Message could not be sent. Mailer Error: ".$mail->ErrorInfo;
			  	$_SESSION['text'] = "Please try again";
			    $_SESSION['status'] = "error";
				header("Location: loan_list_pending.php"); 
		    }

    } else {
      	$_SESSION['message'] = "Something went wrong while rejecting the application.";
	  	$_SESSION['text'] = "Please try again";
	    $_SESSION['status'] = "error";
		header("Location: loan_list_pending.php");  
    }
}




// RE-APPLY APPLICATION
if(isset($_POST['re-apply_loan'])) {
	$id  = $_POST['loan_list_Id'];
	$update = mysqli_query($conn, "UPDATE loan_list SET status='0' WHERE loan_list_Id='$id'");
	if($update) {
			$_SESSION['message']  = "You have successfully applied again the members application.";
	  	$_SESSION['text'] = "Applied successfully";
	    $_SESSION['status'] = "success";
		header("Location: view_loan_list_rejected.php");                                
    } else {
      	$_SESSION['message'] = "Something went wrong while applying again the application.";
	  	$_SESSION['text'] = "Please try again";
	    $_SESSION['status'] = "error";
		header("Location: view_loan_list_rejected.php");
    }
}



// PAID APPLICATION
if(isset($_POST['paid_loan'])) {

		$id  = $_POST['loan_list_Id'];

		$update = mysqli_query($conn, "UPDATE loan_list SET status='5' WHERE loan_list_Id='$id'");
		if($update) {
       			
		    $name                   = $_POST['name'];
			$user_email             = $_POST['user_email'];
			$user_Id                = $_POST['user_Id'];
			$loan_name              = $_POST['loan_name'];
			$amount                 = $_POST['amount'];
			$monthly_payable_amount = $_POST['monthly_payable_amount'];
			$total_amount_to_pay    = $_POST['total_amount_to_pay'];
			$plan                   = $_POST['plan'];


			$email   = $user_email ;
		    $subject = 'Fully paid loan application!';
		    $message = '<h3>Congratulations!</h3>
						<p>Good day sir/maam '.$name.', you have fully paid your applied loan.<br> For more application, just login to your account and apply again.. Thank you!</p>
						<label for=""><b>Fully paid loan application details</b></label>
						<table class="table table-bordered" style="width: auto;">
							<thead>
								<tr>
									<th>Type of loan: </th>
									<td>'.$loan_name.'</td>
								</tr>
								<tr>
									<th>Selected plan: </th>
									<td> '.$plan.' </td>
								</tr>
								<tr>
									<th>Amount: </th>
									<td>₱ '.$amount.' </td>
								</tr>
								<tr>
									<th>Total amount to pay: </th>
									<td>₱ '.$total_amount_to_pay.'</td>
								</tr>
								<tr>
									<th>Total monthly payment: </th>
									<td>₱ '.$monthly_payable_amount.'</td>
								</tr>
							</thead>
						</table>';

			//Load composer's autoloader
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
				
	     		$_SESSION['message']  = "Member has been fully paid.";
			  	$_SESSION['text'] = "Paid successfully";
			    $_SESSION['status'] = "success";
				header("Location: view_loan_list_released.php");

		    } catch (Exception $e) {
		    	$_SESSION['message']  = "Message could not be sent. Mailer Error: ".$mail->ErrorInfo;
			  	$_SESSION['text'] = "Please try again";
			    $_SESSION['status'] = "error";
				header("Location: view_loan_list_released.php");
		    }
    } else {
      	$_SESSION['message']  = "Something went wrong";
	  	$_SESSION['text'] = "Please try again";
	    $_SESSION['status'] = "error";
		header("Location: view_loan_list_released.php");
    }
}




// DELETE MEMBER
if(isset($_POST['unblock_mem'])) {
	$id = $_POST['user_Id']; 

	$delete = mysqli_query($conn, "UPDATE users  set users_status=0 WHERE user_Id='$id'");
	if($delete) {
        $_SESSION['message']  = "Member account has been unblocked.";
	  	$_SESSION['text'] = "Unblocked successfully";
	    $_SESSION['status'] = "success";
		header("Location: users.php");                               
    } else {
        $_SESSION['message']  = "Something went wrong";
	  	$_SESSION['text'] = "Please try again";
	    $_SESSION['status'] = "error";
		header("Location: users.php");
    }
}

?>