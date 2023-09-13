<title>Cancelled Loan | LM System </title>
 <?php 
    include 'sidebar.php';
 ?>

 <div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
        <h4 class="mt-4">My cancelled application</h4>
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
                                <th>Loan #</th>
                                <th>Plan type</th>
                                <th>Loan amount</th> 
                                <th>Weekly</th>
                                <th>Total amount to pay</th>
                                <th>Weekly payable amount</th>    
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                              $i = 1;
                              include("../config.php");
                              $query ="SELECT * FROM loan_list JOIN users ON loan_list.borrower_id=users.user_Id WHERE loan_list.borrower_id='$id' AND loan_list.status=4";
                              $result = mysqli_query($conn,$query);
                              while($row = mysqli_fetch_assoc($result))
                               {

                             ?>
                              <tr>
                                  <td><?php echo $i++; ?></td>
                                  <td>
                                    <p><b><?php echo $row["terms_of_loan"];?></b> months<b></p>
                                    <p>₱ <b><?php echo $row["interest_rate"];?></b> interest rate<b></p>
                                    <p>₱ <b><?php echo $row["monthly_overdue_penalty"];?></b> monthly penalty<b></p>
                                  <td>₱ <?php echo $row["amount"];?></td>
                                  <td>₱ <?php echo $row["monthly_payable_amount"];?></td>
                                  <td>₱ <?php echo $row["total_amount_to_pay"];?></td>
                                  <td>₱ <?php echo $row["monthly_payable_amount"];?></td>
                                  <td>
                                    <a href="loan_view.php" class="btn btn-primary"><i class="bi bi-eye"></i></a>
                                  </td>  

                            </tr>
                            <?php  
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