
<!-- Modal -->
<div class="modal fade" id="release_loan<?php echo $row['user_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Release member loan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="process_update.php" method="POST">
      <div class="modal-body">

          <!-- <input type="hidden" class="form-control" name="payment_Id" value="<?php// echo $row['payment_Id']; ?>">  -->
          <input type="hidden" class="form-control" name="loan_name" value="<?php echo $row['loan_type_name']; ?>">
          <input type="hidden" class="form-control" name="amount" value="<?php echo $row['amount']; ?>">
          <input type="hidden" class="form-control" name="monthly_payable_amount" value="<?php echo $row['monthly_payable_amount']; ?>">
          <input type="hidden" class="form-control" name="total_amount_to_pay" value="<?php echo $row['total_amount_to_pay']; ?>">
          <input type="hidden" class="form-control" name="plan" value="<?php echo $row["terms_of_loan"]; ?> months - <?php echo $row["interest_rate"]; ?> interest - <?php echo $row["monthly_overdue_penalty"]; ?> monthly overdue penalty">

          <input type="hidden" class="form-control" name="user_Id" value="<?php echo $row['user_Id']; ?>">
          <input type="hidden" class="form-control mb-3" name="user_email" value="<?php echo $row['email']; ?>">
          <input type="hidden" class="form-control mb-3" name="name" value="<?php echo $row["firstname"]; echo ' '; echo $row["middlename"]; echo ' '; echo $row["lastname"]; echo ' '; echo $row["suffix"];?>">


          <input type="hidden" class="form-control" name="loan_list_Id" value="<?php echo $row['loan_list_Id']; ?>"> 
          <input type="hidden" class="form-control mb-3" name="receiver" value="<?php echo $row['contact']; ?>">
          <input type="hidden" class="form-control mb-3" name="payment_Id" value="<?php echo $row['payment_Id']; ?>">
          
          <p>Release <strong><?php echo $row["firstname"]; echo ' '; echo $row["middlename"]; echo ' '; echo $row["lastname"]; echo ' '; echo $row["suffix"];?>'s</strong> loan application?</p> 

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Close</button>
        <button type="submit" class="btn btn-primary" name="release_loan"><i class="bi bi-save"></i> Confirm</button>
      </div>
      </form>
    </div>
  </div>
</div>