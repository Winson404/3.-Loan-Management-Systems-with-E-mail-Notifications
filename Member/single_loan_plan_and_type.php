<?php 
    include 'sidebar.php'; 
    $id = $_SESSION['user_id'];

    if(isset($_GET['loan_id']))

    $loan_Id = $_GET['loan_id'];

    $fetch = mysqli_query($conn, "SELECT * FROM loan_types WHERE loan_Id='$loan_Id'");
    $row = mysqli_fetch_array($fetch);

    $fetch_user = mysqli_query($conn, "SELECT * FROM users WHERE user_Id='$id'");
    $row_user = mysqli_fetch_array($fetch_user);

    include 'apply_loan_modal.php';
?>

<div id="layoutSidenav_content" class="bg-primary ">
<main>
    <div class="container mb-4">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="card shadow-lg border-0 rounded-lg mt-3">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Selected Type of Loan</h3></div>
                    <div class="card-body">




                            <div class="row mb-3 d-flex justify-content-center">
				                    <div>
				                      <!-- <h3 class="text-center"><b>Types of Loan</b></h3> -->
				                    </div>
				                    
				                      <div class="card mb-2 py-3" style="width: 18rem; margin: 10px;">
				                      	<a href="f.php" style="text-decoration: none;">
				                      	<img src="../images-loan/<?php echo $row["loan_image"];?>" alt="" class="img-fluid" style="height: 200px;">
				                        <div class="card-body">
				                          <h5 class="card-title text-primary"><b><?php echo $row['loan_name']; ?></b></h5>
				                          <p class="card-text"><?php echo $row['loan_description'];?></p></a>
				                        </div>
				                      </div>
			                </div>

			                <!-- <div class="row mb-3 d-flex justify-content-center"> -->
				                   <!--  <div>
				                      <h3 class="text-center"><b>Loan Plans</b></h3>
				                    </div> -->
				                    
				                      <?php 
				                        // $fetch = mysqli_query($conn, "SELECT * FROM loan_plans ORDER BY plan asc");
				                        // while($row_plan = mysqli_fetch_array($fetch)){
				                      ?>
				                     <!--  <div class="card mb-2 py-3" style="width: 18rem; margin: 10px;">
				                        <div class="card-body">
				                          <h5 class="card-title text-primary"><b><?php// echo $row_plan['plan']; ?> months</b></h5>
					                      <h6 class="card-subtitle mb-2 text-muted"><?php //echo $row_plan['interest']; echo '%'; ?> interest</h6>
					                      <p class="card-text"><?php //echo $row_plan['monthly_penalty']; echo '%'; ?> monthly due penalty</p>
				                        </div>
				                      </div> -->
				                    <?php// } ?>
                            <!-- </div> -->


                            <div class="mt-4 mb-0">
                                <div class="d-grid"><a class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#loan<?php echo $loan_Id; ?>">APPLY NOW!</a></div>
                            </div>

                    </div>
                    <div class="card-footer text-center py-3">
                        <div class="small"><a href="#" style="text-decoration: none;">You are currently viewing your loan types and applications.</a></div>
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