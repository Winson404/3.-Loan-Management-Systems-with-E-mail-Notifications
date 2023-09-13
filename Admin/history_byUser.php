<title>Loan plans | LM System </title>
 <?php 
    include 'sidebar.php';
    if(isset($_GET['user_Id'])) {
        $user_Id = $_GET['user_Id'];
        $query =mysqli_query($conn, "SELECT * FROM payment JOIN users ON payment.borrower_Id=users.user_Id WHERE payment.borrower_id='$user_Id' ORDER BY paid_date DESC");
        $getName = mysqli_fetch_array($query);
 ?>

 <div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
        <h4 class="mt-4"><?php echo $getName["firstname"];?> <?php echo $getName["middlename"];?> <?php echo $getName["lastname"];?> <?php echo $getName["suffix"];?>'s <span class="text-muted">transaction history</span></h4>
        <div class="card mb-4">
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                               <th>#</th>
                               <th>Amount paid</th>    
                               <th>Balance</th>
                               <th>Date paid</th> 
                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                               $i = 1;
                               include("../config.php");
                               
                               while($row = mysqli_fetch_assoc($query))
                                {
                                    $date = $row["paid_date"];
                             ?>
                              <tr>
                                  <td><?php echo $i++; ?></td>
                                  <td>₱ <?php echo number_format((float)$row["paid_amount"], 2, '.', '');?></td>
                                  <td>₱ <?php echo number_format((float)$row["balance"], 2, '.', '');?></td>
                                  <td><?php echo date("F d, Y", strtotime($date)); ?></td>
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

<?php } else { echo '<script>alert("Page can not be accessed.");</script>'; } ?>



<!-- DO NOT DELETE END DIV TAG -->
    </div>
<!-- DO NOT DELETE END DIV TAG -->