<title>List of Loans | LM System </title>
 <?php 
    include 'sidebar.php';
 ?>

 <div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
        <h4 class="mt-4">List of paid loans</h4>
        <div class="card mb-4">
                <div class="card-header">
                    <!-- <i class="fas fa-table me-1"></i>
                    Types of Loan -->
                    <!-- <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-plus-square"></i> Add new</button> -->
                </div>

                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Ref. Number</th>
                                <th>Borrower Name</th> 
                                <th>Type of Loan</th> 
                                <th>Loan Plan</th>  
                                <th>Total Amount to Pay</th> 
                                <th>Status</th>
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                              $i = 1;
                              include("../config.php");
                              $query = mysqli_query($conn, "SELECT * FROM loan_list JOIN users ON loan_list.borrower_id=users.user_Id WHERE status=5");
                              // $query =mysqli_query($conn, "SELECT * FROM loan_list JOIN users ON loan_list.borrower_id=users.user_Id JOIN loan_types ON loan_list.loan_type_id=loan_types.loan_Id JOIN loan_plans ON loan_list.plan_id=loan_plans.plan_Id LEFT JOIN payment ON loan_list.borrower_id=payment.borrower_Id ");
                              while($row = mysqli_fetch_assoc($query))
                               {

                             ?>
                              <tr>
                                  <td><?php echo $row["ref_no"];?></td>
                                  <td><?php echo $row["firstname"]; echo ' '; echo $row["middlename"]; echo ' '; echo $row["lastname"]; echo ' '; echo $row["suffix"];?></td>
                                  <td><?php echo $row["loan_type_name"];?></td>
                                  <td>
                                    <p><b><?php echo $row["terms_of_loan"]; ?></b> months</p>
                                    <p><b>₱ <?php echo $row["interest_rate"]; ?></b> interest</p>
                                    <p><b>₱ <?php echo $row["monthly_overdue_penalty"]; ?></b> weekly overdue penalty</p>
                                    <p><b>₱ <?php echo $row["monthly_payable_amount"]; ?></b> weekly payable amount</p>
                                  </td>
                                  <td>₱<?php echo $row["total_amount_to_pay"];?></td>
                                  <td>
                                      
                                        <?php if($row['status'] === '0'): ?>
                                        <span class="badge bg-danger rounded-pill" data-bs-toggle="modal" type="button" data-bs-target="#approve_loan<?php echo $row['user_Id']; ?>">Pending </span>

                                        <?php elseif($row['status'] === '1'): ?>
                                        <span class="badge bg-primary rounded-pill" data-bs-toggle="modal" type="button" data-bs-target="#release_loan<?php echo $row['user_Id']; ?>">Approved</span>


                                        <?php elseif($row['status'] === '2'): ?>
                                        <span class="badge bg-success rounded-pill">Released</span>


                                        <?php elseif($row['status'] === '3'): ?>
                                        <span class="badge bg-danger rounded-pill">Denied</span>

                                        <?php elseif($row['status'] === '4'): ?>
                                        <span class="badge bg-secondary rounded-pill">Cancelled</span>

                                        <?php else: ?>
                                        <span class="badge bg-info rounded-pill">Paid</span>


                                        <?php endif; ?>
                                        

                                  </td>
                                 <!--  <td>
                                    <button class="btn btn-success rounded-pill" data-bs-toggle="modal" type="button" data-bs-target="#update_loan<?php// echo $row['loan_Id']; ?>"><i class="bi bi-pencil-square"></i> </button>
                                    <button class="btn btn-danger rounded-pill" data-bs-toggle="modal" type="button" data-bs-target="#delete_loan<?php //echo $row['loan_Id']; ?>"><i class="bi bi-trash"></i> </button>
                                  </td> -->  

                                  <?php //include 'loan_list_approve.php';  include 'loan_list_release.php'; ?>             
                            </tr>
                            <?php  
                                //include 'loan_type_delete.php'; 
                               }    
                            ?>

                        </tbody>
                    </table>
                </div>
                 <?php //include 'loan_type_create.php'; ?>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>

</div>



<!-- DO NOT DELETE END DIV TAG -->
    </div>
<!-- DO NOT DELETE END DIV TAG -->