<?php

class vca_adminClass {

	function reConnectClientClassDB()
	{		
		$dbhost= 'localhost';
		//$dbuser= 'clockin_admin';
		//$dbpass= 'wzF7#W4]xOyT';
		//$dbname= 'clockin_maindb';
		
		$dbuser= 'clockin_test';
		$dbpass= 'IAN2?e#(x(Of';
		$dbname= 'clockin_testdb';
	

		/*$dbuser= 'clock2';
		$dbpass= 'd3fault';
		$dbname= 'clock2';*/
		
		$dbm = mysql_connect ($dbhost, $dbuser, $dbpass) or die ('I cannot connect to the database because: ' . mysql_error());
		mysql_select_db ($dbname) or die("Could not select database \n"); 
	
	}

	function formatStorageDate($indate)
	{
		include "vca_conn.php";
		$f_in_date = explode("-", $indate);
		$p_date = $f_in_date[2]."-".$f_in_date[1]."-".$f_in_date[0];		
		return $p_date;
	}

	function checkUserCredentialExist($field, $q_data)
   	{
                include "vca_conn.php";
                $tz_data_q = "SELECT staff_id FROM staff_info WHERE $field='$q_data'";

                $tz_result = mysqli_query($vdbm, $tz_data_q);
                if(!$tz_result)
                {
                        $errno = mysqli_errno($vdbm);
                        $error = mysqli_error($vdbm);
                        die("Query Error: $error (code: $errno)");
                }

                $fdata = mysqli_num_rows($tz_result);
                return $fdata;
        }

	function checkCompanyIDExist($q_data)
        {
                include "vca_conn.php";

                $tz_data_q = "SELECT id FROM company_info WHERE company_login='$q_data'";

                $tz_result = mysqli_query($vdbm, $tz_data_q);
                if(!$tz_result)
                {
                        $errno = mysqli_errno($vdbm);
                        $error = mysqli_error($vdbm);
                        die("Query Error: $error (code: $errno)");
                }

                $fdata = mysqli_num_rows($tz_result);
                return $fdata;
        }

	function checkVerifySess($q_data)
	{
               	include "vca_conn.php";

                $tz_data_q = "SELECT id FROM signup_verify WHERE signup_id='$q_data' AND status='0'";

                $tz_result = mysqli_query($vdbm, $tz_data_q);
                if(!$tz_result)
                {
                        $errno = mysqli_errno($vdbm);
                        $error = mysqli_error($vdbm);
                        die("Query Error: $error (code: $errno)");
                }

                $fdata = mysqli_num_rows($tz_result);
                return $fdata;
        }

	function getUserEmail($userid)
        {
                include "vca_conn.php";

                $tz_data_q = "SELECT email FROM staff_info WHERE staff_id='$userid'";

                $tz_result = mysqli_query($vdbm, $tz_data_q);
                if(!$tz_result)
                {
                        $errno = mysqli_errno($vdbm);
                        $error = mysqli_error($vdbm);
                        die("Query Error: $error (code: $errno)");
                }

                $fdata = mysqli_fetch_assoc($tz_result);
                return $fdata["email"];
        }

	function getUserExplainationNotes($userid, $indate, $clktype)
        {
                include "vca_conn.php";

                $tz_data_q = "SELECT notes FROM attendance_log WHERE staff_id='$userid' AND log_date='$indate' AND clock_type='$clktype'";

                $tz_result = mysqli_query($vdbm, $tz_data_q);
                if(!$tz_result)
                {
                        $errno = mysqli_errno($vdbm);
                        $error = mysqli_error($vdbm);
                        die("Query Error: $error (code: $errno)");
                }

                $fdata = mysqli_fetch_assoc($tz_result);
                return $fdata["notes"];
        }

	function getUserExplainationNotesLogTime($userid, $indate, $clktype)
	{
                include "vca_conn.php";

                $tz_data_q = "SELECT notes_date FROM attendance_log WHERE staff_id='$userid' AND log_date='$indate' AND clock_type='$clktype'";

                $tz_result = mysqli_query($vdbm, $tz_data_q);
                if(!$tz_result)
                {
                        $errno = mysqli_errno($vdbm);
                        $error = mysqli_error($vdbm);
                        die("Query Error: $error (code: $errno)");
                }

                $fdata = mysqli_fetch_assoc($tz_result);
                return $fdata["notes"];
        }

	function getUserNumberofBreak($userid, $indate)
        {
                include "vca_conn.php";

                $tz_data_q = "SELECT id FROM attendance_log WHERE staff_id='$userid' AND log_date='$indate' AND clock_type='brkOut'";

                $tz_result = mysqli_query($vdbm, $tz_data_q);
                if(!$tz_result)
                {
                        $errno = mysqli_errno($vdbm);
                       	$error = mysqli_error($vdbm);
                       	die("Query Error: $error (code: $errno)");
               	}

               	$fdata = mysqli_num_rows($tz_result);
               	return $fdata;
        }

	function getUserClockInTiming($userid, $indate)
        {
                include "vca_conn.php";

       	       	$tz_data_q = "SELECT log_time FROM attendance_log WHERE staff_id='$userid' AND log_date='$indate' AND clock_type='in'";

                $tz_result = mysqli_query($vdbm, $tz_data_q);
                if(!$tz_result)
                {
                        $errno = mysqli_errno($vdbm);
                       	$error = mysqli_error($vdbm);
                       	die("Query Error: $error (code: $errno)");
               	}

		$rrows = mysqli_fetch_assoc($tz_result);
		return $rrows["log_time"];
        }

	function getUserClockOutTiming($userid, $indate)
        {
                include "vca_conn.php";

       	       	$tz_data_q = "SELECT log_time FROM attendance_log WHERE staff_id='$userid' AND log_date='$indate' AND clock_type='Out'";

                $tz_result = mysqli_query($vdbm, $tz_data_q);
                if(!$tz_result)
                {
                        $errno = mysqli_errno($vdbm);
                       	$error = mysqli_error($vdbm);
                       	die("Query Error: $error (code: $errno)");
               	}

		$rrows = mysqli_fetch_assoc($tz_result);
                return $rrows["log_time"];
        }

	function getUserBreakOutTiming($userid, $indate)
        {
                include "vca_conn.php";

       	       	$tz_data_q = "SELECT log_time FROM attendance_log WHERE staff_id='$userid' AND log_date='$indate' AND clock_type='brkOut'";

		$store_list = array();

                $tz_result = mysqli_query($vdbm, $tz_data_q);
                if(!$tz_result)
                {
                        $errno = mysqli_errno($vdbm);
                       	$error = mysqli_error($vdbm);
                       	die("Query Error: $error (code: $errno)");
               	}

		while ($rrows = mysqli_fetch_assoc($tz_result))
               	{
                         array_push($store_list, $rrows["log_time"]);
                }

                return $store_list;
        }

	function getUserBreakInTiming($userid, $indate)
        {
                include "vca_conn.php";

       	       	$tz_data_q = "SELECT log_time FROM attendance_log WHERE staff_id='$userid' AND log_date='$indate' AND clock_type='brkin'";

		$store_list = array();

                $tz_result = mysqli_query($vdbm, $tz_data_q);
                if(!$tz_result)
                {
                        $errno = mysqli_errno($vdbm);
                       	$error = mysqli_error($vdbm);
                       	die("Query Error: $error (code: $errno)");
               	}

               	while ($rrows = mysqli_fetch_assoc($tz_result))
		{
			 array_push($store_list, $rrows["log_time"]);
		}

		return $store_list;
        }

	function getUserBaseLogTime($staffid, $check_day, $base_log_time_field)
        {
               	include "vca_conn.php";


                $tz_data_q = "SELECT department_shifts.$check_day as checkday, department_shifts.$base_log_time_field as base_log_time 
		FROM department_shifts, staff_dept_shift WHERE 
		department_shifts.shift_id = staff_dept_shift.shift_id AND 
		staff_dept_shift.staff_id ='$staffid'";

               	$tz_result = mysqli_query($vdbm, $tz_data_q);
 /*               if(!$tz_result)
                {
                       	$errno = mysqli_errno($vdbm);
                        $error = mysqli_error($vdbm);
                       	die("Query Error: $error (code: $errno)");
                }*/

                $fdata = mysqli_fetch_assoc($tz_result);
                return $fdata;
        }

	function getUserShift($staff_id)
        {
                include "vca_conn.php";

                $tz_data_q = "SELECT shift_id FROM staff_dept_shift WHERE staff_id='$staff_id'";

                $tz_result = mysqli_query($vdbm, $tz_data_q);
                if(!$tz_result)
               	{
                        $errno = mysqli_errno($vdbm);
                       	$error = mysqli_error($vdbm);
                       	die("Query Error: $error (code: $errno)");
                }

               	$fdata = mysqli_fetch_assoc($tz_result);
                return $fdata["shift_id"];
        }

	function getUserviaCompany($coid)
        {
                include "vca_conn.php";

                $tz_data_q = "SELECT staff_id, staff_name FROM staff_info WHERE company_id='$coid'";

                $tz_result = mysqli_query($vdbm, $tz_data_q);
                if(!$tz_result)
                {
                        $errno = mysqli_errno($vdbm);
                       	$error = mysqli_error($vdbm);
                       	die("Query Error: $error (code: $errno)");
                }

                return $tz_result;
        }

	function getUserIDviaCompanyID($coid, $email)
        {
                include "vca_conn.php";

                $tz_data_q = "SELECT staff_id, staff_name, login_name FROM staff_info WHERE company_id='$coid' AND email='$email'";

                $tz_result = mysqli_query($vdbm, $tz_data_q);
                if(!$tz_result)
                {
                        $errno = mysqli_errno($vdbm);
                        $error = mysqli_error($vdbm);
                        die("Query Error: $error (code: $errno)");
                }

                return $tz_result;
        }

	function getUserDept($staff_id)
        {
                include "vca_conn.php";

                $tz_data_q = "SELECT dept_id FROM staff_dept_shift WHERE staff_id='$staff_id'";

                $tz_result = mysqli_query($vdbm, $tz_data_q);
                if(!$tz_result)
               	{
                        $errno = mysqli_errno($vdbm);
                       	$error = mysqli_error($vdbm);
                       	die("Query Error: $error (code: $errno)");
                }

               	$fdata = mysqli_fetch_assoc($tz_result);
                return $fdata["dept_id"];
        }

	function getCompanyContactPersonEmail($co_id)
        {
                include "vca_conn.php";

                $tz_data_q = "SELECT contact_email FROM company_info WHERE id='$co_id'";

                $tz_result = mysqli_query($vdbm, $tz_data_q);
                if(!$tz_result)
                {
                       	$errno = mysqli_errno($vdbm);
                       	$error = mysqli_error($vdbm);
                        die("Query Error: $error (code: $errno)");
                }

                $fdata = mysqli_fetch_assoc($tz_result);
                return $fdata["contact_email"];
        }

	function getCompanyContactPerson($co_id)
        {
                include "vca_conn.php";

                $tz_data_q = "SELECT contact_person FROM company_info WHERE id='$co_id'";

                $tz_result = mysqli_query($vdbm, $tz_data_q);
                if(!$tz_result)
                {
                        $errno = mysqli_errno($vdbm);
                        $error = mysqli_error($vdbm);
                       	die("Query Error: $error (code: $errno)");
                }

               	$fdata = mysqli_fetch_assoc($tz_result);
                return $fdata["contact_person"];
        }

	function getAllUsersinDept($dept_id)
        {
               	include "vca_conn.php";

                $tz_data_q = "SELECT staff_id FROM staff_dept_shift WHERE dept_id='$dept_id'";

                $tz_result = mysqli_query($vdbm, $tz_data_q);
                if(!$tz_result)
                {
                        $errno = mysqli_errno($vdbm);
                        $error = mysqli_error($vdbm);
                        die("Query Error: $error (code: $errno)");
                }

                //$fdata = mysqli_fetch_assoc($tz_result);
                return $tz_result;
        }

	function tz_list() 
	{
  		$zones_array = array();
		$timestamp = time();
		foreach(timezone_identifiers_list() as $key => $zone) {
		    date_default_timezone_set($zone);
		    $zones_array[$key]['zone'] = $zone;
		    $zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
  		}
  		return $zones_array;
	}

	function generatePassword() 
	{
	   $length = 10;
	   
	    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	    $count = mb_strlen($chars);

   	    for ($i = 0, $result = ''; $i < $length; $i++) {
        	$index = rand(0, $count - 1);
	        $result .= mb_substr($chars, $index, 1);
    	   }

	    return $result;
	}

	function getShiftTZviaStaffid($staff_id)
	{
                include "vca_conn.php";

		$tz_data_q = "SELECT department_shifts.time_zone as tz FROM department_shifts, staff_dept_shift WHERE 
			department_shifts.shift_id = staff_dept_shift.shift_id AND staff_dept_shift.staff_id = '$staff_id'";

                $tz_result = mysqli_query($vdbm, $tz_data_q);
                if(!$tz_result)
                {
                        $errno = mysqli_errno($vdbm);
                        $error = mysqli_error($vdbm);
                        die("Query Error: $error (code: $errno)");
                }

		$fdata = mysqli_fetch_assoc($tz_result);
		return $fdata["tz"];
	}

	function sendUserLogin($staffname, $username, $password, $email, $co_id)
        {
		//include "vca_conn.php";
		$company_login = $this->getCompanyLogin($co_id);
		$msg = "Hello $staffname! \r\n\r\n";
		$msg .= "Welcome to Clock-in.me! \r\n";
		$msg .= "Your new account for Cloud Attendance is now created. \r\n";
		$msg .= "Below is the login information to log your attendance.\r\n";
		$msg .= "------------------------------ \r\n";
		$msg .= "Go to http://clock-in.me/selfies/ \r\n";
		$msg .= "Login Company Name: $company_login \r\n";
		$msg .= "Login Username: $username \r\n";
		$msg .= "Login Password: $password \r\n\r\n";
    $msg .= "** Please allow app to make use of camera when prompted. \r\n";
    $msg .= "** Please select the correct Attendance Option (i.e Clock in or Clock Out). \r\n";
    $msg .= "** SMILE :) and Click Log Your Attendance! \r\n\r\n";
    $msg .= "Go to http://clock-in.me/dashboard/ \r\n";
    $msg .= "Login using the same credential above to \r\n";
    $msg .= "- View your attendance for the week. \r\n";
    $msg .= "- Add Explaination notes on any discrepencies for your attendance.  \r\n";
    $msg .= "- Update your personal profile.  \r\n";
    $msg .= "- Change your login password for both \"dashboard\" and \"selfies\" area.  \r\n";
    $msg .= "- View Who is Around Today in your department.  \r\n";
    $msg .= "- and much more!  \r\n";
		$msg .= "------------------------------ \r\n\r\n";
                $msg .= "Do contact us at cs@clock-in.me if you require any assistance. \r\n\r\n";
                $msg .= "Clock-in.me Support Team :). \r\n";

		$company_name = $this->getCompanyName($co_id);
                $subject = "Your Login Details at Clock-in.me for : ". $company_name;

		$headers = "From: no-reply@clock-in.me" . "\r\n";
                $to = $email;

                mail($to,$subject,$msg,$headers);
        }

	function sendAdminWelcomeMail($co_id)
        {
		include "vca_conn.php";
//		echo $co_id;
		$company_login = $this->getCompanyLogin($co_id);
//		echo $company_login;
		$email = $this->getCompanyContactPersonEmail($co_id);
//		echo $email;
		$staffname = $this->getCompanyContactPerson($co_id);
		$password = $this->generatePassword();
		$pre_userinfo = $this->getUserIDviaCompanyID($co_id, $email);
		$urows = mysqli_fetch_assoc($pre_userinfo);		
		
		$companyplan = $this->getCompanyPlan($co_id);
		$plans = mysqli_fetch_assoc($companyplan);
//		echo $plans['max_users'];
//		print_r($companyplan);
		$this->updateUserPassword($urows["staff_id"], "$password", "password");
		$username = $urows["login_name"];

		$this->activateAdminAccount($urows["staff_id"]);
		$this->activateCompany($co_id);
		

		$msg  = "Hello $staffname! \r\n\r\n";
		$msg .= "Welcome to Clock-in.me! \r\n";
		$msg .= "Here is the details of your plan";
		$msg .= "Your Plan name : ". $plans['planName']."\r\n ";
		$msg .= "Maximum Number of users:".  $plans['max_users']."\r\n ";
		$msg .= "_________________________________________________________________________________\r\n\r\n";
		$msg .= "Admin Login.\r\n\r\n";
		$msg .= "Below is the login information to log into your Admin Dashboard and to switch Selfie Dashboard to take your selfies  attendance. \r\n";

      $msg .= "Go to https://clock-in.me/cloudapp/ \r\n";
		$msg .= "Login Company Name: $company_login \r\n";
		$msg .= "Login Username: $username \r\n";
		$msg .= "Login Password: $password \r\n\r\n";
		$msg .= "You will be login as the Admin User.\r\n";
		$msg .= "Please proceed to create Department, Shift(s), Users (Welcome mail with login info will be email to user) and Add User to Shifts \r\n\r\n";
		$msg .= "_________________________________________________________________________________\r\n\r\n";
      $msg .= "Normal User(s) / Staff(s) Login \r\n\r\n";
   	$msg .= "Your user(s) / staff will receive a Welcome Mail once you have added them from your Admin Dashboard\r\n";
      $msg .= "To login and Take a Selfies Attendance \r\n";
      $msg .= "https://clock-in.me/cloudapp \r\n";
      $msg .= "Login Company Name: $company_login \r\n";
	   $msg .= "As per user welcome mail\r\n";
	   $msg .= "As per user welcome mail \r\n\r\n";
      $msg .= "** Please allow app to make use of camera when prompted.\r\n";
	   $msg .= "** Select the correct Attendance Option (i.e Clock in or Clock Out).\r\n";
	   $msg .= "** SMILE :) and Click Mark Your Attendance! \r\n ";              
		$msg .= "_________________________________________________________________________________\r\n\r\n";
      $msg .= "To get additional information on how to use Clock-in.me, you can visit http://clock-in.me/home/and download the PDF Guides under the Download option. \r\n\r\n";
      $msg .= "Thank you once again!\r\n";
      $msg .= "Clock-in.me Support Team :). \r\n";


		$company_name = $this->getCompanyName($co_id);
      $subject = "Your Login Details at Clock-in.me for : ". $company_name;

		$headers = "From: no-reply@clock-in.me" . "\r\n";
                $to = $email;
//				$to = "annie@cliffsupport.com";
//				echo $msg;

               if(mail($to,$subject,$msg,$headers))
               {
               
               		return true;
               
               }
        }

	function addNewDepartment($department_name, $company_id)
	{
		include "vca_conn.php";

		$data_q = "INSERT INTO departments (department_name, company_id) VALUES ('$department_name','$company_id')";
		$result = mysqli_query($vdbm, $data_q);

		if(!$result) 
		{
	          $errno = mysqli_errno($vdbm);
        	  $error = mysqli_error($vdbm);
		  die("Query Error: $error (code: $errno)");
     		}
		
		$dept_id = mysqli_insert_id($vdbm);

		return $dept_id;
	}

 	function addNewCompany($coname, $company_id, $contact_person, $contact_number, $email, $country)
        {
               	include "vca_conn.php";

               	$data_q = "INSERT INTO company_info (company_login, company_name, contact_person, contact_number, contact_email, company_country, company_status) 
		VALUES ('$company_id','$coname', '$contact_person', '$contact_number', '$email', '$country', '0')";
                $result = mysqli_query($vdbm, $data_q);
					//print_r($data_q);
                if(!$result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
               	}

                $co_id = mysqli_insert_id($vdbm);

                return $co_id;
        }

	function addNewCompanyPlan($company_id, $maxusers)
        {
                include "vca_conn.php";

                $data_q = "INSERT INTO company_plans (company_id, max_users,planId)
                VALUES ('$company_id','$maxusers',1)";
                $result = mysqli_query($vdbm, $data_q);

                if(!$result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
               	  die("Query Error: $error (code: $errno)");
                }

        }

	function addNewAnnouncement($title, $msg , $company_id)
	{
		include "vca_conn.php";

		$data_q = "INSERT INTO announcements (title, msg, co_id) VALUES ('$title', '$msg' , '$company_id')";
		$result = mysqli_query($vdbm, $data_q);

		if(!$result) 
		{
	          $errno = mysqli_errno($vdbm);
        	  $error = mysqli_error($vdbm);
		  die("Query Error: $error (code: $errno)");
     		}
		
		$dept_id = mysqli_insert_id($vdbm);

		return $dept_id;
	}
	function logStaffasNonWorkDay($staffid, $indate)
        {
                include "vca_conn.php";

		$check_staff = $this->checkifLogExist($staffid, $indate, "in");
		
		if ($check_staff == 0)
		{
                	$data_q = "INSERT INTO attendance_log (staff_id, log_date, clock_type) VALUES ('$staffid','$indate','nw')";
	                $result = mysqli_query($vdbm, $data_q);

        	        if(!$result)
               		{
	                  $errno = mysqli_errno($vdbm);
        	          $error = mysqli_error($vdbm);
                	  die("Query Error: $error (code: $errno)");
	                }

		 }
        }

	function logStaffasAbsent($staffid, $indate, $shifttype, $base_time)
	{
               	include "vca_conn.php";

                $check_staff = $this->checkifLogExist($staffid, $indate, "in");

                if ($check_staff == 0)
                {
                        $data_q = "INSERT INTO attendance_log (staff_id, log_date, clock_type, shift_type, base_log_time) 
			VALUES ('$staffid','$indate','ab', '$shifttype', '$base_time')";
                       	$result = mysqli_query($vdbm, $data_q);

                       	if(!$result)
                        {
                          $errno = mysqli_errno($vdbm);
                          $error = mysqli_error($vdbm);
                          die("Query Error: $error (code: $errno)");
                        }

			$this->notifyUser($staffid, $indate, $base_time, "Absent");

                 }
        }

	function notifyUser($staffid, $indate, $base_time, $status)
        {
               	//include "vca_conn.php";

		$userName = $this->getStaffName($staffid);
		$userEmail = $this->getStaffEmailId($staffid);

		$msg = "Hello $userName \r\n\r\n";
		$msg .= "Your Attendance for Clock-in.me on $indate have been recorded as \r\n";
		$msg .= "------------------------------ \r\n";
		$msg .= "$status \r\n";
		$msg .= "------------------------------ \r\n\r\n";
                $msg .= "You can go to http://clock-in.me/dashboard/ \r\n";
                $msg .= "Login using your selfies / dashboard credential if you need to add any explaination notes to your HR Department.  \r\n";
                $msg .= "Kind regards, \r\n\r\n";
                $msg .= "The Team @ Clock-in.me :). \r\n";

		//$company_name = $this->getCompanyName($co_id);
                $subject = "Your Attendance @ Clock-in.me on $indate";

		$headers = "From: no-reply@clock-in.me" . "\r\n";
                $to = $email;

                if($to!=''&$to!=' '){
                	mail($to,$subject,$msg,$headers);
                }
        }

	function logStaffasNoClockOut($staffid, $indate, $shifttype, $base_time)
        {
               	include "vca_conn.php";

                $check_staff = $this->checkifLogExist($staffid, $indate, "out");
                
                $check_staff_nc = $this->checkifLogExist($staffid, $indate, "nc");

                if ($check_staff == 0 && $check_staff_nc == 0)
                {
                       	$data_q = "INSERT INTO attendance_log (staff_id, log_date, clock_type, shift_type, base_log_time)
                       	VALUES ('$staffid','$indate','nc', '$shifttype', '$base_time')";
                       	$result = mysqli_query($vdbm, $data_q);

                       	if(!$result)
                       	{
                          $errno = mysqli_errno($vdbm);
                          $error = mysqli_error($vdbm);
                          die("Query Error: $error (code: $errno)");
                       	}

                 }
        }
        
        
        function getCompanyPlan($co_id)
        {
        
        	               	include "vca_conn.php";
        	               	
          		$data_q =  "SELECT company_plans.company_id as compid, company_plans.max_users as max_users, plans.planName as planName
									
									FROM company_plans, plans WHERE company_plans.planId = plans.id 
									AND company_plans.company_id='$co_id'";
//									echo $data_q;
                $result = mysqli_query($vdbm, $data_q);
                if(!$result)
                {
                        $errno = mysqli_errno($vdbm);
                       	$error = mysqli_error($vdbm);
                       	die("Query Error: $error (code: $errno)");
                }
                return $result;
        
        
        
        }

	function getCompanyMaxStaff($co_id)
        {
                include "vca_conn.php";

                $data_q = "SELECT max_users FROM company_plans WHERE company_id='$co_id'";
                $result = mysqli_query($vdbm, $data_q);

                if(!$result)
               	{
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }

                $fdata = mysqli_fetch_assoc($result);

               	return $fdata["max_users"];
        }

	function checkifLogExist($staffid, $indate, $clocktype)
        {
                include "vca_conn.php";

                $data_q = "SELECT id FROM attendance_log WHERE staff_id='$staffid' AND log_date='$indate' AND clock_type='$clocktype'";
                $result = mysqli_query($vdbm, $data_q);

                if(!$result)
               	{
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }

                $exist = mysqli_num_rows($result);

                return $exist;
        }


	function deleteDepartment($deptid)
        {
                include "vca_conn.php";

		$exist = $this->checkifDeptEmpty($deptid);
		if ($exist != 0)
		{
			$delstatus = 0;
		}
		else
		{
                	$data_q = "DELETE FROM departments WHERE dept_id='$deptid'";
	                $result = mysqli_query($vdbm, $data_q);

	               /* if(!$result)
        	       	{
                	  $errno = mysqli_errno($vdbm);
	                  $error = mysqli_error($vdbm);
        	          die("Query Error: $error (code: $errno)");
                	}*/
			$this->deleteDepartmentShift($deptid);
                        $delstatus = 1;
		}

       	        return $delstatus;
        }

	function deleteDepartmentShift($deptid)
        {
                include "vca_conn.php";

                        $data_q = "DELETE FROM departments_shifts WHERE dept_id='$deptid'";
                        $result = mysqli_query($vdbm, $data_q);

                        /*if(!$result)
                        {
                          $errno = mysqli_errno($vdbm);
                          $error = mysqli_error($vdbm);
                          die("Query Error: $error (code: $errno)");
                        }*/

        }

	function deleteUser($userid)
        {
                include "vca_conn.php";

                        $data_q = "DELETE FROM staff_info WHERE staff_id='$userid'";
                       	$result = mysqli_query($vdbm, $data_q);

                       	if(!$result)
                       	{
                          $errno = mysqli_errno($vdbm);
                          $error = mysqli_error($vdbm);
                          die("Query Error: $error (code: $errno)");
                        }

		$this->deleteUserFromShiftTable($userid);

        }

	function deleteUserFromShiftTable($userid)
        {
                include "vca_conn.php";

                        $data_q = "DELETE FROM staff_dept_shift WHERE staff_id='$userid'";
                        $result = mysqli_query($vdbm, $data_q);

                       	if(!$result)
                        {
                          $errno = mysqli_errno($vdbm);
                          $error = mysqli_error($vdbm);
                          die("Query Error: $error (code: $errno)");
                        }

        }

	function deleteShift($shiftid)
        {
                include "vca_conn.php";

		$exist = $this->checkifShiftEmpty($shiftid);
		if ($exist != 0)
		{
			$delstatus = 0;
		}
		else
		{
                	$data_q = "DELETE FROM department_shifts WHERE shift_id='$shiftid'";
	                $result = mysqli_query($vdbm, $data_q);

	                if(!$result)
        	       	{
                	  $errno = mysqli_errno($vdbm);
	                  $error = mysqli_error($vdbm);
        	          die("Query Error: $error (code: $errno)");
                	}

                        $delstatus = 1;
		}

       	        return $delstatus;
        }

	function checkifDeptEmpty($deptid)
        {
                include "vca_conn.php";

                $data_q = "SELECT id FROM staff_dept_shift WHERE dept_id='$deptid'";
                $result = mysqli_query($vdbm, $data_q);

                if(!$result)
               	{
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }

                $exist = mysqli_num_rows($result);

                return $exist;
        }

	function checkifShiftEmpty($shiftid)
        {
                include "vca_conn.php";

                $data_q = "SELECT id FROM staff_dept_shift WHERE shift_id='$shiftid'";
                $result = mysqli_query($vdbm, $data_q);	

                if(!$result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }

                $exist = mysqli_num_rows($result);

                return $exist;
	}


      	function getCurrentNumUsers($co_id)
        {
                include "vca_conn.php";

                $data_q = "SELECT staff_id FROM staff_info WHERE company_id='$co_id'";
                $result = mysqli_query($vdbm, $data_q);

                if(!$result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }

                $exist = mysqli_num_rows($result);

                return $exist;
        }

	function getCompanyNameviaShiftID($shiftid)
        {
                include "vca_conn.php";

                $data_q = "SELECT departments.company_id as coid FROM department_shifts, departments WHERE department_shifts.dept_id = departments.dept_id AND 
		department_shifts.shift_id = '$shiftid'";
                $result = mysqli_query($vdbm, $data_q);

                if(!$result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }

                $p_co_id = mysqli_fetch_assoc($result);
		$f_co_id = $p_co_id["coid"];		

		$q_co_name = "SELECT company_name FROM company_info WHERE id = '$f_co_id'";
                $c_result = mysqli_query($vdbm, $q_co_name);	
		
		if(!$c_result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }

               	$fdata = mysqli_fetch_assoc($c_result);
		return $fdata["company_name"];
        }

	function updateCompanyProfileField($id, $data, $field)
        {
	        include "vca_conn.php";
                $fdata = mysqli_real_escape_string($vdbm, $data);

                $update_stmt = "UPDATE company_info SET $field='$fdata' WHERE id = '$id'";
                $update_result = mysqli_query ($vdbm, $update_stmt);
		
		if(!$update_result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }
        }

   	function getCompanyIDviaSess($sessid)
        {
                include "vca_conn.php";

                $data_q = "SELECT company_id FROM signup_verify WHERE signup_id='$sessid'";
                $result = mysqli_query($vdbm, $data_q);

                if(!$result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }

                $exist = mysqli_fetch_assoc($result);

                return $exist["company_id"];
        }

	function activateSess($sess_id)
        {
                include "vca_conn.php";

		$today = date("Y-m-d", time());

               	$update_stmt = "UPDATE signup_verify SET status='1', date_activated='$today' WHERE signup_id = '$sess_id'";
                $update_result = mysqli_query ($vdbm, $update_stmt);

               	if(!$update_result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }

		$co_id = $this->getCompanyIDviaSess($sess_id);
		$this->sendAdminWelcomeMail($co_id);

        }

	function activateCompany($co_id)
        {
               	include "vca_conn.php";

                $update_stmt = "UPDATE company_info SET company_status='1' WHERE id = '$co_id'";
                $update_result = mysqli_query ($vdbm, $update_stmt);

                if(!$update_result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
               	}

        }

	function activateAdminAccount($id)
        {
               	include "vca_conn.php";

                $update_stmt = "UPDATE staff_info SET staff_status='1' WHERE staff_id = '$id'";
                $update_result = mysqli_query ($vdbm, $update_stmt);

                if(!$update_result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
               	}

        }

	function updateUserStatus($id, $status)
        {
                include "vca_conn.php";

                $update_stmt = "UPDATE staff_info SET staff_status='$status' WHERE staff_id = '$id'";
                $update_result = mysqli_query ($vdbm, $update_stmt);

                if(!$update_result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }
        }

	function updateUserPassword($id, $data, $field)
        {
                include "vca_conn.php";
		$fdata = md5($data);
		
		//$fdata = $data;

                $update_stmt = "UPDATE staff_info SET $field='$fdata' WHERE staff_id = '$id'";
                $update_result = mysqli_query ($vdbm, $update_stmt);

                /*if(!$update_result)
               	{
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }*/
        }

	function clearQueueJob($qid)
        {
                include "vca_conn.php";

                $update_stmt = "UPDATE monitor_queue SET run_status='1' WHERE id='$qid'";
                $update_result = mysqli_query ($vdbm, $update_stmt);

                if(!$update_result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }
        }

	function getNotifyEmail($shiftid)
        {
	
               	include "vca_conn.php";

		$m_data_q = "SELECT staff_info.email as email FROM monitor_info, staff_info WHERE 
		monitor_info.staff_id = staff_info.staff_id AND monitor_info.shift_id = '$shiftid' AND monitor_info.monitor='1'";

               	$m_result = mysqli_query($vdbm, $m_data_q);

                if(!$m_result)
                {
                	//$errno = mysqli_errno($vdbm);
                   	$error = mysqli_error($vdbm);
                   	die("Query Error: $error (code: $errno)");
            	}


		return $m_result;
	}

  	function updateDepartmentField($id, $data, $field)
        {
                include "vca_conn.php";
                $fdata = mysqli_real_escape_string($vdbm, $data);

               	$update_stmt = "UPDATE departments SET $field='$fdata' WHERE dept_id = '$id'";
                $update_result = mysqli_query ($vdbm, $update_stmt);

               	if(!$update_result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }
        }

	function snapStaffSelfie($staffid, $selfiepath)
        {
                include "vca_conn.php";

                $data_q = "UPDATE staff_info SET staff_photo='$selfiepath' WHERE staff_id='$staffid'";
                $result = mysqli_query($vdbm, $data_q);

                if(!$result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }

        }

	function assignGroupShift($staffgroup, $deptid, $shiftid)
        {
                include "vca_conn.php";
		$p_staffList = explode(",",$staffgroup);
		//print_r($p_staffList);
		for ($i=0;$i<count($p_staffList);$i++)
		{
			$check_if_user_exist = $this->checkifUserinDeptShift($p_staffList[$i]);
			if ($check_if_user_exist == 1)
			{
                		$data_q = "UPDATE staff_dept_shift SET dept_id='$deptid', shift_id='$shiftid' WHERE staff_id='$p_staffList[$i]'";
			}
			else
			{
                                $data_q = "INSERT INTO staff_dept_shift (dept_id, shift_id, staff_id)
				 VALUES
				('$deptid', '$shiftid','$p_staffList[$i]')";
			}
			/*echo "<script language=\"javascript\"> alert('Staff(s) $p_staffList[$i]')</script>";*/
                	$result = mysqli_query($vdbm, $data_q);
                	if(!$result)	
                	{
                  		$errno = mysqli_errno($vdbm);
                  		$error = mysqli_error($vdbm);
                  		die("Query Error: $error (code: $errno)");
                	}
		}
        }

	function checkifUserinDeptShift($userid)
        {
                include "vca_conn.php";

                $check_stmt = "SELECT staff_id FROM staff_dept_shift WHERE staff_id = '$userid'";
                $check_result = mysqli_query ($vdbm, $check_stmt);

                if(!$check_result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }

		$exist = mysqli_num_rows($check_result);
		return $exist;
        }

	function assignShiftMonitor($user, $shiftid)
        {
                include "vca_conn.php";
                $p_shiftList = explode(",",$shiftid);

		if ($p_shiftList[0] == -1)
		{
		   $this->removeAllMonitoring($user);
		}
		else
		{
		   $this->removeAllMonitoring($user);
               	   for ($i=0;$i<count($p_shiftList);$i++)
                   {
        		//$check_exist = $this->checkmonitorexist($p_staffList[$i]);
			$fshiftid = $p_shiftList[$i];
	         	$data_q = "INSERT INTO monitor_info (staff_id, shift_id)  VALUES ('$user', '$fshiftid')";

                       	/*echo "<script language=\"javascript\"> alert('Staff(s) $p_shiftList[$i]')</script>";*/
                        $result = mysqli_query($vdbm, $data_q);
                       	if(!$result)
                       	{
                                $errno = mysqli_errno($vdbm);
                               	$error = mysqli_error($vdbm);
                                die("Query Error: $error (code: $errno)");
                        }
                   }
		}
	}

	function removeAllMonitoring($staffid)
        {
                include "vca_conn.php";
                $data_q = "DELETE FROM monitor_info WHERE staff_id='$staffid'";
                $result = mysqli_query($vdbm, $data_q);
                if(!$result)
                {
                        $errno = mysqli_errno($vdbm);
                        $error = mysqli_error($vdbm);
                        die("Query Error: $error (code: $errno)");
                }
        }

	function checkmonitorexist($staffid)
	{
	        include "vca_conn.php";
		$data_q = "SELECT id FROM monitor_info WHERE staff_id='$staffid'";
		$result = mysqli_query($vdbm, $data_q);
                if(!$result)
                {
                	$errno = mysqli_errno($vdbm);
                	$error = mysqli_error($vdbm);
                        die("Query Error: $error (code: $errno)");
                }
		$fdata = mysqli_num_rows($result);
		return $fdata;
	}

	function getUserMonitoringShift($staffid, $shiftid)
        {
                include "vca_conn.php";
                $data_q = "SELECT id FROM monitor_info WHERE staff_id='$staffid' AND shift_id='$shiftid'";
                $result = mysqli_query($vdbm, $data_q);
                if(!$result)
                {
                       	$errno = mysqli_errno($vdbm);
                       	$error = mysqli_error($vdbm);
                        die("Query Error: $error (code: $errno)");
                }
                $fdata = mysqli_num_rows($result);
                return $fdata;
        }

  	function getCompanyDepartment($coid)
        {
                include "vca_conn.php";
               	$data_q = "SELECT dept_id, department_name FROM departments WHERE company_id='$coid'";
                $result = mysqli_query($vdbm, $data_q);
                if(!$result)
                {
                        $errno = mysqli_errno($vdbm);
                        $error = mysqli_error($vdbm);
                        die("Query Error: $error (code: $errno)");
                }
                return $result;
        }

	function getCompanyDepartmentandShift($coid)
        {
               	include "vca_conn.php";
                $data_q = "SELECT departments_shifts.dept_id as deptid, departments.department_name as deptname, departments_shifts.shift_id as shiftid, 
		departments_shifts.shift_name as shiftname
		FROM departments, departments_shifts WHERE departments.dept_id = department_shifts.dept_id 
		AND departments.company_id='$coid'";
                $result = mysqli_query($vdbm, $data_q);
                if(!$result)
                {
                        $errno = mysqli_errno($vdbm);
                       	$error = mysqli_error($vdbm);
                       	die("Query Error: $error (code: $errno)");
                }
                return $result;
        }

	function getCompanyEmail($coid)
        {
                include "vca_conn.php";
                $data_q = "SELECT contact_email FROM company_info WHERE id='$coid'";
                $result = mysqli_query($vdbm, $data_q);
                if(!$result)
                {
                        $errno = mysqli_errno($vdbm);
                        $error = mysqli_error($vdbm);
                        die("Query Error: $error (code: $errno)");
                }
                $fdata = mysqli_fetch_assoc($result);
                return $fdata["contact_email"];
        }

  	function getCompanyName($coid)
        {
                include "vca_conn.php";
                $data_q = "SELECT company_name FROM company_info WHERE id='$coid'";
                $result = mysqli_query($vdbm, $data_q);
                if(!$result)
                {
                        $errno = mysqli_errno($vdbm);
                        $error = mysqli_error($vdbm);
                        die("Query Error: $error (code: $errno)");
                }
                $fdata = mysqli_fetch_assoc($result);
                return $fdata["company_name"];
        }

	function getCompanyLogin($coid)
        {
                include "vca_conn.php";
                $data_q = "SELECT company_login FROM company_info WHERE id='$coid'";
                $result = mysqli_query($vdbm, $data_q);
                if(!$result)
                {
                        $errno = mysqli_errno($vdbm);
                       	$error = mysqli_error($vdbm);
                       	die("Query Error: $error (code: $errno)");
                }
                $fdata = mysqli_fetch_assoc($result);
                return $fdata["company_login"];
        }

	function getClientCompanyProfile($co_id)
        {
                include "vca_conn.php";
                $data_q = "SELECT * FROM company_info WHERE id='$co_id'";
                $result = mysqli_query($vdbm, $data_q);
                if(!$result)
                {
                        $errno = mysqli_errno($vdbm);
                        $error = mysqli_error($vdbm);
                        die("Query Error: $error (code: $errno)");
                }

                $fdata = mysqli_fetch_assoc($result);
		return $fdata;
        }

	function getShift($company_id, $dept_id)
        {
	        include "vca_conn.php";
		 $data_q = "SELECT department_shifts.shift_id as shift_id, department_shifts.shift_name as shift_name FROM department_shifts, departments WHERE departments.dept_id = department_shifts.dept_id AND department_shifts.dept_id = '$dept_id' AND departments.company_id = '$company_id' ";
                $result = mysqli_query($vdbm, $data_q);

                if(!$result)
                {
                  $errno = mysqli_errno($vdbm);
	          $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }

                return $result;
        }

	function getShiftInfo($shift_id)
        {
	        include "vca_conn.php";
		$data_q = "SELECT * FROM department_shifts
		WHERE shift_id = '$shift_id'";
                $result = mysqli_query($vdbm, $data_q);

                if(!$result)
                {
                  $errno = mysqli_errno($vdbm);
	          $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }

		$fdata = mysqli_fetch_assoc($result);
                return $fdata;
        }


	function getStaffSelfiesbyDate($staff_id, $f_from_date, $f_to_date)
	{
               	include "vca_conn.php";

		$data_q = "SELECT * FROM attendance_log WHERE staff_id = '$staff_id' AND clock_type = 'in' AND log_date BETWEEN '$f_from_date' AND '$f_to_date'";
               	$data_r = mysqli_query ($vdbm, $data_q);
  		if(!$data_r)
                {
                 	$errno = mysqli_errno($vdbm);
                 	$error = mysqli_error($vdbm);
                 	die("Query Error: $error (code: $errno)");
                }
               	return $data_r;
	}

	function getShiftName($shift_id)
        {
                include "vca_conn.php";
                $data_q = "SELECT shift_name FROM department_shifts WHERE shift_id='$shift_id'"; 
                $result = mysqli_query($vdbm, $data_q);

                if(!$result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }

		$fdata = mysqli_fetch_assoc($result);
                return $fdata["shift_name"];
        }

	function getDepartmentName($dept_id)
        {
                include "vca_conn.php";
                $data_q = "SELECT department_name FROM departments WHERE dept_id='$dept_id'"; 
                $result = mysqli_query($vdbm, $data_q);

                if(!$result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }

		$fdata = mysqli_fetch_assoc($result);
                return $fdata["department_name"];
        }

	function getStaffSelfies($company_id)
        {
                include "vca_conn.php";
                $data_q = "SELECT staff_id, staff_name, staff_photo FROM staff_info WHERE company_id='$company_id'";
                $result = mysqli_query($vdbm, $data_q);

                if(!$result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }

                return $result;
        }

   	function getStaffSelfiesbyDept($company_id, $dept_id)
        {
                include "vca_conn.php";
                $data_q = "SELECT staff_info.staff_id as staff_id, staff_info.staff_name as staff_name, staff_info.staff_photo as staff_photo, 
		staff_dept_shift.shift_id as shift_id FROM staff_info, staff_dept_shift WHERE staff_info.staff_id = staff_dept_shift.staff_id 
		AND staff_info.company_id='$company_id' AND staff_dept_shift.dept_id = '$dept_id'
		";
                $result = mysqli_query($vdbm, $data_q);

                if(!$result)
               	{
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }

                return $result;
        }

   	function getStaffSelfiesbyCompany($company_id)
        {
                include "vca_conn.php";

		/*$data_q = "SELECT staff_info.staff_id as staff_id, staff_info.staff_name as staff_name, staff_info.staff_photo as staff_photo, 
		staff_dept_shift.dept_id as dept_id,
               	staff_dept_shift.shift_id as shift_id FROM staff_info, staff_dept_shift WHERE staff_info.staff_id = staff_dept_shift.staff_id
                AND staff_info.company_id='$company_id'
               	";*/
		$data_q = "SELECT staff_info.staff_id as staff_id, staff_info.staff_name as staff_name, staff_info.staff_photo as staff_photo
               	FROM staff_info WHERE staff_info.company_id='$company_id'
               	";

                $result = mysqli_query($vdbm, $data_q);

                if(!$result)
               	{
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }

                return $result;
        }

	function getDepartment($company_id)
        {
                include "vca_conn.php";
                $data_q = "SELECT dept_id, department_name FROM departments WHERE company_id='$company_id'";
                $result = mysqli_query($vdbm, $data_q);

                if(!$result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }

                return $result;
        }

	function getDepartmentShifts($dept_id)
        {
                include "vca_conn.php";
                $data_q = "SELECT shift_id, dept_id, shift_name FROM department_shifts WHERE dept_id='$dept_id'";
                $result = mysqli_query($vdbm, $data_q);

                if(!$result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }

                return $result;
        }

	function addNewStaff($co_id, $name, $username, $email, $number, $password, $isadmin, $monitor)
        {
                include "vca_conn.php";
		$fpass = md5($password);
		$data_q = "INSERT INTO staff_info (company_id, is_admin, staff_name, login_name, password, email, contact_number, monitor) 
		VALUES ('$co_id', '$isadmin', '$name', '$username','$fpass', '$email', '$number', '$monitor')";

                $result = mysqli_query($vdbm, $data_q);

                if(!$result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }

                $staff_id = mysqli_insert_id($vdbm);

                return $staff_id;
        }

   	function addStafftoShift($staff_id, $dept_id, $shift_id)
        {
               	include "vca_conn.php";

                 /*       echo "<script language=\"javascript\"> alert('In Class Dept $dept_id Shift $shift_id Staff ID $staff_id')</script>";*/
               	$data_Shift = "INSERT INTO staff_dept_shift (staff_id, dept_id, shift_id) VALUES ('$staff_id', '$dept_id', '$shift_id')";


                $sresult = mysqli_query($vdbm, $data_Shift);

                if(!$sresult)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }

        }

	function addNewVerification($signup_id, $co_id)
        {
                include "vca_conn.php";

		$today = date("Y-m-d", time());

                $data_Shift = "INSERT INTO signup_verify (signup_id, company_id, date_signup, status) VALUES ('$signup_id', '$co_id', '$today','0')";

                $sresult = mysqli_query($vdbm, $data_Shift);

                if(!$sresult)
                {
               	  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
               	}

	}

	//function addNewShift($dept_id, $shift_name, $timezone, $mon_starttime, $tues_starttime, $wed_starttime, $thurs_starttime, $fri_starttime, $sat_starttime, $sun_starttime, $mon_endtime, $tues_endtime, $wed_endtime, $thurs_endtime, $fri_endtime, $sat_endtime, $sun_endtime)
	function addNewShift($dept_id, $shift_name, $timezone, $starttime, $endtime)
        {

                include "vca_conn.php";
		$setdaystate = array();

     //                   echo "<script language=\"javascript\"> alert('New Shift 1 \"$fshift_name $ftimezone\" ')</script>";

		for ($i=0; $i<count($starttime); $i++)
		{
			if($starttime[$i] != "")
			{
				$chk_graveYard = $this->checkifGraveYard($starttime[$i],$endtime[$i]);

   //                     echo "<script language=\"javascript\"> alert('In Grave Yard \"$starttime[$i]\" ')</script>";
			
				if ($chk_graveYard == 1)
				{
					// Yes Graveyard
					$setdaystate[$i] = 1;
				}
				else
				{
					// Not Graveyard
					 $setdaystate[$i] = 2;
				}
			}
			else
			{
				// Off Day
				$setdaystate[$i] = 0;
				$starttime[$i] = "00:00:00";
				$endtime[$i] = "00:00:00";
			}
			//echo $i." graveyard state ".$setdaystate." ". $starttime[$i]." | ";
		}


                $data_q = "INSERT INTO department_shifts (dept_id, shift_name, time_zone, monday, tuesday, wednesday, thursday, friday, saturday, sunday, monday_starttime, tuesday_starttime, wednesday_starttime, thursday_starttime, friday_starttime, saturday_starttime, sunday_starttime, monday_endtime, tuesday_endtime, wednesday_endtime, thursday_endtime, friday_endtime, saturday_endtime, sunday_endtime) 
		VALUES ('$dept_id','$shift_name', '$timezone', '$setdaystate[0]', 
		'$setdaystate[1]', '$setdaystate[2]', '$setdaystate[3]', '$setdaystate[4]', '$setdaystate[5]', '$setdaystate[6]', 
		'$starttime[0]', '$starttime[1]', '$starttime[2]', '$starttime[3]', '$starttime[4]', '$starttime[5]', '$starttime[6]', 
		'$endtime[0]', '$endtime[1]', '$endtime[2]', '$endtime[3]', '$endtime[4]', '$endtime[5]', '$endtime[6]')";

                $result = mysqli_query($vdbm, $data_q);

                /*if(!$result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }*/

                $shift_id = mysqli_insert_id($vdbm);

                return $shift_id;
        }

	function updateShiftInfo($shift_id, $timezone, $starttime, $endtime)
        {
                include "vca_conn.php";
		$setdaystate = array();

		for ($i=0; $i<count($starttime); $i++)
		{
			if($starttime[$i] != "")
			{
				if ($starttime[$i] == $endtime[$i])	
				{
					// Off Day
	                                $setdaystate[$i] = 0;
				}
				else
				{
					$chk_graveYard = $this->checkifGraveYard($starttime[$i],$endtime[$i]);
			
					if ($chk_graveYard == 1)
					{
						// Yes Graveyard
						$setdaystate[$i] = 1;
					}
					else
					{
						// Not Graveyard
					 	$setdaystate[$i] = 2;
					}
				}
			
			}
			else
			{
				// Off Day
				$setdaystate[$i] = 0;
				$starttime[$i] = "00:00";
				$endtime[$i] = "00:00";
			}
			//echo $i." graveyard state ".$setdaystate." ". $starttime[$i]." | ";
		}

		if ($timezone != "-1")
		{
                	$data_q = "UPDATE department_shifts SET time_zone='$timezone', monday='$setdaystate[0]', tuesday='$setdaystate[1]', wednesday='$setdaystate[2]', 
			thursday='$setdaystate[3]', friday='$setdaystate[4]', saturday='$setdaystate[5]', sunday='$setdaystate[6]', 
			monday_starttime='$starttime[0]', tuesday_starttime='$starttime[1]', wednesday_starttime='$starttime[2]', thursday_starttime='$starttime[3]', 
			friday_starttime='$starttime[4]', saturday_starttime='$starttime[5]', sunday_starttime='$starttime[6]', 
			monday_endtime='$endtime[0]', tuesday_endtime='$endtime[1]', wednesday_endtime='$endtime[2]', thursday_endtime='$endtime[3]', 
			friday_endtime='$endtime[4]', saturday_endtime='$endtime[5]', sunday_endtime='$endtime[6]' WHERE shift_id = '$shift_id'";
		}
		else
		{
			$data_q = "UPDATE department_shifts SET monday='$setdaystate[0]', tuesday='$setdaystate[1]', wednesday='$setdaystate[2]',
                        thursday='$setdaystate[3]', friday='$setdaystate[4]', saturday='$setdaystate[5]', sunday='$setdaystate[6]',
                       	monday_starttime='$starttime[0]', tuesday_starttime='$starttime[1]', wednesday_starttime='$starttime[2]', thursday_starttime='$starttime[3]',
                       	friday_starttime='$starttime[4]', saturday_starttime='$starttime[5]', sunday_starttime='$starttime[6]',
                        monday_endtime='$endtime[0]', tuesday_endtime='$endtime[1]', wednesday_endtime='$endtime[2]', thursday_endtime='$endtime[3]',
                       	friday_endtime='$endtime[4]', saturday_endtime='$endtime[5]', sunday_endtime='$endtime[6]' WHERE shift_id = '$shift_id'";
		}
                $result = mysqli_query($vdbm, $data_q);

                if(!$result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }

        }

	function checkifGraveYard($start_time,$end_time)
	{
		$dtA = new DateTime($start_time);
		$dtB = new DateTime($end_time);

		if ( $dtA > $dtB ) {
		  //echo 'dtA > dtB';
		  $graveyard = 1;	
		}
		else {
		  //echo 'dtA <= dtB';
		   $graveyard = 0;	
		}

		return $graveyard;
	}

	function addAttStaff_v2($staff, $base ,$work_days,$start_time,$end_time,$timezone,$track_attendance)
	{
	        $data_q = "INSERT INTO attendance_operators_info (staff_id,base_void,work_days,start_time,end_time,timezone,track_attendance) VALUES ('$staff','$base','$work_days','$start_time','$end_time','$timezone','$track_attendance')";
		$data_r = mysql_query ($data_q) or die("Could not enter data into entitlements.\n".mysql_error());
	}
	
	function generateClientPwd($length = 14) 
	{
    		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
    		for ($i = 0; $i < $length; $i++) 
		{
		        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    		}
	
		return $randomString;
	}
   	
	function portal_getUserToken($id)
       	{
               	$data_r = mysql_query("SELECT token FROM client_info WHERE clientid = '$id'") or die("Get Token Failed!");
               	$fdata = mysql_fetch_array($data_r);
               	return $fdata["token"];
       	}
	function portal_updateClientToken($cid, $token)
        {
               	$update_stmt = "UPDATE client_info SET token='$token' WHERE clientid = '$cid'";
               	$update_result = mysql_query ($update_stmt) or die("Could not update Client Field \n");
       	}

	function getProductNameByID($id)
	{
		
	        $data_q = "SELECT product_name FROM products WHERE product_id='$id' ";
		$data_r = mysql_query ($data_q) or die("Could not get Staff VOID Access.\n");

		$fdata = mysql_fetch_row($data_r);
		return $fdata[0];
	}
	
	function GetStaffAtdc($id,$datefrom,$dateto)
	{
        	$data_q = "SELECT * FROM attendance_log WHERE staff_id =$id AND log_date BETWEEN '$datefrom' AND '$dateto' AND check_in_type='in'";
		$data_r = mysql_query ($data_q) or die("Could not find any clinet.\n");
		return $data_r;
	}

	function getStaffAttendanceLogout($id,$date)
        {
                $data_q = "SELECT log_time FROM attendance_log WHERE staff_id=$id AND log_date='$date' AND check_in_type='Out'";
               	$data_r = mysql_query ($data_q) or die("Could not find any Staff Logout.\n");
               	$fdata =  mysql_fetch_assoc($data_r);
		return $fdata["log_time"];
        }

	function getAttndceSet($id)
	{
        	$data_q = "SELECT * FROM attendance_operators_info WHERE staff_id='$id'";
		$data_r = mysql_query ($data_q) or die("Could not find any clinet.\n");
		return $data_r;
	}

	function getStaffAttByID($id)
	{
		
       		 $data_q = "SELECT staff_id FROM attendance_operators_info WHERE staff_id='$id' ";
		$data_r = mysql_query ($data_q) or die("Could not get Staff VOID Access.\n");
		$fdata = mysql_fetch_row($data_r);
		return $fdata[0];
	}
		function getClientIDfromclient_contacts($id)
	{
		
        $data_q = "SELECT cp_id FROM client_contacts WHERE id='$id' ";
		$data_r = mysql_query ($data_q) or die("Could not get client id.\n");
		$fdata = mysql_fetch_row($data_r);
		return $fdata[0];
	}


	function getVOCountryCode($voloc)
	{
        $data_q = "SELECT country_code FROM location_info WHERE id='$voloc'";
		$data_r = mysql_query ($data_q) or die("Could not get VO Country Code.\n");

		$fdata = mysql_fetch_row($data_r);
		return $fdata[0];
	}

	function getVOinfoTemplate($voloc)
	{
        $data_q = "SELECT * FROM location_info WHERE id='$voloc'";
		$data_r = mysql_query ($data_q) or die("Could not get VO Info.\n");

		$fdata = mysql_fetch_array($data_r);
		return $fdata;
	}

	

	function addSuiteInfo( $snumber, $date, $sprice, $cprice, $lprice, $currency, $pax, $country, $branch)
	{
		$data_q = "INSERT INTO suite_availability (suite_number, availability_date, standard_price, current_price, low_price, currency, pax, country, branch) VALUES ('$snumber', '$date', '$sprice', '$cprice', '$lprice', '$currency', '$pax', '$country', '$branch')";
		$data_r = mysql_query ($data_q) or die("Could not insert number.\n". mysql_error());
	}
	function setPermissionsStaff($op_id, $vo_id, $core, $addclient, $manageclient, $invoicing, $suspendaccount, $updateprofile, $changeClientPassword, $editfacilitieshours, $editplansettings, $updateclientstatus, $editmiscsettings, $editreceipt, $changesalesleadownership, $callqa, $number_cancel_auth, $send_mass_email, $vworld, $barcode)
	{
		$data_q = "INSERT INTO operator_acl 
		(op_id, vo_id, core, addclient, manageclient, invoicing, suspendaccount, updateprofile, changeClientPassword, editfacilitieshours, editplansettings, updateclientstatus, editmiscsettings, editreceipt, changesalesleadownership, callqa, number_cancel_auth, send_mass_email, vworld, barcode) 
		VALUES 
		('$op_id', '$vo_id', '$core', '$addclient', '$manageclient', '$invoicing', '$suspendaccount', '$updateprofile', '$changeClientPassword', '$editfacilitieshours', '$editplansettings', '$updateclientstatus', '$editmiscsettings', '$editreceipt', '$changesalesleadownership', '$callqa', '$number_cancel_auth', '$send_mass_email', '$vworld', '$barcode')";
		
		$data_r = mysql_query ($data_q) or die("Could not insert number.\n". mysql_error());
	}
	function addStaffLocationPerms($op_id, $vo_id, $core){
		$data_q = "INSERT INTO operator_acl (op_id, vo_id, core)VALUES ('$op_id', '$vo_id', '$core')";
		$data_r = mysql_query ($data_q) or die("Could not insert number.\n". mysql_error());
	}
		
		function updateStaffPermissions($id)
	{
	    $data_q = "UPDATE operator_acl SET vo_id='$void' WHERE id='$id'";
		$data_r = mysql_query ($data_q) or die("Could not Update Staff Location.\n");
	}
		function updatePlanRequests($id,$stat,$reason)
	{
	    $data_q = "UPDATE products_req SET request_stat='$stat', reason='$reason' WHERE product_id='$id'";
		$data_r = mysql_query ($data_q) or die("Could not Update Plan Requests.\n");
	}
		function updateAllStaffPermissions($op_id, $vo_id, $core, $addclient, $manageclient, $invoicing, $suspendaccount, $updateprofile, $changeClientPassword, $editfacilitieshours, $editplansettings, $updateclientstatus, $editmiscsettings, $editreceipt, $changesalesleadownership, $callqa, $number_cancel_auth, $send_mass_email, $vworld, $barcode)
	{
	    $data_q = "UPDATE operator_acl SET  core = '$core', addclient='$addclient', manageclient='$manageclient', invoicing='$invoicing', suspendaccount='$suspendaccount', updateprofile='$updateprofile', changeClientPassword='$changeClientPassword', editfacilitieshours='$editfacilitieshours' , editplansettings='$editplansettings', updateclientstatus='$updateclientstatus', editmiscsettings='$editmiscsettings' , editreceipt='$editreceipt', changesalesleadownership='$changesalesleadownership', callqa='$callqa', number_cancel_auth='$number_cancel_auth', send_mass_email='$send_mass_email', vworld='$vworld', barcode='$barcode' WHERE op_id='$op_id' AND vo_id='$vo_id'";
		$data_r = mysql_query ($data_q) or die("Could not Update Staff Location.\n");
	}
	

	function getStaffAttendanceTimeOut($staffid, $in_date)
        {
               	$data_q = "SELECT log_time FROM attendance_log WHERE staff_id='$staffid' AND log_date='$in_date' AND check_in_type='Out'";

               	$data_r = mysql_query ($data_q) or die("Could not get Staff Attendance Time Out.\n");

		$o_data = mysql_fetch_assoc($data_r);
               	return $o_data["log_time"];
       	}

	function getStaffClockInfobyDate($staff_id, $f_from_date, $clocktype)
	{
               	include "vca_conn.php";

		$data_q = "SELECT id, log_time, attendance_file, log_date, base_log_time, shift_type FROM attendance_log WHERE clock_type = '$clocktype' 
		AND staff_id = '$staff_id' AND log_date='$f_from_date' ORDER BY id DESC";
		$result = mysqli_query($vdbm, $data_q);

                if(!$result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }

		$fdata = mysqli_fetch_assoc($result);
                return $fdata;
	}

	function getStaffAllClockInfobyDate($staff_id, $f_from_date)
	{
               	include "vca_conn.php";
		$data_q = "SELECT log_time, attendance_file, log_date, base_log_time, shift_type FROM attendance_log WHERE staff_id = '$staff_id' AND log_date='$f_from_date'";
		$result = mysqli_query($vdbm, $data_q);

                if(!$result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }

		$fdata = mysqli_fetch_assoc($result);
                return $fdata;
	}

	function checkStaffWorkDay($shift_id, $checkday)
        {
                include "vca_conn.php";
                $f_inday = strtolower($checkday);
		
                $data_q = "SELECT department_shifts.$f_inday as qday
                FROM department_shifts WHERE shift_id='$shift_id'";

                $result = mysqli_query($vdbm, $data_q);
		$fdata = mysqli_fetch_assoc($result);
	
                if(!$result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }

                return $fdata["qday"];
        }

	function getStaffShiftType($staff_id, $clock_type, $in_date)
        {
               	include "vca_conn.php";

               	$data_q = "SELECT shift_type FROM attendance_log WHERE staff_id='$staff_id' AND clock_type='$clock_type' AND log_date='$in_date'";

                $result = mysqli_query($vdbm, $data_q);
                $fdata = mysqli_fetch_assoc($result);

                if(!$result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
               	}

                return $fdata["shift_type"];
        }

	function getStaffShiftTypeviaDay($staff_id, $in_day)
        {
                include "vca_conn.php";

		$starttime = $in_day."_starttime";
		$endtime = $in_day."_endtime";

                $data_q = "SELECT department_shifts.$in_day as shifttype, department_shifts.$starttime as basestart, department_shifts.$endtime as baseend, 
		department_shifts.shift_id as shiftid  
		FROM staff_dept_shift, department_shifts
		WHERE staff_dept_shift.shift_id = department_shifts.shift_id AND staff_dept_shift.staff_id='$staff_id'";

		//echo $data_q." ";

                $result = mysqli_query($vdbm, $data_q);
                $fdata = mysqli_fetch_assoc($result);

               if(!$result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                } 

                return $fdata;
        }

	function getAllStaffAttendanceList($deptid, $shiftid, $fromdate, $todate)
       	{
		include "vca_conn.php";

		$data_q = "SELECT attendance_log.staff_id as staff_id, attendance_log.log_date as logdate, attendance_log.clock_type as clocktype, 
		attendance_log.attendance_file as afile 
		FROM attendance_log, staff_dept_shift WHERE attendance_log.staff_id = staff_dept_shift.staff_id AND
		staff_dept_shift.shift_id = '$shiftid' AND staff_dept_shift.dept_id ='$deptid' AND attendance_log.log_date BETWEEN '$fromdate' AND '$todate'
		";
	
                $result = mysqli_query($vdbm, $data_q);

                if(!$result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }

                return $result;
	}

	function getAllStaffWorkList($shiftid, $userinfo, $switch)
        {
                include "vca_conn.php";

		$p_shiftList = explode(",",$shiftid);
		$p_userList = explode(",",$userinfo);


		$shift_stmt = " (";

		for ($i=0; $i<count($p_shiftList); $i++)
		{
			$fshiftid = $p_shiftList[$i];

			if ($i != 0)
			{
                               	$shift_stmt .= " OR staff_dept_shift.shift_id ='$fshiftid' ";

			}
			else
			{
				$shift_stmt .= "staff_dept_shift.shift_id ='$fshiftid'";

			} 

		}

		$shift_stmt .= " )";

		$users_stmt = " (";

                for ($u=0; $u<count($p_userList); $u++)
                {
                       	$fuserid = $p_userList[$u];

                        if ($u != 0)
                        {
                               	$users_stmt .= " OR staff_info.staff_id ='$fuserid' ";

                        }
                        else
                        {
                                $users_stmt .= "staff_info.staff_id ='$fuserid'";

                        }

                }

                $users_stmt .= " )";


                /*$data_q = "SELECT staff_dept_shift.id as id, staff_dept_shift.staff_id as staff_id, staff_dept_shift.dept_id as dept_id, staff_dept_shift.shift_id as shift_id
		FROM staff_dept_shift, staff_info WHERE staff_dept_shift.staff_id = staff_info.staff_id AND staff_dept_shift.shift_id = '$shiftid'
		AND staff_info.monitor = '1'
		";*/

		if ($switch == "d")
		{
                	$data_q = "SELECT staff_dept_shift.id as id, staff_dept_shift.staff_id as staff_id, staff_dept_shift.dept_id as dept_id, staff_dept_shift.shift_id as shift_id
			FROM staff_dept_shift, staff_info WHERE staff_dept_shift.staff_id = staff_info.staff_id AND staff_info.monitor = '1' AND ".$shift_stmt;
		}
		else
		{
                	$data_q = "SELECT staff_dept_shift.id as id, staff_dept_shift.staff_id as staff_id, staff_dept_shift.dept_id as dept_id, staff_dept_shift.shift_id as shift_id
			FROM staff_dept_shift, staff_info WHERE staff_dept_shift.staff_id = staff_info.staff_id AND staff_info.monitor = '1' AND ".$users_stmt;
		}

//		echo "<script language=\"javascript\"> alert('$data_q')</script>";

//		echo "Wat ".$switch." ".$data_q;

               	$result = mysqli_query($vdbm, $data_q);

                if(!$result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
               	}

                return $result; 
        }


	function getShiftDetails($shiftid, $inday)
        {
                include "vca_conn.php";
		$f_inday = strtolower($inday);

		$shift_starttime = $f_inday."_starttime";
		$shift_endtime = $f_inday."_endtime";

                $data_q = "SELECT department_shifts.$inday as pday, department_shifts.$shift_starttime as pday_starttime, department_shifts.$shift_endtime as pday_endtime 
                FROM department_shifts WHERE shift_id = '$shiftid'";

                $result = mysqli_query($vdbm, $data_q);

                if(!$result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
               	}

                return $result;
        }

   	function getShiftDetails_v2($shiftid, $inday)
        {
                include "vca_conn.php";
                $f_inday = strtolower($inday);

                $shift_starttime = $f_inday."_starttime";
                $shift_endtime = $f_inday."_endtime";

                $data_q = "SELECT department_shifts.$inday as pday, department_shifts.$shift_starttime as pday_starttime, department_shifts.$shift_endtime as pday_endtime
                FROM department_shifts WHERE shift_id = '$shiftid'";

               	$result = mysqli_query($vdbm, $data_q);

                if(!$result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }

               	$fdata = mysqli_fetch_assoc($result);
		return $fdata;
        }

   	function getStaffAttendanceInfo($staff_id)
        {
                $data_q = "SELECT * FROM attendance_operators_info WHERE staff_id='$staff_id'";
                $data_r = mysql_query ($data_q) or die("Could not get Staff Attendance Info.\n");

                return $data_r;
        }

	function getStaffName($staffid)
	{
                include "vca_conn.php";

	        $data_q = "SELECT staff_name FROM staff_info WHERE staff_id='$staffid'";

		$result = mysqli_query($vdbm, $data_q);

                if(!$result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }

		$fdata = mysqli_fetch_row($result);
		return $fdata[0];
	}
	
	function getStaffEmailId($staffid)
	{
                include "vca_conn.php";

	        $data_q = "SELECT email FROM staff_info WHERE staff_id='$staffid'";

		$result = mysqli_query($vdbm, $data_q);

                if(!$result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }

		$fdata = mysqli_fetch_row($result);
		return $fdata[0];
	}
	
	function getAllStaffs()
	{
        $data_q = "SELECT * FROM operators ORDER BY loginname ASC";
		$data_r = mysql_query ($data_q) or die("Could not get Staff Name.\n");
		return $data_r;
	}
		function getAllActiveStaffs()
	{
        $data_q = "SELECT * FROM operators WHERE status='1' ORDER BY loginname ASC";
		$data_r = mysql_query ($data_q) or die("Could not get Staff Name.\n");
		return $data_r;
	}
		function getFacilitiesName($id)
	{
        $data_q = "SELECT facilities_type FROM facilities_type WHERE id='$id'";
		$data_r = mysql_query ($data_q) or die("Could not get Facility Name.\n");

		$fdata = mysql_fetch_row($data_r);
		return $fdata[0];
	}
		function getStatusName($id)
	{
        $data_q = "SELECT status_desc FROM client_status WHERE id='$id'";
		$data_r = mysql_query ($data_q) or die("Could not get Status.\n");

		$fdata = mysql_fetch_row($data_r);
		return $fdata[0];
	}
	
	// VCA
	function getStaffProfile($staffid)
	{
				                include "vca_conn.php";
	        $data_q = "SELECT * FROM staff_info WHERE staff_id='$staffid'";
		$data_r = mysqli_query ($vdbm,$data_q) or die("Could not get Staff Name.\n");

		$fdata = mysqli_fetch_assoc($data_r);
		return $fdata;
	}

	function getStaffIDSimple($staffid)
	{
        $data_q = "SELECT * FROM operators WHERE id='$staffid'";
		$data_r = mysql_query ($data_q) or die("Could not get Staff ID.\n");
		return $data_r;
	}
		function getAllStaffProfile()
	{
        $data_q = "SELECT * FROM operators WHERE status = '1'";
		$data_r = mysql_query ($data_q) or die();
		return $data_r;
	}
		function filterStaffProfile($loc)
	{
        $data_q = "SELECT * FROM operators WHERE vo_id='$loc' AND status = '1'";
		$data_r = mysql_query ($data_q) or die();
		return $data_r;
	}
	
	function getStaffEmail($staffid)
	{
        $data_q = "SELECT email FROM operators WHERE id='$staffid'";
		$data_r = mysql_query ($data_q) or die("Could not get Staff Name.\n");

		$fdata = mysql_fetch_assoc($data_r);
		return $fdata["email"];
	}
	
	function getMessengerTypeName($type_id)
	{
        $data_q = "SELECT messenger_type_name FROM vo_messenger_type WHERE messenger_type_id='$type_id'";
		$data_r = mysql_query ($data_q) or die("Could not get Staff Messenger Type Name.\n");

		$fdata = mysql_fetch_assoc($data_r);
		return $fdata["messenger_type_name"];
	}

	function getMessengerTypeList()
	{
        $data_q = "SELECT * FROM vo_messenger_type";
		$data_r = mysql_query ($data_q) or die("Could not get Messenger Type Name List.\n");

		return $data_r;
		
	}

	function updateStaffLocation($cid, $void)
	{
        $data_q = "UPDATE operators SET vo_id='$void' WHERE id='$cid'";
		$data_r = mysql_query ($data_q) or die("Could not Update Staff Location.\n");

	}
	function updateStaffMessengerType($cid, $mtype)
	{
        $data_q = "UPDATE operators SET messenger_type='$mtype' WHERE id='$cid'";
		$data_r = mysql_query ($data_q) or die("Could not Update Staff Messenger Type.\n");

	}

	function updateStaffAvatar($cid, $imagename)
	{
        $data_q = "UPDATE operators SET profile_photo_path='$imagename' WHERE id='$cid'";
		$data_r = mysql_query ($data_q) or die("Could not Update Staff Photo.\n");

	}


	function updateStaffProfileField($id, $data, $field)
	{	
	        include "vca_conn.php";
		/*$fdata = mysql_real_escape_string($data);
		$jmsg = "ID ".$id." fdata ".$data." Field ".$field;
		echo "<script language=\"javascript\"> alert('$jmsg')</script>";*/
		$data_q = "UPDATE staff_info SET $field='$data' WHERE staff_id = '$id'";

                $result = mysqli_query($vdbm, $data_q);

                if(!$result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }
	}

	function updateShiftField($id, $data, $field)
	{	
	        include "vca_conn.php";
		/*$fdata = mysql_real_escape_string($data);
		$jmsg = "ID ".$id." fdata ".$data." Field ".$field;
		echo "<script language=\"javascript\"> alert('$jmsg')</script>";*/
		$data_q = "UPDATE department_shifts SET $field='$data' WHERE shift_id = '$id'";

                $result = mysqli_query($vdbm, $data_q);

                if(!$result)
                {
                  $errno = mysqli_errno($vdbm);
                  $error = mysqli_error($vdbm);
                  die("Query Error: $error (code: $errno)");
                }
	}

	function getStaffDashBoard($staffid)
	{
        $data_q = "SELECT dashboard_file FROM operator_group WHERE operator_id='$staffid'";
		$data_r = mysql_query ($data_q) or die("Could not get Staff Dash Board.\n");

		$fdata = mysql_fetch_assoc($data_r);
		return $fdata["dashboard_file"];
	}

	function getVOLocationwithPBX_acl($void)
	{
		//include "../include/config.php";

		$this->reConnectClientClassDB();

        $loc_check = "SELECT * FROM location_info WHERE id='$void'";
		$loc_out = mysql_query ($loc_check) or die (mysql_error());
		$loc_reult = mysql_fetch_array($loc_out);
		return $loc_reult;
	}

	function getNumberofVOLocation()
	{
        $data_q = "SELECT id FROM location_info";
		$data_r = mysql_query($data_q) or die("Could not get Number of VO Location.\n");

		$fdata = mysql_num_rows($data_r);
		return $fdata;
	}

	function getPBXHost($void)
	{
        $data_q = "SELECT pbx_host FROM location_info WHERE id='$void'";
		$data_r = mysql_query($data_q) or @die("Could not get PBX Host .\n");

		$fdata = mysql_fetch_row($data_r);
		return $fdata[0];
		
	}

	function getPBXUsername($void)
	{
        $data_q = "SELECT pbx_user FROM location_info WHERE id='$void'";
		$data_r = mysql_query($data_q) or die("Could not get PBX Username.\n");

		$fdata = mysql_fetch_row($data_r);
		return $fdata[0];
	}

	function getPBXPassword($void)
	{
        $data_q = "SELECT pbx_pass FROM location_info WHERE id='$void'";
		$data_r = mysql_query($data_q) or die("Could not get PBX Password.\n");

		$fdata = mysql_fetch_row($data_r);
		return $fdata[0];
	}
	
	function getPBXDB($void)
	{
        $data_q = "SELECT pbx_db FROM location_info WHERE id='$void'";
		$data_r = mysql_query($data_q) or die("Could not get PBX DB.\n");

		$fdata = mysql_fetch_row($data_r);
		return $fdata[0];
	}
	
	function getVOName($void)
	{
        $data_q = "SELECT location_desc FROM location_info WHERE id='$void'";
		//$data_r = mysql_query($data_q) or die("Could not get VO Location Name.\n");
		$data_r = mysql_query($data_q);

		$fdata = mysql_fetch_array($data_r);
		return $fdata["location_desc"];
	}
		function getFacilName($id)
	{
        $data_q = "SELECT description FROM location_facilities_v2 WHERE id='$id'";
		$data_r = mysql_query($data_q);
		$fdata = mysql_fetch_array($data_r);
		return $fdata["description"];
	}
	
	function getVOAlias($void)
	{
        $data_q = "SELECT vo_alias FROM location_info WHERE id='$void'";
		//$data_r = mysql_query($data_q) or die("Could not get VO Location Name.\n");
		$data_r = mysql_query($data_q);

		$fdata = mysql_fetch_array($data_r);
		return $fdata["vo_alias"];
	}


	function getPBXIncomingCalls($void)
	{
		//$get_tz = $this->getTimeZone("Asia/Kuala_Lumpur");		
		//date_default_timezone_set($get_tz);

		$r_pbxhost = $this->getPBXHost($void);
		$r_pbxdb = $this->getPBXDB($void);
		$r_pbxusername = $this->getPBXUsername($void);
		$r_pbxpw = $this->getPBXPassword($void);

		//echo $r_pbxhost;
		if ($r_pbxhost != "")
		{
			//echo date("Y-m-d G:i:s", time());
			
			$pdbm = mysql_connect ($r_pbxhost, $r_pbxusername, $r_pbxpw) or die ('I cannot connect to the database because: ' . mysql_error());
			mysql_select_db ($r_pbxdb, $pdbm) or die("Could not select database \n"); 
	
			$data_q = "SELECT * FROM incominglog WHERE logtime > now( ) - INTERVAL 100 MINUTE GROUP BY logtime ORDER BY id DESC";
			$data_r = mysql_query ($data_q, $pdbm) or die("Could not get Call Log.\n");
		
			return $data_r;
		}
	}

	function getPBXDisplayDate($indate)
	{
		
		$ps_date = strtotime($indate);
		$done_date = date("d-m-Y H:i:s", $ps_date);
		
		return $done_date;
	}
	
	function getStaffExtension($staffid)
	{
        $data_q = "SELECT extension FROM operators WHERE id='$staffid'";
		$data_r = mysql_query ($data_q) or die("Could not get Staff Name.\n");

		$fdata = mysql_fetch_row($data_r);
		return $fdata[0];
	}
	function getCreatedStaff($name)
	{
        $data_q = "SELECT * FROM operators WHERE loginname='$name'";
		$data_r = mysql_query ($data_q) or die("Could not get Staff Name.\n");
		return $data_r;
	}


	function checkStaffAccess($staffid, $void, $section, $rights )
	{
		
        $data_q = "SELECT id FROM operator_acl WHERE op_id='$staffid' AND vo_id='$void' AND $section='$rights'";
		$data_r = mysql_query ($data_q) or die("Could not get Staff Name.\n");

		$fdata = mysql_num_rows($data_r);

		return $fdata;
	}

	function getCallLoggingStatus()
	{
        $status_r = "SELECT * FROM call_logging_status";
		$status_info = mysql_query ($status_r) or die (mysql_error());

		return $status_info;
	}

	function getTimeZone($void)
	{
		$tz_q = "SELECT time_zone FROM location_info WHERE id='$void'";
		$tz_r = mysql_query ($tz_q) or die("Could not get Time Zone.\n");
		$fdata = mysql_fetch_row($tz_r);

		$g_tz = $fdata[0];

        //$data_q = "SET time_zone = $g_tz";
		//$data_r = mysql_query ($data_q) or die("Could not set TimeZone.\n");

		return $g_tz;
	}
		function getTimeZonebycode($code)
	{
		$tz_q = "SELECT time_zone FROM location_info WHERE country_code='$code'";
		$tz_r = mysql_query ($tz_q) or die("Could not get Time Zone.\n");
		$fdata = mysql_fetch_row($tz_r);

		$g_tz = $fdata[0];

        //$data_q = "SET time_zone = $g_tz";
		//$data_r = mysql_query ($data_q) or die("Could not set TimeZone.\n");

		return $g_tz;
	}
	function getSuspendDays($vo_id)
	{
        $data_q = "SELECT suspend_day FROM location_info WHERE id='$vo_id'";
		$data_r = mysql_query ($data_q) or die("Could not get Suspend Day.\n");

		$fdata = mysql_fetch_row($data_r);
		return $fdata[0];
	}


	function getStaffACL($vo_id, $staffid, $section)
	{
        $data_q = "SELECT $section FROM operator_acl WHERE op_id='$staffid' AND vo_id= '$vo_id'";
		$data_r = mysql_query ($data_q) or die("Could not get Staff ACL.\n");

		$fdata = mysql_fetch_row($data_r);
		return $fdata[0];
	}
	
	function getStaffVOACLList($staffid, $section)
	{
        $data_q = "SELECT vo_id FROM operator_acl WHERE op_id='$staffid' AND $section='111'";
		$data_r = mysql_query ($data_q) or die("Could not get Staff ACL VO List.\n");

		return $data_r;
	}
		function getOperatorFromPhoneLog($refid)
	{
        $data_q = "SELECT operator FROM phone_log WHERE id='$refid'";
		$data_r = mysql_query ($data_q) or die("Could not get operator FROM phone_log.\n");
		return $data_r;
	}


	function getVOAccess($staffid)
	{
        $data_q = "SELECT vo_id FROM operator_acl WHERE op_id='$staffid'";
		$data_r = mysql_query ($data_q) or die("Could not get Staff ACL.\n");

		//$fdata = mysql_fetch_row($data_r);
		return $data_r;
	}
	
	function getVOAccessv2($staffid, $main_section)
	{
        $data_q = "SELECT vo_id FROM operator_acl WHERE op_id='$staffid' AND $main_section='111'";
		$data_r = mysql_query ($data_q) or die("Could not get Staff ACL.\n");

		//$fdata = mysql_fetch_row($data_r);
		return $data_r;
	}

	function getAutoFollowupDay($void)
	{
        $data_q = "SELECT followup_auto_day FROM location_info WHERE id ='$void'";
		$data_r = mysql_query ($data_q) or die("Could not get followup day.\n");

		$fdata = mysql_fetch_row($data_r);
		return $fdata[0];
	}

	function checkVOAccess($staffid, $volist)
	{
		
        $data_q = "SELECT vo_id FROM operator_acl WHERE op_id='$staffid' AND vo_id ='$volist' ";
		$data_r = mysql_query ($data_q) or die("Could not get Staff VOID Access.\n");

		$fdata = mysql_fetch_row($data_r);
		return $fdata[0];
	}

	function setupvMailclientPanel($void, $cid, $staffid)
	{	
		//$fdata = mysql_real_escape_string($data);
		$update_stmt = "UPDATE vmail_client_panel SET client_id='$cid', staff_id='$staffid' WHERE vo_id = '$void'";
		$update_result = mysql_query ($update_stmt) or die("Could not update vMail Client Panel \n");
	}

	function logPhoneMsg($fid, $femail,$mt_date, $mt_time, $fmsg, $oid, $mtype, $mcallername, $mcallerconame, $mcallerno)
	{
		$data_q = "INSERT INTO phone_log (clientid, notify_via, log_date, log_time,  msg, operator, caller_no, caller_name, notify_type, caller_coname) VALUES ('$fid', '$femail','$mt_date', '$mt_time','$fmsg', '$oid', '$mcallerno', '$mcallername', '$mtype', '$mcallerconame' )";
		$data_r = mysql_query ($data_q) or die("Could not get Insert Pone Message.\n");
		
		$id = mysql_insert_id(); 
		return $id;
	}


	function vca_adminClass ()
	{
		require_once 'config.php';
		//$vdbm = mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) or die ('I cannot connect to the database because: ' . mysql_error());
		$vdbm = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if (mysqli_connect_errno())
  		{
 	 		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		}

		//mysql_select_db (DB_NAME) or die("Could not select database \n"); 

		/*$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if (mysqli_connect_errno()) {
		    printf("Connect failed: %s\n", mysqli_connect_error());
		    exit();
		}*/

	}

	function getNumbers()
	{
		
        $data_q = "SELECT * FROM ipadnums where reserv_stat = '0'";
		$data_r = mysql_query ($data_q) or die("Could not get data from ipadnum table.\n". mysql_error());
		return $data_r;
		
	}
	function getName($email)
	{
		
        $data_q = "SELECT * FROM operators WHERE email = '$email'";
		$data_r = mysql_query ($data_q) or die("Could not get data from ipadnum table.\n". mysql_error());

		//$return = mysql_fetch_assoc($data_r);
		return $data_r;
	}
	function checkNum($number)
	{
		
        $data_q = "SELECT * FROM ipadnums WHERE number = '$number' ORDER BY number ASC";
		$data_r = mysql_query ($data_q) or die("Could not get data from ipadnum table.\n". mysql_error());
		return $data_r;
	}
	function updateIPadNumas($number, $sales_mail, $date, $reserv_stat, $type, $compname)
	{	
		$update_stmt = "UPDATE ipadnums SET sales_mail='$sales_mail', date='$date', reserv_stat = '$reserv_stat', type = '$type', compname = '$compname' WHERE number = '$number'";
		$update_result = mysql_query ($update_stmt) or die("Could not insert number. \n".mysql_error());
	}
	
		function showNumbers()
	{
        $data_q = "SELECT * FROM ipadnums ORDER BY number ASC";
		$data_r = mysql_query ($data_q) or die("Could not get data from ipadnum table.\n". mysql_error());
		return $data_r;
	}
		function selectNumbers($type)
	{
        $data_q = "SELECT * FROM ipadnums WHERE number_type='$type' AND reserv_stat='0' ORDER BY number ASC LIMIT 20";
		$data_r = mysql_query ($data_q) or die("Could not get data from ipadnum table.\n". mysql_error());
		return $data_r;
	}
	
		function getNumber($number)
	{
        $data_q = "SELECT * FROM ipadnums where number= '$number' ORDER BY number ASC";
		$data_r = mysql_query ($data_q) or die("Could not get data from ipadnum table.\n". mysql_error());
		return $data_r;
	}
		function getNumberbyType($type) 
	{
        $data_q = "SELECT * FROM ipadnums where number_type='$type' ORDER BY number ASC";
		$data_r = mysql_query ($data_q) or die("Could not get data from ipadnum table.\n". mysql_error());
		return $data_r;
	}
		function getNumberbyLocation($location,$type) 
	{
        $data_q = "SELECT * FROM ipadnums where location='$location' and number_type='$type' and reserv_stat = '0' ORDER BY number ASC LIMIT 20";
		$data_r = mysql_query ($data_q) or die("Could not get data from ipadnum table.\n". mysql_error());
		return $data_r;
	}
		function getNumberbyLocation2($location) 
	{
        $data_q = "SELECT * FROM ipadnums where location='$location' ORDER BY number ASC";
		$data_r = mysql_query ($data_q) or die("Could not get data from ipadnum table.\n". mysql_error());
		return $data_r;
	}
		function getNumberbyStat($stat) 
	{
        $data_q = "SELECT * FROM ipadnums where reserv_stat='$stat' ORDER BY number ASC";
		$data_r = mysql_query ($data_q) or die("Could not get data from ipadnum table.\n". mysql_error());
		return $data_r;
	}
		function getAllNumbers() 
	{
        $data_q = "SELECT * FROM ipadnums";
		$data_r = mysql_query ($data_q) or die("Could not get data from ipadnum table.\n". mysql_error());
		return $data_r;
	}
		function getCancelationAuth($id) 
	{
        $data_q = "SELECT number_cancel_auth FROM operator_acl where op_id='$id'";
		$data_r = mysql_query ($data_q) or die("Could not get data from ipadnum table.\n". mysql_error());
		return $data_r;
	}
		function getMassMailAuth($id) 
	{
        $data_q = "SELECT send_mass_email FROM operator_acl where op_id='$id'";
		$data_r = mysql_query ($data_q) or die("Could not get data from ipadnum table.\n". mysql_error());
		return $data_r;
	}
		function getAllSurvey() 
	{
        $data_q = "SELECT * FROM vo_survey";
		$data_r = mysql_query ($data_q) or die("Could not get data from ipadnum table.\n". mysql_error());
		return $data_r;
	}
		function insertNumbers($number, $type,$location)
	{
		$data_q = "INSERT INTO ipadnums (number, number_type, location) VALUES ('$number', '$type', '$location')";
		$data_r = mysql_query ($data_q) or die("Could not insert number.\n". mysql_error());
	}
		function updateStatus($number,$status)
	{
		$update_stmt = "UPDATE ipadnums SET reserv_stat='$status' where number= '$number'";
		$update_result = mysql_query ($update_stmt) or die("Could not get data from ipadnum table \n".mysql_error());
	}
		function updateStatusvoffice($number,$status)
	{
		$update_stmt = "UPDATE ipadnums SET reserv_stat='$status' where number= '$number'";
		$update_result = mysql_query ($update_stmt) or die("Could not get data from ipadnum table \n".mysql_error());
	}
		function unreserveNumber($number,$date)
	{
		$update_stmt = "UPDATE ipadnums SET reserv_stat='0',date='$date' where number= '$number'";
		$update_result = mysql_query ($update_stmt) or die("Could not get data from ipadnum table \n".mysql_error());
	}
		function resrveNumber($number,$date) 
	{
		$update_stmt = "UPDATE ipadnums SET reserv_stat='1',date='$date' where number= '$number'";
		$update_result = mysql_query ($update_stmt) or die("Could not get data from ipadnum table \n".mysql_error());
	}
		function paidNumber($number,$date) 
	{
		$update_stmt = "UPDATE ipadnums SET reserv_stat='1',payment_stat='1' where number= '$number'";
		$update_result = mysql_query ($update_stmt) or die("Could not get data from ipadnum table \n".mysql_error());
	}
		function unpaidNumber($number) 
	{
		$update_stmt = "UPDATE ipadnums SET payment_stat='0' where number= '$number'";
		$update_result = mysql_query ($update_stmt) or die("Could not get data from ipadnum table \n".mysql_error());
	}
		function updateStatusType($number,$type,$status)
	{
		$update_stmt = "UPDATE ipadnums SET reserv_stat='$status', type='$type', datefield=NOW() where number= '$number'";
		$update_result = mysql_query ($update_stmt) or die("Could not get data from ipadnum table \n".mysql_error());
	}
		function deleteNumber($number)
	{
		$update_stmt = "DELETE FROM ipadnums WHERE number = '$number'";
		$update_result = mysql_query ($update_stmt) or die("Could not delete data from ipadnum table \n".mysql_error());
	}
		function deleteNull()
	{
		$update_stmt = "DELETE FROM ipadnums WHERE number = ''";
		$update_result = mysql_query ($update_stmt) or die("Could not delete data from ipadnum table \n".mysql_error());
	}
		function refreshStatusType($type,$status) 
	{
		$update_stmt = "UPDATE ipadnums SET reserv_stat='$status', type='$type' WHERE datefield<=(NOW() - INTERVAL 5 MINUTE)";
		$update_result = mysql_query ($update_stmt) or die("Could not update data with regards to timestamp from ipadnum table \n".mysql_error());
	}
		function updateAllNumbers($number,$number2,$type, $sales_mail,$compname,$number_type,$location)
	{
		$update_stmt = "UPDATE ipadnums SET number='$number2', type='$type', sales_mail='$sales_mail', compname='$compname', number_type='$number_type', location='$location' WHERE number='$number'";
		$update_result = mysql_query ($update_stmt) or die("Could not get data from ipadnum table \n".mysql_error());
	}
	
	
		function updateLanguage($clientid, $lang)
	{	
		$update_stmt = "UPDATE client_info SET greet_lang = '$lang' WHERE clientid = '$clientid'";
		$update_result = mysql_query ($update_stmt) or die("Could not update language. \n".mysql_error());
	}
		function getGreetLang($id) 
	{
        $data_q = "SELECT greet_lang FROM client_info where clientid='$id'";
		$data_r = mysql_query ($data_q) or die("Could not get data from client_info.\n". mysql_error());
		return $data_r;
	}
		function updateOldIpadNums($number) 
	{
        $data_q = "UPDATE ipadnums SET reserv_stat='0', payment_stat='0' WHERE number='$number'";
		$data_r = mysql_query ($data_q) or die("Could not get data from ipadnums.\n". mysql_error());
		return $data_r;
	}
		function getOldIpadNums() 
	{
        $data_q = "SELECT * from ipadnums WHERE date<DATE_SUB(curdate(), INTERVAL 2 DAY) AND reserv_stat='1' AND payment_stat='0'";
		$data_r = mysql_query ($data_q) or die("Could not get data from ipadnums.\n". mysql_error());
		return $data_r;
	}
	//function by annie for testing db connecitnio
	function test() {
		
		$data_q="select * from company_plans";
		$data_r = mysql_query ($data_q) or die("Could not get data from ipadnums.\n". mysql_error());
		return $data_r;
		}
	
	
}

?>
