<?php 
	
session_start();
include '../config.php';

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
		$file            = basename($_FILES["fileToUpload"]["name"]);


		$check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
		if(mysqli_num_rows($check_email)===1) {
				$_SESSION['message']  = "Email is already taken.";
			  $_SESSION['text'] = "Please try again.";
		    $_SESSION['status'] = "error";
				header("Location: users.php"); 
		} else {

			if($password != $cpassword) {
					$_SESSION['message']  = "Password does not matched.";
				  $_SESSION['text'] = "Please try again.";
			    $_SESSION['status'] = "error";
					header("Location: users.php"); 
			} else {

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
             	
              	$save = mysqli_query($conn, "INSERT INTO users (firstname, middlename, lastname, suffix, gender, dob, age, address, email, contact, password, image, date_registered) VALUES ('$firstname', '$middlename', '$lastname', '$suffix', '$gender', '$dob', '$age', '$address', '$email', '$contact', '$password', '$file','$date_registered')");

                if($save) {
                  $_SESSION['message']  = "Record has been added.";
								  $_SESSION['text'] = "Saved successfully";
							    $_SESSION['status'] = "success";
									header("Location: users.php");                                
                } else {
                  $_SESSION['message'] = "Something went wrong while saving your information. Please try again.";
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
			header("Location: staff.php");
		} else {

			if($password != $cpassword) {
				$_SESSION['message']  = "Password does not matched.";
			  $_SESSION['text'] = "Please try again.";
		    $_SESSION['status'] = "error";
				header("Location: staff.php");
			} else {

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
            	$save = mysqli_query($conn, "INSERT INTO employees (firstname, middlename, lastname, suffix, gender, dob, age, address, email, contact, password, image, date_registered) VALUES ('$firstname', '$middlename', '$lastname', '$suffix', '$gender', '$dob', '$age', '$address', '$email', '$contact', '$password', '$file','$date_registered')");

              if($save) {
                $_SESSION['message']  = "Record has been added.";
							  $_SESSION['text'] = "Saved successfully";
						    $_SESSION['status'] = "success";
								header("Location: staff.php");                                
              } else {
                $_SESSION['message'] = "Something went wrong while saving your information. Please try again.";
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
	}
}




// SAVE LOAN TYPE
if(isset($_POST['save_loan_type'])) {
	$name        = $_POST['name'];
	$description = $_POST['description'];
	$file        = basename($_FILES["fileToUpload"]["name"]);

	if(empty($file)) {
			$save = mysqli_query($conn, "INSERT INTO loan_types (loan_name, loan_description) VALUES ('$name', '$description')");
			if($save) {
				$_SESSION['message'] = "Loan type has been added.";
			    $_SESSION['text'] = "Saved successfully";
			    $_SESSION['status'] = "success";
				header("Location: loan_type.php");
			} else {
				$_SESSION['message'] = "Something went wrong while saving the data.";
			    $_SESSION['text'] = "Please try again.";
			    $_SESSION['status'] = "error";
				header("Location: loan_type.php");
			}
	} else {

				$check = mysqli_query($conn, "SELECT * FROM loan_types WHERE loan_name='$name'");
				if(mysqli_num_rows($check)===1) {
						$_SESSION['message']  = "Loan type already exists.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
						header("Location: loan_type.php");
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
	            if ($uploadOk == 0) {
	            $_SESSION['message']  = "Your file was not uploaded.";
					    $_SESSION['text'] = "Please try again.";
					    $_SESSION['status'] = "error";
							header("Location: loan_type.php");
	            // if everything is ok, try to upload file
	            } else {

	                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	               	
	                	$save = mysqli_query($conn, "INSERT INTO loan_types (loan_image, loan_name, loan_description) VALUES ('$file', '$name', '$description')");
										if($save) {
											$_SESSION['message'] = "Loan type has been added.";
										    $_SESSION['text'] = "Saved successfully";
										    $_SESSION['status'] = "success";
											header("Location: loan_type.php");
										} else {
											$_SESSION['message'] = "Something went wrong while saving the data.";
										    $_SESSION['text'] = "Please try again.";
										    $_SESSION['status'] = "error";
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
}




// SAVE LOAN TYPE
if(isset($_POST['save_loan_plan'])) {
	$loan_type = $_POST['loan_type'];
	$plan      = $_POST['plan'];
	// $interest  = $_POST['interest'];
	// $penalty   = $_POST['penalty'];

	$check = mysqli_query($conn, "SELECT * FROM loan_plans WHERE plan='$plan'");
	if(mysqli_num_rows($check)===1) {
			$_SESSION['message']  = "Loan plan already exists.";
		  $_SESSION['text'] = "Please try again.";
	    $_SESSION['status'] = "error";
			header("Location: loan_plans.php"); 
	} else {

			$save = mysqli_query($conn, "INSERT INTO loan_plans (plan_loan_type_Id, plan) VALUES ('$loan_type', '$plan')");
			if($save) {
					$_SESSION['message']  = "Loan plan has been added.";
				  $_SESSION['text'] = "Saved successfully";
			    $_SESSION['status'] = "success";
					header("Location: loan_plans.php");     
			} else {
					$_SESSION['message']  = "Something went wrong while saving the data.";
				  $_SESSION['text'] = "Please try again.";
			    $_SESSION['status'] = "error";
					header("Location: loan_plans.php"); 
			}

	}
}




// SAVE PAYMENT
if(isset($_POST['payment'])) {
	$payment_Id          = $_POST['payment_Id'];
	$borrower            = $_POST['borrower'];
	$amount              = $_POST['amount'];
	$date_paid_today		 = date('Y-m-d');
	$date_today          = strtotime(date('Y-m-d'));
	$next_paid_date      = date('Y-m-d', strtotime('+1 month', $date_today));
	$total_amount_to_pay = $_POST['total_amount_to_pay'];
	
	$previous_balance = mysqli_query($conn, "SELECT * FROM payment WHERE payment_Id='$payment_Id'");
	$old_balance = mysqli_fetch_array($previous_balance);

	$balance = $old_balance['balance'] - $amount;

		$update = mysqli_query($conn, "UPDATE payment SET paid_amount='$amount', paid_date='$date_paid_today', next_paid_date='$next_paid_date', balance='$balance', payment_status='OFF' WHERE payment_Id='$payment_Id' ");
    if($update) {
    	$sql = mysqli_query($conn, "SELECT * FROM payment WHERE payment_Id='$payment_Id'");
    	if(mysqli_num_rows($sql)===1) {

    			$row = mysqli_fetch_array($sql);

    			$last_payment   = date('Y-m-d');

    			$today		 = date('Y-m-d');
    			$next_payment   = date('Y-m-d',strtotime($today." +1 month"));

    			$new_balance    = $row['balance'];

    			$save = mysqli_query($conn, "INSERT INTO payment (borrower_Id, paid_amount, paid_date, next_paid_date, balance) VALUES ('$borrower', '$amount', '$last_payment', '$next_payment', '$new_balance')");

        			if($save) {
        					$_SESSION['message']  = "Borrower has successfully paid.";
      					  $_SESSION['text'] = "Saved successfully";
							    $_SESSION['status'] = "success";
									header("Location: payments.php"); 
        			} else {
        					$_SESSION['message']  = "Something went wrong while saving the data.";
							    $_SESSION['text'] = "Please try again.";
							    $_SESSION['status'] = "error";
									header("Location: payments.php");
        			}
    	}
    } else {
    		$_SESSION['message']  = "Something went wrong while saving the data.";
		    $_SESSION['text'] = "Please try again.";
		    $_SESSION['status'] = "error";
				header("Location: payments.php");
    }
}

?>