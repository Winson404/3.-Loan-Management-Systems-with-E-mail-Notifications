<?php 
    include 'sidebar.php'; 
    $id = $_SESSION['user_id'];

    $fetch = mysqli_query($conn, "SELECT * FROM users WHERE user_Id='$id'");
    $row = mysqli_fetch_array($fetch);

    
?>

<div id="layoutSidenav_content" class="bg-primary ">
<main>
    <div class="container mb-4">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="card shadow-lg border-0 rounded-lg mt-3">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Types of Loans</h3></div>
                    <div class="card-body">




                            <div class="row mb-3 d-flex justify-content-center">
				                    <div>
				                      <!-- <h3 class="text-center"><b>Types of Loan</b></h3> -->
				                    </div>
				                    
				                      <?php 
				                        $fetch2 = mysqli_query($conn, "SELECT * FROM loan_types ORDER BY loan_name asc");
				                        while($row_types = mysqli_fetch_array($fetch2)){
				                      ?>
				                      <div class="card mb-2 py-3" style="width: 18rem; margin: 10px;">
				                      	<a href="single_loan_plan_and_type.php?loan_id=<?php echo $row_types['loan_Id']; ?>" style="text-decoration: none;">
				                      	<img src="../images-loan/<?php echo $row_types["loan_image"];?>" alt="" class="img-fluid" style="height: 200px;">
				                        <div class="card-body">
				                          <h5 class="card-title text-primary"><b><?php echo $row_types['loan_name']; ?></b></h5>
				                          <p class="card-text"><?php echo $row_types['loan_description'];?></p></a>
				                        </div>
				                      </div>
				                    <?php } ?>
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


                            <!-- <div class="mt-4 mb-0">
                                <div class="d-grid"><a class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#loan<?php //echo $row['user_Id']; ?>">APPLY NOW!</a></div>
                            </div> -->

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