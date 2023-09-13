<?php 
    include 'sidebar.php'; 
    $id = $_SESSION['admin_id'];

    $admin = mysqli_query($conn, "SELECT * FROM employees WHERE emp_Id='$id'");
    $row = mysqli_fetch_array($admin);
?>

<div id="layoutSidenav_content" class="bg-primary">
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light m-0 pt-3">Change password</h3>
                        <p class="text-xs text-center">Make your password more secured.</p>
                    </div>
                    <div class="card-body">
                    <form action="process_update.php" method="POST">

                        <input type="hidden" class="form-control" name="emp_Id" value="<?php echo $row['emp_Id']; ?>">
                        
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
                    </form>
                    </div>
                    <div class="card-footer justify-content-end d-flex py-3">
                        <button class="btn btn-primary float-right" type="submit" name="password_emp"><i class="bi bi-save"></i> Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</div>


<!-- DO NOT DELETE END DIV TAG -->
    </div>
<!-- DO NOT DELETE END DIV TAG -->