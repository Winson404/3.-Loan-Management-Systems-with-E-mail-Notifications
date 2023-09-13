
<!-- CREATE NEW LOAN TYPE MODAL -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create plan type</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="process_save.php" method="POST">

      
          <div class="mb-3">
            <label for=""><b>Type of Loan</b></label>
            <select name="loan_type" id="" class="form-select">
              <option selected disabled>Select type of Loan</option>
            <?php 
              $fetch = mysqli_query($conn, "SELECT * FROM loan_types");
              while ($row = mysqli_fetch_array($fetch)) {
            ?>
            <option value="<?php echo $row['loan_Id']; ?>"><?php echo $row['loan_name']; ?></option>
          <?php } ?>
          </select>
          </div>
          
          <div class="mb-3">
            <label for=""><b>Plan (Months)</b></label>
            <input type="number" class="form-control input" name="plan" required>
          </div>


        <!--   <div class="mb-3">
            <label for=""><b>Interest (%)</b></label>
            <input type="number" class="form-control input" name="interest" required>
          </div> 
          <div class="mb-3">
            <label for=""><b>Monthly overdue penalty (%)</b></label>
            <input type="number" class="form-control input" name="penalty" required>
          </div> -->
          
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Close</button>
        <button type="submit" class="btn btn-primary" name="save_loan_plan"><i class="bi bi-save"></i> Save</button>
      </div>
      </form>
    </div>
  </div>
</div>


