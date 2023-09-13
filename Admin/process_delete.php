<?php 
	
	session_start();
	include '../config.php';

	// DELETE EMPLOYEE
	if(isset($_POST['delete_emp'])) {
		$id = $_POST['emp_Id']; 

    	$delete = mysqli_query($conn, "DELETE FROM employees WHERE emp_Id='$id'");
		if($delete) {
			$_SESSION['message']  = "Employee account has been deleted.";
		  	$_SESSION['text'] = "Deleted successfully";
		    $_SESSION['status'] = "success";
			header("Location: staff.php"); 
		} else {
			$_SESSION['message']  = "Something went wrong. Please try again.";
		    $_SESSION['text'] = "Please try again.";
		    $_SESSION['status'] = "error";
			header("Location: staff.php");
		}
	}



	// DELETE MEMBER
	if(isset($_POST['delete_mem'])) {
		$id = $_POST['user_Id']; 

		$delete = mysqli_query($conn, "DELETE FROM users WHERE user_Id='$id'");
		if($delete) {
			$_SESSION['message']  = "Member account has been deleted.";
		  	$_SESSION['text'] = "Deleted successfully";
		    $_SESSION['status'] = "success";
			header("Location: users.php"); 
		} else {
			$_SESSION['message']  = "Something went wrong. Please try again.";
		    $_SESSION['text'] = "Please try again.";
		    $_SESSION['status'] = "error";
			header("Location: users.php");
		}
	}


	// DELETE LOAN TYPE
	if(isset($_POST['delete_loan_type'])) {
		$id = $_POST['loan_Id']; 

		$delete = mysqli_query($conn, "DELETE FROM loan_types WHERE loan_Id='$id'");
		if($delete) {
			$_SESSION['message']  = "Loan type has been deleted.";
		  	$_SESSION['text'] = "Deleted successfully";
		    $_SESSION['status'] = "success";
			header("Location: loan_type.php"); 
		} else {
			$_SESSION['message']  = "Something went wrong. Please try again.";
		    $_SESSION['text'] = "Please try again.";
		    $_SESSION['status'] = "error";
			header("Location: loan_type.php");
		}
	}




	// DELETE PLAN
	if(isset($_POST['delete_plan'])) {
		$id = $_POST['plan_Id']; 

		$delete = mysqli_query($conn, "DELETE FROM loan_plans WHERE plan_Id='$id'");
		if($delete) {
			$_SESSION['message']  = "Loan plans has been deleted.";
		  	$_SESSION['text'] = "Deleted successfully";
		    $_SESSION['status'] = "success";
			header("Location: loan_plans.php"); 
		} else {
			$_SESSION['message']  = "Something went wrong. Please try again.";
		    $_SESSION['text'] = "Please try again.";
		    $_SESSION['status'] = "error";
			header("Location: loan_plans.php");
		}
	}

?>