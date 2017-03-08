<?php

class Selfie extends MX_Controller
{
	public $data;	

	function __construct()
	{
		parent::__construct();

		$this->load->model('Selfie_model');
		$this->authentication->is_logged_in();
		$this->get_common();
	}
	
	public function index()
	{
		
		$staff_id 	= $this->session->userdata('mid');
		$shiftid 	= $this->Selfie_model->getStaffShiftid($staff_id);
		$coid 		= $this->Selfie_model->getStaffCoid($staff_id);
		$tzone 		= $this->Selfie_model->getStaffTimeZone($shiftid);
		$ancmnt 		= $this->Selfie_model->getCoAnnouncements($coid);
		$counter=0;
		foreach($ancmnt as $row){
			$statid = $this->Selfie_model->getAnnouncementStat($row->id, $staff_id);
			if ($statid=="")
				$counter++;
		}

		date_default_timezone_set($tzone);

		$today = date("Y-m-d / G:i:s", time());
		$ptoday = date("Y-m-d", time());
		
		
		$staff_already_in  = $this->Selfie_model->checkAttendanceIn($staff_id, $ptoday);
		$staff_mark_absent = $this->Selfie_model->checkAttendanceAbsent($staff_id, $ptoday);
		$staff_already_out = $this->Selfie_model->checkAttendanceOut($staff_id, $ptoday);
		$staff_break_state = $this->Selfie_model->checkAttendanceBreakState($staff_id);
		
		$this->data['staff_already_in']=$staff_already_in;
		$this->data['staff_mark_absent']=$staff_mark_absent;
		$this->data['staff_already_out']=$staff_already_out;
		$this->data['staff_break_state']=$staff_break_state;
		$this->data['ancmnt_count']	  =$counter;
		
		$this->data['footer_includes']			=	'<script src="'.base_url().'js/snap/selfie.js" type="text/javascript"></script>';
		$this->data['view']					=	'selfiemarking/selfie';
		$this->load->view('master_selfie', $this->data);	
		
	}	

	function save_selfie()
	{
		//flexible shift determining
		$companyPlanDetails					=	$this->site_settings->companyPlanDetails();
		if(isset($companyPlanDetails->flexiibleClockin) ) 
		{
			$flexiibleClockin =$companyPlanDetails->flexiibleClockin;
		}
		else 
		{
			$flexiibleClockin=0;
		}
		
		$userShiftType= $this->Selfie_model->fetchUserShiftType();
		
		if($userShiftType==2 && $flexiibleClockin==1)
		{
			$flexiUser=1;
		}
		else 
		{
			$flexiUser=0;
		}
      
						            			
		$image_fmt 	= $this->input->post('image_fmt');
		$staffid 	= $this->input->post('staffid');
		$geolocation= $this->input->post('geolocation');
		$img 		= $this->input->post('base64image');
		$clock_type	= $this->input->post('clktype');
		
		$shiftid 	= $this->Selfie_model->getStaffShiftid($staffid);
		$tzone 		= $this->Selfie_model->getStaffTimeZone($shiftid);
		date_default_timezone_set($tzone);

		$result = substr($img, 0, 9);
		if($result=='[removed]'){ //Checking It Existed or not
		  	$img = str_replace('[removed]', '', $img);
		}    
		$img 			= str_replace('data:image/png;base64,', '', $img);
		$img 			= str_replace(' ', '+', $img);
		//$img 			= substr($img,strpos($img,",")+1);// remove the prefix
		$data 		= base64_decode($img);
		$extension= '.png';
		/*

		if (strpos($img, 'data:image/png;base64') !== false)
		{
			$img = str_replace('data:image/png;base64,', '', $img);
			$img = str_replace(' ', '+', $img);
			$data = base64_decode($img);
			$extension= '.png';
		}

		if (strpos($img, 'data:image/jpeg;base64') !== false)
		{
			$img = str_replace('data:image/jpeg;base64,', '', $img);
			$img = str_replace(' ', '+', $img);
			$data = base64_decode($img);
			$extension= '.jpeg';
		}
		*/
		$log_path = "/home/clockin/www/selfies/aLog/";
		//$log_path = "C:/xampp/htdocs/clockin3/selfies/aLog/";
		$file_name = $log_path;
		$logdatetime = date("Y-m-d-H_i_s", time());
		$datein = date("Y-m-d", time());
		$showlogdatetime = date("Y-m-d H:i:s", time());
		$in_day = date("l", time());
		$in_day = strtolower($in_day);
		
		$p_in_file = $staffid."-".$logdatetime."-".$clock_type.$extension;
		
		$in_file = $file_name.$p_in_file;
		
		$upload_path = $log_path.$p_in_file;
		
		//if ( ! file_put_contents($upload_path, $data)){
		if ( ! write_file($upload_path,$data))
		{
			//echo $img;
			echo "Failed";
		}
		else
		{			
			$p_check_workday_type = $this->Selfie_model->getStaffShiftTypeviaDay($staffid, $in_day);
			$check_workday_type = $p_check_workday_type["shifttype"];
			$base_start_time = $p_check_workday_type["basestart"];
			$base_end_time = $p_check_workday_type["baseend"];
			if ($clock_type == "brkin")
			{
				$clock_msg = "IN as Returning from Break ";
       		$this->Selfie_model->updateStaffBreakState($staffid, "0");	
			}
			elseif ($clock_type == "brkOut")
			{
				$clock_msg = "OUT for Having a Break ";
        		$this->Selfie_model->updateStaffBreakState($staffid, "1");
			}
			else
			{
				$clock_msg = $clock_type;
			}
			
			if ($clock_type == "in")
			{
				$base_time = $base_start_time;
			}
			else
			{
				$base_time = $base_end_time;
			}
			
			//to check is mobile or not
			$mobile=0;
			if($this->check_mobile())
			{
				$mobile=1;
			}
			else
			{
				$mobile=0;
			}
			
			$chkabid = $this->Selfie_model->checkAttendanceAbsent($staffid, $datein);
			
			if ($chkabid != "")
			{
				$this->Selfie_model->updateStaffAttendanceState($chkabid, "in", $p_in_file,$geolocation,$mobile,$flexiUser);
			}
			else
			{
				$this->Selfie_model->logStaffAttendance($staffid, $clock_type, $p_in_file, $tzone, $base_time, $check_workday_type,$geolocation,$mobile,$flexiUser);
			}
			
			// save to log table	
			$operation = 'Staff with id:'.$staffid.'. Has '.$clock_type .'.';
	      $this->site_settings->adminlog($operation);
			//echo $img;
			
			
			//******commented by annie, march 8,2017 , to disable notification for clockin and clockout********
			
		/*	$sName=$this->session->userdata('staffname');
			if ($clock_type == "brkOut")
			{
				$notifyMsg=' : Took a break';
			}
			else if ($clock_type == "brkin")
			{
				$notifyMsg=' : Back from break';
			}
			else if ($clock_type == "in")
			{
				$notifyMsg=' : Clocked In';
			}
			else 
			{
				$notifyMsg=' : Clocked Out';
			}
			
			$nType = 1; //clockin updates
			$nMsg  = $sName.$notifyMsg;
			$this->site_settings->addNotification($nType,$nMsg,'');*/
			//-------******comment ends here*******----//
			
						
			
			//send clockin email if company has paid plan	
			/*		
			$calendarView= $this->authentication->checkCalendarViewAccess(); 
			if($calendarView==1)
			{
			   if ($clock_type == "in" || $clock_type == "Out")
			   {
			   	$this->send_clockin_email($p_in_file,$staffid,$showlogdatetime,$clock_type,$shiftid);
			   }
			}
			*/
			
	      echo "Clock $clock_type Logged at $showlogdatetime";
		}		
   }
   
   function send_clockin_email($staffphoto,$staff_id,$logdatetime,$clock_type,$shiftid)
	{
		$fullpath = "https://clock-in.me/selfies/aLog/".$staffphoto;
      $config = array(
			    'protocol'  => EMAIL_PROTOCOL,
			    'smtp_host' => EMAIL_SMTP_HOST,
			    'smtp_port' => EMAIL_SMTP_PORT,
			    'smtp_user' => EMAIL_SMTP_USER,
			    'smtp_pass' => EMAIL_SMTP_PASS,
			    'mailtype'  => EMAIL_MAILTYPE,
	       	 'charset'   => EMAIL_CHARSET,
	       	 'crlf' 		 => EMAIL_CRLF,
	  			 'newline'   => EMAIL_NEWLINE
	      );
		////$config['protocol']= "sendmail";
      $this->load->library('email', $config);
      $this->email->set_mailtype("html");
      
      //$email_to ='dominic@cliffsupport.com';
      $subject="clock-in.me : Clockin Alert!";
		$this->site_settings->get_site_settings();
      //$from = $this->config->item('smtp_server');
      $from = "ask@clock-in.me";
 	   
 	   if($clock_type == "brkOut")
		{
			$this->data['clock']	=	': Took a break';
		}
		else if($clock_type == "brkin")
		{
			$this->data['clock']	=	': Back from break';
		}
		else if($clock_type == "in")
		{
			$this->data['clock']	=	': Clocked In';
		}
		else 
		{
			$this->data['clock']	=	': Clocked Out';
		}
 	   
 	   //$coid 	= $this->Selfie_model->getStaffCoid($staff_id);
		$watchers = $this->Selfie_model->get_attendance_watchers($shiftid);
		$watchers_list=array();
      foreach($watchers as $row){
	     $watchers_list[]=$row->email;
	   }
		
 	   $user_data	=	array();
		$user_data	=	modules::load('users')->getUserDataFromUserID($staff_id);
		foreach($user_data as $row)
		{
			$this->data['name']					=	$row->staff_name;
			$this->data['company_name']		=	$row->company_name;
			$this->data['department_name']	=	$row->department_name;
			$this->data['shiftName']			=	$row->shift_name;
	 	   $this->data['clockinpic']			=	$fullpath;
	 	   $this->data['clockintime']			=	$logdatetime;  						
		}
 	      
	   $template = $this->load->view('email_templates/clockin_alert_template',$this->data,TRUE); 
		$this->email->from($from, 'Clock-in.me Customer Care');			
  		$this->email->to($watchers_list);
  		//$this->email->cc($cc_list);
  		//$this->email->bcc($bcc_list);
		$this->email->message($template);	
		$this->email->subject($subject);		
  	 	$this->email->send();
	}	

	//Function to check mobile or table or computer
	function check_mobile(){
		$this->load->library('Mobile_Detect');
		$detect = new Mobile_Detect();
    	if ($detect->isMobile() || $detect->isTablet() || $detect->isAndroidOS()) {
        return true;
    	}else{
    		return false;
    	}
	}


	function get_common()
	{
		$this->data['listAnnouncements']	=	$this->site_settings->fetchLatestAnnouncementsforUser();
		$this->site_settings->get_site_settings();
	}
}

