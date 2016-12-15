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
		if($tzone=='Asia/Kolkata')
		{
			//ini_alter('date.timezone','Asia/Calcutta');
			date_default_timezone_set('Asia/Calcutta');
		}
		else
		{
			date_default_timezone_set($tzone);
		}
		
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

	function save_selfie(){
		$image_fmt 	= $this->input->post('image_fmt');
		$staffid 	= $this->input->post('staffid');
		$geolocation= $this->input->post('geolocation');
		$img 			= $this->input->post('base64image');
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
		
		$log_path = "/home/clockin/www/selfies/aLog/";
		$file_name = $log_path;
		$logdatetime = date("Y-m-d-H_i_s", time());
		$datein = date("Y-m-d", time());
		$showlogdatetime = date("Y-m-d H:i:s", time());
		$in_day = date("l", time());
		$in_day = strtolower($in_day);
		
		$p_in_file = $staffid."-".$logdatetime."-".$clock_type.".png";
		
		$in_file = $file_name.$p_in_file;
		
		$upload_path = $log_path.$p_in_file;
		
		//if ( ! file_put_contents($upload_path, $data)){
		if ( ! write_file($upload_path,$data)){
			echo "Failed";
		}else{
			
			$p_check_workday_type = $this->Selfie_model->getStaffShiftTypeviaDay($staffid, $in_day);
			$check_workday_type = $p_check_workday_type["shifttype"];
			$base_start_time = $p_check_workday_type["basestart"];
			$base_end_time = $p_check_workday_type["baseend"];
			if ($clock_type == "brkin"){
				$clock_msg = "IN as Returning from Break ";
       		$this->Selfie_model->updateStaffBreakState($staffid, "0");	
			}elseif ($clock_type == "brkOut"){
				$clock_msg = "OUT for Having a Break ";
        		$this->Selfie_model->updateStaffBreakState($staffid, "1");
			}else{
				$clock_msg = $clock_type;
			}
			
			if ($clock_type == "in"){
				$base_time = $base_start_time;
			}else{
				$base_time = $base_end_time;
			}
			
			//to check is mobile or not
			$mobile=0;
			if($this->check_mobile()){
				$mobile=1;
			}else{
				$mobile=0;
			}
			
			$chkabid = $this->Selfie_model->checkAttendanceAbsent($staffid, $datein);
			
			if ($chkabid != ""){
				$this->Selfie_model->updateStaffAttendanceState($chkabid, "in", $p_in_file,$geolocation,$mobile);
			}else{
				$this->Selfie_model->logStaffAttendance($staffid, $clock_type, $p_in_file, $tzone, $base_time, $check_workday_type,$geolocation,$mobile);
			}
			
			// save to log table	
			$operation = 'Staff with id:'.$staffid.'. Has '.$clock_type .'.';
	      $this->site_settings->adminlog($operation);
	      
	      echo "Clock $clock_type Logged at $showlogdatetime";
		}		
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
		
		/*
		$this->site_settings->get_site_settings();
		$this->data['profile']			=	$this->site_settings->personal_details();	
		$this->data['menus_all']		= 	modules::load('menus')->get_menus();
		$this->data['myprivileges']	=	$this->site_settings->myprivileges();
			
		*/
	}
}

