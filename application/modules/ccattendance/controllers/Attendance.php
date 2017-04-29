<?php

class Attendance extends MX_Controller
{
	public $data;	

	function __construct()
	{
		parent::__construct();

		$this->load->model('Attendance_model');
		$this->authentication->is_logged_in();

		$this->get_common();
	}
	
	//Function to load my attendance
	//Dominic; Dec 14,2016
	
	public function index()
	{
		$this->authentication->check_admin_access();
		$this->monthiview();
	}
	
   /*
	public function index()
	{
		$this->authentication->check_admin_access();
		$this->data['datepickerSwitch']	=	1;
		
		$reportDownload		= $this->authentication->reportType(); 
		if($reportDownload==DETAILED_REPORT)
		{
			$this->data['attendance_table']	="<table id='myattendance' class='table table-bordered table-striped'>
					                                <thead>
					                                <tr>
					                                    <th width='10px'>No</th>
					                                    <th>Date</th>
					                                    
																	<th>Scheduled Clock in Time</th>
					                                    <th>Clock in Time</th>
																	<th>Clock in Status</td>
																	
																	<th>Scheduled Clock Out Time</th>
					                                    <th>Clock out Time</th>
					                                    <th>Clock Out Status</th>
					                                    
					                                    <th>Clock In Selfie</th>
																	<th>Clock Out Selfie</th>
					                                    <th>Notes</th>
					                                </tr>
					                                </thead>
					                                <tbody>";		
		}
		else 
		{
			$this->data['attendance_table']	="<table id='myattendance' class='table table-bordered table-striped'>
					                                <thead>
					                                <tr>
					                                    <th width='10px'>No</th>
					                                    <th>Date</th>
																	<th>Scheduled Clock in Time</th>
					                                    <th>Clock in Status</th>
																	<th>Scheduled Clock Out Time</th>
					                                    <th>Clock out Status</th>
					                                </tr>
					                                </thead>
					                                <tbody>";
		}		
		

														  
		 if ($this->form_validation->run('frm_attendance_search') === FALSE) 
		 {
		 	if($reportDownload==DETAILED_REPORT)
		 	{
		 		$this->data['attendance_table']	.= "<tr>
                                                 <td class=\"botline\"></td>
                                                 <td class=\"botline\"></td>
                                                 <td class=\"botline\"></td>
                                                 <td class=\"botline\"></td>
                                                 <td class=\"botline\"></td>
                                                 <td class=\"botline\">Please Select The From Date And To Date</td>
																 <td class=\"botline\"></td>
																 <td class=\"botline\"></td>
																 <td class=\"botline\"></td>
                                                 <td class=\"botline\"></td>
                                                 <td class=\"botline\"></td>
                                                </tr>";
		 	}
		 	else
		 	{
		 		$this->data['attendance_table']	.= "<tr>
                                                 <td class=\"botline\"></td>
                                                 <td class=\"botline\"></td>
                                                 <td class=\"botline\">Please Select The From Date And To Date</td>
																 <td class=\"botline\"></td>
																 <td class=\"botline\"></td>
																 <td class=\"botline\"></td>
                                                </tr>";
		 	}
	                                
			$this->data['attendance_table']	.= "		</tbody>
   													 		</table>";
   													 
			$this->data['view']					=	'ccattendance/my-attendance';
			$this->load->view('master', $this->data);
		}
		else
		{
			$f_from_date = $this->formatStorageDate($this->input->post('date_from'));
			$f_to_date 	 = $this->formatStorageDate($this->input->post('date_to'));
			$staff 		 = $this->session->userdata('mid');
			
			if($reportDownload==DETAILED_REPORT)
		 	{
				$this->data['attendance_table']	.= $this->myAttendanceTablulaData($f_from_date,$f_to_date,$staff);
			}
			else
			{
				$this->data['attendance_table']	.= $this->myBasicAttendanceTablulaData($f_from_date,$f_to_date,$staff);
			}
			
			$this->data['view']					=	'ccattendance/my-attendance';
			$this->load->view('master', $this->data);	

		}
	}
   */
	
	//Function to compute basic attendance for my attendance view
	//Dominic; Jan 14,2017
	function myBasicAttendanceTablulaData($f_from_date,$f_to_date,$staff)
	{			
		$attendance_table='';
		$file_path 	 =  "../../selfies/aLog/";
		//$file_path 	 	=  "/home/clockin/www/selfies/aLog/";
		$r_cnt 		 = 1;	
		// Store date to process due to BETWEEN difficiency
		$q_date = array();
		$p_date =  $f_from_date;
		while ($p_date <= $f_to_date)
		{
			//echo "Array ".$p_date." ";
			array_push($q_date, $p_date);	
			$p_date = date("Y-m-d", strtotime($p_date . ' + 1 day'));
		}
						
		for($dcnt=0; $dcnt < count($q_date); $dcnt++)
		{
			$in_invfilter 	= 	"non";
			$dispute_msg	=	"";  					
			
			if ($in_invfilter == "non")
			{
				$staff_attendance_info_result = $this->Attendance_model->getStaffAllClockInfobyDate($staff, $q_date[$dcnt]);																									
				// Get Day - Monday, Tuesday etc.
				$log_date = $q_date[$dcnt];
            $timestamp = strtotime($log_date);
            $check_day = date("l", $timestamp);
               
            // Check if Staff is suppose to be working on DAY.
				// 0 = non work, 1 = Grave yard, 2 = Non Grave Yard
            $p_check_workday_type = $this->Attendance_model->getStaffShiftTypeviaDay($staff, $check_day);
               	                  
            if(isset($p_check_workday_type["shifttype"]))
            {
               $check_workday_type 	 = $p_check_workday_type["shifttype"];
            }
            else
            {
               $check_workday_type 	 = 0;
            }	
               
            if(isset($p_check_workday_type["basestart"]))
            {
               $base_start_time 		 = $p_check_workday_type["basestart"];
            }
            else
            {
               $base_start_time	 	 = '';
            }
               
            if(isset($p_check_workday_type["baseend"]))
            {
               $base_end_time 		 = $p_check_workday_type["baseend"];
            }
            else
            {
               $base_end_time	 	 	= '';
            }
               
            if(isset($p_check_workday_type["baseend"]))
            {
               $in_shift = $p_check_workday_type["shiftid"];
            }
            else
            {
               $in_shift = '';
            }

				$shift_info = $this->Attendance_model->getShiftDetails_v2($in_shift, $check_day);

				if ($check_workday_type == 0)
				{
					// 0 = Non working day
					$ab_log_date = $q_date[$dcnt];
					$log_date = $q_date[$dcnt];								
					$staffname = $this->Attendance_model->getStaffName($staff);
						
					$attendance_status = "<span class='label label-default'>Non Work Day</span>";
					$log_time = "Non";
               $a_in_file = "Non";
               $a_out_file = "Non";
               $attendance_time = $base_start_time;
               $attendance_end_time = $base_end_time;
               $staff_logout_time = "Non";
               $attendance_out_status = "<span class='label label-default'>Non Work Day</span>";								
				}
				elseif ($check_workday_type == 1)
				{
					// 1 = Grave Yard Work Day - Need Add 1 Day
						
					$p_log_date = $log_date;
					$out_log_date = date('Y-m-d', strtotime($p_log_date . ' + 1 day'));
					$staff_work_day_info = $this->Attendance_model->getStaffClockInfobyDate($staff, $log_date, "in");
					$staffname = $this->Attendance_model->getStaffName($staff);
					// Check in clock in.
					if (count($staff_work_day_info)==0||$staff_work_day_info["log_time"] == "")
					{
						$staff_work_day_infoz = $this->Attendance_model->getStaffClockInfobyDate($staff, $log_date, "ab");
						$dispute_msg = $staff_work_day_infoz["notes"];								
						
						$attendance_status = "<span class='label label-danger'>Absent</span>"; //compute difference
						// Process for show in table
                  //$staffname = $adminfunc->getStaffName($srow["staff_id"]);
                  $staffname = $this->Attendance_model->getStaffName($staff);
                  $log_time = "NA";
                  $a_in_file = "NA";
                  $a_out_file = "NA";
                  $attendance_time = $base_start_time;
                  $attendance_end_time = $base_end_time;
                  $staff_logout_time = "NA";
                  $attendance_out_status = "<span class='label label-danger'>Absent</span>";
					}
					else
					{
						// Get shift details
						$p_shift_info = $this->Attendance_model->getShiftDetails($in_shift, $check_day);
						$shift_info 	= $p_shift_info->row_array();
															 
						// Compute Clock in
						$d_attendance_in_time = strtotime($staff_work_day_info["base_log_time"]);
						$d_staff_time_in = strtotime($staff_work_day_info["log_time"]);
						$p_in_undertime = $d_staff_time_in - $d_attendance_in_time;
						//$p_in_undertime = $d_attendance_in_time - $d_staff_in_out;
						$in_undertime = gmdate('H:i:s', $p_in_undertime);
						$in_file_name = $staff_work_day_info["attendance_file"];
						$a_in_file = "<a href=\"$file_path$in_file_name\" target=\"_blank\">$staffname</a>";
							 
						if ($p_in_undertime > 0)
						{
							$attendance_status = "<span class='label label-warning'>Late by : ".$in_undertime."</span>";
						}
						else
						{
							$attendance_status = "<span class='label label-success'>On Time</span>";
						}
						$log_time = $staff_work_day_info["log_time"];
						$attendance_time = $staff_work_day_info["base_log_time"];
						$dispute_msg = $staff_work_day_info["notes"];
 
						// Compute Clock out
						$staff_work_day_out_info = $this->Attendance_model->getStaffClockInfobyDate($staff, $out_log_date, "out");
						if (count($staff_work_day_out_info)>0&&$staff_work_day_out_info["log_time"] != "")
						{									 	
							$d_attendance_out_time = strtotime($staff_work_day_out_info["base_log_time"]);
							$staff_logout_time = $staff_work_day_out_info["log_time"];
							$d_staff_time_out = strtotime($staff_work_day_out_info["log_time"]);
							$p_out_undertime = $d_attendance_out_time - $d_staff_time_out;
							$out_undertime = gmdate('H:i:s', $p_out_undertime);
							 	
							if ($p_out_undertime > 0)
							{
							 	$attendance_out_status = "<span class='label label-primary'>Early check out by : ".$out_undertime."</span>";
							}
							else
							{
							 	$attendance_out_status = "<span class='label label-success'>Ok.</span>";
							}
							 	
							// Process for show in table
							$file_name = $staff_work_day_out_info["attendance_file"];
							$a_out_file = "<a href=\"$file_path$file_name \" target=\"_blank\">$staffname </a>";
							// Compute
							$attendance_end_time = $staff_work_day_out_info["base_log_time"];
							$dispute_msg = $staff_work_day_info["notes"];
							 	
						}
						else
						{
							$a_out_file = "";
							$staff_logout_time = "NA";
                     $attendance_end_time = $shift_info["pday_endtime"];
                     $attendance_out_status = "<span class='label label-default'>Did Not Clock Out.</span>";
						}
							 
					}
				}
				elseif ($check_workday_type == 2)
				{
					// 2 = Non Grave Yard Work Day
					$staff_work_day_info = $this->Attendance_model->getStaffClockInfobyDate($staff, $log_date, "in");
						
					// Check in clock in.
					if (count($staff_work_day_info)==0||$staff_work_day_info["log_time"] == "")
					{

						$staff_work_day_infozz = $this->Attendance_model->getStaffClockInfobyDate($staff, $log_date, "ab");
						$dispute_msg = $staff_work_day_infozz["notes"];									
						
						$attendance_status = "<span class='label label-danger'>Absent</span>";
						// Process for show in table
						$staffname = $this->Attendance_model->getStaffName($staff);
						$log_time = "NA";
                  $a_in_file = "NA";
                  $a_out_file = "NA";
                  $attendance_time = $base_start_time; 
          			$attendance_end_time = $base_end_time;
						$staff_logout_time = "NA";
						$attendance_out_status = "<span class='label label-danger'>Absent</span>";
					}
					else
					{
						// Get shift details
						$p_shift_info = $this->Attendance_model->getShiftDetails($in_shift, $check_day);
						$shift_info   = $p_shift_info->row_array();
						$staffname 	  = $this->Attendance_model->getStaffName($staff);
						// ---------- Compute Clock in ------------
						$d_attendance_in_time = strtotime($staff_work_day_info["base_log_time"]);
						$d_staff_time_in = strtotime($staff_work_day_info["log_time"]);
						$p_in_undertime = $d_staff_time_in - $d_attendance_in_time;
						$in_undertime = gmdate('H:i:s', $p_in_undertime);
						$in_file_name = $staff_work_day_info["attendance_file"];
						$a_in_file = "<a href=\"$file_path$in_file_name\" target=\"_blank\">$staffname</a>";
						if($p_in_undertime > 0)
						{
							$attendance_status = "<span class='label label-warning'>Late by : ".$in_undertime."</span>";
						}
						else
						{
							$attendance_status = "<span class='label label-success'>On Time</span>";
						}
							
						// Process for show in table
						$staffname 	  = $this->Attendance_model->getStaffName($staff);
						$log_time = $staff_work_day_info["log_time"];
						$attendance_time = $shift_info["pday_starttime"]; // Compute
						$attendance_time = $staff_work_day_info["base_log_time"];
						$dispute_msg = $staff_work_day_info["notes"];
							
						// --------- Compute Clock out ---------------
						$staff_work_day_out_info = $this->Attendance_model->getStaffClockInfobyDate($staff, $log_date, "out");
						if (count($staff_work_day_out_info)>0&&$staff_work_day_out_info["log_time"] != "")
						{
							$d_attendance_out_time = strtotime($staff_work_day_out_info["base_log_time"]);
							$staff_logout_time = $staff_work_day_out_info["log_time"];
							$d_staff_time_out = strtotime($staff_work_day_out_info["log_time"]);
							$p_out_undertime = $d_attendance_out_time - $d_staff_time_out;
							$out_undertime = gmdate('H:i:s', $p_out_undertime);
								
							if ($p_out_undertime > 0)
							{
								$attendance_out_status = "<span class='label label-primary'>Early check out by : ".$out_undertime."</span>";
							}
							else
							{
								$attendance_out_status = "<span class='label label-success'>Ok</span>";
							}
								
							// Process for show in table
							$out_file_name = $staff_work_day_out_info["attendance_file"];
							$a_out_file = "<a href=\"$file_path$out_file_name \" target=\"_blank\">$staffname </a>";
							$attendance_time = $staff_work_day_info["base_log_time"];
							$attendance_end_time = $staff_work_day_out_info["base_log_time"]; 
							$dispute_msg = $staff_work_day_info["notes"];
								
						}
						else
						{
							// Process for show in table
                     $out_file_name = "NA";
                     $a_out_file = "";
                     $staff_logout_time = "NA";
                     $attendance_time = $base_start_time;
                     $attendance_end_time = $shift_info["pday_endtime"]; 		
							$attendance_out_status = "<span class='label label-default'>Did Not Clock Out.</span>";
						}
					}
						
				}
				
				$attendance_table	.= "<tr>
                                     <td class=\"botline\">$r_cnt</td>
                                     <td class=\"botline\">$log_date</td>
                                     <td class=\"botline\">$attendance_time</td>
                                     <td class=\"botline\">$attendance_status</td>
												 <td class=\"botline\">$attendance_end_time</td>
												 <td class=\"botline\">$attendance_out_status</td>
                                  </tr>";
             $r_cnt++;   
             $dispute_msg=""; 
		  }
		}
		$attendance_table	.= "</tbody>
															</table>";
		return $attendance_table;
	}		
	
	
	
	//Function to compute detailed attendance for my attendance view
	//Dominic; Dec 14,2016
	function myAttendanceTablulaData($f_from_date,$f_to_date,$staff)
	{			
		$attendance_table='';
		$file_path 	 =  "../../selfies/aLog/";
		//$file_path 	 	=  "/home/clockin/www/selfies/aLog/";
		$r_cnt 		 = 1;	
		// Store date to process due to BETWEEN difficiency
		$q_date = array();
		$p_date =  $f_from_date;
		while ($p_date <= $f_to_date)
		{
			//echo "Array ".$p_date." ";
			array_push($q_date, $p_date);	
			$p_date = date("Y-m-d", strtotime($p_date . ' + 1 day'));
		}
						
		for($dcnt=0; $dcnt < count($q_date); $dcnt++)
		{
			$in_invfilter 	= 	"non";
			$dispute_msg	=	"";  					
			
			if ($in_invfilter == "non")
			{
				$staff_attendance_info_result = $this->Attendance_model->getStaffAllClockInfobyDate($staff, $q_date[$dcnt]);																									
				// Get Day - Monday, Tuesday etc.
				$log_date = $q_date[$dcnt];
            $timestamp = strtotime($log_date);
            $check_day = date("l", $timestamp);
               
            // Check if Staff is suppose to be working on DAY.
				// 0 = non work, 1 = Grave yard, 2 = Non Grave Yard
            $p_check_workday_type = $this->Attendance_model->getStaffShiftTypeviaDay($staff, $check_day);
               	                  
            if(isset($p_check_workday_type["shifttype"]))
            {
               $check_workday_type 	 = $p_check_workday_type["shifttype"];
            }
            else
            {
               $check_workday_type 	 = 0;
            }	
               
            if(isset($p_check_workday_type["basestart"]))
            {
               $base_start_time 		 = $p_check_workday_type["basestart"];
            }
            else
            {
               $base_start_time	 	 = '';
            }
               
            if(isset($p_check_workday_type["baseend"]))
            {
               $base_end_time 		 = $p_check_workday_type["baseend"];
            }
            else
            {
               $base_end_time	 	 	= '';
            }
               
            if(isset($p_check_workday_type["baseend"]))
            {
               $in_shift = $p_check_workday_type["shiftid"];
            }
            else
            {
               $in_shift = '';
            }

				$shift_info = $this->Attendance_model->getShiftDetails_v2($in_shift, $check_day);

				if ($check_workday_type == 0)
				{
					// 0 = Non working day
					$ab_log_date = $q_date[$dcnt];
					$log_date = $q_date[$dcnt];								
					$staffname = $this->Attendance_model->getStaffName($staff);
						
					$attendance_status = "<span class='label label-default'>Non Work Day</span>";
					$log_time = "Non";
               $a_in_file = "Non";
               $a_out_file = "Non";
               $attendance_time = $base_start_time;
               $attendance_end_time = $base_end_time;
               $staff_logout_time = "Non";
               $attendance_out_status = "<span class='label label-default'>Non Work Day</span>";								
				}
				elseif ($check_workday_type == 1)
				{
					// 1 = Grave Yard Work Day - Need Add 1 Day
						
					$p_log_date = $log_date;
					$out_log_date = date('Y-m-d', strtotime($p_log_date . ' + 1 day'));
					$staff_work_day_info = $this->Attendance_model->getStaffClockInfobyDate($staff, $log_date, "in");
					$staffname = $this->Attendance_model->getStaffName($staff);
					// Check in clock in.
					if (count($staff_work_day_info)==0||$staff_work_day_info["log_time"] == "")
					{
						$staff_work_day_infoz = $this->Attendance_model->getStaffClockInfobyDate($staff, $log_date, "ab");
						$dispute_msg = $staff_work_day_infoz["notes"];								
						
						$attendance_status = "<span class='label label-danger'>Absent</span>"; //compute difference
						// Process for show in table
                  //$staffname = $adminfunc->getStaffName($srow["staff_id"]);
                  $staffname = $this->Attendance_model->getStaffName($staff);
                  $log_time = "NA";
                  $a_in_file = "NA";
                  $a_out_file = "NA";
                  $attendance_time = $base_start_time;
                  $attendance_end_time = $base_end_time;
                  $staff_logout_time = "NA";
                  $attendance_out_status = "<span class='label label-danger'>Absent</span>";
					}
					else
					{
						// Get shift details
						$p_shift_info = $this->Attendance_model->getShiftDetails($in_shift, $check_day);
						$shift_info 	= $p_shift_info->row_array();
															 
						// Compute Clock in
						$d_attendance_in_time = strtotime($staff_work_day_info["base_log_time"]);
						$d_staff_time_in = strtotime($staff_work_day_info["log_time"]);
						$p_in_undertime = $d_staff_time_in - $d_attendance_in_time;
						//$p_in_undertime = $d_attendance_in_time - $d_staff_in_out;
						$in_undertime = gmdate('H:i:s', $p_in_undertime);
						$in_file_name = $staff_work_day_info["attendance_file"];
						$a_in_file = "<a href=\"$file_path$in_file_name\" target=\"_blank\">$staffname</a>";
							 
						if ($p_in_undertime > 0)
						{
							$attendance_status = "<span class='label label-warning'>Late by : ".$in_undertime."</span>";
						}
						else
						{
							$attendance_status = "<span class='label label-success'>On Time</span>";
						}
						$log_time = $staff_work_day_info["log_time"];
						$attendance_time = $staff_work_day_info["base_log_time"];
						$dispute_msg = $staff_work_day_info["notes"];
 
						// Compute Clock out
						$staff_work_day_out_info = $this->Attendance_model->getStaffClockInfobyDate($staff, $out_log_date, "out");
						if (count($staff_work_day_out_info)>0&&$staff_work_day_out_info["log_time"] != "")
						{									 	
							$d_attendance_out_time = strtotime($staff_work_day_out_info["base_log_time"]);
							$staff_logout_time = $staff_work_day_out_info["log_time"];
							$d_staff_time_out = strtotime($staff_work_day_out_info["log_time"]);
							$p_out_undertime = $d_attendance_out_time - $d_staff_time_out;
							$out_undertime = gmdate('H:i:s', $p_out_undertime);
							 	
							if ($p_out_undertime > 0)
							{
							 	$attendance_out_status = "<span class='label label-primary'>Early check out by : ".$out_undertime."</span>";
							}
							else
							{
							 	$attendance_out_status = "<span class='label label-success'>Ok.</span>";
							}
							 	
							// Process for show in table
							$file_name = $staff_work_day_out_info["attendance_file"];
							$a_out_file = "<a href=\"$file_path$file_name \" target=\"_blank\">$staffname </a>";
							// Compute
							$attendance_end_time = $staff_work_day_out_info["base_log_time"];
							$dispute_msg = $staff_work_day_info["notes"];
							 	
						}
						else
						{
							$a_out_file = "";
							$staff_logout_time = "NA";
                     $attendance_end_time = $shift_info["pday_endtime"];
                     $attendance_out_status = "<span class='label label-default'>Did Not Clock Out.</span>";
						}
							 
					}
				}
				elseif ($check_workday_type == 2)
				{
					// 2 = Non Grave Yard Work Day
					$staff_work_day_info = $this->Attendance_model->getStaffClockInfobyDate($staff, $log_date, "in");
						
					// Check in clock in.
					if (count($staff_work_day_info)==0||$staff_work_day_info["log_time"] == "")
					{

						$staff_work_day_infozz = $this->Attendance_model->getStaffClockInfobyDate($staff, $log_date, "ab");
						$dispute_msg = $staff_work_day_infozz["notes"];									
						
						$attendance_status = "<span class='label label-danger'>Absent</span>";
						// Process for show in table
						$staffname = $this->Attendance_model->getStaffName($staff);
						$log_time = "NA";
                  $a_in_file = "NA";
                  $a_out_file = "NA";
                  $attendance_time = $base_start_time; 
          			$attendance_end_time = $base_end_time;
						$staff_logout_time = "NA";
						$attendance_out_status = "<span class='label label-danger'>Absent</span>";
					}
					else
					{
						// Get shift details
						$p_shift_info = $this->Attendance_model->getShiftDetails($in_shift, $check_day);
						$shift_info   = $p_shift_info->row_array();
						$staffname 	  = $this->Attendance_model->getStaffName($staff);
						// ---------- Compute Clock in ------------
						$d_attendance_in_time = strtotime($staff_work_day_info["base_log_time"]);
						$d_staff_time_in = strtotime($staff_work_day_info["log_time"]);
						$p_in_undertime = $d_staff_time_in - $d_attendance_in_time;
						$in_undertime = gmdate('H:i:s', $p_in_undertime);
						$in_file_name = $staff_work_day_info["attendance_file"];
						$a_in_file = "<a href=\"$file_path$in_file_name\" target=\"_blank\">$staffname</a>";
						if($p_in_undertime > 0)
						{
							$attendance_status = "<span class='label label-warning'>Late by : ".$in_undertime."</span>";
						}
						else
						{
							$attendance_status = "<span class='label label-success'>On Time</span>";
						}
							
						// Process for show in table
						$staffname 	  = $this->Attendance_model->getStaffName($staff);
						$log_time = $staff_work_day_info["log_time"];
						$attendance_time = $shift_info["pday_starttime"]; // Compute
						$attendance_time = $staff_work_day_info["base_log_time"];
						$dispute_msg = $staff_work_day_info["notes"];
							
						// --------- Compute Clock out ---------------
						$staff_work_day_out_info = $this->Attendance_model->getStaffClockInfobyDate($staff, $log_date, "out");
						if (count($staff_work_day_out_info)>0&&$staff_work_day_out_info["log_time"] != "")
						{
							$d_attendance_out_time = strtotime($staff_work_day_out_info["base_log_time"]);
							$staff_logout_time = $staff_work_day_out_info["log_time"];
							$d_staff_time_out = strtotime($staff_work_day_out_info["log_time"]);
							$p_out_undertime = $d_attendance_out_time - $d_staff_time_out;
							$out_undertime = gmdate('H:i:s', $p_out_undertime);
								
							if ($p_out_undertime > 0)
							{
								$attendance_out_status = "<span class='label label-primary'>Early check out by : ".$out_undertime."</span>";
							}
							else
							{
								$attendance_out_status = "<span class='label label-success'>Ok</span>";
							}
								
							// Process for show in table
							$out_file_name = $staff_work_day_out_info["attendance_file"];
							$a_out_file = "<a href=\"$file_path$out_file_name \" target=\"_blank\">$staffname </a>";
							$attendance_time = $staff_work_day_info["base_log_time"];
							$attendance_end_time = $staff_work_day_out_info["base_log_time"]; 
							$dispute_msg = $staff_work_day_info["notes"];
								
						}
						else
						{
							// Process for show in table
                     $out_file_name = "NA";
                     $a_out_file = "";
                     $staff_logout_time = "NA";
                     $attendance_time = $base_start_time;
                     $attendance_end_time = $shift_info["pday_endtime"]; 		
							$attendance_out_status = "<span class='label label-default'>Did Not Clock Out.</span>";
						}
					}
						
				}
				
				$attendance_table	.= "<tr>
                                                 <td class=\"botline\">$r_cnt</td>
                                                 <td class=\"botline\">$log_date</td>
                                                 
                                                 <td class=\"botline\">$attendance_time</td>
                                                 <td class=\"botline\">$log_time</td>
                                                 <td class=\"botline\">$attendance_status</td>
																 <td class=\"botline\">$attendance_end_time</td>
																 <td class=\"botline\">$staff_logout_time</td>
																 <td class=\"botline\">$attendance_out_status</td>
                                                 <td class=\"botline\">$a_in_file</td>
                                                 <td class=\"botline\">$a_out_file</td>
																 <td class=\"botline\">$dispute_msg</td>
                                                 </tr>";
             $r_cnt++;   
             $dispute_msg=""; 

		 }
		}
		$attendance_table	.= "</tbody>
															</table>";
		return $attendance_table;
	}	
	
	//Bridge to fetch myattendance
	//Dominic; Dec 14,2016 
	function myAttendanceTablulaDataBridge($f_from_date,$f_to_date,$staff)
	{
      $build_array   = $this->myAttendanceTablulaData($f_from_date,$f_to_date,$staff);
      return $build_array;  
	}
	
	//Function to list who all are around
	//Dominic; Dec 14,2016 
	public function whosaroundtoday()
	{
		$this->authentication->check_admin_access();
		$this->data['department_attendance']= '';	
		
		$compIdSess =$this->session->userdata('coid');
		$staff=$this->session->userdata('mid');
			
		$details= modules::load('users')->getUserDataFromUserID($staff);
		foreach($details as $row)
		{
			$usershift= $row->shift_id;					
		}
		$this->data['company_shifts']			=	modules::load('ccshifts/Shifts')->fetchShiftsofaCompany($compIdSess);
		
		if($this->input->post('shifts'))
   	{
   		$sel_shift = $this->input->post('shifts');
   	}
   	else
   	{
   		$sel_shift = $usershift;
   	}
   	$this->data['shifts'] = $sel_shift;
   	
   	$this->data['department_attendance']	.= $this->findWhoAllAround($staff,$sel_shift,$compIdSess);
		
		$this->data['view']					=	'ccattendance/whos-around-today';
		$this->data['footer_includes']			=	'<script src="'.base_url().'js/cc/whos-around-today.js" type="text/javascript"></script>';
		$this->load->view('master', $this->data);			
	}	
	
	//Function to compute who's all are around
	//Dominic; Dec 14,2016 
	function findWhoAllAround($staff,$sel_shift,$compIdSess)
   {
   	//http://192.168.11.13/projects/clock2/assets/cc/images/admin-user.png"
   	$url_log_path 	 	=  "../../../selfies/aLog";
   	//$url_log_path 	 	=  "/home/clockin/www/selfies/aLog";
   	$absent_image 		= "image-absent.jpg";
		$non_work_image 	= "image-nonwork.jpg";
		$leave_image 	= "image-onleave.jpg";
		$no_selfies_image = "avatar.png";
		$del_image 			= "icon-delete.png";
		$avatar_path		=	base_url()."images/avatars";
   	$department_attendance='';  
   	
   	$attendanceToken=0;
   		
   	$tz 		= $this->Attendance_model->getShiftTZviaStaffid($staff);
   	
   	$d_cid	=	time();
   	
   	if($tz!='') 
   	date_default_timezone_set($tz);
   	
   	$today = date("Y-m-d", strtotime("today"));
   	$q_date = date("Y-m-d", time());
   	
   	$userslist = $this->Attendance_model->getAllUsersinDept($sel_shift,$compIdSess);
   	
   	if(count($userslist)>0) 
   	{
	   	foreach ($userslist as $drows)
	   	{	   		
	   		$srow = $this->Attendance_model->getStaffClockInfobyDate($drows["staff_id"], $q_date, "in");	   		
	   		//$showdate = $q_date[$i];
	   		
	   		$showdate = $q_date;				
				if (count($srow)==0)
				{
	   			$aid = '';
	   			$logdate ='';
	   			$staffid = $drows["staff_id"];
	   			$logtime ='';
	   			$baselogtime = '';
	   			$geolocation = '';
	         	$mobile 		 = '';
				}
				else
				{
					$aid = $srow["id"];
					$logdate = $srow["log_date"];
	         	$staffid = $drows["staff_id"];
	         	$logtime = $srow["log_time"];
	         	$baselogtime = $srow["base_log_time"];
	         	$geolocation = $srow["geolocation"];
	         	$mobile 		 = $srow["mobile"];
				}
				
				if ($aid == "")
				{
					$aid = $d_cid;
					$d_cid++;
				}
				
	        	$staffname = $this->Attendance_model->getStaffName($drows["staff_id"]);
	       	$showday = date("l", strtotime($q_date));
	       	
	       	// ---------- Compute Clock in ------------
	       	$d_attendance_in_time = strtotime($baselogtime);
	       	$d_staff_time_in = strtotime($logtime);
	       	$p_in_undertime = $d_staff_time_in - $d_attendance_in_time;
	      	$in_undertime = gmdate('H:i:s', $p_in_undertime);
	
	       	if ($p_in_undertime > 0)
	       	{
	       		$attendance_status = "Status : Late by ".$in_undertime;
	       		$attendanceToken=2;
	       	}
	       	else
	       	{
	            $attendance_status = "Status : On Time";
	            $attendanceToken=1;
	       	}
	       	
	       	if ($logdate != "")
	       	{
	       		$staffphoto = $srow["attendance_file"];
	       		$fullpath = $url_log_path."/".$staffphoto;
	       	}
	       	else
	       	{
	       		$p_checkday = date("l", strtotime($q_date));
	       		$p_checkday = strtolower($p_checkday);
	       		$check_base_log_time = $p_checkday."_starttime";
	       		$check_user_shift = $this->Attendance_model->getUserBaseLogTime($staffid, $p_checkday, $check_base_log_time);
			      
			      if (count($check_user_shift)>0&&$check_user_shift["checkday"] == 1)
			      {			      	
		         	$fullpath = $avatar_path."/".$absent_image;
	               $attendance_status = "Did Not Clock in.";
						$logtime = "Did Not Clock in.";
			         $baselogtime = $check_user_shift["base_log_time"];
			         unset($mobile);
			         $attendanceToken=3;
			         
					}
					else if (count($check_user_shift)>0&&$check_user_shift["checkday"] == 0)
					{			      	
		         	$fullpath = $avatar_path."/".$non_work_image;
						$attendance_status = "Non Work Day";
						$logtime = "NA";
			         $baselogtime = "NA";
			         unset($mobile);
			         $attendanceToken=0;
					}
					else
					{						
						if (count($check_user_shift)>0)
						{
							$fullpath = $avatar_path."/".$absent_image;
	               	$attendance_status = "Did Not Clock in.";
							$logtime = "Did Not Clock in.";
			         	$baselogtime = $check_user_shift["base_log_time"];
			         	unset($mobile);
			         	$attendanceToken=3;
						}
						else
						{
							$fullpath = $avatar_path."/".$non_work_image;
							$attendance_status = "Non Work Day";
							$logtime = "NA";
			         	$baselogtime = "NA";
			         	unset($mobile);
			         	$attendanceToken=0;
						}								         
			      }
			      
			      //check if user is on leave today
			      $userAbsentOrNot = $this->site_settings->checkUserAbsentOrNot($staffid,$today);
			      if($userAbsentOrNot==1) //on leave
			      {
			      	$fullpath = $avatar_path."/".$leave_image;
			      	$attendance_status = "On Leave";
			      	$logtime = "NA";
			         $baselogtime = "NA";
			         $attendanceToken=4;
			      }
				
	       }
				
				if($attendanceToken==0) //non work
				{
				  $attendanceLabel= '<span class="label label-default">v</span>';
				}
				else if($attendanceToken==1) //on time
				{
					$attendanceLabel= '<span class="label label-success">v</span>';
				}
				else if($attendanceToken==2) //late
				{
				  $attendanceLabel= '<span class="label label-warning">v</span>';
				}
				else if($attendanceToken==4) //on leave
				{
				  $attendanceLabel= '<span class="label label-primary">a</span>';
				}
				else //did not clock in
				{
					$attendanceLabel= '<span class="label label-danger">x</span>';
				}

				//$selfie_icon	=	(isset($mobile))?(($mobile==0)?'<i class="fa fa-desktop"></i>':'<i class="fa fa-mobile"></i>'):'';
				//$map_icon		=	(isset($geolocation)&&($geolocation!='')&&($geolocation!=0))?'<a href="#" data-image="http://maps.googleapis.com/maps/api/staticmap?center='.$geolocation.'&zoom=18&markers=color:red|label:A|'.$geolocation.'&scale=false&size=560x370&maptype=roadmap&format=png&visual_refresh=true" data-alt="Google Map of '.$geolocation.'" class="attendance_map_link" ><i class="fa fa-map-marker"></i></a>':'';
				$selfie_icon='';	
				$map_icon='';			
				$department_attendance	.=	'<div class="col-md-4" data-user_id="'.$staffid.'">
													                <div class="box box-danger">
													                    <div class="box-header with-border">
													                        <h3 class="box-title">'.$staffname.'</h3>
																					
													                        <div class="box-tools pull-right">
													                            '.$attendanceLabel.'
													                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
													                                    class="fa fa-minus"></i>
													                            </button>
													                        </div>
													                    </div>
													                    <div class="box-body" style="min-height:400px;">
													                        <div class="box box-widget widget-user-2">
													                            <!-- Add the bg color to the header using any of the bg-* classes -->

													                            <div class="text-center">
													                                <img class="img-rounded img-responsive" src="' . $fullpath . '" alt="Photo">
													                            </div>

													                            <div class="bg-gray-light text-center">

													                                <h3>' . $staffname . '</h4>
													                                <h5>Scheduled Clock in @ <b> ' . $baselogtime . '</b></h5>
													                                <h5>Actual Clock in @ <b> ' . $logtime . '</b></h5>
													                                <a class="on-time">' . $attendance_status . '</a>
													                                <p>' . $selfie_icon . $map_icon . '</p>
													                            </div>
													                        </div>
													                    </div>
													                </div>
													              </div>';	       	
		   }
	   }
	   else
	   {
	   	$department_attendance	.=	'<h3>No Users Found</h3>';
	   }											              
   	return $department_attendance;
   }
   
   
   //Function to fetch attendance info for calendar view
   //Dominic; Dec 28,2016
   function fetchMonthlyAttendance()
   {
   	
   	$staff 	  = $this->session->userdata('mid');
   	//2016-11-01
   	//$this->input->get('your_field');
		$obtainedDate = $this->db->escape_str($this->input->post('dateofMonth'));
		$split_date=explode('-',$obtainedDate);
		$year  = $split_date[0];
		$month = $split_date[1];
		
		$sfromDate = $month.'/'.'01/'.$year; // hard-coded '01' for first day
		$stoDate   = $month.'/'.'31/'.$year;
		//$stoDate   = date('m/t/Y');
   	$fromDate  = $this->formatStorageDate($sfromDate); // hard-coded '01' for first day
		$toDate    = $this->formatStorageDate($stoDate);
		
		//$attendance	= '';
		$attendance['attendance']	= $this->attendanceCalendarData($fromDate,$toDate,$staff);
		$attendance['leaves']	   = $this->leaveCalendarData($fromDate,$toDate,$staff);
		echo json_encode($attendance);
		
	}
   //Function to view attendance info in calendar view
   //Dominic; Dec 27,2016 
   function monthiview()
   {
   	$this->authentication->check_admin_access();
		//$this->authentication->checkCalendarViewFeaturesAccess();
   	$sfromDate = date('m/01/Y'); // hard-coded '01' for first day
		$stoDate   = date('m/t/Y');
   	$fromDate  = $this->formatStorageDate($sfromDate); // hard-coded '01' for first day
		$toDate    = $this->formatStorageDate($stoDate);
		$staff 	  = $this->session->userdata('mid');
		$this->data['attendance_table']	= '';
		//$this->data['attendance_table']	= $this->attendanceCalendarData($fromDate,$toDate,$staff);
   	$this->data['view']					=	'ccattendance/monthview';
   	$this->data['footer_includes']			=	'<script src="'.base_url().'js/cc/calendarview.js" type="text/javascript"></script>';
		$this->load->view('master', $this->data);	
   }
   
   //Function to fetch leaves taken by a staff
   //Dominic; Jan 05,2016
   function leaveCalendarData($fromDate,$toDate,$staff)
   {
   	$user_leaves	=	array();
		$leaves			=	$this->Attendance_model->leaveCalendarData($fromDate,$toDate,$staff);
		$dcnt = 0;
		foreach($leaves as $row)
		{			
			//$startFormat = date_create($row->leave_date);
			//$formatDate= date_format ($startFormat, 'Y-m-d');leaveType
			
			if($row->status==0)
			{
				$lStatus ='Pending';
			}
			else if($row->status==1)
			{
				$lStatus ='Approved';
			}
			else if($row->status==2)
			{
				$lStatus ='Rejected';
			}
			else
			{
				$lStatus ='NA';
			}
			
			
			if($row->leaveType=='annual')
			{
				$leave='Annual Leave';
			}
			else if($row->leaveType=='casual')
			{
				$leave='Casual Leave';
			}
			else if($row->leaveType=='medical')
			{
				$leave='Medical Leave';
			}
			else
			{
				$leave='';
			}
			
         $user_leaves[$dcnt]["start"]				=	$row->leave_date;
         $user_leaves[$dcnt]["end"]					=	$row->leave_date;
         $user_leaves[$dcnt]["title"]				=	$leave;
         $user_leaves[$dcnt]["outtime"]			=	'';
         $user_leaves[$dcnt]["intime"]				=	$lStatus;
         $user_leaves[$dcnt]["clock"]				=	'leave';
         $user_leaves[$dcnt]["backgroundColor"]	=	"#f56954"; //Info (red)
         $user_leaves[$dcnt]["borderColor"]		=	"#f56954"; 	//Info (red)
            
			$dcnt++;				
		}
		return $user_leaves;
   }
   
   //Function to fetch attendance data for calendar view
   //Dominic; Dec 27,2016 
   function attendanceCalendarData($f_from_date,$f_to_date,$staff)
   {
		$attendance_table=array();
		$file_path 	 =  "../../selfies/aLog/";
		//$file_path 	 	=  "/home/clockin/www/selfies/aLog/";
		$r_cnt 		 = 1;	
		// Store date to process due to BETWEEN difficiency
		$q_date = array();
		$p_date =  $f_from_date;
		while ($p_date <= $f_to_date)
		{
			//echo "Array ".$p_date." ";
			array_push($q_date, $p_date);	
			$p_date = date("Y-m-d", strtotime($p_date . ' + 1 day'));
		}
						
		for($dcnt=0; $dcnt < count($q_date); $dcnt++)
		{
			$in_invfilter 	= 	"non";
			$dispute_msg	=	"";  					
			
			if ($in_invfilter == "non")
			{
				$staff_attendance_info_result = $this->Attendance_model->getStaffAllClockInfobyDate($staff, $q_date[$dcnt]);																									
				// Get Day - Monday, Tuesday etc.
				$log_date = $q_date[$dcnt];
            $timestamp = strtotime($log_date);
            $check_day = date("l", $timestamp);
               
            // Check if Staff is suppose to be working on DAY.
				// 0 = non work, 1 = Grave yard, 2 = Non Grave Yard
            $p_check_workday_type = $this->Attendance_model->getStaffShiftTypeviaDay($staff, $check_day);
               	                  
            if(isset($p_check_workday_type["shifttype"]))
            {
               $check_workday_type 	 = $p_check_workday_type["shifttype"];
            }
            else
            {
               $check_workday_type 	 = 0;
            }	
               
            if(isset($p_check_workday_type["basestart"]))
            {
               $base_start_time 		 = $p_check_workday_type["basestart"];
            }
            else
            {
               $base_start_time	 	 = '';
            }
               
            if(isset($p_check_workday_type["baseend"]))
            {
               $base_end_time 		 = $p_check_workday_type["baseend"];
            }
            else
            {
               $base_end_time	 	 	= '';
            }
               
            if(isset($p_check_workday_type["baseend"]))
            {
               $in_shift = $p_check_workday_type["shiftid"];
            }
            else
            {
               $in_shift = '';
            }

				$shift_info = $this->Attendance_model->getShiftDetails_v2($in_shift, $check_day);

				if ($check_workday_type == 0)
				{
					// 0 = Non working day
					$ab_log_date = $q_date[$dcnt];
					$log_date = $q_date[$dcnt];								
					$staffname = $this->Attendance_model->getStaffName($staff);
					//$attendanceToken= 2;	
					$attendanceInToken= 1;	
					$attendanceOutToken= 1;	
					$attendance_status = "Non Work Day";
					$log_time = "Non";
               $a_in_file = "Non";
               $a_out_file = "Non";
               $attendance_time = $base_start_time;
               $attendance_end_time = $base_end_time;
               $staff_logout_time = "Non";
               $attendance_out_status = "Non";								
				}
				elseif ($check_workday_type == 1)
				{
					// 1 = Grave Yard Work Day - Need Add 1 Day
						
					$p_log_date = $log_date;
					$out_log_date = date('Y-m-d', strtotime($p_log_date . ' + 1 day'));
					$staff_work_day_info = $this->Attendance_model->getStaffClockInfobyDate($staff, $log_date, "in");
					$staffname = $this->Attendance_model->getStaffName($staff);
					// Check in clock in.
					if (count($staff_work_day_info)==0||$staff_work_day_info["log_time"] == "")
					{
						$staff_work_day_infoz = $this->Attendance_model->getStaffClockInfobyDate($staff, $log_date, "ab");
						$dispute_msg = $staff_work_day_infoz["notes"];								
						
						$clockToday = date("Y-m-d");
						$clockDay = $log_date; //from db
						
						$today_clock = strtotime($clockToday);
						$log_clock = strtotime($clockDay);
						
						if ($log_clock > $today_clock) 
						{ 
							$attendance_status = "NA"; 
							$attendance_out_status = "NA";
							//$attendanceToken= 1;
							$attendanceInToken= 0;	
							$attendanceOutToken= 0;
						}
						else
						{
							$attendance_status = "Absent"; 
							$attendance_out_status = "Absent";
							//$attendanceToken= 3;
							$attendanceInToken= 2;	
							$attendanceOutToken= 2;
						}


						//$attendance_status = "<span class='label label-danger'>Absent</span>"; 
						// Process for show in table
                  //$staffname = $adminfunc->getStaffName($srow["staff_id"]);
                  $staffname = $this->Attendance_model->getStaffName($staff);
                  $log_time = "NA";
                  $a_in_file = "NA";
                  $a_out_file = "NA";
                  $attendance_time = $base_start_time;
                  $attendance_end_time = $base_end_time;
                  $staff_logout_time = "NA";
                  
					}
					else
					{
						// Get shift details
						$p_shift_info = $this->Attendance_model->getShiftDetails($in_shift, $check_day);
						$shift_info 	= $p_shift_info->row_array();
															 
						// Compute Clock in
						$d_attendance_in_time = strtotime($staff_work_day_info["base_log_time"]);
						$d_staff_time_in = strtotime($staff_work_day_info["log_time"]);
						$p_in_undertime = $d_staff_time_in - $d_attendance_in_time;
						//$p_in_undertime = $d_attendance_in_time - $d_staff_in_out;
						$in_undertime = gmdate('H:i:s', $p_in_undertime);
						$in_file_name = $staff_work_day_info["attendance_file"];
						$a_in_file = "<a href=\"$file_path$in_file_name\" target=\"_blank\">$staffname</a>";
							 
						if ($p_in_undertime > 0)
						{
							$attendance_status = "Late by : ".$in_undertime;
							//$attendanceToken= 5;
							$attendanceInToken= 3;	
						}
						else
						{
							$attendance_status = "On Time";
							//$attendanceToken= 4;
							$attendanceInToken= 6;	
						}
						$log_time = $staff_work_day_info["log_time"];
						$attendance_time = $staff_work_day_info["base_log_time"];
						$dispute_msg = $staff_work_day_info["notes"];
 
						// Compute Clock out
						$staff_work_day_out_info = $this->Attendance_model->getStaffClockInfobyDate($staff, $out_log_date, "out");
						if (count($staff_work_day_out_info)>0&&$staff_work_day_out_info["log_time"] != "")
						{									 	
							$d_attendance_out_time = strtotime($staff_work_day_out_info["base_log_time"]);
							$staff_logout_time = $staff_work_day_out_info["log_time"];
							$d_staff_time_out = strtotime($staff_work_day_out_info["log_time"]);
							$p_out_undertime = $d_attendance_out_time - $d_staff_time_out;
							$out_undertime = gmdate('H:i:s', $p_out_undertime);
							 	
							if ($p_out_undertime > 0)
							{
							 	$attendance_out_status = "Early check out by : ".$out_undertime;
							 	//$attendanceToken= 6;	
								$attendanceOutToken= 4;
							}
							else
							{
							 	$attendance_out_status = "Ok.";
							 	//$attendanceToken= 8;	
								$attendanceOutToken= 7;
							}
							 	
							// Process for show in table
							$file_name = $staff_work_day_out_info["attendance_file"];
							$a_out_file = "<a href=\"$file_path$file_name \" target=\"_blank\">$staffname </a>";
							// Compute
							$attendance_end_time = $staff_work_day_out_info["base_log_time"];
							$dispute_msg = $staff_work_day_info["notes"];
							 	
						}
						else
						{
							$a_out_file = "";
							$staff_logout_time = "NA";
                     $attendance_end_time = $shift_info["pday_endtime"];
                     $attendance_out_status = "Did Not Clock Out.";
                     //$attendanceToken= 7;
							$attendanceOutToken= 5;
						}
							 
					}
				}
				elseif ($check_workday_type == 2)
				{
					// 2 = Non Grave Yard Work Day
					$staff_work_day_info = $this->Attendance_model->getStaffClockInfobyDate($staff, $log_date, "in");
						
					// Check in clock in.
					if (count($staff_work_day_info)==0||$staff_work_day_info["log_time"] == "")
					{

						$staff_work_day_infozz = $this->Attendance_model->getStaffClockInfobyDate($staff, $log_date, "ab");
						$dispute_msg = $staff_work_day_infozz["notes"];		
						
						$clockToday = date("Y-m-d");
						$clockDay = $log_date; //from db
						
						$today_clock = strtotime($clockToday);
						$log_clock = strtotime($clockDay);
						
						if ($log_clock > $today_clock) 
						{ 
							$attendance_status = "NA"; 
							$attendance_out_status = "NA";
							//$attendanceToken= 1;
							$attendanceInToken= 0;	
							$attendanceOutToken= 0;
						}
						else
						{
							$attendance_status = "Absent"; 
							$attendance_out_status = "Absent";
							//$attendanceToken= 3;
							$attendanceInToken= 2;	
							$attendanceOutToken= 2;
						}							
						
						//$attendance_status = "<span class='label label-danger'>Absent</span>";
						// Process for show in table
						$staffname = $this->Attendance_model->getStaffName($staff);
						$log_time = "NA";
                  $a_in_file = "NA";
                  $a_out_file = "NA";
                  $attendance_time = $base_start_time; 
          			$attendance_end_time = $base_end_time;
						$staff_logout_time = "NA";
						//$attendance_out_status = "<span class='label label-danger'>Absent</span>";
					}
					else
					{
						// Get shift details
						$p_shift_info = $this->Attendance_model->getShiftDetails($in_shift, $check_day);
						$shift_info   = $p_shift_info->row_array();
						$staffname 	  = $this->Attendance_model->getStaffName($staff);
						// ---------- Compute Clock in ------------
						$d_attendance_in_time = strtotime($staff_work_day_info["base_log_time"]);
						$d_staff_time_in = strtotime($staff_work_day_info["log_time"]);
						$p_in_undertime = $d_staff_time_in - $d_attendance_in_time;
						$in_undertime = gmdate('H:i:s', $p_in_undertime);
						$in_file_name = $staff_work_day_info["attendance_file"];
						$a_in_file = "<a href=\"$file_path$in_file_name\" target=\"_blank\">$staffname</a>";
						if($p_in_undertime > 0)
						{
							$attendance_status = "Late by : ".$in_undertime;
							//$attendanceToken= 5;
							$attendanceInToken= 3;	
						}
						else
						{
							$attendance_status = "On Time";
							//$attendanceToken= 4;
							$attendanceInToken= 6;	
						}
							
						// Process for show in table
						$staffname 	  = $this->Attendance_model->getStaffName($staff);
						$log_time = $staff_work_day_info["log_time"];
						$attendance_time = $shift_info["pday_starttime"]; // Compute
						$attendance_time = $staff_work_day_info["base_log_time"];
						$dispute_msg = $staff_work_day_info["notes"];
							
						// --------- Compute Clock out ---------------
						$staff_work_day_out_info = $this->Attendance_model->getStaffClockInfobyDate($staff, $log_date, "out");
						if (count($staff_work_day_out_info)>0&&$staff_work_day_out_info["log_time"] != "")
						{
							$d_attendance_out_time = strtotime($staff_work_day_out_info["base_log_time"]);
							$staff_logout_time = $staff_work_day_out_info["log_time"];
							$d_staff_time_out = strtotime($staff_work_day_out_info["log_time"]);
							$p_out_undertime = $d_attendance_out_time - $d_staff_time_out;
							$out_undertime = gmdate('H:i:s', $p_out_undertime);
								
							if ($p_out_undertime > 0)
							{
								$attendance_out_status = "Early check out by : ".$out_undertime;
								//$attendanceToken= 6;	
								$attendanceOutToken= 4;
							}
							else
							{
								$attendance_out_status = "Ok.";
								//$attendanceToken= 8;
								$attendanceOutToken= 7;
							}
								
							// Process for show in table
							$out_file_name = $staff_work_day_out_info["attendance_file"];
							$a_out_file = "<a href=\"$file_path$out_file_name \" target=\"_blank\">$staffname </a>";
							$attendance_time = $staff_work_day_info["base_log_time"];
							$attendance_end_time = $staff_work_day_out_info["base_log_time"]; 
							$dispute_msg = $staff_work_day_info["notes"];
								
						}
						else
						{
							// Process for show in table
                     $out_file_name = "NA";
                     $a_out_file = "";
                     $staff_logout_time = "NA";
                     $attendance_time = $base_start_time;
                     $attendance_end_time = $shift_info["pday_endtime"]; 		
							$attendance_out_status = "Did Not Clock Out.";
							//$attendanceToken= 7;	
							$attendanceOutToken= 5;
						}
					}
						
				}   
				
				//na =0
				//non =1
				//abs =2
				//latein=3
				//earlyout=4
				//didnot=5
				//ontime=6
				//ok=7
				//leave=8
				
				if($attendanceInToken== 0 && $attendanceOutToken== 0)
				{
					$attendance_table[$dcnt]["backgroundColor"]="#ebebe0"; //Info (aqua)
            	$attendance_table[$dcnt]["borderColor"]="#ebebe0"; 	 //Info (aqua)
            	$attendance_table[$dcnt]["title"]= "NA";
				}  
				else if($attendanceInToken== 1 && $attendanceOutToken== 1)
				{
					$attendance_table[$dcnt]["backgroundColor"]="#00c0ef"; //Info (light blue)
            	$attendance_table[$dcnt]["borderColor"]="#00c0ef"; 	//Info (light blue)
            	$attendance_table[$dcnt]["title"]= "Non-working day";
				}
				else if($attendanceInToken== 2 && $attendanceOutToken== 2)  
				{
					$attendance_table[$dcnt]["backgroundColor"]="#f56954"; //Info (red)
            	$attendance_table[$dcnt]["borderColor"]="#f56954"; 	//Info (red)
            	$attendance_table[$dcnt]["title"]= "Absent";
				}
				else if($attendanceInToken== 6 && $attendanceOutToken== 7)
				{
					$attendance_table[$dcnt]["backgroundColor"]="#00a65a"; //Info (green)
            	$attendance_table[$dcnt]["borderColor"]="#00a65a"; 	//Info (green)
            	$attendance_table[$dcnt]["title"]= "On Time";
				}   
				else if($attendanceInToken== 6 && $attendanceOutToken== 4)
				{
					$attendance_table[$dcnt]["backgroundColor"]="#FFBF00"; //Info (orange)
            	$attendance_table[$dcnt]["borderColor"]="#FFBF00"; 	//Info (orange)
            	$attendance_table[$dcnt]["title"]= $attendance_out_status;
				}  
				else if($attendanceInToken== 6 && $attendanceOutToken== 5) 
				{
					$attendance_table[$dcnt]["backgroundColor"]="#585858"; //Info (yellow)
            	$attendance_table[$dcnt]["borderColor"]="#585858"; 	//Info (yellow)
            	$attendance_table[$dcnt]["title"] = "Did Not Clock Out.";
				}
				else if($attendanceInToken== 3 && $attendanceOutToken== 7)   
				{
					$attendance_table[$dcnt]["backgroundColor"]="#FFBF00"; //Info (orange)
            	$attendance_table[$dcnt]["borderColor"]="#FFBF00"; 	//Info (orange)
            	$attendance_table[$dcnt]["title"]=$attendance_status;
				}
				else if($attendanceInToken== 3 && $attendanceOutToken== 4)
				{
					$attendance_table[$dcnt]["backgroundColor"]="#FFBF00"; //Info (orange)
            	$attendance_table[$dcnt]["borderColor"]="#FFBF00"; 	//Info (orange)
            	$attendance_table[$dcnt]["title"]= $attendance_out_status;
				}
				else if($attendanceInToken== 3 && $attendanceOutToken== 5)
				{
					$attendance_table[$dcnt]["backgroundColor"]="#585858"; //Info (yellow)
            	$attendance_table[$dcnt]["borderColor"]="#585858"; 	//Info (yellow)
            	$attendance_table[$dcnt]["title"] = "Did Not Clock Out.";
				}
				else
				{
					$attendance_table[$dcnt]["backgroundColor"]="#ebebe0"; //Info (aqua)
            	$attendance_table[$dcnt]["borderColor"]="#ebebe0"; 	 //Info (aqua)
            	$attendance_table[$dcnt]["title"]= "NA";
				}
                
				// 1: NA  //aqua
				// 2: Non working //aqua
				// 3: absent //red
				// 4: on time //green
				// 5: Late by // orange
				// 6: Early check out by //orange
				// 7: Did Not Clock Out //yellow
				// 8: Ok
				/*
				if($attendanceToken==1)
				{
					$attendance_table[$dcnt]["backgroundColor"]="#ebebe0"; //Info (aqua)
            	$attendance_table[$dcnt]["borderColor"]="#ebebe0"; 	 //Info (aqua)
            	$attendance_table[$dcnt]["title"]= "NA";
				}
				else if($attendanceToken==2)
				{
					$attendance_table[$dcnt]["backgroundColor"]="#00c0ef"; //Info (light blue)
            	$attendance_table[$dcnt]["borderColor"]="#00c0ef"; 	//Info (light blue)
            	$attendance_table[$dcnt]["title"]= "Non-working day";
				}
				else if($attendanceToken==3)
				{
					$attendance_table[$dcnt]["backgroundColor"]="#f56954"; //Info (red)
            	$attendance_table[$dcnt]["borderColor"]="#f56954"; 	//Info (red)
            	$attendance_table[$dcnt]["title"]= "AWOL";
				}
				else if($attendanceToken==4)
				{
					$attendance_table[$dcnt]["backgroundColor"]="#00a65a"; //Info (green)
            	$attendance_table[$dcnt]["borderColor"]="#00a65a"; 	//Info (green)
            	$attendance_table[$dcnt]["title"]= "On Time";
				}
				else if($attendanceToken==5)
				{
					$attendance_table[$dcnt]["backgroundColor"]="#FFBF00"; //Info (orange)
            	$attendance_table[$dcnt]["borderColor"]="#FFBF00"; 	//Info (orange)
            	$attendance_table[$dcnt]["title"]=$attendance_status;
				}
				else if($attendanceToken==6)
				{
					$attendance_table[$dcnt]["backgroundColor"]="#FFBF00"; //Info (orange)
            	$attendance_table[$dcnt]["borderColor"]="#FFBF00"; 	//Info (orange)
            	$attendance_table[$dcnt]["title"]= $attendance_out_status;
				}
				else if($attendanceToken==7)
				{
					$attendance_table[$dcnt]["backgroundColor"]="#FFFF00"; //Info (yellow)
            	$attendance_table[$dcnt]["borderColor"]="#FFFF00"; 	//Info (yellow)
            	$attendance_table[$dcnt]["title"] = "Did Not Clock Out.";
				}
				else if($attendanceToken==8)
				{
					$attendance_table[$dcnt]["backgroundColor"]="#00a65a"; //Info (green)
            	$attendance_table[$dcnt]["borderColor"]="#00a65a"; 	//Info (green)
            	$attendance_table[$dcnt]["title"]=$attendance_status;
				}
				else
				{
					$attendance_table[$dcnt]["backgroundColor"]="#ebebe0";
            	$attendance_table[$dcnt]["borderColor"]="#ebebe0";
            	$attendance_table[$dcnt]["title"]=$attendance_status;
				} */
				
            $startFormat = date_create($log_date);
				$formatDate= date_format ($startFormat, 'Y-m-d');
            $attendance_table[$dcnt]["start"]=$log_date;
            $attendance_table[$dcnt]["end"]=$log_date;
            //$attendance_table[$dcnt]["title"]=$attendance_status;
            $attendance_table[$dcnt]["outtime"]=$staff_logout_time;
            $attendance_table[$dcnt]["intime"]=$log_time;
            $attendance_table[$dcnt]["clock"]='attendance';
            
            
            //$attendance_table[$dcnt]["logtime"]=$log_time;
            
            $r_cnt++;   
            $dispute_msg=""; 

		 }
		}
		return $attendance_table;   
   }

	//Function to fetch staff attendance in calendar view
	//Jan 01, 2017
	function staffattendance($selUser='')
	{
		$this->authentication->check_admin_access();
		$this->authentication->checkCalendarViewFeaturesAccess();
		$compIdSess =$this->session->userdata('coid');
		$sfromDate = date('m/01/Y'); // hard-coded '01' for first day
		$stoDate   = date('m/t/Y');
		$fromDate  = $this->formatStorageDate($sfromDate); // hard-coded '01' for first day
		$toDate    = $this->formatStorageDate($stoDate);
		$staff 	  = $this->session->userdata('mid');
		$this->data['attendance_table']	= '';
		if(isset($selUser) && !empty($selUser))
		{
			$this->data['myID']	= $selUser;
		}
		else
		{
			$this->data['myID']	= $this->session->userdata('mid');
		}	
		$this->data['users']	  = $this->Attendance_model->getCompanyUsers($compIdSess);
		//$this->data['attendance_table']	= $this->attendanceCalendarData($fromDate,$toDate,$staff);
		$this->data['view']					=	'ccattendance/staffattendancecalendar';
		$this->data['footer_includes']			=	'<script src="'.base_url().'js/cc/calendarview.js" type="text/javascript"></script>
																 <script src="'.base_url().'js/cc/my-attendance.js" type="text/javascript"></script>';
		
		$this->load->view('master', $this->data);
	}

	//Fetch a staffs attendance to show in staff calendar
	//Dominic; Jan 01,2016
	function fetchStaffMonthlyAttendance()
	{
		//2016-11-01
		$staff = $this->db->escape_str($this->input->post('user'));
		$obtainedDate = $this->db->escape_str($this->input->post('dateofMonth'));
		$split_date=explode('-',$obtainedDate);
		$year  = $split_date[0];
		$month = $split_date[1];

		$sfromDate = $month.'/'.'01/'.$year; // hard-coded '01' for first day
		$stoDate   = $month.'/'.'31/'.$year;
		//$stoDate   = date('m/t/Y');
		$fromDate  = $this->formatStorageDate($sfromDate); // hard-coded '01' for first day
		$toDate    = $this->formatStorageDate($stoDate);

		//$attendance	= '';
		$attendance	= $this->attendanceCalendarData($fromDate,$toDate,$staff);
		echo json_encode($attendance);
	}
	
	
	//function to add notes and change clock time
	//Annie , Feb 28, 2017
	
	function add_notes()
	{
		$clock 		= 	$this->input->post('clock');
		$notes 		= 	$this->input->post('notes');
		$id			=	$this->input->post('user');
		$date			=	$this->input->post('date');
		$time			=	$this->input->post('clocktime');
		$mid			=	$this->session->userdata('mid');
		$set			=	$this->input->post('set');
		/*echo $notes;
		echo $id;*/
		$data['notes']			=	$notes;
		
		if( $set == "yes")
		{
			$data['log_time']		=	$time;
			$data['base_log_time']		=	$time;
		
		}
	/*	else
		{
		
			$time		=	$this->Attendance_model->getClockIn($clock,$id,$date);
			$data['log_time']		=$time;
		}*/
		
		$result		=	$this->Attendance_model->updateNote($data,$clock,$date,$id);
		if($result > 0)
		{
			$an_id	=	$this->Attendance_model->getAttendanceID($date,$id,$clock);
			$attid	=	$an_id['id'];
			$res 		=	$this->Attendance_model->insertLog($attid,$mid);
			if($res)
			{
					$operation = 'Note is added to '.$id.' modified by '.$mid;
					$this->site_settings->adminlog($operation);				
					echo "true";
			
			}
			else 
			{
					echo "false";
			
			}
		
		}
	
		//echo "Success";
		//redirect(base_url().'ccattendance/attendance/staffattendance/'.$id);
		
	}
	
	//Function to view leave request (and approve or reject it)
	//Dominic, Jan 13,2017
	function leaveManagement()
	{
		$this->authentication->check_admin_access();
		$this->authentication->checkLeaveManagementFeatureAccess();
		$compIdSess =$this->session->userdata('coid');
		$this->data['allLeaves']	=	$this->Attendance_model->fetchLeaverequests($compIdSess);
		$this->data['view']						=	'ccattendance/leaverequestslists';
		$this->data['footer_includes']		=	'<script src="'.base_url().'js/cc/my-attendance.js" type="text/javascript"></script>';
		$this->load->view('master', $this->data);	
	}
	
	//Function to approve a leave request
	//Dominic, Jan 13,2017
	function aproveLeaveApplication()
	{
		$this->authentication->check_admin_access();
		$this->authentication->checkLeaveManagementFeatureAccess();
		if($this->input->post('id')&&$this->input->post('staffid'))
		{
			$staffid	=	$this->db->escape_str($this->input->post('staffid'));
			$leaveId	=	$this->db->escape_str($this->input->post('id'));
			$compIdSess =$this->session->userdata('coid');
			$leaveTypeMsg = "approved";
			
			$this->Attendance_model->aproveLeaveApplication($staffid,$leaveId);
			$user	=	$this->Attendance_model->fetchUserDetail($leaveId);
			$staffName	=	$user->staff_name;
			$staffEmail	=	$user->email;
			$date = $this->Attendance_model->getLeaveDates($leaveId,$user->staff_id); 
			//print_r($date);
			foreach($date as $obj)
			{
					$value[] = $obj->leave_date;
			}
			$this->singleLeaveActionMail($leaveTypeMsg,$staffName,$staffEmail,$value);
			// save to log table	
			$operation = 'Leave request '.$leaveId.' approved under company '.$compIdSess;
			$this->site_settings->adminlog($operation);
				
			echo 'approved';
		}
	}
	
	//Function to reject a leave request
	//Dominic, Jan 13,2017
	function rejectLeaveApplication()
	{
		$this->authentication->check_admin_access();
		$this->authentication->checkLeaveManagementFeatureAccess();
		if($this->input->post('id')&&$this->input->post('staffid'))
		{
			$staffid	=	$this->db->escape_str($this->input->post('staffid'));
			$leaveId	=	$this->db->escape_str($this->input->post('id'));
			$compIdSess =$this->session->userdata('coid');
			$leaveTypeMsg = "rejected";		
			$this->Attendance_model->rejectLeaveApplication($staffid,$leaveId);
			$user	=	$this->Attendance_model->fetchUserDetail($leaveId);
			$staffName	=	$user->staff_name;
			$staffEmail	=	$user->email;
			$date = $this->Attendance_model->getLeaveDates($leaveId,$user->staff_id);
			foreach($date as $obj)
			{
					$value[] = $obj->leave_date;
			}        	         
			$this->singleLeaveActionMail($leaveTypeMsg,$staffName,$staffEmail,$value);
			// save to log table	
			$operation = 'Leave request '.$leaveId.' rejected under company '.$compIdSess;
			$this->site_settings->adminlog($operation);
				
			echo 'rejected';
		}
	}
	
	//Function to bulk approve/reject leaves
	//Dominic, Feb 21,2017
	function bulkActionLeaves()
	{
		$this->authentication->check_admin_access();
		$email_list=array();
		
		$staff 		 = $this->session->userdata('mid');
		$leaveType   = $this->input->post('leaveType');
	   $selectedLeaves = $this->input->post('selectedLeaves');
	   $totalApplied = sizeof($selectedLeaves);
	   //$date 		= 	array();
	   if($leaveType == 1)
		{
			$leaveTypeMsg = 'approved';
		}
		else if($leaveType == 2)
		{
			$leaveTypeMsg = 'rejected';
		}
	   
	   if($totalApplied>0)
	   {
	   	$userList	 = $this->Attendance_model->fetchUserEmailIds($selectedLeaves);
	   	$this->Attendance_model->performBulkEmailAction($selectedLeaves,$leaveType);

	    	foreach($userList as $row)
	      {
	         $staffName  = 	$row->staff_name;
	         $staffEmail = 	$row->email;
	         $loginName  = 	$row->login_name;
	         $companyId  = 	$row->company_id;
	         
	         $staffId    = $this->Attendance_model->fetchUserIdFromLoginAndCompanyId($loginName,$companyId);
	 	   	$dates       = $this->Attendance_model->getLeaveDates($selectedLeaves,$staffId);
	 	   	foreach($dates as $obj)
				{
					$value[] = $obj->leave_date;
				}
				print_r($value);        	         
	         $this->bulkLeaveActionMail($leaveTypeMsg,$staffName,$staffEmail,$value);
		      $email_list[]=$row->email;  //Get all email 
		   }
		   $response ='success';
	   }
	   echo json_encode($response); 
	}
	
	
   //Function to send mail to support
	//By Dominic, Nov 28,2016
	public function bulkLeaveActionMail($leaveTypeMsg,$staffName,$staffEmail,$dates)
	{
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
      
      $email_to 	= 	$staffEmail;
//      $email_to 	= 	"dominic@cliffsupport.com";
      $subject="Clock-in.me : Leave Request Status";
      
      $from = "ask@clock-in.me";
 	   
 	  /* foreach($dates as $row) 
 	   {
 	     $date[] = $row->leave_date;
 	   }*/ 
 	   print_r($dates);
 	   //$dateString  = implode(",",$date); 
 	   $this->data['leaveActionMessage'] 	=	$leaveTypeMsg;
 	   $this->data['staffName'] 	=	$staffName;
 	   $this->data['baseurl']		=	base_url();
 	   $this->data['leavedate']	=  $dates;
 	   $bcc_list = array('ask@clock-in.me', 'sean@flexiesolutions.com', 'albert.goh@flexiesolutions.com');
 	   //$bcc_list = array('dominiccliff88@gmail.com');
 	      
	   $template = $this->load->view('email_templates/leave_acknowledgement',$this->data,TRUE); 
		$this->email->from($from, 'Clock-in.me Customer Care');			
  		$this->email->to($email_to);
  		//$this->email->cc($cc_list);
  		$this->email->bcc($bcc_list);
		$this->email->message($template);	
		$this->email->subject($subject);		
  	 	$this->email->send();  	 	
	}
	
	
	//function to send single mail for approve or reject leave
	//Annie, March 15,2017 
	
	
	public function singleLeaveActionMail($leaveTypeMsg,$staffName,$staffEmail,$date)
	{
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
      
      $email_to 	= 	$staffEmail;
//      $email_to 	= 	"dominic@cliffsupport.com";
      $subject="Clock-in.me : Leave Request Status";
      
      $from = "ask@clock-in.me";
 	      
 	   $this->data['leaveActionMessage'] 	=	$leaveTypeMsg;
 	   $this->data['staffName'] 	=	$staffName;
 	   $this->data['leavedate']	=	$date;
 	   $this->data['baseurl']		=	base_url();
 	   $bcc_list = array('ask@clock-in.me', 'sean@flexiesolutions.com', 'albert.goh@flexiesolutions.com');
// 	   $bcc_list = array('dominiccliff88@gmail.com');
 	      
	   $template = $this->load->view('email_templates/leave_acknowledgement',$this->data,TRUE); 
		$this->email->from($from, 'Clock-in.me Customer Care');			
  		$this->email->to($email_to);
  		//$this->email->cc($cc_list);
  		$this->email->bcc($bcc_list);
		$this->email->message($template);	
		$this->email->subject($subject);		
  	 	$this->email->send();  	 	
	}
	
	
	//Dominic; Feb 22,2017 
	function fetchMonthlyLeaveAttendance()
   {
   	
   	$staff 	  = $this->session->userdata('mid');
   	//2016-11-01
   	//$this->input->get('your_field');
		$obtainedDate = $this->db->escape_str($this->input->post('dateofMonth'));
		$split_date=explode('-',$obtainedDate);
		$year  = $split_date[0];
		$month = $split_date[1];
		
		$sfromDate = $month.'/'.'01/'.$year; // hard-coded '01' for first day
		$stoDate   = $month.'/'.'31/'.$year;
		//$stoDate   = date('m/t/Y');
   	$fromDate  = $this->formatStorageDate($sfromDate); // hard-coded '01' for first day
		$toDate    = $this->formatStorageDate($stoDate);
		
		//$attendance	= '';
		$attendance['attendance']	= $this->monthlyLeaveCalendarData($fromDate,$toDate,$staff);
		$attendance['leaves']	   = $this->leaveCalendarData($fromDate,$toDate,$staff);
		echo json_encode($attendance);
		
	}
	
   //Function to fetch attendance data for calendar view
   //Dominic; Feb 22,2017 
   function monthlyLeaveCalendarData($f_from_date,$f_to_date,$staff)
   {
		$attendance_table=array();
		$file_path 	 =  "../../selfies/aLog/";
		//$file_path 	 	=  "/home/clockin/www/selfies/aLog/";
		$r_cnt 		 = 1;	
		// Store date to process due to BETWEEN difficiency
		$q_date = array();
		$p_date =  $f_from_date;
		while ($p_date <= $f_to_date)
		{
			//echo "Array ".$p_date." ";
			array_push($q_date, $p_date);	
			$p_date = date("Y-m-d", strtotime($p_date . ' + 1 day'));
		}
						
		for($dcnt=0; $dcnt < count($q_date); $dcnt++)
		{
			$in_invfilter 	= 	"non";
			$dispute_msg	=	"";  					
			
			if ($in_invfilter == "non")
			{
				$staff_attendance_info_result = $this->Attendance_model->getStaffAllClockInfobyDate($staff, $q_date[$dcnt]);																									
				// Get Day - Monday, Tuesday etc.
				$log_date = $q_date[$dcnt];
            $timestamp = strtotime($log_date);
            $check_day = date("l", $timestamp);
               
            // Check if Staff is suppose to be working on DAY.
				// 0 = non work, 1 = Grave yard, 2 = Non Grave Yard
            $p_check_workday_type = $this->Attendance_model->getStaffShiftTypeviaDay($staff, $check_day);
               	                  
            if(isset($p_check_workday_type["shifttype"]))
            {
               $check_workday_type 	 = $p_check_workday_type["shifttype"];
            }
            else
            {
               $check_workday_type 	 = 0;
            }	
               
            if(isset($p_check_workday_type["basestart"]))
            {
               $base_start_time 		 = $p_check_workday_type["basestart"];
            }
            else
            {
               $base_start_time	 	 = '';
            }
               
            if(isset($p_check_workday_type["baseend"]))
            {
               $base_end_time 		 = $p_check_workday_type["baseend"];
            }
            else
            {
               $base_end_time	 	 	= '';
            }
               
            if(isset($p_check_workday_type["baseend"]))
            {
               $in_shift = $p_check_workday_type["shiftid"];
            }
            else
            {
               $in_shift = '';
            }

				$shift_info = $this->Attendance_model->getShiftDetails_v2($in_shift, $check_day);

				if ($check_workday_type == 0)
				{
					// 0 = Non working day
					$ab_log_date = $q_date[$dcnt];
					$log_date = $q_date[$dcnt];								
					$staffname = $this->Attendance_model->getStaffName($staff);
					$attendanceToken= 2;	
					$attendance_status = "Non Work Day";
					$log_time = "Non";
               $a_in_file = "Non";
               $a_out_file = "Non";
               $attendance_time = $base_start_time;
               $attendance_end_time = $base_end_time;
               $staff_logout_time = "Non";
               $attendance_out_status = "Non";								
				}
				elseif ($check_workday_type == 1)
				{
					// 1 = Grave Yard Work Day - Need Add 1 Day
						
					$p_log_date = $log_date;
					$out_log_date = date('Y-m-d', strtotime($p_log_date . ' + 1 day'));
					$staff_work_day_info = $this->Attendance_model->getStaffClockInfobyDate($staff, $log_date, "in");
					$staffname = $this->Attendance_model->getStaffName($staff);
					// Check in clock in.
					if (count($staff_work_day_info)==0||$staff_work_day_info["log_time"] == "")
					{
						$staff_work_day_infoz = $this->Attendance_model->getStaffClockInfobyDate($staff, $log_date, "ab");
						$dispute_msg = $staff_work_day_infoz["notes"];								
						
						$clockToday = date("Y-m-d");
						$clockDay = $log_date; //from db
						
						$today_clock = strtotime($clockToday);
						$log_clock = strtotime($clockDay);
						
						if ($log_clock > $today_clock) 
						{ 
							$attendance_status = "NA"; 
							$attendance_out_status = "NA";
							$attendanceToken= 1;
						}
						else
						{
							$attendance_status = "Absent"; 
							$attendance_out_status = "Absent";
							$attendanceToken= 3;
						}


						//$attendance_status = "<span class='label label-danger'>Absent</span>"; 
						// Process for show in table
                  //$staffname = $adminfunc->getStaffName($srow["staff_id"]);
                  $staffname = $this->Attendance_model->getStaffName($staff);
                  $log_time = "NA";
                  $a_in_file = "NA";
                  $a_out_file = "NA";
                  $attendance_time = $base_start_time;
                  $attendance_end_time = $base_end_time;
                  $staff_logout_time = "NA";
                  
					}
					else
					{
						$attendance_status="";
                  $staff_logout_time="";
                  $log_time="";
                  $attendanceToken==1;
					}
				}
				elseif ($check_workday_type == 2)
				{
					// 2 = Non Grave Yard Work Day
					$staff_work_day_info = $this->Attendance_model->getStaffClockInfobyDate($staff, $log_date, "in");
						
					// Check in clock in.
					if (count($staff_work_day_info)==0||$staff_work_day_info["log_time"] == "")
					{

						$staff_work_day_infozz = $this->Attendance_model->getStaffClockInfobyDate($staff, $log_date, "ab");
						$dispute_msg = $staff_work_day_infozz["notes"];		
						
						$clockToday = date("Y-m-d");
						$clockDay = $log_date; //from db
						
						$today_clock = strtotime($clockToday);
						$log_clock = strtotime($clockDay);
						
						if ($log_clock > $today_clock) 
						{ 
							$attendance_status = "NA"; 
							$attendance_out_status = "NA";
							$attendanceToken= 1;
						}
						else
						{
							$attendance_status = "Absent"; 
							$attendance_out_status = "Absent";
							$attendanceToken= 3;
						}							
						
						//$attendance_status = "<span class='label label-danger'>Absent</span>";
						// Process for show in table
						$staffname = $this->Attendance_model->getStaffName($staff);
						$log_time = "NA";
                  $a_in_file = "NA";
                  $a_out_file = "NA";
                  $attendance_time = $base_start_time; 
          			$attendance_end_time = $base_end_time;
						$staff_logout_time = "NA";
						//$attendance_out_status = "<span class='label label-danger'>Absent</span>";
					}
					else
					{
						$attendance_status="";
                  $staff_logout_time="";
                  $log_time="";
                  $attendanceToken==1;
					}
						
				}                
                
				// 1: NA  //aqua
				// 2: Non working //aqua
				// 3: absent //red
				// 4: on time //green
				// 5: Late by // light red
				// 6: Early check out by //crimson red
				// 7: Did Not Clock Out //yellow
				// 8: Ok
				
				if($attendanceToken==1)
				{
					$attendance_table[$dcnt]["backgroundColor"]="#ebebe0"; //Info (aqua)
            	$attendance_table[$dcnt]["borderColor"]="#ebebe0"; 	 //Info (aqua)
				}
				else if($attendanceToken==2)
				{
					$attendance_table[$dcnt]["backgroundColor"]="#00c0ef"; //Info (aqua)
            	$attendance_table[$dcnt]["borderColor"]="#00c0ef"; 	//Info (aqua)
				}
				else if($attendanceToken==3)
				{
					$attendance_table[$dcnt]["backgroundColor"]="#f56954"; //Info (red)
            	$attendance_table[$dcnt]["borderColor"]="#f56954"; 	//Info (red)
				}
				else if($attendanceToken==4)
				{
					$attendance_table[$dcnt]["backgroundColor"]="#00a65a"; //Info (green)
            	$attendance_table[$dcnt]["borderColor"]="#00a65a"; 	//Info (green)
				}
				else if($attendanceToken==5)
				{
					$attendance_table[$dcnt]["backgroundColor"]="#ff4d4d"; //Info (light )
            	$attendance_table[$dcnt]["borderColor"]="#ff4d4d"; 	//Info (green)
				}
				else if($attendanceToken==6)
				{
					$attendance_table[$dcnt]["backgroundColor"]="#cc0000"; //Info (green)
            	$attendance_table[$dcnt]["borderColor"]="#cc0000"; 	//Info (green)
				}
				else if($attendanceToken==7)
				{
					$attendance_table[$dcnt]["backgroundColor"]="#ffcc00"; //Info (green)
            	$attendance_table[$dcnt]["borderColor"]="#ffcc00"; 	//Info (green)
				}
				else if($attendanceToken==8)
				{
					$attendance_table[$dcnt]["backgroundColor"]="#00a65a"; //Info (green)
            	$attendance_table[$dcnt]["borderColor"]="#00a65a"; 	//Info (green)
				}
				else
				{
					$attendance_table[$dcnt]["backgroundColor"]="#ebebe0";
            	$attendance_table[$dcnt]["borderColor"]="#ebebe0";
				}
				
            $startFormat = date_create($log_date);
				$formatDate= date_format ($startFormat, 'Y-m-d');
            $attendance_table[$dcnt]["start"]=$log_date;
            $attendance_table[$dcnt]["end"]=$log_date;
            $attendance_table[$dcnt]["title"]=$attendance_status;
            $attendance_table[$dcnt]["outtime"]=$staff_logout_time;
            $attendance_table[$dcnt]["intime"]=$log_time;
            $attendance_table[$dcnt]["clock"]='attendance';
            
            
            //$attendance_table[$dcnt]["logtime"]=$log_time;
            
            $r_cnt++;   
            $dispute_msg=""; 

		 }
		}
		return $attendance_table;   
   }
	
	function formatStorageDate($date)
	{
		$in_date = explode("/", $date);
		$retn_date = $in_date[2]."-".$in_date[0]."-".$in_date[1];		
		return $retn_date;
	}
	
	//Bridge to fetch who's all are around
	//Dominic; Dec 14,2016 
	function bridgefindWhoAllAround($staff,$sel_shift,$compIdSess)
	{
		$response = $this->findWhoAllAround($staff,$sel_shift,$compIdSess);
		return $response;
	}
	
	//Function to show attendance stats for the day
	//Dominic; Jan 07,2017 
	function company_users_attendance_details()
	{
		$row = $this->Attendance_model->company_users_attendance_details();	
		$data['late_checkin_users']	=	$row->late_checkins;
		$data['early_checkout_users']	=	$row->early_checkouts;
		$data['ontime_checkin_users']	=	$row->on_checkins;
		$data['absent_checkin_users']	=	$row->absentees;
		//print_r($row);
		return $data;
	}
	
	//Bridge to fetch attendance stats for the day
	//Dominic; Jan 07,2017 
	function bridge_company_users_attendance_details()
	{
		$response = $this->company_users_attendance_details();
		return $response;
	}
	
	
	//Function to get actual clock time
	//Annie, march 8,2017
	function getClockTime()
	{
		
		$clock 		= 	$this->input->post('clock');
		$id			=	$this->input->post('user');
		$date			=	$this->input->post('date');
		$result		=	$this->Attendance_model->getClockTime($clock,$id,$date);
		return $result;
	
			
	}


	function get_common()
	{
		$this->data['mynotifications']			=	$this->site_settings->fetchMyNotifications();
//		$this->data['mypic']							=	$this->site_settings->fetchMyPic();
		$this->data['footer_includes']			=	'<script src="'.base_url().'js/cc/my-attendance.js" type="text/javascript"></script>';
		/*
		$this->site_settings->get_site_settings();
		$this->data['profile']			=	$this->site_settings->personal_details();	
		$this->data['menus_all']		= 	modules::load('menus')->get_menus();
		$this->data['myprivileges']	=	$this->site_settings->myprivileges();
		
		*/
			
	}
}

