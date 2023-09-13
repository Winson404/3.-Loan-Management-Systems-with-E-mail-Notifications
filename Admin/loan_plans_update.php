
<!-- Modal -->
<div class="modal fade" id="update_loan<?php echo $row['plan_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update plan type</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="process_update.php" method="POST">
          
          <input type="hidden" class="form-control" name="plan_Id" value="<?php echo $row['plan_Id']; ?>">

          <?php                           
              $loan_name  = mysqli_query($conn, "SELECT * FROM loan_types");
              $loan_Id = $row['loan_Id'];
              $all_gender = mysqli_query($conn, "SELECT * FROM loan_plans where plan_loan_type_Id = '$loan_Id' ");
              $rowss = mysqli_fetch_array($all_gender);
          ?>
          <label><b>Type of Loan</b></label>
          <select class="form-select mb-3" name="loan_Id" required>
              <?php foreach($loan_name as $rows):?>
                    <option value="<?php echo $rows['loan_Id']; ?>"  
                        <?php if($rowss['plan_loan_type_Id'] == $rows['loan_Id']) echo 'selected="selected"'; ?> 
                         > <!--/////   CLOSING OPTION TAG  -->
                        <?php echo $rows['loan_name']; ?>                                           
                    </option>

             <?php endforeach;?>
           </select> 

          <div class="mb-3">
            <label for=""><b>Plan (Months)</b></label>
            <input type="number" class="form-control input" name="plan" required value="<?php echo $row['plan']; ?>">
          </div>
          <!-- <div class="mb-3">
            <label for=""><b>Interest</b></label>
            <input type="number" class="form-control input" name="interest" required value="<?php //echo $row['interest']; ?>">
          </div> 
          <div class="mb-3">
            <label for=""><b>Monthly overdue penalty</b></label>
            <input type="number" class="form-control input" name="penalty" required value="<?php //echo $row['monthly_penalty']; ?>">
          </div> -->
          
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Close</button>
        <button type="submit" class="btn btn-primary" name="update_plan"><i class="bi bi-save"></i> Save</button>
      </div>
      </form>
    </div>
  </div>
</div>