<?php include 'navbar.php'; ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"/>

<!-- ======= GIVE BACKGROUND COLOR FOR NAVBAR: GI CUSTOMIZED NAKO NI ======= -->
  <div id="hero" style="height: 73px;"></div>
<!-- ======= GIVE BACKGROUND COLOR FOR NAVBAR: GI CUSTOMIZED NAKO NI ======= -->

  <?php 
       if(isset($_GET['page'])) {
        $page = $_GET['page'];
          if($page == 'employee') {
  ?>

        <main id="main">
          <!-- ======= Contact Section ======= -->
          <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">
                <div class="d-flex justify-content-center login">
                  <img src="images/user.png" alt="" width="60">
                </div>
              <div class="section-title">
                <h2>EMPLOYEE LOGIN</h2>
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
              <div class="row justify-content-center">
                <div class="col-lg-4 rounded p-4 bg-light" style="border:1px solid lightgrey;">
                  <form action="processes.php" method="post" >
                    <div class="row d-flex justify-content-center">
                          <div class="mb-3 mt-2">
                            <input type="email" class="form-control text-center" name="email" placeholder="Email@mail.com">
                          </div>
                          <div class="mb-3">
                            <input type="password" class="form-control text-center mb-1" name="password" id="password" placeholder="Password">
                            <input type="checkbox" onclick="myFunction()"> <span type="button" onclick="myFunction()" >Show Password</span>
                          </div>
                    </div>
                    <div class="text-center mt-2"><button type="submit" class="btn btn-primary" name="employer_login" style="width: 100%;">Login</button></div>
                    <p id="link">Don't have an account? <a href="register_employee.php">Click here!</a></p>
                  </form>
                </div>
              </div>
            </div>
          </section><!-- End Contact Section -->

        </main><!-- End #main -->

  <?php } else { ?>

        <main id="main">

          <!-- ======= Contact Section ======= -->
          <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">
                <div class="d-flex justify-content-center login">
                  <img src="images/user.png" alt="" width="60">
                </div>
              <div class="section-title">
                <h2>MEMBER LOGIN</h2>
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
              <div class="row justify-content-center">
                <div class="col-lg-4 rounded p-4 bg-light" style="border:1px solid lightgrey;">
                  <form action="processes.php" method="post" >
                    <div class="row d-flex justify-content-center">
                          <div class="mb-3 mt-2">
                            <input type="email" class="form-control text-center" name="email" placeholder="Email@mail.com">
                          </div>
                          <div class="mb-3">
                            <input type="password" class="form-control text-center mb-1" name="password" id="password" placeholder="Password">
                             <input type="checkbox" onclick="myFunction()"> <span type="button" onclick="myFunction()" >Show Password</span>
                          </div>
                    </div>
                    <div class="text-center mt-2"><button type="submit" class="btn btn-primary" name="member_login" style="width: 100%;">Login</button></div>
                    <p id="link">Don't have an account? <a href="register_member.php">Click here!</a></p>
                  </form>
                </div>
              </div>
            </div>
          </section><!-- End Contact Section -->

        </main><!-- End #main -->

    <?php } } else { echo '<script>alert("Page cannot be accessed!");</script>'; } ?>



<?php include 'footer.php'; ?>

<script>
  function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>