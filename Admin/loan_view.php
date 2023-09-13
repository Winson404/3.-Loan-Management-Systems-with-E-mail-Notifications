<?php 
    include 'sidebar.php'; 
   if(isset($_GET['loan_id'])) {
    $loan_id = $_GET['loan_id'];
  

    $fetch = mysqli_query($conn, "SELECT * FROM loan_list JOIN loan_types ON loan_list.loan_type_name=loan_types.loan_name JOIN users ON loan_list.borrower_id=users.user_Id WHERE loan_list.loan_list_Id='$loan_id'");
    $row = mysqli_fetch_array($fetch);

    // include 'apply_loan_modal.php';

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
                                  <p><b>Application date:</b> <?php echo $row['date_created'] ?></p>
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

                              <div class="col-md-12 mb-4">
                                  <label for=""><b>Borrower name</b></label>
                                  <input type="text" readonly class="form-control" value="<?php echo $row['firstname']; echo ' '; echo $row['middlename']; echo ' '; echo $row['lastname']; echo ' '; echo $row['suffix'];?>">
                              </div>

                              <div class="col-md-6 mb-4">
                                  <label for=""><b>Type of Loan</b></label>
                                  <input type="text" readonly class="form-control" value="<?php echo $row['loan_type_name']; ?>">
                              </div>
                              <div class="col-md-6 mb-4">
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
                         <!-- <input type="hidden" class="form-control" name="payment_Id" value="<?php// echo $row['payment_Id']; ?>">  -->
         

                         <div class="mt-4 mb-0">
                            <div class="d-grid">
                              <!-- PENDING -->
                              <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#reject"><i class="bi bi-x-circle"></i> Reject application</button>
                            </div>
                         </div>


                    </div> 
                    <!-- END CARD BODY -->

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






<!-- CANCEL Modal -->
<div class="modal fade" id="reject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reject member application</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="process_update.php" method="POST">
          <input type="hidden" class="form-control" name="loan_name" value="<?php echo $row['loan_name']; ?>">
          <input type="hidden" class="form-control" name="amount" value="<?php echo $row['amount']; ?>">
          <input type="hidden" class="form-control" name="monthly_payable_amount" value="<?php echo $row['monthly_payable_amount']; ?>">
          <input type="hidden" class="form-control" name="total_amount_to_pay" value="<?php echo $row['total_amount_to_pay']; ?>">
          <!-- <input type="hidden" class="form-control" name="plan" value="<?php// echo $row["plan"]; ?> months - <?php //echo $row["interest"]; ?>% interest - <?php// echo $row["monthly_penalty"]; ?>% monthly overdue penalty"> -->

          <input type="hidden" class="form-control" name="user_Id" value="<?php echo $row['user_Id']; ?>">
          <input type="hidden" class="form-control mb-3" name="user_email" value="<?php echo $row['email']; ?>">
          <input type="hidden" class="form-control mb-3" name="name" value="<?php echo $row["firstname"]; echo ' '; echo $row["middlename"]; echo ' '; echo $row["lastname"]; echo ' '; echo $row["suffix"];?>">
        <p>Reject this application?</p>
        <input type="hidden" class="form-control" value="<?php echo $row['loan_list_Id']; ?>" name="loan_list_Id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Close</button>
        <button type="submit" class="btn btn-warning" name="reject_application"><i class="bi bi-check-circle"></i> Confirm</button>
      </div>
      </form>
    </div>
  </div>
</div>




<?php } ?>

<!-- DO NOT DELETE END DIV TAG -->
    </div>
<!-- DO NOT DELETE END DIV TAG -->