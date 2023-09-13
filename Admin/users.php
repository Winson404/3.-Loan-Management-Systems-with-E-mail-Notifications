 <title>Registered users | LM System </title>
 <?php 
    include 'sidebar.php';
 ?>

 <div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
        <h4 class="mt-4">Registered users</h4>
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
                               <th>Account status</th>
                               <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                               $i = 1;
                               include("../config.php");
                               $query ="SELECT * FROM users";
                               $result = mysqli_query($conn,$query);
                               while($row = mysqli_fetch_assoc($result))
                                {
                             ?>
                              <tr>
                                  <td><?php echo $i++; ?></td>
                                  <td>
                                    <img src="../images-member/<?php echo $row['image'];?>" class="d-block m-auto" style="width: 35px; height: 35px;border: 3px solid #e6f2ff; border-radius: 50%;" alt="image">
                                  </td>
                                  <td><?php echo $row["firstname"];?> <?php echo $row["middlename"];?> <?php echo $row["lastname"];?> <?php echo $row["suffix"];?></td>
                                  <td><?php echo $row["contact"];?></td>
                                  <td><?php echo date("F d, Y", strtotime($row["date_registered"]));?></td>
                                   <td>
                                       <?php if($row['users_status'] ==0): ?>
                                        <span class="badge bg-success">Approved</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger" data-bs-toggle="modal" type="button" data-bs-target="#unblock<?php echo $row['user_Id']; ?>">Blocked</span>
                                    <?php endif; ?>
                                    <?php  include 'users_unblock.php'; ?>
                                   </td>
                                  <td>
                                    <button class="btn btn-primary" data-bs-toggle="modal" type="button" data-bs-target="#view_mem<?php echo $row['user_Id']; ?>"><i class="bi bi-eye"></i> </button>
                                    <button class="btn btn-success" data-bs-toggle="modal" type="button" data-bs-target="#update_mem<?php echo $row['user_Id']; ?>"><i class="bi bi-pencil-square"></i> </button>
                                    <button class="btn btn-danger" data-bs-toggle="modal" type="button" data-bs-target="#del_mem<?php echo $row['user_Id']; ?>"><i class="bi bi-trash"></i> </button>
                                    <button class="btn btn-warning" data-bs-toggle="modal" type="button" data-bs-target="#pass_mem<?php echo $row['user_Id']; ?>"><i class="bi bi-key"></i> </button>
                                  </td>      

                                  <?php 
                                       include 'users_update.php'; 

                                       include 'users_view.php';
                                        
                                       include 'users_change_password.php'; 
                                  ?>             
                            </tr>

                            <?php  
                                      
                                include 'users_delete.php'; 
                               }    
                            ?>

                        </tbody>
                    </table>
                    <p><b>NOTE:</b> <span> To <span class="text-danger"><b>unblock</b></span> member's account, just click <b>blocked</b> status.</span></p>
                </div>
                 <?php include 'users_create.php'; ?>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>

</div>



<!-- DO NOT DELETE END DIV TAG -->
    </div>
<!-- DO NOT DELETE END DIV TAG -->