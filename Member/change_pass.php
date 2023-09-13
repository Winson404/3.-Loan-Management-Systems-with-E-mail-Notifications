<?php 
    include 'sidebar.php'; 
    $id = $_SESSION['user_id'];

    $fetch = mysqli_query($conn, "SELECT * FROM users WHERE user_Id='$id'");
    $row = mysqli_fetch_array($fetch);

?>

<div id="layoutSidenav_content" class="bg-primary">
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header text-center">
                        <h3 class="font-weight-light m-0 pt-3">Change password</h3>
                        <a href="#" class="text-sm" style="text-decoration: none;">Make your password more secured.</a>
                    </div>
                    <div class="card-body">
                    <form action="process_update.php" method="POST">

                        <input type="hidden" class="form-control" name="user_Id" value="<?php echo $row['user_Id']; ?>">
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputPassword" type="password" placeholder="Old password" name="OldPassword" required />
                            <label for="inputPassword">Old password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputPassword" type="password" placeholder="New password" name="NewPassword" required />
                            <label for="inputPassword">New password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputPassword" type="password" placeholder="Confirm new password" name="ConfirmPassword" required />
                            <label for="inputPassword">Confirm new password</label>
                        </div>
                   
                    </div>
                    <div class="card-footer d-flex justify-content-end py-3">
                        <button class="btn btn-primary" type="submit" name="change_password_mem"><i class="bi bi-save"></i> Save</button>
                    </div>
                     </form>
                </div>
            </div>
        </div>
    </div>
</main>
</div>



<!-- DO NOT DELETE END DIV TAG -->
    </div>
<!-- DO NOT DELETE END DIV TAG -->