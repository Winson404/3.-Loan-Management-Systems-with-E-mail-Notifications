<?php 
	
	session_start();
	include '../config.php';

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require '../vendor/PHPMailer/src/Exception.php';
	require '../vendor/PHPMailer/src/PHPMailer.php';
	require '../vendor/PHPMailer/src/SMTP.php';

	

	// if(isset($_POST['save_application'])) {

	// 	$borrower_id = $_POST['borrower_id'];
	// 	$loan_id     = $_POST['loan_id'];
	// 	$plan_id     = $_POST['plan_id'];
	// 	$amount      = $_POST['amount'];
	// 	$purpose     = $_POST['purpose'];
	// 	$date_requested = date('Y-m-d H:i:s');

	// 	$pending = mysqli_query($conn, "SELECT * FROM loan_list WHERE borrower_id='$borrower_id'");
	// 	if(mysqli_num_rows($pending)===1) {
	// 		$_SESSION['exists'] = "You still have a pending loan application.";
 //          	header("Location: apply.php");
	// 	} else {
	// 		$save = mysqli_query($conn, "INSERT INTO loan_list (loan_type_id, borrower_id, purpose, amount, plan_id, date_created) VALUES ('$loan_id', '$borrower_id', '$purpose', '$amount', '$plan_id', '$date_requested')");
	// 		if($save) {
	// 			$_SESSION['success'] = "You have submitted your loan application.";
 //          		header("Location: apply.php");
	// 		} else {
	// 			$_SESSION['exists'] = "Something went wrong while applying for loan. Please try again later.";
 //          		header("Location: apply.php");
	// 		}
	// 	}
	// }
	

	if(isset($_POST['save_application'])) {


		include 'smsAPIController.php';
		$reference              = uniqid();
		$name                   = $_POST['name'];
		$user_email             = $_POST['email'];
		$borrower_id            = $_POST['borrower_id'];
		$selected_loan_type     = $_POST['selected_loan_type'];
		$loan_type_name         = $_POST['loan_type_name'];
		// $plan_id     = $_POST['plan_id'];
		$amount                 = $_POST['amount'];
		$terms_of_loan          = $_POST['terms_of_loan'];
		$interest_rate          = $_POST['interest_rate'];
		$monthly_overdue_penalty= $_POST['monthly_overdue_penalty'];
		$total_amount_to_pay    = $_POST['total_amount_to_pay'];
		$monthly_payable_amount = $_POST['monthly_payable_amount'];
		$purpose       = $_POST['purpose'];
		$date_requested = date('Y-m-d H:i:s');

		$receiver       = $_POST['borrower_contact'];
		$message        = 'Good day Maam/Sir, your loan application has been approved.';
		// $smsAPICode     = "TR-ERWIN075714_PI6HP";
		// $smsAPIPassword = "%ge{cl211q";
		// $send = new ItextMoController();
		// $send->itexmo($receiver, $message, $smsAPICode, $smsAPIPassword);



		// if($send == false) {
		// 	$_SESSION['exists']  = "No response from the server. ";
		// 	header("Location: loan_plan_and_type.php");
		// } elseif($send == true) {


					$pending = mysqli_query($conn, "SELECT * FROM loan_list WHERE borrower_id='$borrower_id'");
					$row = mysqli_fetch_array($pending);

					if($row['status'] == '0' || $row['status'] == '1' || $row['status'] == '2') {
						$_SESSION['message'] = "You still have a pending loan application.";
					  	$_SESSION['text'] = "Please try again";
					    $_SESSION['status'] = "error";
		      			header("Location: loan_plan_and_type.php");
					} else {

						$pending = mysqli_query($conn, "SELECT * FROM loan_list WHERE ref_no='$reference'");
						if(mysqli_num_rows($pending)===1) {
							$_SESSION['message'] = "Something went wrong while submitting your application.";
						  	$_SESSION['text'] = "Please try again";
						    $_SESSION['status'] = "error";
			      			header("Location: loan_plan_and_type.php");
						} else {

								$save = mysqli_query($conn, "INSERT INTO loan_list (ref_no, loan_type_name, borrower_id, purpose, amount, terms_of_loan,  total_amount_to_pay, monthly_payable_amount, monthly_overdue_penalty, interest_rate, date_created) VALUES ('$reference', '$loan_type_name', '$borrower_id', '$purpose', '$amount', '$terms_of_loan', '$total_amount_to_pay', '$monthly_payable_amount', '$monthly_overdue_penalty', '$interest_rate', '$date_requested')");
								if($save) {
									
										$off = 'OFF';
						          		// ADDING DATA TO PAYMENT
						          		$insert_to_payment = mysqli_query($conn, "INSERT INTO payment (borrower_Id, balance, payment_status) VALUES ('$borrower_id', '$total_amount_to_pay', '$off')");
						          		if($insert_to_payment) {


											        $email   = $user_email ;
												    $subject = 'Pending loan application!';
												    $message = '<h3>Congratulations!</h3>
																<p>Good day sir/maam '.$name.', your loan application has been submitted.<br> It is <b>pending</b> in status and is under approval of the management.<br> We will notify again for further updates regarding with your application. Thank you!</p>
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
														
												     		$_SESSION['message']  = "You have successfully submitted your loan application.";
														  	$_SESSION['text'] = "Saved successfully";
														    $_SESSION['status'] = "success";
															header("Location: single_loan_plan_and_type.php?loan_id=".$selected_loan_type);

												    } catch (Exception $e) {
												    	$_SESSION['message']  = "Message could not be sent. Mailer Error: ".$mail->ErrorInfo;
													  	$_SESSION['text'] = "Please try again";
													    $_SESSION['status'] = "error";
					        			      			header("Location: single_loan_plan_and_type.php?loan_id=".$selected_loan_type);
												    }


						          		} else {
						          			$_SESSION['message'] = "Something went wrong while applying for loan.";
										  	$_SESSION['text'] = "Please try again";
										    $_SESSION['status'] = "error";
		        			      			header("Location: single_loan_plan_and_type.php?loan_id=".$selected_loan_type);
						          		}

								} else {
									$_SESSION['message'] = "Something went wrong while applying for loan.";
								  	$_SESSION['text'] = "Please try again";
								    $_SESSION['status'] = "error";
					          		header("Location: loan_plan_and_type.php");
								}
						}

					}
		// }

	} 




		
	
?>