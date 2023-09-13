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
                            $paid = mysqli_query($conn, "SELECT loan_list_Id FROM loan_list WHERE borrower_id='$id' AND status=5");
                            $row_paid = mysqli_num_rows($paid);
                        ?>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-info text-white mb-4">
                                <div class="card-body"><i class="bi bi-check-circle-fill"></i> Fully paid
                                    <h1 class="text-center"> <?php echo $row_paid; ?></h1>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="loan_paid.php">View All</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>


                        <!-- DISPLAY RELEASED -->
                        <?php 
                            $released = mysqli_query($conn, "SELECT loan_list_Id FROM loan_list WHERE borrower_id='$id' AND status=2");
                            $row_released = mysqli_num_rows($released);
                        ?>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body"><i class="bi bi-check-circle"></i> Released
                                <h1 class="text-center"><?php echo $row_released; ?></h1>
                                </div>

                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="loan_released.php">View All</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>



                        <!-- DISPLAY APPROVED -->
                        <?php   
                          $approved = mysqli_query($conn, "SELECT loan_list_Id FROM loan_list WHERE borrower_id='$id' AND status=1");
                          $row_approved= mysqli_num_rows($approved);
                        ?>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body"><i class="bi bi-check2-all"></i> Approved
                                    <h1 class="text-center"><?php echo $row_approved; ?></h1>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="loan_approved.php">View All</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>


                        <!-- DISPLAY PENDING -->
                        <?php   
                          $pending = mysqli_query($conn, "SELECT loan_list_Id FROM loan_list WHERE borrower_id='$id' AND status=0");
                          $row_pending = mysqli_num_rows($pending);
                        ?>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body"><i class="bi bi-hourglass-top"></i> Pending
                                    <h1 class="text-center"><?php echo $row_pending; ?></h1>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="loan_pending.php">View All</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>



                        <!-- DISPLAY DENIED -->
                        <?php   
                          $denied = mysqli_query($conn, "SELECT loan_list_Id FROM loan_list WHERE borrower_id='$id' AND status=3");
                          $row_denied= mysqli_num_rows($denied);
                        ?>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body"><i class="bi bi-exclamation-triangle"></i> Rejected
                                    <h1 class="text-center"><?php echo $row_denied; ?></h1>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="loan_rejected.php">View All</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>



                        <!-- DISPLAY CANCELLED -->
                        <?php 
                          $cancel = mysqli_query($conn, "SELECT loan_list_Id FROM loan_list WHERE borrower_id='$id' AND status=4");
                          $row_cancel = mysqli_num_rows($cancel);
                        ?>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-secondary text-white mb-4">
                                <div class="card-body"><i class="bi bi-dash-circle"></i> Cancelled
                                    <h1 class="text-center"><?php echo $row_cancel; ?></h1>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="loan_cancelled.php">View All</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
            </main>
            <?php include 'footer.php'; ?>
        </div>



<!-- DO NOT DELETE END DIV TAG -->
    </div>
<!-- DO NOT DELETE END DIV TAG -->