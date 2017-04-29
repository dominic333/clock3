<?php 

include "vca_adminClass.php";
$adminfunc = new vca_adminClass();

function converCurrency($from,$to,$amount){
   $url = "http://www.google.com/finance/converter?a=$amount&from=$from&to=$to"; 
   $request = curl_init(); 
   $timeOut = 0; 
   curl_setopt ($request, CURLOPT_URL, $url); 
   curl_setopt ($request, CURLOPT_RETURNTRANSFER, 1); 
   curl_setopt ($request, CURLOPT_USERAGENT,"Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)"); 
   curl_setopt ($request, CURLOPT_CONNECTTIMEOUT, $timeOut); 
   $response = curl_exec($request); 
   curl_close($request); 
   return $response;
} 
function trim_value(&$value,$curr) 
{ 
    $value = trim($value," AUD");
    $value = trim($value," PHP");
    $value = trim($value," SGD");
    $value = trim($value," USD");
}
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){
   session_start();
   date_default_timezone_set("Asia/Manila");
   $ref_id = uniqid("CLCKME-".time());
   $ip = $_SERVER['REMOTE_ADDR'];
   
   // PLAN DETAILS
   $formPlan = $_POST["plan"];
   $formNouser = $_POST["no-user"];
   $formTerms = $_POST["terms"];
   $formCurrency = $_POST["currency"];
   $formCurrency = strtoupper($formCurrency);
   $bank_conversion_rate_discount = 0.01; // 1.5%
   
   // ACCOUNT DETAILS
   $formFname = $_POST["fname"];
   $formLname = $_POST["lname"];
   $formCname = $_POST["cname"];
   $formPhoneNo = $_POST["pnum"];
   $formEmail = $_POST["email"];
   $formAddress = $_POST["address"];
   $formCity = $_POST["city"];
   $formState = $_POST["state"];
   $formZipcode = $_POST["zipcode"];
   $formCountry = $_POST["country"];
   $formUsername = $_POST["username"];
   $formCompLoginName = $_POST["companyusername"];
  // echo 'athere';
   
   // PAYMENT DETAILS
   $formPayment = isset($_POST["payment"]);
   $ccname = $_POST["ccname"];
   $ccnum  = str_replace("-", "", $_POST["ccnum"]); 
   $ccmonth =isset($_POST["ccmonth"]);
   $ccyear = isset($_POST["ccyear"]); 
   $ccbank = $_POST["ccbank"];
   $ccv = $_POST["ccv"];
   $disp_card = "xxxx-xxxx-xxxx-" . substr($ccnum,-4,4);
   
   $from_currency    = 'USD';
   $to_currency    = $formCurrency;
   $amount            = 0.99;//(0.99 * $formNouser) * $formTerms;
   $results = converCurrency($from_currency,$to_currency,$amount);
   $regularExpression     = '#\<span class=bld\>(.+?)\<\/span\>#s';
   preg_match($regularExpression, $results, $finalData);
   array_walk($finalData, 'trim_value');

   $dis = ($finalData[1] * $bank_conversion_rate_discount);
   $price = $finalData[1] - $dis;
   $total = number_format($price, 2,'', '');
   
   
   $cd_array = array(
      "ref_id" => $ref_id,
      "date" => date("F j,Y g:i a"),
      "fname" => $formFname,
      "lname" => $formLname,
      "email" => $formEmail,
      "phone_no" => $formPhoneNo,
      "plan" => $formPlan,
      "nouser" => $formNouser,
      "price" => $price,
      "term" => $formTerms,
      "total" => $total,
      "comp_name" => $formCname,
      "city" => $formCity,
      "address" => trim($formAddress),
      "country" => $_POST["country"],
      "zip" => $_POST["zipcode"],
      "payment" => $formPayment,
      "ccnum" => $disp_card
   );
   
   $_SESSION["c_details"] = $cd_array;
   $redirect_url = "signup.php";
   $success_url = "index.php";
   $q=0;
   if($formPlan == "paid"){
 	 $q = (0.99 * $formNouser) * $formTerms;
   
   }
      
      
   //Added by Dominic; Feb 06,2017
   //To add users who applied for free plan
   //Modified by Annie,  removed functions that are not used  
   if($formPlan == "free")
   {
   	//echo 'wereachedfree';
     $name		= $formFname.' '.$formLname;
     $username = $formUsername;
     $coid		= $formCompLoginName;
     
	  $check_username_exist = $adminfunc->checkUserCredentialExist("login_name", $username);
	  $check_coid_exist = $adminfunc->checkCompanyIDExist($coid);
	 //echo $check_username_exist;
     if ($check_username_exist == 1)
     {
         echo "<script language=\"javascript\"> alert('Username already Exist. Please use different Username')</script>";
         			echo "
                               	<script>
				window.location=\"".$redirect_url."\"
                               	</script>
                               	";
     }
		
	  if ($check_coid_exist == 1)
     {
         echo "<script language=\"javascript\"> alert('Company Acronym already taken. Please use different Company Acronym')</script>";
         			echo "
                               	<script>
				window.location=\"".$redirect_url."\"
                               	</script>
                               	";
     }  
  /*   $test =$adminfunc->getStaffProfile(1511);
    print_r($test)*/;

		if (($check_username_exist && $check_coid_exist) != 1)
		{
			// Insert info and email
			//echo "reached here insert info";
			$ref_sess = md5(time());
			//echo "in go";
			//exit(0);
			$co_id = $adminfunc->addNewCompany($formCname, $formCompLoginName, $name, $formPhoneNo, $formEmail, $formCountry);
			$adminfunc->addNewCompanyPlan($co_id, $formNouser);
			$userid = $adminfunc->addNewStaff($co_id, $name, $formUsername, $formEmail, $formPhoneNo, $ref_sess, "1", "0");
			$adminfunc->updateUserStatus($userid, "0");
			$adminfunc->addNewVerification($ref_sess, $co_id);
			//echo "co id test"+$co_id;
			
			  $msg = "Hello $name! \r\n\r\n";
	        $msg .= "Thanks you for siging up for Clock-in.me. \r\n";
	  	     $msg .= "Please go to http://clock-in.me/verifyacct.php?sess=$ref_sess \r\n";
	        $msg .= "to confirm your email. \r\n";
	        $msg .= "You will receive another email on how you can login to your Company Dashboard once you have completed the email verification process. \r\n\r\n";
	        $msg .= "Do contact us at cs@clock-in.me if you require any assistance. \r\n\r\n";
	        $msg .= "Clock-in.me Support Team :). \r\n";
	
	        $subject = "Clock-in.me - Account Confirmation for : ". $username;
	
	        $headers = "From: no-reply@clock-in.me" . "\r\n";
	  	        $to = $formEmail;
	
	        mail($to,$subject,$msg,$headers);
	
			  //unset($_SESSION["clockin"]);
	        session_destroy();
 
			// ----- Done ------
			echo "<script language=\"javascript\"> alert('Signup Process Completed. Please Check your Email Now to Verify Your Email Address.')</script>";
			echo "
                               	<script>
				window.location=\"".$success_url."\"
                               	</script>
                               	";
		}
	}
   
   $header = "
   <style>table{font-size:1em;}</style>
   <table width='100%' align='center'>
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
   <table width='100%' align='center'>
      <tr>
         <th>
            <hr>
            <p align='left'>&nbsp;&nbsp;Dear CS team here is a new order details.</p>
            <hr>
         </th>
      </tr>
   </table>";
   
   $plan_details = "<table>
      <tr>
         <table width='100%' align='center' cellpadding='1' bgcolor='#8DD35F'>
            <th width='60%'>Description</th>
            <th>Price</th>
         </table>
      </tr>
      <tr>
         <table width='100%' align='center'border='0' bgcolor='#f3f3f3' cellpadding='5'>
            <tr>
               <td width='60%'><strong>Clockin.me ".strtoupper($formPlan)." Plan</strong></td>
               <td>$ $price USD</td>
            </tr>
            <tr>
               <td width='60%'><strong>Number of Users</strong></td>
               <td>".$formNouser."</td>
            </tr>
            <tr>
               <td colspan='2'><strong>".$formTerms." Months Plan</strong></td>
            </tr>
            <tr>
               <td><strong>Currency Selected</strong></td>
               <td><strong>".$formCurrency."</strong></td>
            </tr>
            <tr>
               <td align='right'><strong>TOTAL</strong></td>
               <td><strong>$ ".$q." USD</strong></td>
            </tr>
         </table>
      </tr>";
      
   $payment_details = "
   <tr>
      <table width='100%' align='center' cellpadding='1' bgcolor='#8DD35F'>
         <th colspan='2'>Payment Details</th>
      </table>
   </tr>
   <tr>
      <table width='100%' align='center'border='0' bgcolor='#f3f3f3' cellpadding='5'>
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
         </tr>";
         
   $cc_payment = "
         <tr>
            <td><strong>Credit Card</strong></td>
            <td>".$ccnum."</td>
         </tr>";
         
   $customer_details = "
      </table>
      </tr>
      <tr>
         <table width='100%' align='center' cellpadding='1' bgcolor='#8DD35F'>
            <th colspan='2'>Customer's Details</th>
         </table>
      </tr>
      <tr>
         <table width='100%' align='center'border='0' bgcolor='#f3f3f3' cellpadding='5'>
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
               <td>".$formEmail."</td>
            </tr>
            <tr>
               <td><strong>Contact</strong></td>
               <td>".$formPhoneNo."</td>
            </tr>
            <tr>
               <td><strong>Company Name</strong></td>
               <td>".$formCname."</td>
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

   if($formPayment == "cc")
      $message = $plan_details.$payment_details.$cc_payment.$customer_details;
   else
      $message = $plan_details.$payment_details.$customer_details;
   
   $cs = $cs_h.$message;
   $guest = $header.$message;
   
   
   require_once('sendmail/class.phpmailer.php');
   $mail = new PHPMailer();
   $mail->IsSMTP();				
   $mail->SMTPAuth = true; 
   $mail->Username = "smtp_flexi"; 
   $mail->Password = "1xaUvCpfPANkM"; 
   //$mail->SMTPDebug = 2;
   $mail->Host     = "mailgun.securesvr.net";
   $mail->Port     = "587";

   $mail->SetFrom($formEmail, $name);
   $mail->Subject = "Clock-in.me Order";
   $mail->Body = $cs;	

   $mail->IsHTML(true);
   $mail->AddAddress('ask@clock-in.me', 'CS');
   //$mail->AddAddress('aldrin.enrile@voffice.com.ph', 'Aldrin');
   $mail->AddAddress('sean@flexiesolutions.com', 'Sean');
   //$mail->AddAddress('Dominic@voffice.com.ph', 'Dominic');
   $mail->AddAddress('albert.g@flexiesolutions.com', 'Albert');
   //$mail->AddAddress("javad@flexiesolutions.com", "Javad");
   //$mail->AddAddress("reymarth.voffice@gmail.com", "Reymarth");

  /* if($mail->Send()) {			
      //echo "<script>$('#ty').show();</script>";
   }*/

   
   if($formPayment == "paypal") {
     
      
      if($payment == "cc") {
         $payment = "Credit/Debit Card";
      }elseif($payment == "paypal") {
         $payment = "Paypal (USD)";
      }
      
      $cs = $cs_h.$plan_details.$payment_details;
      if($payment == "cc") $cs.= $cc_payment;
      $cs .= $customer_details;
      
      $ppreturnurl = "http://voffice.com.ph/clockin/check.php"; 
      $ppreturncancel = "http://voffice.com.ph/clockin/signup.php";
      $ppacct = "billing@flexiesolutions.com";
      $curencytype = $formCurrency;
      

      $paypalcmd = "https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&currency_code=$curencytype&amount=$total&item_number=$ref_id&return=$ppreturnurl&cancel_return=$ppreturncancel&item_name=Clock-in.me Invoice $invoices&business=$ppacct";
      $paypalcmd = "https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&currency_code=$curencytype&amount=$ppamt&item_number=$ref_id&return=$ppreturnurl&cancel_return=$ppreturncancel&item_name=vOffice Philippines Inc $invoices&business=$ppacct";
      echo "<script>window.location= \"".$paypalcmd."\";</script>";
      
   }
   elseif($formPayment == "cc") {
      include "egate.php";
      $vpc_MTxnRef = $ref_id;
      
      $fields = array(

         'vpc_Version'=>urlencode("1"),
         'vpc_Command'=>urlencode("pay"),
         'vpc_AccessCode'=>urlencode($vpcAccessCode),//
         'vpc_MerchTxnRef'=>urlencode($vpc_MTxnRef),
         'vpc_Merchant'=>urlencode($vps_MID),//
         'vpc_OrderInfo'=>urlencode($formPlan),
         'vpc_Amount'=>urlencode($total),
         'vpc_CardNum'=>urlencode($formCCnum),
         'vpc_CardExp'=>urlencode($ccyear.$ccmonth),
         'vpc_CardSecurityCode'=>urlencode($ccv),
         //'vpc_card'=>urlencode("Mastercard"),
         'vpc_TxSource'=>urlencode("INTERNET"),
         'vpc_ReturnURL'=>urlencode($vpc_ReturnURL),
         'vpc_SecureHash'=>urlencode(strtoupper(md5($md5HashData))),
         'vpc_Locale'=>urlencode($vpc_Locale),// en
         //'vpc_gateway'=>urlencode($vpc_gateway),
         'vpc_TxSourceSubType'=>urlencode("SINGLE")

      );
      
      //url-ify the data for the POST 
      foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; } 
      rtrim($fields_string,'&');
      
      ob_start();
      
      // initialise Client URL object
      $ch = curl_init();
      
      // set the URL of the VPC
      curl_setopt ($ch, CURLOPT_URL, $vpcURL);	
      curl_setopt($ch,CURLOPT_POST,count($fields));
      curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
      
      curl_exec ($ch);

      // get response
      $response = ob_get_contents();
      
      
      // turn output buffering off.
      ob_end_clean();
      
      // set up message paramter for error outputs
      $message = "";
      
      // serach if $response contains html error code
      if(strchr($response,"<html>") || strchr($response,"<html>")) {;
         $message = $response;
      } else {
         // check for errors from curl
         if (curl_error($ch))
              $message = "%s: s". curl_errno($ch) . "<br/>" . curl_error($ch);
      }

      //echo print_r($response);
      //exit(0);
      
      curl_close ($ch);

      $map = array();

      // process response if no errors
      if (strlen($message) == 0) {
         $pairArray = split("&", $response);
         foreach ($pairArray as $pair) {
            $param = split("=", $pair);
            $map[urldecode($param[0])] = urldecode($param[1]);
         }
         $message         = null2unknown($map, "vpc_Message");
      } 
      
      // Standard Receipt Data
      # merchTxnRef not always returned in response if no receipt so get input
      //TK//$merchTxnRef     = $vpc_MerchTxnRef;
      $merchTxnRef     = $vpc_MTxnRef;
      
      // check if all fields are not empty
      $amount          = null2unknown($map, "vpc_Amount");
      $locale          = null2unknown($map, "vpc_Locale");
      $batchNo         = null2unknown($map, "vpc_BatchNo");
      $command         = null2unknown($map, "vpc_Command");
      $version         = null2unknown($map, "vpc_Version");
      $cardType        = null2unknown($map, "vpc_Card");
      $orderInfo       = null2unknown($map, "vpc_OrderInfo");
      $receiptNo       = null2unknown($map, "vpc_ReceiptNo");
      $merchantID      = null2unknown($map, "vpc_Merchant");
      $authorizeID     = null2unknown($map, "vpc_AuthorizeId");
      $transactionNo   = null2unknown($map, "vpc_TransactionNo");
      $acqResponseCode = null2unknown($map, "vpc_AcqResponseCode");
      $txnResponseCode = null2unknown($map, "vpc_TxnResponseCode");
      
      // 3D option return variables
      // 3-D Secure Data
      $verType         = array_key_exists("vpc_VerType", $map)          ? $map["vpc_VerType"]          : "No Value Returned";
      $verStatus       = array_key_exists("vpc_VerStatus", $map)        ? $map["vpc_VerStatus"]        : "No Value Returned";
      $token           = array_key_exists("vpc_VerToken", $map)         ? $map["vpc_VerToken"]         : "No Value Returned";
      $verSecurLevel   = array_key_exists("vpc_VerSecurityLevel", $map) ? $map["vpc_VerSecurityLevel"] : "No Value Returned";
      $enrolled        = array_key_exists("vpc_3DSenrolled", $map)      ? $map["vpc_3DSenrolled"]      : "No Value Returned";
      $xid             = array_key_exists("vpc_3DSXID", $map)           ? $map["vpc_3DSXID"]           : "No Value Returned";
      $acqECI          = array_key_exists("vpc_3DSECI", $map)           ? $map["vpc_3DSECI"]           : "No Value Returned";
      $authStatus      = array_key_exists("vpc_3DSstatus", $map)        ? $map["vpc_3DSstatus"]        : "No Value Returned";

      /*********************
      * END OF MAIN PROGRAM
      *********************/
      
      // FINISH TRANSACTION - Process the VPC Response Data
      // =====================================================
      // For the purposes of demonstration, we simply display the Result fields on a
      // web page.
      
      // Show 'Error' in title if an error condition
      //$errorTxt = "";
      // Show the display page as an error page 
      //if ($txnResponseCode == "7" || $txnResponseCode == "No Value Returned" ) 
      // Show this page as an error page if vpc_TxnResponseCode equals '7'
      
      if ($txnResponseCode != 0 || $txnResponseCode == "No Value Returned" ) 
      {
         $gw_resp_code = getResponseDescription($txnResponseCode);
         //echo $gw_resp_code;
         header("Location: ".$vpc_ReturnURL."?status=fail&message=".$gw_resp_code);
      }
      else
      {
         $gw_resp_code = getResponseDescription($txnResponseCode);
         //echo $gw_resp_code;
         header("Location: ".$vpc_ReturnURL."?status=success&message=".$gw_resp_code);
      }
   }
   
   header("Location: payment.php");

}
?>

















