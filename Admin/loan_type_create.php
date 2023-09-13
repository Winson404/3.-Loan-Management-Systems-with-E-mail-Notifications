

<!-- CREATE NEW LOAN TYPE MODAL -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create loan type</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="process_save.php" method="POST" enctype="multipart/form-data">
          
          <div class="form-group col-lg-12 mb-4">
              <div class="form-group" id="preview">
              </div>
          </div>

          <div class="col-md-12 mb-3">
            <label for=""><b>Name of Loan</b></label>
            <input type="text" class="form-control input" name="name" required>
          </div>
          <div class="col-md-12 mb-3">
            <label for=""><b>Description</b></label>
            <input type="text" class="form-control input" name="description" required>
          </div>

          <div class="form-group col-lg-12 mb-4">
            <label for="fileToUpload">Image</label>
            <input type="file" class="form-control" id="fileToUpload" name="fileToUpload" required onchange="getImagePreview(event)">
          </div>
          
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Close</button>
        <button type="submit" class="btn btn-primary" name="save_loan_type"><i class="bi bi-save"></i> Save</button>
      </div>
      </form>
    </div>
  </div>
</div>