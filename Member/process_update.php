<?php 
	
	session_start();
	include '../config.php';

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
        $_SESSION['message']  = "Your information has been updated.";
		  	$_SESSION['text'] = "Updated successfully";
		    $_SESSION['status'] = "success";
  			header("Location: about_me_update.php");                   
    } else {
      $_SESSION['message'] = "Something went wrong while updating the information.";
	  	$_SESSION['text'] = "Please try again";
	    $_SESSION['status'] = "error";
			header("Location: about_me_update.php");
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
			  	$_SESSION['text'] = "Please try again";
			    $_SESSION['status'] = "error";
	  			header("Location: about_me_update.php");   
	      	$uploadOk = 0;
	      }

	      // Check if $uploadOk is set to 0 by an error
	      elseif ($uploadOk == 0) {
	      	$_SESSION['message']  = "Your file was not uploaded.";
			  	$_SESSION['text'] = "Please try again";
			    $_SESSION['status'] = "error";
	  			header("Location: about_me_update.php");   
	      // if everything is ok, try to upload file
	      } else {

	          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	         	
	          	$save = mysqli_query($conn, "UPDATE users SET image='$file' WHERE user_Id='$ids'");

	                if($save) {
	                    $_SESSION['message']  = "Profile has been updated.";
									  	$_SESSION['text'] = "Updated successfully";
									    $_SESSION['status'] = "success";
							  			header("Location: about_me_update.php");             
	                } else {
	                  $_SESSION['message'] = "Something went wrong while uploading the photo.";
								  	$_SESSION['text'] = "Please try again";
								    $_SESSION['status'] = "error";
						  			header("Location: about_me_update.php");     
	                }
	          } else {
	                $_SESSION['message'] = "There was an error uploading your file.";
							  	$_SESSION['text'] = "Please try again";
							    $_SESSION['status'] = "error";
					  			header("Location: about_me_update.php");   
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
		    				    $_SESSION['message']  = "Password does not matched.";
								  	$_SESSION['text'] = "Please try again";
								    $_SESSION['status'] = "error";
						  			header("Location: change_pass.php");  
		    		} else {
			    			$update_password = mysqli_query($conn, "UPDATE users SET password='$NewPassword' WHERE user_Id='$user_Id' ");

			    			if($update_password) {
			    					$_SESSION['message']  = "Password has been changed.";
								  	$_SESSION['text'] = "Changed successfully";
								    $_SESSION['status'] = "success";
						  			header("Location: change_pass.php"); 
			    			} else {
			    					$_SESSION['message']  = "Something went wrong while changing the password.";
								  	$_SESSION['text'] = "Please try again";
								    $_SESSION['status'] = "error";
						  			header("Location: change_pass.php");  
			    			}
		    		}
    	} else {
    				$_SESSION['message']  = "Old password is incorrect.";
				  	$_SESSION['text'] = "Please try again";
				    $_SESSION['status'] = "error";
		  			header("Location: change_pass.php");  
    	}

    }




// CANCEL LOAN APPLICATION
 if(isset($_POST['cancel_application'])) {
 	$id = $_POST['loan_list_Id'];

	 	$update = mysqli_query($conn, "UPDATE loan_list SET status='4' WHERE loan_list_Id='$id'");
	 	if($update) {
	 			$_SESSION['message']  = "Your application has been cancelled just now.";
			  $_SESSION['text']  = "Cancelation success";
		    $_SESSION['status'] = "success";
  			header("Location: loan_view.php");  
	 	} else {
	 		  $_SESSION['message']  = "Something went wrong.";
		  	$_SESSION['text'] = "Please try again";
		    $_SESSION['status'] = "error";
  			header("Location: loan_view.php");  
	 	}

 }



 // RE-APPLY LOAN APPLICATION
 if(isset($_POST['reapply_application'])) {
 	$ids = $_POST['loan_list_Ids'];

	 	$update = mysqli_query($conn, "UPDATE loan_list SET status='0' WHERE loan_list_Id='$ids'");
	 	if($update) {
	 			$_SESSION['message']  = "Your application has been submitted again and is now Pending in status.";
			  $_SESSION['text']  = "Cancelation success";
		    $_SESSION['status'] = "success";
  			header("Location: loan_view.php");  
	 	} else {
				$_SESSION['message']  = "Something went wrong.";
		  	$_SESSION['text'] = "Please try again";
		    $_SESSION['status'] = "error";
  			header("Location: loan_view.php");  
	 	}

 }



?>