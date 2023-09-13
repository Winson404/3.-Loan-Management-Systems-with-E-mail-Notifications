    <title>Loan plans | LM System </title>
 <?php 
    include 'sidebar.php';
 ?>

 <div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
        <h4 class="mt-4">Payments</h4>
        <div class="card mb-4">
                <div class="card-header">
                    <!-- <i class="fas fa-table me-1"></i>
                    Types of Loan -->
                    <!-- <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-plus-square"></i> Add new</button> -->
                </div>

                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                              <!--  <th>ID Number</th> -->
                               <th>Borrower</th> 
                               <th>Total loan</th>
                               <th>Bal.</th> 
                               <th>Last payment</th>
                                 
                               <th>Last date payment</th>
                               <th>Next date payment</th>    
                               <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                               $i = 1;
                               include("../config.php");

                               $query ="SELECT * FROM loan_list JOIN users ON loan_list.borrower_id=users.user_Id JOIN payment ON users.user_Id=payment.borrower_Id WHERE payment.payment_status='ON' AND loan_list.status=2 ";
                               // $query ="SELECT * FROM loan_list LEFT JOIN payment ON loan_list.loan_list_Id=payment.payment_loan_list_Id JOIN users ON loan_list.borrower_id=users.user_Id WHERE loan_list.status='2' LIMIT 1";
                               $result = mysqli_query($conn,$query);
                               while($row = mysqli_fetch_assoc($result))
                                {
                             ?>
                              <tr>
                                  <!-- <td><?php //echo $i++; ?></td> -->
                                  <td><?php echo $row['firstname']; echo ' '; echo $row['middlename']; echo ' '; echo $row['lastname']; echo ' '; echo $row['suffix']; ?></td>
                                  <td><span class="badge bg-primary rounded">₱ <?php echo number_format((float)$row["total_amount_to_pay"], 2, '.', '');?></span></td>
                                  
                                  
                                  <td>
                                    <?php if($row['balance'] != ""): ?>
                                    <span class="badge bg-danger rounded">₱ <?php echo number_format((float)$row["balance"], 2, '.', '');?></span>
                                    <?php else: ?>

                                    <span class="badge bg-danger rounded">₱ <?php echo number_format((float)$row["total_amount_to_pay"], 2, '.', '');?></span>
                                    <?php endif; ?> 

                                  </td>
                                  <td><span class="badge bg-warning">₱ <?php echo number_format((float)$row["paid_amount"], 2, '.', '');?></span></td>
                                  <td><span class="badge bg-secondary rounded"><?php echo date("F d, Y", strtotime($row["paid_date"])); ?></span></td>
                                  <td><?php echo date("F d, Y", strtotime($row["next_paid_date"])); ?></td>
                                  <td>
                                    <button class="btn btn-primary" data-bs-toggle="modal" type="button" data-bs-target="#app_payment<?php echo $row["loan_list_Id"];?>"><i class="bi bi-plus-square"></i> </button>
                                    <!-- <button class="btn btn-success" data-bs-toggle="modal" type="button" data-bs-target="#update_loan<?php// echo $row['payment_Id']; ?>"><i class="bi bi-pencil-square"></i> </button> -->
                                    <!-- <button class="btn btn-danger" data-bs-toggle="modal" type="button" data-bs-target="#delete_plan<?php //echo $row['payment_Id']; ?>"><i class="bi bi-trash"></i> </button> -->
                                  </td>    

                                  <?php  ?> 
                                             
                            </tr>
                            <?php  
                                include 'payments_create.php';
                               }    
                            ?>

                        </tbody>
                    </table>
                </div>
                  
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>

</div>



<!-- DO NOT DELETE END DIV TAG -->
    </div>
<!-- DO NOT DELETE END DIV TAG -->