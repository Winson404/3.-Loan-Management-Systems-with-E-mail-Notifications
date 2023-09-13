<?php 
    include 'sidebar.php'; 
    $id = $_SESSION['user_id'];

    $fetch = mysqli_query($conn, "SELECT * FROM loan_list JOIN users ON loan_list.borrower_id=users.user_Id AND users.user_Id='$id'");
    $row = mysqli_fetch_array($fetch);

    include 'apply_loan_modal.php';

    $interest = $row['total_amount_to_pay'] - $row['amount'];
?>

<div id="layoutSidenav_content" class="bg-primary ">
<main>
    <div class="container mb-4">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="card shadow-lg border-0 rounded-lg mt-3">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Applied loan</h3></div>
                    <div class="card-body">



  
                         <div class="row">
                               <div class="d-flex col-md-12">
                                <div class="justify-content-start ">
                                  <p><b>Reference no:</b> <span class="text-primary bg-light rounded p-2"><b><?php echo $row['ref_no'] ?></b></span> </p>
                                </div>

                                <div class="justify-content-end px-5" style="position: absolute; right: 0;">
                                  <p><b>Application date:</b> <?php echo date("F d, Y", strtotime($row['date_created'])); ?></p>
                                </div>
                              </div>

                              <div class="d-flex mb-3">
                                <?php if($row['status'] === '0'): ?>
                                <p><b>Status:</b> <span class="badge bg-danger p-1">Pending</span></p>

                                <?php elseif($row['status'] === '1'): ?>
                                <p><b>Status:</b> <span class="badge bg-primary p-1">Approved</span></p>

                                <?php elseif($row['status'] === '2'): ?>
                                <p><b>Status:</b> <span class="badge bg-success p-1">Released</span></p>

                                <?php elseif($row['status'] === '3'): ?>
                                <p><b>Status:</b> <span class="badge bg-danger p-1">Denied</span></p>

                                <?php else: ?>
                                <p><b>Status:</b> <span class="badge bg-danger p-1">Cancelled</span></p>

                                <?php endif; ?>
                              </div>

                              <div class="col-md-6 mb-4">
                                  <label for=""><b>Type of Loan</b></label>
                                  <input type="text" readonly class="form-control" value="<?php echo $row['loan_type_name']; ?>">
                              </div>
                              <div class="col-md-12 mb-4">
                                  <label for=""><b>Chosen Plan</b> (Duration - Interest - Weekly overdue penalty)</label>
                                  <input type="text" readonly class="form-control" value="<?php echo $row['terms_of_loan']; echo ' '; echo 'months'; echo ' - ';  echo $row['interest_rate']; echo ' '; echo ' interest'; echo ' - '; echo $row['monthly_overdue_penalty']; echo ' '; echo ' penalty'; ?>">
                              </div>
                              <div class="col-md-4">
                                  <label for=""><b>Amount borrowed</b></label>
                                  <input type="text" readonly class="form-control" value="<?php echo '₱ '; echo number_format((float)$row['amount'], 2, '.', ''); ?>">
                              </div>
                              <div class="col-md-4 mb-4">
                                  <label for=""><b>Interest</b></label>
                                  <input type="text" readonly class="form-control" value="<?php echo '₱ '; echo number_format((float)$interest, 2, '.', ''); ?>">
                              </div>
                               <div class="col-md-4 mb-4">
                                  <label for=""><b>Total payable amount</b></label>
                                  <input type="text" readonly class="form-control" value="<?php echo '₱ '; echo number_format((float)$row['total_amount_to_pay'], 2, '.', ''); ?>">
                              </div>
                              <div class="col-md-4 mb-4">
                                  <label for=""><b>Weekly payable amount</b></label> 
                                  <input type="text" readonly class="form-control" value="<?php echo '₱ '; echo  number_format((float)$row['monthly_payable_amount'], 2, '.', '') ; ?>">

                                  <!-- ROUNDED AMOUNT -->
                                 <!--  <input type="text" readonly class="form-control" value="<?php //echo '₱ '; echo  round(number_format((float)$row['monthly_payable_amount'], 2, '.', '')); ?>"> -->
                              </div>
                              <div class="col-md-4 mb-4">
                                  <label for=""><b>Weekly overdue penalty</b></label>
                                  <input type="text" readonly class="form-control" value="<?php echo '₱ '; echo number_format((float)$row['monthly_overdue_penalty'], 2, '.', ''); ?>">

                                  <!-- ROUNDED AMOUNT -->
                                  <!-- <input type="text" readonly class="form-control" value="<?php //echo '₱ '; echo round(number_format((float)$row['monthly_overdue_penalty'], 2, '.', '')); ?>">  -->
                              </div>
                         </div>   


                         <div class="mt-4 mb-0">
                            <div class="d-grid">
                              <!-- PENDING -->
                              <?php if($row['status'] === '0'): ?>
                              <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#cancel"><i class="bi bi-x-circle"></i> Cancel application</button>

                              <!-- CANCELLED -->
                              <?php elseif($row['status'] === '4'): ?>
                              <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#reapply"><i class="bi bi-check-circle"></i> Re-apply application</button>

                              <?php else: ?>
                              <!-- HIDE THE BUTTON RE-APPLY or CANCELLED -->
                              <button class="btn btn-success d-none" type="button" data-bs-toggle="modal" data-bs-target="#reapply"><i class="bi bi-check-circle"></i> Re-apply application</button>

                              <?php endif; ?>
                            </div>
                         </div>


                    </div> 
                    <!-- END CARD BODY -->

                    <div class="card-footer text-center py-3">
                        <div class="small"><a href="#" style="text-decoration: none;">You are currently viewing your applied loan details.</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
 <?php include 'footer.php'; ?>
</div>






<!-- CANCEL Modal -->
<div class="modal fade" id="cancel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cancel application</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="process_update.php" method="POST">
        <h5>Are you sure you want to cancel your application?</h5>
        <input type="hidden" class="form-control" value="<?php echo $row['loan_list_Id']; ?>" name="loan_list_Id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Close</button>
        <button type="submit" class="btn btn-warning" name="cancel_application"><i class="bi bi-check-circle"></i> Confirm</button>
      </div>
      </form>
    </div>
  </div>
</div>



<!-- RE-APPLY Modal -->
<div class="modal fade" id="reapply" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Re-apply application</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="process_update.php" method="POST">
        <h5>Are you sure you want to re-apply this application?</h5>
        <input type="hidden" class="form-control" value="<?php echo $row['loan_list_Id']; ?>" name="loan_list_Ids">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Close</button>
        <button type="submit" class="btn btn-primary" name="reapply_application"><i class="bi bi-check-circle"></i> Re-apply</button>
      </div>
      </form>
    </div>
  </div>
</div>




<!-- DO NOT DELETE END DIV TAG -->
    </div>
<!-- DO NOT DELETE END DIV TAG -->