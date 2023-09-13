<title>Loan plans | LM System </title>
 <?php 
    include 'sidebar.php';
 ?>

 <div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
        <h4 class="mt-4">Transaction history</h4>
        <div class="card mb-4">
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                               <th>#</th>
                               <th>Borrower name</th>
                               <th>Amount paid</th>    
                               <th>Balance</th>
                               <th>Date paid</th> 
                               <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                               $i = 1;
                               include("../config.php");
                               $query ="SELECT * FROM payment JOIN users ON payment.borrower_Id=users.user_Id GROUP BY users.user_Id ORDER BY paid_date DESC";
                               $result = mysqli_query($conn,$query);
                               while($row = mysqli_fetch_assoc($result))
                                {
                                    $date = $row["paid_date"];
                             ?>
                              <tr>
                                  <td><?php echo $i++; ?></td>
                                  <td><?php echo $row["firstname"];?> <?php echo $row["middlename"];?> <?php echo $row["lastname"];?> <?php echo $row["suffix"];?></td>
                                  <td>₱ <?php echo number_format((float)$row["paid_amount"], 2, '.', '');?></td>
                                  <td>₱ <?php echo number_format((float)$row["balance"], 2, '.', '');?></td>
                                  <td><?php echo date("F d, Y", strtotime($date)); ?></td>
                                  <td><a href="history_byUser.php?user_Id=<?php echo $row['user_Id']; ?>">View more</a></td>
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