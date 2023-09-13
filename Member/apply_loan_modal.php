<style>
  .input {
    border:  1px solid lightgrey;
  }
  .hidden{
        display: none;
        }
</style>



<!-- Modal -->
<div class="modal fade" id="loan<?php echo $loan_Id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Loan application</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="process_save.php" method="POST">
          <input type="hidden" class="form-control mb-3" name="name" value="<?php echo $row_user["firstname"]; echo ' '; echo $row_user["middlename"]; echo ' '; echo $row_user["lastname"]; echo ' '; echo $row_user["suffix"];?>">
          <input type="hidden" class="form-control" value="<?php echo $row_user['email']; ?>" name="email">
          <input type="hidden" class="form-control" value="<?php echo $row_user['user_Id']; ?>" name="borrower_id">
          <input type="hidden" class="form-control" value="<?php echo $row_user['contact']; ?>" name="borrower_contact">
          <input type="hidden" class="form-control" value="<?php echo $loan_Id; ?>" name="selected_loan_type">
          <div class="form-group mb-3">
            <label for=""><b>Type of Loan</b></label>
            <select class="form-select type_of_Loan" aria-label="Default select example" name="loan_type_name" required id="demo">
              <option selected disabled>Select loan type</option>
              <?php 
                  $plan = mysqli_query($conn, "SELECT * FROM loan_types ORDER BY loan_name ASC");
                  while ($row_type_fetch = mysqli_fetch_array($plan)){
              ?>
              <option value="<?php echo $row_type_fetch['loan_name']; ?>" <?php if($row_type_fetch['loan_Id'] == $loan_Id) { echo 'selected'; } ?>><?php echo $row_type_fetch['loan_name'];?></option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group mb-3">
            <label for=""><b>Amount</b></label>
            <input type="number" class="form-control input amount" name="amount" placeholder="Enter amount" required onkeyup="mult(this.value);">
          </div>

          <div class="form-group mb-3">
            <label for=""><b>Terms of Loan</b></label>
            <select class="form-select loan_terms" aria-label="Default select example" name="terms_of_loan" required id="month">
              <option selected disabled>Terms of Loan</option>
              <option value="12" id="12">12 Months</option>
              <option value="24" id="24">24 months</option>
              <option value="36" id="36">36 months</option>
              <!-- <option value="12" class="hidden" id="12">12 Months</option>
              <option value="24" class="hidden" id="24">24 months</option>
              <option value="36" class="hidden" id="36">36 months</option> -->
            </select>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <div class="form-group mb-3">
                <label for=""><b>Interest(%)</b></label>
                <input type="number" class="form-control input" name="interest_rate" placeholder="Interest rate" required id="rates" readonly>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group mb-3">
                <label for=""><b>Weekly Overdue penalty(%)</b></label>
                <input type="number" class="form-control input" name="monthly_overdue_penalty" placeholder="Weekly Overdue penalty" required readonly id="penalty">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <div class="form-group mb-3">
                <label for=""><b>Weekly payment</b></label>
                <input type="number" class="form-control input" name="monthly_payable_amount" placeholder="Weekly payment" required id="payment" readonly>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group mb-3">
                <label for=""><b>Total Amount to pay</b></label>
                <input type="number" class="form-control input" name="total_amount_to_pay" placeholder="Total Amount to pay" required readonly id="total">
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for=""><b>Purpose</b></label>
            <textarea name="purpose" id="" cols="30" rows="3" class="form-control input"></textarea>
          </div>

    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Close</button>
        <button type="submit" class="btn btn-primary" name="save_application"><i class="bi bi-save"></i> Save</button>
      </div>
      </form>
    </div>
  </div>
</div>


<script> 

    


     function mult(value) {

        // var months = $("#month").val();
        var amount = value; //loanable amount
        var rate, y;
        rate = amount/2*0.01*13;
        y = rate * amount;

        // RESET VALUES
        var r =  document.getElementById('rates').value = "";
        var pa =  document.getElementById('payment').value = "";
        var pe =  document.getElementById('penalty').value = "";
        var t =  document.getElementById('total').value = "";
        $("#month")[0].selectedIndex = 0;

        
        if(amount == "") {
            document.getElementById('month').disabled = true;
        } else {
          document.getElementById('month').disabled = false;
        }
      } 
  

    

</script> 


<script>
  $('.loan_terms').change(function(){

    var loan_terms = $(this).val();
    var amount = $(".amount").val();
    var rate, result_payment, sum_payment, penalty;

    if(loan_terms == 12) {

      rate = amount/2*0.01*13;
      var rate_result = document.getElementById('rates').value = rate.toFixed(2);

      sum_payment = parseInt(rate)+parseInt(amount);
      document.getElementById('total').value = sum_payment.toFixed(2);
      result_payment = sum_payment/12;
      document.getElementById('payment').value = result_payment.toFixed(2);

      penalty = amount*0.01*12;
      document.getElementById('penalty').value = penalty.toFixed(2);

    } else  if(loan_terms == 24) {

      rate = amount/2*0.01*25;
      var rate_result = document.getElementById('rates').value = rate.toFixed(2);
      
      sum_payment = parseInt(rate)+parseInt(amount);
      document.getElementById('total').value = sum_payment.toFixed(2);
      result_payment = sum_payment/24;
      document.getElementById('payment').value = result_payment.toFixed(2);

      penalty = amount*0.01*24;
      document.getElementById('penalty').value = penalty.toFixed(2);

    } else {

      rate = amount/2*0.01*37;
      var rate_result = document.getElementById('rates').value = rate.toFixed(2);
      
      sum_payment = parseInt(rate)+parseInt(amount);
      document.getElementById('total').value = sum_payment.toFixed(2);
      result_payment = sum_payment/37;
      document.getElementById('payment').value = result_payment.toFixed(2);

      penalty = amount*0.01*36;
      document.getElementById('penalty').value = penalty.toFixed(2);

    }


  });
</script>



<script>
  //   $('.type_of_Loan').change(function(){

  //   var type_of_Loans = $(this).val();

  //   if(type_of_Loans =="Regular Loan") {

  //     $('#12').removeClass("hidden");
  //     $('#12').addClass("show"); 
  //     $('#24').removeClass("hidden");
  //     $('#24').addClass("show"); 
  //     $('#36').removeClass("hidden");
  //     $('#36').addClass("show"); 

  //   } else if(type_of_Loans == "Appliance Loan" || type_of_Loans == "Educational Loan") {
  
  //     $('#12').removeClass("hidden");
  //     $('#12').addClass("show"); 

  //     $('#24').removeClass("show");
  //     $('#24').addClass("hidden");

  //     $('#36').removeClass("show");
  //     $('#36').addClass("hidden");

  //   } else if(type_of_Loans == "Special Loan") {
  
  //     $('#12').removeClass("show");
  //     $('#12').addClass("hidden"); 

  //     $('#24').removeClass("show");
  //     $('#24').addClass("hidden");

  //     $('#36').removeClass("hidden");
  //     $('#36').addClass("show");

  //   } else {

  //     $('#12').addClass("hidden");
  //     $('#24').addClass("hidden");
  //     $('#36').addClass("hidden");

  //   }
  // //console.log(responseID);
  // });


</script>

