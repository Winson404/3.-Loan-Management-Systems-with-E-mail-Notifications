<!-- Modal -->
<div class="modal fade" id="view_mem<?php echo $row['user_Id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="staticBackdropLabel">Member info</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="process_update.php" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="d-flex justify-content-center mb-5">
            <style> img:hover { opacity: .8; } .camera {background-color: lightgrey; border-radius: 20%;} </style>
            <img src="../images-member/<?php echo $row['image']; ?>" alt="" style="width: 100px; height: 100px; border-radius: 50%;">
        </div>

        <div class="row">
          
           <input type="hidden" class="form-control" name="emp_Id" value="<?php echo $row['user_Id']; ?>">

           <div class="col-md-4 mb-3">
            <label for=""><b>First name</b></label>
            <input type="text" class="form-control" name="firstname" required value="<?php echo $row['firstname']; ?>" readonly>
          </div>

          <div class="col-md-4 mb-3">
            <label for=""><b>Middle name</b></label>
            <input type="text" class="form-control" name="middlename" required value="<?php echo $row['middlename']; ?>" readonly>
          </div>

          <div class="col-md-4 mb-3">
            <label for=""><b>Last name</b></label>
            <input type="text" class="form-control" name="lastname" required value="<?php echo $row['lastname']; ?>" readonly>
          </div>

          <div class="col-md-2 mb-3">
            <label for=""><b>Suffix</b></label>
            <input type="text" class="form-control" name="suffix" value="<?php echo $row['suffix']; ?>" readonly>
          </div>

          <div class="col-md-4 mb-3">
           <?php                           
                $gender  = mysqli_query($conn, "SELECT DISTINCT gender FROM users");
                $ids = $row['user_Id'];
                $all_gender = mysqli_query($conn, "SELECT * FROM users  where user_Id = '$ids' ");
                $row = mysqli_fetch_array($all_gender);
            ?>
                <label>Gender</label>
                 <select class="form-control form-select" name="gender" required="">
                  <?php foreach($gender as $rows):?>
                        <option value="<?php echo $rows['gender']; ?>"  
                            <?php if($row['gender'] == $rows['gender']) echo 'selected="selected"'; ?> 
                             > <!--/////   CLOSING OPTION TAG  -->
                            <?php echo $rows['gender']; ?>                                           
                        </option>

                 <?php endforeach;?>
               </select> 
          </div>

          <div class="col-md-4 mb-3">
            <label for=""><b>Date of Birth</b></label>
            <input type="date" class="form-control" name="dob" required value="<?php echo $row['dob']; ?>" readonly>
          </div>

          <div class="col-md-2 mb-3">
            <label for=""><b>Age</b></label>
            <input type="number" class="form-control" name="age" required value="<?php echo $row['age']; ?>" readonly>
          </div>

          <div class="col-md-6 mb-3">
            <label for=""><b>Contact</b></label>
            <input type="number" class="form-control" name="contact" required value="<?php echo $row['contact']; ?>" readonly>
          </div>

          <div class="col-md-6 mb-3">
            <label for=""><b>Email address</b></label>
            <input type="email" class="form-control" name="email" required value="<?php echo $row['email']; ?>" readonly>
          </div>

          <div class="col-md-12">
            <label for=""><b>Address</b></label>
            <input type="text" class="form-control" name="address" required value="<?php echo $row['address']; ?>" readonly>
          </div>

        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Close</button>
      </div>
      </form>
    </div>
  </div>
</div>











