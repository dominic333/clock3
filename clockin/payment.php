<?php include "header.html";

   session_start();
   $details = $_SESSION["c_details"];
   session_unset($_SESSION["c_details"]);
   $stat = $_GET["status"];
   $message = $_GET["message"];
   include "header.html";
   
   if($details["payment"] == "cc") {
      $payment_type = "Credit Card";
   }elseif($details["payment"] == "paypal") {
      $payment_type = "Paypal";
   }
?>
<section id="signup">
   <div class="container">
      <div class="row">
         <div class="col-sm-10 col-sm-offset-1">
         <?php if($detail["plan"] == "paid") {?>
                  <div class="form-group">
                        <div class="col-sm-4">
                           <label for="plan-details" class="control-label">Payment Status: </label>
                        </div>
                        <div class="col-sm-8">
                        <?php 
                        if($stat == "fail") {
                           echo '<label for="plan-details" class="control-label"><b>Failed</b></label>';
                           if($details["payment"] == "cc") {
                              echo "
                                 <div class='col-sm-12 no-padding'>
                                    <p> Error:&nbsp;&nbsp;&nbsp;$message </p>
                                    <p> Please contact us at <a href='mailto:ask@clock-in.me'>ask@clock-in.me</a> or call us +1617 778 2299</p>
                                 </div>
                              ";
                           }else echo $details["payment"];
                        }elseif($stat == "success"){
                           echo "<label for='plan-details' class='control-label'>$message</label>";
                        } 
                        
                        ?>
                        </div>
                  </div>
         <?php }else{?>
                  
                  <div class="form-group">
                        <div class="col-sm-12">
                           <label for="plan-details" class="control-label">Thank you. Please wait for yout confirmation email from our staff.</label>
                        </div>
                  </div>
                  <div class="link text-center">
                     <a href="index.php" class="btn btn-default btn-lg">BACK TO HOME</a>
                  </div>
         <?php } ?>
         </div>
      </div>
   </div>
</section>
<?php include "footer.html"; ?>