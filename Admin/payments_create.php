

<!-- Modal -->
<div class="modal fade" id="app_payment<?php echo $row["loan_list_Id"];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="process_save.php" method="POST">

          <input type="hidden" class="form-control" value="<?php echo $row["loan_list_Id"];?>" name="loan_list_Id">

          <input type="hidden" class="form-control" value="<?php echo $row["payment_Id"];?>" name="payment_Id">

          <input class="form-control" type="hidden" value="<?php echo $row["total_amount_to_pay"];?>" name="total_amount_to_pay">

          <div class="col-md-12 mb-3">
            <label for=""><b>Borrower name</b></label>
            <select class="form-control " name="borrower" id="" required>
              <!-- <option value="" selected disabled>Select borrower</option> -->
              <?php 
                  $loan_list_Id = $row["loan_list_Id"];
                  $fetch = mysqli_query($conn, "SELECT * FROM users JOIN loan_list ON users.user_Id=loan_list.borrower_id WHERE loan_list.status=2 AND loan_list_Id='$loan_list_Id'");
                  while($row = mysqli_fetch_array($fetch)) {
              ?>
              <option value="<?php echo $row['user_Id']; ?>"><?php echo $row['firstname']; echo ' '; echo $row['middlename']; echo ' '; echo $row['lastname']; echo ' '; echo $row['suffix']; ?></option>
            <?php } ?>
            </select>
          </div>
          <div class="col-md-12 mb-3">
            <label for=""><b>Amount to pay</b></label>
            <input type="number" class="form-control input" name="amount" required>
          </div>
          
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Close</button>
        <button type="submit" class="btn btn-primary" name="payment"><i class="bi bi-save"></i> Save</button>
      </div>
      </form>
    </div>
  </div>
</div>