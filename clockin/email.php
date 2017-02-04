<?php 

   $header = "
   <style>table{font-size:1em;}</style>
   <table width='50%' align='center'>
      <tr>
         <th>
            <hr>
            <p align='left'>&nbsp;&nbsp;Thank you for your order!<br/>&nbsp;&nbsp;You will find the Details below.</p>
            <hr>
         </th>
      </tr>
   </table>";
   $cs_h = "
   <style>table{font-size:1em;}</style>
   <table width='50%' align='center'>
      <tr>
         <th>
            <hr>
            <p align='left'>&nbsp;&nbsp;Dear CS team here is a new order details.</p>
            <hr>
         </th>
      </tr>
   </table>";
   
   $plan_details = "
   <table>
      <tr>
         <table width='50%' align='center' cellpadding='1' bgcolor='#8DD35F'>
            <th width='60%'>Description</th>
            <th>Price</th>
         </table>
      </tr>
      <tr>
         <table width='50%' align='center'border='0' bgcolor='#f3f3f3' cellpadding='5'>
            <tr>
               <td width='60%'><strong>Clockin.me ".strtoupper($details["payment"])." Plan</strong></td>
               <td>$ $price USD</td>
            </tr>
            <tr>
               <td width='60%'><strong>Number of Users</strong></td>
               <td>".$details["nouser"]."</td>
            </tr>
            <tr>
               <td colspan='2'><strong>".$details["term"]." Months Plan</strong></td>
            </tr>
            <tr>
               <td align='right'><strong>TOTAL</strong></td>
               <td><strong>$ ".$details["total"]." USD</strong></td>
            </tr>
         </table>
      </tr>";
      
   $payment_details = "
   <tr>
      <table width='50%' align='center' cellpadding='1' bgcolor='#8DD35F'>
         <th colspan='2'>Payment Details</th>
      </table>
   </tr>
   <tr>
      <table width='50%' align='center'border='0' bgcolor='#f3f3f3' cellpadding='5'>
         <tr>
            <td width='50%'><strong>Reference Number</strong></td>
            <td>$ref_id</td>
         </tr>
         <tr>
            <td><strong>Transaction Date</strong></td>
            <td>".date("F j,Y g:i a")."</td>
         </tr>
         <tr>
            <td><strong>Payment Type</strong></td>
            <td>".ucwords($details["payment"])."</td>
         </tr>";
         
   $cc_payment = "
         <tr>
            <td><strong>Credit Card</strong></td>
            <td>".$details["ccnum"]."</td>
         </tr>
         <tr>
            <td><strong>Payment Status</strong></td>
            <td>".$message."</td>
         </tr>";
         
   $customer_details = "
      </table>
      </tr>
      <tr>
         <table width='50%' align='center' cellpadding='1' bgcolor='#8DD35F'>
            <th colspan='2'>Customer's Details</th>
         </table>
      </tr>
      <tr>
         <table width='50%' align='center'border='0' bgcolor='#f3f3f3' cellpadding='5'>
            <tr>
               <td width='50%'><strong>Client IP Address</strong></td>
               <td>$ip</td>
            </tr>
            <tr>
               <td><strong>Name</strong></td>
               <td>".ucwords($details["lname"]).", ".ucwords($details["fname"])."</td>
            </tr>
            <tr>
               <td><strong>Email</strong></td>
               <td>".$details["email"]."</td>
            </tr>
            <tr>
               <td><strong>Contact</strong></td>
               <td>".$details["phone_no"]."</td>
            </tr>
            <tr>
               <td><strong>Company Name</strong></td>
               <td>".$details["comp_name"]."</td>
            </tr>
            <tr>
               <td><strong>Address</strong></td>
               <td>".ucwords($details["address"])."</td>
            </tr>
            <tr>
               <td><strong>City</strong></td>
               <td>".ucwords($details["city"])."</td>
            </tr>
            <tr>
               <td><strong>Country, Zip Code</strong></td>
               <td>".$details["country"].", ".$details["zip"]."</td>
            </tr>
         </table>
      </tr>
   </table>";

   if($details["payment"] == "cc")
      $message = $plan_details.$payment_details.$cc_payment.$customer_details;
   elseif($details["payment"] == "paypal"))
      $message = $plan_details.$payment_details.$customer_details;
   
   $cs = $cs_h.$message;
   $guest = $header.$message;
   
   require_once('sendmail/class.phpmailer.php');
   $mail = new PHPMailer();
   $mail->IsSMTP();				
   $mail->SMTPAuth = true; 
   $mail->Username = "smtp_flexi"; 
   $mail->Password = "1xaUvCpfPANkM"; 
   $mail->SMTPDebug = 2;
   $mail->Host     = "mailgun.securesvr.net";
   $mail->Port     = "587";

   $mail->SetFrom($email, $fullname);
   $mail->Subject = "Clock-in.me Order";
   $mail->Body = $cs;	

   $mail->IsHTML(true);
   //$mail->AddAddress('cs@voffice.com.ph', 'CS');
   //$mail->AddAddress('aldrin.enrile@voffice.com.ph', 'Aldrin');
   //$mail->AddAddress('sean@flexiesolutions.com', 'Sean');
   //$mail->AddAddress('Dominic@voffice.com.ph', 'Dominic');
   //$mail->AddAddress('albert.g@flexiesolutions.com', 'Albert');
   //$mail->AddAddress("javad@flexiesolutions.com", "Javad");
   $mail->AddAddress("reymarth.voffice@gmail.com", "Reymarth");

   if($mail->Send()) {			
      echo "<script>$('#ty').show();</script>";
   }

































echo "<style>table{font-size:1em;}</style>
   <table width='50%' align='center'>
      <tr>
         <th>
            <hr>
            <p align='left'>&nbsp;&nbsp;Thank you for your order!<br/>&nbsp;&nbsp;You will find the Details below.</p>
            <hr>
         </th>
      </tr>
   </table>
   <table>
      <tr>
         <table width='50%' align='center' cellpadding='1' bgcolor='#8DD35F'>
            <th width='60%'>Description</th>
            <th>Price</th>
         </table>
      </tr>
      <tr>
         <table width='50%' align='center'border='0' bgcolor='#f3f3f3' cellpadding='5'>
            <tr>
               <td width='60%'><strong>Clockin.me ".strtoupper($formPlan)." Plan</strong></td>
               <td>$ ".$price." USD</td>
            </tr>
            <tr>
               <td colspan='2'><strong>$formTerms Months Plan</strong></td>
            </tr>
            <tr>
               <td align='right'><strong>TOTAL</strong></td>
               <td><strong>$ ".$total." USD</strong></td>
            </tr>
         </table>
      </tr>
      <tr>
         <table width='50%' align='center' cellpadding='1' bgcolor='#8DD35F'>
            <th colspan='2'>Payment Details</th>
         </table>
      </tr>
      <tr>
         <table width='50%' align='center'border='0' bgcolor='#f3f3f3' cellpadding='5'>
            <tr>
               <td width='50%'><strong>Reference Number</strong></td>
               <td>$ref_id</td>
            </tr>
            <tr>
               <td><strong>Transaction Date</strong></td>
               <td>".date("F j,Y g:i a")."</td>
            </tr>
            <tr>
               <td><strong>Payment Type</strong></td>
               <td>".ucwords($formPayment)."</td>
            </tr>
            <tr>
               <td><strong>Credit Card</strong></td>
               <td>$disp_card</td>
            </tr>
            </table>
      </tr>
      <tr>
         <table width='50%' align='center' cellpadding='1' bgcolor='#8DD35F'>
            <th colspan='2'>Customer's Details</th>
         </table>
      </tr>
      <tr>
         <table width='50%' align='center'border='0' bgcolor='#f3f3f3' cellpadding='5'>
            <tr>
               <td width='50%'><strong>Client IP Address</strong></td>
               <td>$ip</td>
            </tr>
            <tr>
               <td><strong>Name</strong></td>
               <td>".ucwords($formLname).", ".ucwords($formFname)."</td>
            </tr>
            <tr>
               <td><strong>Email</strong></td>
               <td>$formEmail</td>
            </tr>
            <tr>
               <td><strong>Contact</strong></td>
               <td>$formPhoneNo</td>
            </tr>
            <tr>
               <td><strong>Company Name</strong></td>
               <td>$formCname</td>
            </tr>
            <tr>
               <td><strong>Address</strong></td>
               <td>".ucwords($formAddress)."</td>
            </tr>
            <tr>
               <td><strong>City</strong></td>
               <td>".ucwords($formCity)."</td>
            </tr>
            <tr>
               <td><strong>Country, Zip Code</strong></td>
               <td>".$formCountry.", ".$formZipcode."</td>
            </tr>
         </table>
      </tr>
   </table>";
?>