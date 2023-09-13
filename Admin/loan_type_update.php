<!-- Modal -->
<div class="modal fade" id="update_loan<?php echo $row['loan_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update loan type</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="process_update.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" class="form-control" name="loan_Id" value="<?php echo $row['loan_Id']; ?>">
          
          <div class="form-group col-lg-12 mb-4">
              <div class="form-group" id="updatepreview">
              </div>
          </div>

          <div class="mb-3">
            <label for=""><b>Name of Loan</b></label>
            <input type="text" class="form-control input" name="name" required value="<?php echo $row['loan_name']; ?>">
          </div>
          <div class="mb-3">
            <label for=""><b>Description</b></label>
            <input type="text" class="form-control input" name="description" required value="<?php echo $row['loan_description']; ?>">
          </div>

          <div class="form-group col-lg-12 mb-4">
            <label for="fileToUpload">Image</label>
            <input type="file" class="form-control" id="fileToUpload" name="fileToUpload"  onchange="updategetImagePreview(event)">
          </div>
          
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Close</button>
        <button type="submit" class="btn btn-success" name="update_loan_type"><i class="bi bi-save"></i> Save</button>
      </div>
      </form>
    </div>
  </div>
</div>