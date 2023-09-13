
<!-- Modal -->
<div class="modal fade" id="re-apply_loan<?php echo $row['user_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Re-apply member loan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="process_update.php" method="POST">
      <div class="modal-body">
      
          <!-- <input type="hidden" class="form-control" name="payment_Id" value="<?php echo $row['payment_Id']; ?>">  -->
          
          <input type="hidden" class="form-control" name="loan_list_Id" value="<?php echo $row['loan_list_Id']; ?>"> 
          <input type="hidden" class="form-control mb-3" name="receiver" value="<?php echo $row['contact']; ?>">
          
          <p>Re-apply <strong><?php echo $row["firstname"]; echo ' '; echo $row["middlename"]; echo ' '; echo $row["lastname"]; echo ' '; echo $row["suffix"];?>'s</strong> loan application?</p> 

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Close</button>
        <button type="submit" class="btn btn-primary" name="re-apply_loan"><i class="bi bi-save"></i> Confirm</button>
      </div>
      </form>
    </div>
  </div>
</div>