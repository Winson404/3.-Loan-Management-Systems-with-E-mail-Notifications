 <title>Employee & Staff | LM System </title>
 <?php 
    include 'sidebar.php';
 ?>

 <div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
        <h4 class="mt-4">Employees and Staff</h4>
        <div class="card mb-4">
                <div class="card-header">
                    <!-- <i class="fas fa-table me-1"></i>
                    Types of Loan -->
                    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addnewstaff"><i class="bi bi-plus-square"></i> Add new</button>
                </div>

                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                               <th>ID Number</th>
                               <th>Image</th> 
                               <th>Full name</th>    
                               <th>Contact</th>
                               <th>Date registered</th>
                               <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                               $i = 1;
                               include("../config.php");
                               $query ="SELECT * FROM employees WHERE user_type!='2'";
                               $result = mysqli_query($conn,$query);
                               while($row = mysqli_fetch_assoc($result))
                                {
                             ?>
                              <tr>
                                  <td><?php echo $i++; ?></td>
                                  <td>
                                    <img src="../images-employees/<?php echo $row['image'];?>" class="d-block m-auto" style="width: 35px; height: 35px;border: 3px solid #e6f2ff; border-radius: 50%;" alt="image">
                                  </td>
                                  <td><?php echo $row["firstname"];?> <?php echo $row["middlename"];?> <?php echo $row["lastname"];?> <?php echo $row["suffix"];?></td>
                                  <td><?php echo $row["contact"];?></td>
                                  <td><?php echo date("F d, Y", strtotime($row["date_registered"]));?></td>
                                  <td>
                                    <button class="btn btn-primary" data-bs-toggle="modal" type="button" data-bs-target="#view_emp<?php echo $row['emp_Id']; ?>"><i class="bi bi-eye"></i> </button>
                                    <button class="btn btn-success" data-bs-toggle="modal" type="button" data-bs-target="#update_emp<?php echo $row['emp_Id']; ?>"><i class="bi bi-pencil-square"></i> </button>
                                    <button class="btn btn-danger" data-bs-toggle="modal" type="button" data-bs-target="#del_emp<?php echo $row['emp_Id']; ?>"><i class="bi bi-trash"></i> </button>
                                    <button class="btn btn-warning" data-bs-toggle="modal" type="button" data-bs-target="#pass_emp<?php echo $row['emp_Id']; ?>"><i class="bi bi-key"></i> </button>
                                  </td>      

                                  <?php 
                                      include 'staff_update.php'; 
                                      include 'staff_view.php';
                                      include 'staff_change_password.php';  
                                  ?>             
                            </tr>
                            <?php  
                                include 'staff_delete.php';   
                               }    
                            ?>

                        </tbody>
                    </table>
                </div>
                 <?php include 'staff_create.php'; ?>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>

</div>



<!-- DO NOT DELETE END DIV TAG -->
    </div>
<!-- DO NOT DELETE END DIV TAG -->