 <?php 
    include 'sidebar.php';
    ?>

         <div id="layoutSidenav_content">
             <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Loan applications</li>
                    </ol>
                    <div class="row">


                        <!-- DISPLAY FULLY PAID -->
                        <?php 
                            $paid = mysqli_query($conn, "SELECT loan_list_Id FROM loan_list WHERE status='5'");
                            $row_paid = mysqli_num_rows($paid);
                        ?>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-info text-white mb-4">
                                <div class="card-body"><i class="bi bi-check-circle-fill"></i> Fully paid
                                    <h1 class="text-center"> <?php echo $row_paid; ?></h1>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="view_loan_list_paid.php">View All</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>


                        <!-- DISPLAY RELEASED -->
                        <?php 
                            $released = mysqli_query($conn, "SELECT loan_list_Id FROM loan_list WHERE status='2'");
                            $row_released = mysqli_num_rows($released);
                        ?>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body"><i class="bi bi-check-circle"></i> Released
                                <h1 class="text-center"><?php echo $row_released; ?></h1>
                                </div>

                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="view_loan_list_released.php">View All</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>



                        <!-- DISPLAY APPROVED -->
                        <?php   
                          $approved = mysqli_query($conn, "SELECT loan_list_Id FROM loan_list WHERE status='1'");
                          $row_approved= mysqli_num_rows($approved);
                        ?>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body"><i class="bi bi-check2-all"></i> Approved
                                    <h1 class="text-center"><?php echo $row_approved; ?></h1>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="view_loan_list_approved.php">View All</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>


                        <!-- DISPLAY PENDING -->
                        <?php   
                          $pending = mysqli_query($conn, "SELECT loan_list_Id FROM loan_list WHERE status='0'");
                          $row_pending = mysqli_num_rows($pending);
                        ?>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body"><i class="bi bi-hourglass-top"></i> Pending
                                    <h1 class="text-center"><?php echo $row_pending; ?></h1>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="loan_list_pending.php">View All</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>



                        <!-- DISPLAY DENIED -->
                        <?php   
                          $denied = mysqli_query($conn, "SELECT loan_list_Id FROM loan_list WHERE status='3'");
                          $row_denied= mysqli_num_rows($denied);
                        ?>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body"><i class="bi bi-exclamation-triangle"></i> Rejected
                                    <h1 class="text-center"><?php echo $row_denied; ?></h1>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="view_loan_list_rejected.php">View All</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>



                        <!-- DISPLAY CANCELLED -->
                        <?php 
                          $cancel = mysqli_query($conn, "SELECT loan_list_Id FROM loan_list WHERE status='4'");
                          $row_cancel = mysqli_num_rows($cancel);
                        ?>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-secondary text-white mb-4">
                                <div class="card-body"><i class="bi bi-dash-circle"></i> Cancelled
                                    <h1 class="text-center"><?php echo $row_cancel; ?></h1>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="view_loan_list_cancelled.php">View All</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>




                        <!-- DISPLAY MEMBER -->
                        <?php 
                          $user = mysqli_query($conn, "SELECT user_Id FROM users");
                          $row_user = mysqli_num_rows($user);
                        ?>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body"><i class="bi bi-check-circle-fill"></i> Members
                                    <h1 class="text-center"><?php echo $row_user; ?></h1>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="users.php">View All</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>



                         <!-- DISPLAY EMPLOYEE AND STAFF -->
                        <?php 
                          $staff = mysqli_query($conn, "SELECT emp_Id FROM employees");
                          $row_staff = mysqli_num_rows($staff);
                        ?>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body"><i class="bi bi-check-circle-fill"></i> Employees and staff
                                    <h1 class="text-center"><?php echo $row_staff; ?></h1>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="staff.php">View All</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>



                    </div>
                    
                    
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Loan Management 2022</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>



<!-- DO NOT DELETE END DIV TAG -->
    </div>
<!-- DO NOT DELETE END DIV TAG -->