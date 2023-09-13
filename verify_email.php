  <?php 
  include 'navbar.php'; 
  // include 'login_member_modal.php'; 
  // include 'login_employee_modal.php';
  include 'config.php';


  if(isset($_GET['code'])) {
  $code = $_GET['code'];

  $select = mysqli_query($conn, "SELECT * FROM users WHERE vkey='$code'");
  $row = mysqli_fetch_array($select);

  
?>



<!-- ======= GIVE BACKGROUND COLOR FOR NAVBAR: GI CUSTOMIZED NAKO NI ======= -->
  <div id="hero" style="height: 73px;"></div>
<!-- ======= GIVE BACKGROUND COLOR FOR NAVBAR: GI CUSTOMIZED NAKO NI ======= -->

  <main id="main">

      <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Email Verification</h2>

              <?php if(isset($_SESSION['success'])) { ?> 
                  <p class="alert text-success" role="alert"><b><?php echo $_SESSION['success']; ?></b></p> 
              <?php unset($_SESSION['success']); } ?>


              <?php if(isset($_SESSION['invalid']) && isset($_SESSION['error'])) { ?>
                  <h6 class="alert text-danger" role="alert"><b><?php echo $_SESSION['invalid']; ?> <?php echo $_SESSION['error']; ?></b></h6>
              <?php unset($_SESSION['invalid']);  unset($_SESSION['error']);  } ?>


              <?php  if(isset($_SESSION['exists'])) { ?>
                  <h6 class="alert text-danger" role="alert"><b><?php echo $_SESSION['exists']; ?></b></h6>
              <?php unset($_SESSION['exists']); } ?>

        </div>

        <div class="row">

          <div class="" style="border:1px solid lightgrey;">
            <form action="verify_code.php" method="post" enctype="multipart/form-data">
              <div class="row p-5 d-flex justify-content-center">
                  
                  <div class="col-lg-5">
                    <div class="form-group mb-3">
                      <input type="hidden" class="form-control" value="<?php echo $row['vkey']; ?>" name="code">
                      <input type="text" class="form-control text-center" placeholder="Enter code" required name="code">
                    </div>
                    <div class="form-group  d-flex justify-content-center">
                      <button type="submit" class="btn btn-primary" name="verify_code">Verify</button>
                    </div>
                  </div>

                
              </div>

            </form>
          </div>
<?php } ?>
        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->


<?php include 'footer.php'; ?>