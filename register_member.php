<?php 
  include 'navbar.php'; 
  // include 'login_member_modal.php'; 
  // include 'login_employee_modal.php';
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"/>

<!-- ======= GIVE BACKGROUND COLOR FOR NAVBAR: GI CUSTOMIZED NAKO NI ======= -->
  <div id="hero" style="height: 73px;"></div>
<!-- ======= GIVE BACKGROUND COLOR FOR NAVBAR: GI CUSTOMIZED NAKO NI ======= -->

  <main id="main">

      <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Member registration</h2>

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

          <div class="col-lg-11 mt-5 mt-lg-0 d-flex align-items-stretch rounded p-4 bg-light" style="border:1px solid lightgrey;">
            <form action="processes.php" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="form-group col-md-4 mb-4">
                  <label for="firstname">First name</label>
                  <input type="text" class="form-control" id="firstname" name="firstname" required onkeyup="lettersOnly(this)" id="fname">
                </div>
                <div class="form-group col-md-3 mb-4">
                  <label for="middlename">Middle name</label>
                  <input type="text" class="form-control" id="middlename" name="middlename"required onkeyup="lettersOnly(this)" id="mname">
                </div>
                <div class="form-group col-md-3 mb-4">
                  <label for="lastname">Last name</label>
                  <input type="text" class="form-control" id="lastname" name="lastname" required onkeyup="lettersOnly(this)">
                </div>
                <div class="form-group col-md-2 mb-4">
                  <label for="suffix">Suffix</label>
                  <input type="text" class="form-control" id="suffix" name="suffix">
                </div>
                <div class="form-group col-md-3 mb-4">
                  <label for="gender">Gender</label>
                  <select class="form-control form-select" id="gender" name="gender" required>
                    <option value="" selected disabled>Select your gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
                <div class="form-group col-md-3 mb-4">
                  <label for="dob">Date of Birth</label>
                  <input type="date" class="form-control" id="dob" name="dob" required>
                </div>
                <div class="form-group col-md-2 mb-4">
                  <label for="age">Age</label>
                  <input type="number" class="form-control" id="age" name="age" required>
                </div>
                <div class="form-group col-md-4 mb-4">
                  <label for="contact">Contact number</label>
                  <input type="number" class="form-control" id="contact" name="contact" required>
                </div>
                <div class="form-group col-md-4 mb-4">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" required>
                </div>
                 <div class="form-group col-md-4 mb-4">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" name="password" required id="mynewpassword">
                  <i class="fas fa-eye-slash show_hide" style="position: absolute;top: 340px; left: 700px;"></i>
                  <div class="indicator">
                  <div class="icon-text">
                    <!-- <i class="fas fa-exclamation-circle error_icon"></i> -->
                    <h6 class="text"></h6>
                  </div>
                </div>
                </div>

                <div class="form-group col-md-4 mb-4">
                  <label for="cpassword">Confirm password</label>
                  <input type="password" class="form-control" name="cpassword" required id="myconfirmpassword" onkeyup="validate_password()">
                  <h6 id="wrong_pass_alert" class="text"></h6>
                </div>
                <div class="form-group col-md-12 mb-4">
                  <label for="address">Address</label>
                  <textarea class="form-control" cols="30" rows="3" id="address" name="address" required></textarea>
                </div>
                <div class="form-group col-lg-6 mb-4">
                  <label for="fileToUpload">Image</label>
                  <input type="file" class="form-control" id="fileToUpload" name="fileToUpload" required onchange="getImagePreview(event)">
                </div>
                <div class="form-group col-lg-6 mb-4">
                    <div class="form-group" id="preview">
                    </div>
                </div>
                
              </div>
              
            <!--   <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div> -->

              <div class="text-center mt-3"><button type="submit" class="btn btn-primary" name="register_member" id="register">Register</button></div>
              <!-- <p>Already have an account? <a href="" data-bs-toggle="modal" data-bs-target="#memberlogin">Click here!</a></p> -->
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->


<?php include 'footer.php'; ?>


<!-- PASSWORD STRENGTH -->
<script>

const input = document.querySelector("#mynewpassword"),
showHide = document.querySelector(".show_hide"),
indicator = document.querySelector(".indicator"),
iconText = document.querySelector(".icon-text"),
text = document.querySelector(".text");

// js code to show & hide password

showHide.addEventListener("click", ()=>{
  if(input.type === "password"){
    input.type = "text";
    showHide.classList.replace("fa-eye-slash","fa-eye");
  }else {
    input.type = "password";
    showHide.classList.replace("fa-eye","fa-eye-slash");
  }
});


let alphabet = /[a-zA-Z]/, //letter a to z and A to Z
    numbers = /[0-9]/, //numbers 0 to 9
    scharacters = /[!,@,#,$,%,^,&,*,?,_,(,),-,+,=,~]/; //special characters

  input.addEventListener("keyup", ()=>{
  indicator.classList.add("active");

  let val = input.value;
  if(val.match(alphabet) || val.match(numbers) || val.match(scharacters)){
    text.textContent = "Password is weak";
    // text2.textContent = "Must be at least 6 characters.";
    // text3.textContent = "At least one special character.";
    // input.style.borderColor = "#FF6333";
    // showHide.style.color = "#FF6333";
    iconText.style.color = "red";
    document.getElementById('register').disabled = true;
  }
  if(val.match(alphabet) && val.match(numbers) || val.length >= 6){
    text.textContent = "Password is medium";
    // input.style.borderColor = "#cc8500";
    // showHide.style.color = "#cc8500";
    iconText.style.color = "#cc8500";
    document.getElementById('register').disabled = true;
  }
  if(val.match(alphabet) && val.match(numbers) && val.match(scharacters) && val.length >= 8){
    text.textContent = "Password is strong";
    // input.style.borderColor = "#22C32A";
    // showHide.style.color = "#22C32A";
    iconText.style.color = "green";
    document.getElementById('register').disabled = true;
  }

  if(val == ""){
    indicator.classList.remove("active");
    // input.style.borderColor = "#A6A6A6";
    // showHide.style.color = "#A6A6A6";
    iconText.style.color = "#A6A6A6";
    document.getElementById('register').disabled = true;
  }
});
</script>







<script>
   function getImagePreview(event)
  {
    var image=URL.createObjectURL(event.target.files[0]);
    var imagediv= document.getElementById('preview');
    var newimg=document.createElement('img');
    var text=document.createElement('p');
    text.innerHTML='Image preview';
    text.style['position']="relative";
    text.style['margin-left']="185px";
    text.style['margin-top']="10px";
    text.style['font-weight']="bold";
    imagediv.innerHTML='';
    newimg.src=image;
    newimg.width="90";
    newimg.height="90";
    newimg.style['border-radius']="50%";
    newimg.style['display']="block";
    newimg.style['margin-left']="auto";
    newimg.style['margin-right']="auto";
    newimg.style['box-shadow']="rgba(100, 100, 111, 0.2) 0px 7px 29px 0px";
    imagediv.appendChild(newimg);
    imagediv.appendChild(text);
  }

</script>

<script>
    function validate_password() {

      var pass = document.getElementById('mynewpassword').value;
      var confirm_pass = document.getElementById('myconfirmpassword').value;
      if (pass != confirm_pass) {
        document.getElementById('wrong_pass_alert').style.color = 'red';
        document.getElementById('wrong_pass_alert').innerHTML = 'X Password did not matched!';
        document.getElementById('register').disabled = true;
        document.getElementById('register').style.opacity = (0.4);
      } else {
        document.getElementById('wrong_pass_alert').style.color = 'green';
        document.getElementById('wrong_pass_alert').innerHTML = '✓ Password matched!';
        document.getElementById('register').disabled = false;
        document.getElementById('register').style.opacity = (1);
      }
    }


    function lettersOnly(input) {
      var regex = /[^a-z ]/gi;
      input.value = input.value.replace(regex, "");
    }

</script>