<?php include "header.html";?>
   <style>
      #contact-us {padding:8%}
      #contact-us h1 {visibility:hidden;}
      @media (max-width: 991px){
         #contact-us{padding:20% 0}
      }
      @media (min-width: 768px){
         #contact-form .form{float:right !important}
      }
      @media (max-width: 767px){
         #contact-form .footer img{padding: 15% 15% 0% 15%;}
      }
      #contact-form{margin-top:5%}
      #contact-form button{padding:1% 6%;margin-top: 2%;}
      #contact-form a{color:#413F41;font-weight:700}
      #contact-form .footer{margin-top:3%}
      #contact-form .footer .directory{margin-top:5%}
      .form-control{
         border: none;
         background-color: #EBEBEC;
         font-style: normal;
         margin-bottom: 2%;
      }
   </style>
   <section id="contact-us" class="header">
      <div class="container">
         <div class="row">
            <div class="col-md-8 col-md-10 col-md-offset-2 col-sm-offset-1 text-center">
            </div>
         </div>
      </div>
   </section>
   
   <section>
      <div class="container">
         <div class="row">
            <div class="col-sm-12 text-center">
               <p class="title">Get in touch</p>
            </div>
            <div class="col-sm-6 col-sm-offset-3 text-center">
               <p>For inquires, please use the form on the right. Our team will respond to your message within 24 hours</p>
            </div>
            <div class="col-sm-12" id="contact-form">
               <div class="col-sm-6 form">
               <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                  <input type="text" class="form-control" name="name" placeholder="Name" required>
                  <input type="text" class="form-control" name="contact" placeholder="Contact Number" required>
                  <input type="email" class="form-control" name="email" placeholder="Email" required>
                  <textarea class="form-control" rows="3" name="message" placeholder="Your Message" required></textarea>
                  <div class="g-recaptcha" data-sitekey="6LfHtyMTAAAAAFfE6nWxjliakebLBSKTqQIUwAxj"></div>
                  <button type="submit" class="btn btn-default btn-lg" name="submit">Send</button>
               </form>
               </div>
               <div class="col-sm-6 footer">
                  <div class="col-sm-12">
                     <div class="col-sm-6">
                        <img src="assets/clock-in-logo.png" class="img-responsive center-block">
                     </div>
                     <div class="col-sm-12 directory">
                        <p><i class="fa fa-volume-control-phone" aria-hidden="true"></i>&emsp;<a href="tel:+16177782299">+1617 778 2299</a></p>
                        <p><i class="fa fa-chrome" aria-hidden="true"></i>&emsp;<a href="http://www.clock-in.me">www.clock-in.me</a></p>
                        <p><i class="fa fa-envelope-o" aria-hidden="true"></i>&emsp;<a href="mailto:ask@clock-in.me">ask@clock-in.me</a></p>
                        
                     </div>
                     <div class="col-sm-12">
                        <hr>
                     </div>
                     <div class="col-md-4 social">
                        <div class="col-md-3 col-xs-3"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></div>
                        <div class="col-md-3 col-xs-3"><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></div>
                        <div class="col-md-3 col-xs-3"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></div>
                        <div class="col-md-3 col-xs-3"><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <script src="js/bootstrap.min.js"></script>
   
</body>
</html>

<?php 
   function clean($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
   }
   if(isset($_POST["submit"])){
      require_once "recaptchalib.php";
      $secret = "6LfHtyMTAAAAALBv2YZiZgQdLkiFoweluDbEjahk";
      $response = null;
      $reCaptcha = new ReCaptcha($secret);
      if ($_POST["g-recaptcha-response"]) {
         $response = $reCaptcha->verifyResponse(
            $_SERVER["REMOTE_ADDR"],
            $_POST["g-recaptcha-response"]
         );
      }
      if ($response != null && $response->success) {
         $fname = clean($_POST["name"]);
         $email = clean($_POST["email"]);
         $number = clean($_POST["contact"]);
         $message = clean($_POST["message"]);
         
         $body =  "Name : ".$fname."<br/>";
         $body .= "Email : ".$email."<br/>";
         $body .= "Contact Number : ".$number."<br/>";
         $body .= "Message : ".$message."<br/>";
         $body .= "<br/><br/>";
         $body .= "<br/><br/>";
         
         
         
         require_once('class.phpmailer.php');
         $mail = new PHPMailer();
         $mail->IsSMTP();				
         $mail->SMTPAuth = true; 
         $mail->Username = "smtp_flexi"; 
         $mail->Password = "1xaUvCpfPANkM"; 
         //$mail->SMTPDebug = 2;
         $mail->Host     = "mailgun.securesvr.net";
         $mail->Port     = "587";

         $mail->SetFrom($email, $fname);
         $mail->Subject = "Clockin Contact Us";
         $mail->Body = $body;	
         
         $mail->IsHTML(true);
         $mail->AddAddress('ask@clock-in.me', 'CS');
         //$mail->AddAddress('aldrin.enrile@voffice.com.ph', 'Aldrin');
         //$mail->AddAddress('krisselle.gumaru@voffice.com.ph', 'Krisselle');
         $mail->AddAddress('sean@flexiesolutions.com', 'Sean');
         //$mail->AddAddress('Dominic@voffice.com.ph', 'Dominic');
         $mail->AddAddress('albert.g@flexiesolutions.com', 'Albert');
         //$mail->AddAddress("javad@flexiesolutions.com", "Javad");
         //$mail->AddAddress("reymarth.voffice@gmail.com", "Reymarth");

         if($mail->Send()) {			
            echo "<script>alert('Success. Your message is sent.');</script>";
         }
      }
      else{ echo "<script>alert('Error validation on reCaptcha. Please try again.');</script>";exit();}
      
   }
?>