<title>Loan plans | LM System </title>
 <?php 
    include 'sidebar.php';
 ?>

 <div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
        <h4 class="mt-4">Loan Plans</h4>
        <div class="card mb-4">
                <div class="card-header">
                    <!-- <i class="fas fa-table me-1"></i>
                    Types of Loan -->
                    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-plus-square"></i> Add new</button>
                </div>

                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                               <!-- <th>ID Number</th> -->
                               <th>Type of Loan</th>
                               <th>Plan (months)</th> 
                               <!-- <th>Interest (%)</th>
                               <th>Monthly overdue penalty (%)</th>    --> 
                               <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                               $i = 1;
                               include("../config.php");
                               $query ="SELECT * FROM loan_plans LEFT JOIN loan_types ON loan_plans.plan_loan_type_Id=loan_types.loan_Id ORDER BY plan desc";
                               $result = mysqli_query($conn,$query);
                               while($row = mysqli_fetch_assoc($result))
                                {
                             ?>
                              <tr>
                                  <!-- <td><?php //echo $i++; ?></td> -->
                                  <td><?php echo $row["loan_name"];?></td>
                                  <td><?php echo $row["plan"];?> months</td>
                                <!--   <td><?php// echo $row["interest"];?> %</td>
                                  <td><?php //echo $row["monthly_penalty"];?> %</td> -->
                                  <td>
                                    <button class="btn btn-success" data-bs-toggle="modal" type="button" data-bs-target="#update_loan<?php echo $row['plan_Id']; ?>"><i class="bi bi-pencil-square"></i> </button>
                                    <button class="btn btn-danger" data-bs-toggle="modal" type="button" data-bs-target="#delete_plan<?php echo $row['plan_Id']; ?>"><i class="bi bi-trash"></i> </button>
                                  </td>    

                                  <?php include 'loan_plans_update.php';  ?>             
                            </tr>
                            <?php  
                                include 'loan_plans_delete.php';  
                               }    
                            ?>

                        </tbody>
                    </table>
                </div>
                 <?php include 'loan_plans_create.php'; ?>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>

</div>



<!-- DO NOT DELETE END DIV TAG -->
    </div>
<!-- DO NOT DELETE END DIV TAG -->