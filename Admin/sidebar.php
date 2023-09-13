<?php
session_start();
include '../config.php';
date_default_timezone_set('Asia/Manila');
  if(isset($_SESSION['admin_id'])) {
    $id = $_SESSION['admin_id'];

    $admin = mysqli_query($conn, "SELECT * FROM employees WHERE emp_Id='$id'");
    while($row = mysqli_fetch_array($admin)) {
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>LM System </title>
        <!---FAVICON ICON FOR WEBSITE--->
    		<link rel="shortcut icon" type="image/png" href="../images/logo2.png">

        <!-- BOOTSTRAP ICONS -->
				<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

        <link href="../css/style.css" rel="stylesheet" />
        <!-- BOOTSTRAP LAYOUT LINK : BOOTSTRAP.MIN.CSS -->
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

	    </head>


	    <body class="sb-nav-fixed">
	        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
	            <!-- Navbar Brand-->
	            <a class="navbar-brand ps-3" href="dashboard.php">LM SYSTEM</a>
	            <!-- Sidebar Toggle-->
	            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>


	            <!-- Navbar Search-->
	            <!-- <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
	                <div class="input-group">
	                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
	                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
	                </div>
	            </form> -->



	            <!-- Navbar-->
	            <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
	                <li class="nav-item dropdown">
	                  <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
	                    	<img src="../images-employees/<?php echo $row['image']; ?>" alt="" style="height: 25px; width: 25px; border-radius: 50%;"> <?php echo $row['email']; ?>
	                	</a>
	                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
	                        <!-- <li><a class="dropdown-item" href="#!">Profile</a></li> -->
	                        <li><a class="dropdown-item" href="admin_change_pass.php">Change password</a></li>
	                        <li><hr class="dropdown-divider" /></li>
	                        <li><a class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#logoutmodal">Logout</a></li>
	                    </ul>
	                </li>
	            </ul>
	        </nav>
	        <div id="layoutSidenav">
	            <div id="layoutSidenav_nav">
	                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
	                    <div class="sb-sidenav-menu">
	                        <div class="nav">


	                            <!-- <div class="sb-sidenav-menu-heading">Core</div> -->
	                            <a class="nav-link" href="dashboard.php">
	                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
	                                Dashboard
	                            </a>

	                            <div class="sb-sidenav-menu-heading">Loans</div>
	                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
	                                <div class="sb-nav-link-icon"><i class="bi bi-coin"></i></div>
	                                Loan Applications
	                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
	                            </a>
	                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
	                                <nav class="sb-sidenav-menu-nested nav">

	                                		<!-- DISPLAY PAID -->
												              <?php 
												                $paid = mysqli_query($conn, "SELECT loan_list_Id FROM loan_list WHERE status=5");
												                $row_paid = mysqli_num_rows($paid);
												              ?>
	                                    <a class="nav-link" href="view_loan_list_paid.php">Paid &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge bg-info rounded-pill"> <?php echo $row_paid; ?></span></a></a>

	                                		<!-- DISPLAY RELEASED -->
												              <?php 
												                $released = mysqli_query($conn, "SELECT loan_list_Id FROM loan_list WHERE status=2");
												                $row_released = mysqli_num_rows($released);
												              ?>
	                                    <a class="nav-link" href="view_loan_list_released.php">Released &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge bg-primary rounded-pill"> <?php echo $row_released; ?></span></a></a>


	                                    <!-- DISPLAY APPROVED -->
												              <?php   
												                $approved = mysqli_query($conn, "SELECT loan_list_Id FROM loan_list WHERE status=1");
												                $row_approved= mysqli_num_rows($approved);
												              ?>
	                                    <a class="nav-link" href="view_loan_list_approved.php">Approved &nbsp;&nbsp;<span class="badge bg-success rounded-pill"> <?php echo $row_approved; ?></span></a>


	                                    <!-- DISPLAY PENDING -->
												              <?php   
												                $pending = mysqli_query($conn, "SELECT loan_list_Id FROM loan_list WHERE status=0");
												                $row_pending = mysqli_num_rows($pending);
												              ?>
	                                    <a class="nav-link" href="loan_list_pending.php">Pending &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge bg-warning rounded-pill"> <?php echo $row_pending; ?></span></a></a>


	                                    

	                                    <!-- DISPLAY DENIED -->
												              <?php   
												                $denied = mysqli_query($conn, "SELECT loan_list_Id FROM loan_list WHERE status=3");
												                $row_denied= mysqli_num_rows($denied);
												              ?>
	                                    <a class="nav-link" href="view_loan_list_rejected.php">Rejected &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge bg-danger rounded-pill"> <?php echo $row_denied; ?></span></a>



	                                    <!-- DISPLAY CANCELLED -->
												              <?php   
												                $cancel = mysqli_query($conn, "SELECT loan_list_Id FROM loan_list WHERE status=4");
												                $row_cancel= mysqli_num_rows($cancel);
												              ?>
	                                    <a class="nav-link" href="view_loan_list_cancelled.php">Cancelled &nbsp;&nbsp;<span class="badge bg-secondary rounded-pill"> <?php echo $row_cancel; ?></span></a>

	                                </nav>
	                            </div>



	                            <a class="nav-link" href="loan_type.php">
	                                <div class="sb-nav-link-icon"><i class="bi bi-bookmark-check-fill"></i></div>
	                                Types of Loan
	                            </a>


	                            <a class="nav-link" href="payments.php">
	                                <div class="sb-nav-link-icon"><i class="bi bi-credit-card-2-back-fill"></i></div>
	                                Payments
	                            </a>


	                            <!-- <a class="nav-link" href="loan_plans.php">
	                                <div class="sb-nav-link-icon"><i class="bi bi-bookmark-check-fill"></i></div>
	                                Loan Plans
	                            </a> -->



	                            <div class="sb-sidenav-menu-heading">Transaction history</div>

	                            <a class="nav-link" href="history.php">
	                                <div class="sb-nav-link-icon"><i class="bi bi-clock-history"></i></div>
	                                Transaction history
	                            </a>
	                            
	                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts_akoy-nag-ilis-nani" aria-expanded="false" aria-controls="collapseLayouts_akoy-nag-ilis-nani">
	                                <div class="sb-nav-link-icon"><i class="bi bi-people-fill"></i></div>
	                                System Users
	                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
	                            </a>


	                            <div class="collapse" id="collapseLayouts_akoy-nag-ilis-nani" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
	                                <nav class="sb-sidenav-menu-nested nav">
	                                    <a class="nav-link" href="staff.php">Employees and Staff</a>
	                                    <a class="nav-link" href="users.php">Registered users</a>
	                                </nav>
	                            </div>


	                           <!--  <div class="sb-sidenav-menu-heading">Logout</div>
	                            <a class="nav-link" type="button" data-bs-toggle="modal" data-bs-target="#logoutmodal">
	                                <div class="sb-nav-link-icon"><i class="bi bi-door-closed-fill"></i></div>
	                                Logout
	                            </a> -->
	                           
	                        </div>
	                    </div>
	                    <div class="sb-sidenav-footer">
	                        <div class="small">Welcome,</div>
	                        <?php echo $row['firstname'].' '.$row['lastname']; ?> !
	                    </div>
	                </nav>
	            </div>


	          <!-------------------------------LOGOUT MODAL------------------------------------>
				<!-- The Modal -->
				<div class="modal fade" id="logoutmodal">
				  <div class="modal-dialog">
				    <div class="modal-content">

				      <!-- Modal Header -->
				      <div class="modal-header">
				        <h5 class="modal-title">Admin logout</h5>
				        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				      </div>
				      
				        <!-- Modal body -->
				        <div class="modal-body">
				        
				          <?php if($row['gender'] === 'Male'):?>
				              <h6>Mr.   <?php echo $row['lastname'];?>, are you sure you want to logout?</h6>
				          <?php else: ?>
				              <h6>Ma'am <?php echo $row['lastname'];?>, are you sure you want to logout?</h6>
				          <?php endif; ?>
				        </div>

				        <!-- Modal footer -->
				        <div class="modal-footer">
				              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Close</button>
				              <a class="btn btn-primary" href="../logout.php"><i class="bi bi-check-circle"></i> Confirm</a>
				        </div>
				        
				    </div>
				  </div>
				</div>


<!-------------------------------END LOGOUT MODAL-------------------------------->
		<?php } ?>
        

				<!-- CAN BE DELETEd ############################################################################################ -->
        <!-- FOR CHARTS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../assets/js/chart-area-demo.js"></script>
        <script src="../assets/js/chart-bar-demo.js"></script>
        <!-- END FOR CHARTS -->
        <!-- CAN BE DELETEd ############################################################################################ -->


        <!-- POPPER -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <!-- END POPPER -->

        <!-- TOGGLER -->
        <script src="../js/scripts.js"></script>
        <!-- END TOGGLER -->

        <!-- ALERT MESSAGES TIMEOUT  -->
        <script src="../js/jquery.min.js"></script>
        <!-- END ALERT MESSAGES TIMEOUT  -->

        <!-- DATATABLES -->
        <script src="../js/datatables-simple-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
         <!-- END DATATABLES -->
       	<script src="../sweetalert2.min.js"></script>
        <?php include 'sweetalert_messages.php'; ?>

    </body>
</html>



<script>
  //-----------------------------ALERT TIMEOUT-------------------------//
  $(document).ready(function() {
      setTimeout(function() {
          $('.alert').hide();
      } ,5000);
  }
  );
//-----------------------------END ALERT TIMEOUT---------------------//

</script>

<?php
// ------------------------------CLOSING THE SESSION OF THE LOGGED IN USER WITH else statement----------//
    } else {
     header('Location: ../index.php');
    }
?>
