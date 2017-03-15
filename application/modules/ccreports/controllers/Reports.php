<?php

class Reports extends MX_Controller
{
	public $data;	

	function __construct()
	{
		parent::__construct();

		$this->load->model('Reports_model');
		$this->authentication->is_logged_in();
		$this->authentication->checkReportsFeaturesAccess();
		$this->get_common();
	}
	
	function formatStorageDate($date)
	{
		$in_date = explode("/", $date);
		$retn_date = $in_date[2]."-".$in_date[0]."-".$in_date[1];		
		return $retn_date;
	}
	
	//Dominic; Dec 20,2016
	public function index()
	{
			$this->authentication->check_admin_access();
			$compIdSess =$this->session->userdata('coid');
			$this->data['company_shifts']			=	modules::load('ccshifts/Shifts')->fetchShiftsofaCompany($compIdSess);
			$this->data['company_members']		=  modules::load('ccshifts/Shifts')->getAllCompanyMembers($compIdSess);
		   
			$reportDownload		= $this->authentication->reportType(); 
			if($reportDownload==DETAILED_REPORT)
			{
				$this->data['tab1'] ='active';
		      $this->data['tab2'] ='';
				$this->data['attendance_shift']	="<table id='attendance_shift_table' class='table table-bordered table-striped'>
													<thead>
													  <tr>
													  	<th>No.</td>
														<th>Real Name</th>
														<th>Attendance Date</th>
														<th>Scheduled Clock in Time</th>
														<th>Clock in Time</th>
														<th>Clock in Status</td>
														<th><i class='fa fa-desktop'></i>/<i class='fa fa-mobile'></i></td>
												      <th>Scheduled Clock Out Time</th>
												      <th>Clock Out Time</th>
												      <th>Clock Out Status</th>
												      <th><i class='fa fa-desktop'></i>/<i class='fa fa-mobile'></i></td>
														<th>Clock In Selfie</th>
														<th>Clock Out Selfie</th>
														<th>User Notes</th>
													  </tr>
													  </thead>
				                            <tbody>";
						                            
			   $this->data['attendance_user']	="<table id='attendance_user_table' class='table table-bordered table-striped'>
	   													<thead>
															  <tr>
															  	<th>No.</td>
																<th>Real Name</th>
																<th>Attendance Date</th>
																<th>Scheduled Clock in Time</th>
																<th>Clock in Time</th>
																<th>Clock in Status</td>
																<th><i class='fa fa-desktop'></i>/<i class='fa fa-mobile'></i></td>
														      <th>Scheduled Clock Out Time</th>
														      <th>Clock Out Time</th>
														      <th>Clock Out Status</th>
														      <th><i class='fa fa-desktop'></i>/<i class='fa fa-mobile'></i></td>
																<th>Clock In Selfie</th>
																<th>Clock Out Selfie</th>
																<th>User Notes</th>
															  </tr>
															  </thead>
						                            <tbody>";
			}
			else
			{
				$this->data['tab1'] ='active';
		   	$this->data['tab2'] ='';
				$this->data['attendance_shift']	="<table id='attendance_shift_table' class='table table-bordered table-striped'>
													<thead>
													  <tr>
													  	<th>No.</td>
														<th>Real Name</th>
														<th>Attendance Date</th>
														<th>Scheduled Clock in Time</th>
														<th>Clock in Status</th>
												      <th>Scheduled Clock Out Time</th>
												      <th>Clock Out Status</th>
													  </tr>
													  </thead>
				                            <tbody>";
						                            
			   $this->data['attendance_user']	="<table id='attendance_user_table' class='table table-bordered table-striped'>
	   													<thead>
															  <tr>
															  	<th>No.</td>
																<th>Real Name</th>
																<th>Attendance Date</th>
																<th>Scheduled Clock in Time</th>
																<th>Clock in Status</th>
														      <th>Scheduled Clock Out Time</th>
														      <th>Clock Out Status</th>
															  </tr>
															  </thead>
						                            <tbody>";
			}

					                            
			$staff 		 = $this->session->userdata('mid');
														  
			if( $this->input->post('multiSelect') && $this->input->post('date_from') && $this->input->post('date_to'))
			{
				$this->data['tab1'] ='active';
		      $this->data['tab2'] ='';
				$shifts=$this->input->post('multiSelect');
				$this->data['multiSelect']=$shifts;
				$this->data['date_from']=$this->input->post('date_from');
				$this->data['date_to']=$this->input->post('date_to');
				$f_from_date = $this->formatStorageDate($this->input->post('date_from'));
				$f_to_date 	 = $this->formatStorageDate($this->input->post('date_to'));
				
				
				$reportDownload		= $this->authentication->reportType(); 
				if($reportDownload==DETAILED_REPORT)
				{
					$this->data['attendance_shift']	.= $this->shiftAttendanceTabulaData($f_from_date,$f_to_date,$shifts);
				}
				else 
				{
					$this->data['attendance_shift']	.= $this->basicShiftAttendanceTabulaData($f_from_date,$f_to_date,$shifts);
				}
				
			}
			else 
			{
				$reportDownload		= $this->authentication->reportType(); 
				if($reportDownload==DETAILED_REPORT)
				{
					$this->data['attendance_shift']	.= "<tr>
                          <td class=\"botline\"></td>
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
                         <td class=\"botline\"></td>
								 <td class=\"botline\"></td>
                        </tr>";	
				}
				else 
				{
					$this->data['attendance_shift']	.= "<tr>
		                               <td class=\"botline\"></td>
		                               <td class=\"botline\"></td>
		                               <td class=\"botline\"></td>
		                               <td class=\"botline\">Please Select The From Date And To Date</td>
												 <td class=\"botline\"></td>
												 <td class=\"botline\"></td>
												 <td class=\"botline\"></td>
		                              </tr>";					
				}
	
			}
			
			if($this->input->post('umultiSelect') && $this->input->post('udate_from') && $this->input->post('udate_to'))
			{
				$this->data['tab1'] ='';
		      $this->data['tab2'] ='active';
				$users=$this->input->post('umultiSelect');
				$this->data['umultiSelect']=$users;
				$this->data['udate_from']=$this->input->post('udate_from');
				$this->data['udate_to']=$this->input->post('udate_to');
				$uf_from_date = $this->formatStorageDate($this->input->post('udate_from'));
				$uf_to_date 	 = $this->formatStorageDate($this->input->post('udate_to'));
				$reportDownload		= $this->authentication->reportType(); 
				if($reportDownload==DETAILED_REPORT)
				{
					$this->data['attendance_user']	.= $this->userAttendanceTabulaData($uf_from_date,$uf_to_date,$users);
				}
				else 
				{
					$this->data['attendance_user']	.= $this->basicUserAttendanceTabulaData($uf_from_date,$uf_to_date,$users);
				}
				 
			}
			else
			{		 
	         $reportDownload		= $this->authentication->reportType(); 
				if($reportDownload==DETAILED_REPORT)
				{
					$this->data['attendance_user']	.= "<tr>
                         <td class=\"botline\"></td>
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
                         <td class=\"botline\"></td>
								 <td class=\"botline\"></td>
                        </tr>";	
				}
				else 
				{
					$this->data['attendance_user']	.= "<tr>
		                               <td class=\"botline\"></td>
		                               <td class=\"botline\"></td>
		                               <td class=\"botline\"></td>
		                               <td class=\"botline\">Please Select The From Date And To Date</td>
												 <td class=\"botline\"></td>
												 <td class=\"botline\"></td>
												 <td class=\"botline\"></td>
		                              </tr>";					
				}                	
			}
			
		   $this->data['attendance_shift']	.= "		</tbody>
											 		</table>";                             
					                                
			$this->data['attendance_user']	.= "		</tbody>
   													 		</table>";

			$this->data['view']					=	'ccreports/report';
			$this->load->view('master', $this->data);											 
	}	
	
	//Function to fetch user attendance tabular data
	//Dominic; Dec 20,2016
	//Feb 11, 2017: Added leave checking and info
	function userAttendanceTabulaData($f_from_date,$f_to_date,$users)
	{
		$attendance_user='';
		$staff 		 = $this->session->userdata('mid');
		$file_path 	 =  "../../selfies/aLog/";
		
				// Store date to process due to BETWEEN difficiency
				$q_date = array();
				$p_date =  $f_from_date;
				while ($p_date <= $f_to_date)
				{
					//echo "Array ".$p_date." ";
					array_push($q_date, $p_date);	
					$p_date = date("Y-m-d", strtotime($p_date . ' + 1 day'));
				}
				
				$staff_attendance_result	=	$this->Reports_model->getAllStaffWorkList_users($users);
				$r_cnt 		 = 1;	
				for($dcnt=0; $dcnt < count($q_date); $dcnt++){
					$sta = array();
					foreach ($staff_attendance_result as $srow){
						array_push($sta, $srow["staff_id"]);
					}
					
					
					
					for ($j=0;$j<count($sta);$j++){
						// filter holder for future use
						$dispute_msg	=	"";  
						$in_invfilter = "non";
						if ($in_invfilter == "non"){
						  // Get Day - Monday, Tuesday etc.
                    $log_date = $q_date[$dcnt];
                    $timestamp = strtotime($log_date);
                    $check_day = date("l", $timestamp);
                    
                    $p_check_workday_type = $this->Reports_model->getStaffShiftTypeviaDay($sta[$j], $check_day);
                    $check_workday_type = $p_check_workday_type["shifttype"];
                    $base_start_time = $p_check_workday_type["basestart"];
 		              $base_end_time = $p_check_workday_type["baseend"];
 		              $in_shift 	= $p_check_workday_type["shiftid"];
 		              //echo '<br>--------------------check_workday_type : '.$check_workday_type.'--------------------<br>';
 		              if ($check_workday_type == 0){
 		              		// 0 = Non working day
								//echo "In 0 <br>";
								$ab_log_date = $q_date[$dcnt];
								$log_date = $q_date[$dcnt];
				
								$staffname = $this->Reports_model->getStaffName($sta[$j]);
								$shift_info = $this->Reports_model->getShiftDetails_v2($in_shift, $check_day);
								
								$attendance_status = "<span class='label label-default'>Non Work Day</span>";
	                     $log_time = "NA";
	                     $a_in_file = "NA";
	                     $a_out_file = "NA";
	                     $attendance_time = "NA";
	                     $attendance_end_time = "NA";

	                     $staff_logout_time = "NA";
	                     $attendance_out_status = "<span class='label label-default'>Non Work Day</span>";
	                     unset($in_mobile);
                        unset($out_mobile);
	                     
 		              }elseif ($check_workday_type == 1){
 		              		// 1 = Grave Yard Work Day - Need Add 1 Day
 		              		$p_log_date = $log_date;
 		              		$out_log_date = date('Y-m-d', strtotime($p_log_date . ' + 1 day'));
 		              		$staff_work_day_info = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "in");
 		              		$staffname = $this->Reports_model->getStaffName($sta[$j]);
 		              		
 		              		
 		              		// Check in clock in.
 		              		if (count($staff_work_day_info)==0||$staff_work_day_info["log_time"] == ""){
 		              			
 		              			$attendance_status = "<span class='label label-danger'>Absent</span>"; //compute difference
 		              			// Process for show in table
                           //$staffname = $adminfunc->getStaffName($srow["staff_id"]);
                           $staffname = $this->Reports_model->getStaffName($sta[$j]);
                           $log_time = "NA";
                           $a_in_file = "NA";
                           $a_out_file = "NA";
                           
                           $abs_checkintime_infoz = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "ab");
 		              			$abs_checkouttime_infoz = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "nc");
 		              			if (!empty($abs_checkintime_infoz["base_log_time"]))
 		              			{
 		              				$attendance_time = $abs_checkintime_infoz["base_log_time"];
 		              			}
 		              			else
 		              			{
 		              				$attendance_time = $base_start_time;
 		              			}
 		              			
 		              			if (!empty($abs_checkouttime_infoz["base_log_time"]))
 		              			{
 		              				$attendance_end_time = $abs_checkouttime_infoz["base_log_time"];
 		              			}
 		              			else
 		              			{
 		              				$attendance_end_time = $base_end_time;
 		              			}
	                   		
                           $staff_logout_time = "NA";
									//$staff_work_day_infoz = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "ab");  
//									$dispute_msg = $staff_work_day_info["notes"];	                         
                           
                           $attendance_out_status = "<span class='label label-danger'>Absent</span>";
                           unset($in_mobile);
                        	unset($out_mobile);
                        	
 		              		}else{
 		              			// Get shift details
                           $p_shift_info = $this->Reports_model->getShiftDetails($in_shift, $check_day);
                           $shift_info   = $p_shift_info->row_array();
                           
                           // Compute Clock in
                           $d_attendance_in_time = strtotime($staff_work_day_info["base_log_time"]);
                           $d_staff_time_in = strtotime($staff_work_day_info["log_time"]);
                           $p_in_undertime = $d_staff_time_in - $d_attendance_in_time;
                           $in_undertime = gmdate('H:i:s', $p_in_undertime);
                           $in_file_name = $staff_work_day_info["attendance_file"];
                           $a_in_file = "<a href=\"$file_path$in_file_name\" target=\"_blank\">$staffname</a>";
                           if ($p_in_undertime > 0){
                           	$attendance_status = "<span class='label label-warning'>Late by : ".$in_undertime."</span>";
                           }else{
                           	$attendance_status = "<span class='label label-success'>On Time</span>";
                           }
                           $log_time = $staff_work_day_info["log_time"];
                           $attendance_time = $staff_work_day_info["base_log_time"];
                           $log_time = $staff_work_day_info["log_time"];
                           
                           $in_mobile = $staff_work_day_info["mobile"];
                           // Compute Clock out
                           $staff_work_day_out_info = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $out_log_date, "out");
                           //echo '<br>--------------------Clock out 1--------------------<br>';
									//print_r($staff_work_day_out_info);
                           if (count($staff_work_day_out_info)>0&&$staff_work_day_out_info["log_time"] != ""){
                           	
                           	$d_attendance_out_time = strtotime($staff_work_day_out_info["base_log_time"]);
                           	$staff_logout_time = $staff_work_day_out_info["log_time"];
                           	$d_staff_time_out = strtotime($staff_work_day_out_info["log_time"]);
                           	$p_out_undertime = $d_attendance_out_time - $d_staff_time_out;
                           	$out_undertime = gmdate('H:i:s', $p_out_undertime);
                           	if ($p_out_undertime > 0){
                           		$attendance_out_status = "<span class='label label-primary'>Early check out by : ".$out_undertime."</span>";
                           	}else{
                           		$attendance_out_status = "<span class='label label-success'>Ok.</span>";
                           	}
                           	// Process for show in table
                           	$file_name = $staff_work_day_out_info["attendance_file"];
                           	$a_out_file = "<a href=\"$file_path$file_name \" target=\"_blank\">$staffname </a>";
                           	$attendance_end_time = $staff_work_day_out_info["base_log_time"];
                           	$out_mobile = $staff_work_day_out_info["mobile"];
                           }else{
                           	$a_out_file = "";
                           	$staff_logout_time ='';
                           	$attendance_end_time = $shift_info["pday_endtime"];
                           	$attendance_out_status = "<span class='label label-warning'>Did Not Clock Out.</span>";
                           	unset($out_mobile);
                           }
 		              		}
 		              }elseif ($check_workday_type == 2){
 		              		// 2 = Non Grave Yard Work Day
 		              		$staff_work_day_info = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "in");
 		              		
 		              		// Check in clock in.
 		              		if (count($staff_work_day_info)==0||$staff_work_day_info["log_time"] == ""){
 		              			$attendance_status = "<span class='label label-danger'>Absent</span>";
 		              			// Process for show in table
 		              			$staffname = $this->Reports_model->getStaffName($sta[$j]);
 		              			
                         	$log_time = "NA";
                         	$a_in_file = "NA";
                         	$a_out_file = "NA";
                         	
                           $abs_checkintime_infoz = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "ab");
 		              			$abs_checkouttime_infoz = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "nc");
 		              			if (!empty($abs_checkintime_infoz["base_log_time"]))
 		              			{
 		              				$attendance_time = $abs_checkintime_infoz["base_log_time"];
 		              			}
 		              			else
 		              			{
 		              				$attendance_time = $base_start_time;
 		              			}
 		              			
 		              			if (!empty($abs_checkouttime_infoz["base_log_time"]))
 		              			{
 		              				$attendance_end_time = $abs_checkouttime_infoz["base_log_time"];
 		              			}
 		              			else
 		              			{
 		              				$attendance_end_time = $base_end_time;
 		              			}
	                   		
									$staff_logout_time = "NA";

									//$staff_work_day_infoz = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "ab");  
//									$dispute_msg = $staff_work_day_info["notes"];										
									
									$attendance_out_status = "<span class='label label-danger'>Absent</span>";
									unset($in_mobile);
									unset($out_mobile);
 		              		}else{
 		              			// Get shift details
 		              			$p_shift_info = $this->Reports_model->getShiftDetails($in_shift, $check_day);
 		              			$shift_info   = $p_shift_info->row_array();
 		              			$staffname = $this->Reports_model->getStaffName($sta[$j]);
 		              			
 		              			// ---------- Compute Clock in ------------
 		              			$d_attendance_in_time = strtotime($staff_work_day_info["base_log_time"]);
 		              			$d_staff_time_in = strtotime($staff_work_day_info["log_time"]);
                           $p_in_undertime = $d_staff_time_in - $d_attendance_in_time;
                           $in_undertime = gmdate('H:i:s', $p_in_undertime);
                           $in_file_name = $staff_work_day_info["attendance_file"];
                           $a_in_file = "<a href=\"$file_path$in_file_name\" target=\"_blank\">$staffname</a>";
                           if ($p_in_undertime > 0){
                           	$attendance_status = "<span class='label label-warning'>Late by : ".$in_undertime."</span>";
                           }else{
                           	$attendance_status = "<span class='label label-success'>On Time</span>";
                           }
                           // Process for show in table
                           $staffname = $this->Reports_model->getStaffName($sta[$j]);
                           $log_time = $staff_work_day_info["log_time"];
                           $attendance_time = $shift_info["pday_starttime"]; // Compute
                           $attendance_time = $staff_work_day_info["base_log_time"];
                           $in_mobile = $staff_work_day_info["mobile"];
                           
                           // --------- Compute Clock out ---------------
									$staff_work_day_out_info = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "out");
									//echo '<br>--------------------Clock out 2--------------------<br>';
									//print_r($staff_work_day_out_info);
									if (count($staff_work_day_out_info)>0&&$staff_work_day_out_info["log_time"] != ""){
										$d_attendance_out_time = strtotime($staff_work_day_out_info["base_log_time"]);
										$staff_logout_time = $staff_work_day_out_info["log_time"];
										$d_staff_time_out = strtotime($staff_work_day_out_info["log_time"]);
										$p_out_undertime = $d_attendance_out_time - $d_staff_time_out;
										$out_undertime = gmdate('H:i:s', $p_out_undertime);
										if ($p_out_undertime > 0){
											$attendance_out_status = "<span class='label label-primary'>Early check out by : ".$out_undertime."</span>";
										}else{
											$attendance_out_status = "<span class='label label-success'>Ok</span>";
										}
										// Process for show in table
										$out_file_name = $staff_work_day_out_info["attendance_file"];
										$a_out_file = "<a href=\"$file_path$out_file_name \" target=\"_blank\">$staffname </a>";
										$attendance_time = $staff_work_day_info["base_log_time"];
										$attendance_end_time = $staff_work_day_out_info["base_log_time"]; 
										$out_mobile = $staff_work_day_out_info["mobile"];
										
									}else{
										// Process for show in table
										$out_file_name = "NA";
										$a_out_file = "";
										$staff_logout_time ='';
                              $attendance_time = $base_start_time;
                              $attendance_end_time = $shift_info["pday_endtime"]; 		
										$attendance_out_status = "<span class='label label-warning'>Did Not Clock Out.</span>";
										unset($out_mobile);
									}
 		              		}
 		              }

 		              //check if user is on leave today
				        $userAbsentOrNot = $this->site_settings->checkUserAbsentOrNot($sta[$j],$log_date);
				        if($userAbsentOrNot==1) //on leave
				        {
				      	 $attendance_status = "<span class='label label-primary'>On Leave</span>";
				      	 $attendance_out_status = "<span class='label label-primary'>On Leave</span>";
				        }
						}
						
						$selfie_in_icon	=	(isset($in_mobile))?(($in_mobile==0)?'<i class="fa fa-desktop"></i>':'<i class="fa fa-mobile"></i>'):'';
						$selfie_out_icon	=	(isset($out_mobile))?(($out_mobile==0)?'<i class="fa fa-desktop"></i>':'<i class="fa fa-mobile"></i>'):'';
						
						$attendance_user	.= "<tr>
		                                                    <td class=\"botline\">$r_cnt</td>
		                                                    <td class=\"botline\">$staffname</td>
		                                                    <td class=\"botline\">$log_date</td>
		                                                    <td class=\"botline\">$attendance_time</td>
		                                                    <td class=\"botline\">$log_time</td>
		                                                    <td class=\"botline\">$attendance_status</td>
		                                                    <td class=\"botline\">$selfie_in_icon</td>
																			 <td class=\"botline\">$attendance_end_time</td>
																			 <td class=\"botline\">$staff_logout_time</td>
																			 <td class=\"botline\">$attendance_out_status</td>
																			 <td class=\"botline\">$selfie_out_icon</td>
		                                                    <td class=\"botline\">$a_in_file</td>
		                                                    <td class=\"botline\">$a_out_file</td>
																			 <td class=\"botline\">$dispute_msg</td>

		                                                   </tr>";
		           $r_cnt++;   
                 $dispute_msg="";    
                 unset($in_mobile);                                    
                 unset($out_mobile);                                         
					}
					
				}
				if($r_cnt==1){
					$attendance_user	.= "<tr>
	                                                 <td class=\"botline\"></td>
	                                                 <td class=\"botline\"></td>
	                                                 <td class=\"botline\"></td>
	                                                 <td class=\"botline\"></td>
	                                                 <td class=\"botline\"></td>
	                                                 <td class=\"botline\"></td>
	                                                 <td class=\"botline\">Sorry No Data Found</td>
																	 <td class=\"botline\"></td>
																	 <td class=\"botline\"></td>
																	 <td class=\"botline\"></td>
	                                                 <td class=\"botline\"></td>
	                                                 <td class=\"botline\"></td>
	                                                 <td class=\"botline\"></td>
																	 <td class=\"botline\"></td>
																	 <td class=\"botline\"></td>
	                                                </tr>";
				}
				$attendance_user	.= "</tbody>
																</table>";

			return $attendance_user;				
		
	}
	
	
	
	//Function to fetch basic user attendance tabular data
	//Dominic; Jan 14,2017
	//Feb 11, 2017: Added leave checking and info
	//modified by Annie, March 3 2017
	//Dominic. March 03, 2017- fixed Clockin status not showing
	//Dominic: March 04, 2017: Fixed clock in/out status issues
	function basicUserAttendanceTabulaData($f_from_date,$f_to_date,$users)
	{

		$attendance_user='';
		$staff 		 = $this->session->userdata('mid');
		$file_path 	 =  "../../selfies/aLog/";
		
				// Store date to process due to BETWEEN difficiency
				$q_date = array();
				$p_date =  $f_from_date;
				while ($p_date <= $f_to_date)
				{
					//echo "Array ".$p_date." ";
					array_push($q_date, $p_date);	
					$p_date = date("Y-m-d", strtotime($p_date . ' + 1 day'));
				}
				
				$staff_attendance_result	=	$this->Reports_model->getAllStaffWorkList_users($users);
				$r_cnt 		 = 1;	
				for($dcnt=0; $dcnt < count($q_date); $dcnt++){
					$sta = array();
					foreach ($staff_attendance_result as $srow){
						array_push($sta, $srow["staff_id"]);
					}
					
					
					
					for ($j=0;$j<count($sta);$j++){
						// filter holder for future use
						$dispute_msg	=	"";  
						$in_invfilter = "non";
						if ($in_invfilter == "non"){
						  // Get Day - Monday, Tuesday etc.
                    $log_date = $q_date[$dcnt];
                    $timestamp = strtotime($log_date);
                    $check_day = date("l", $timestamp);
                    
                    $p_check_workday_type = $this->Reports_model->getStaffShiftTypeviaDay($sta[$j], $check_day);
                    $check_workday_type = $p_check_workday_type["shifttype"];
                    $base_start_time = $p_check_workday_type["basestart"];
 		              $base_end_time = $p_check_workday_type["baseend"];
 		              $in_shift 	= $p_check_workday_type["shiftid"];
 		              //echo '<br>--------------------check_workday_type : '.$check_workday_type.'--------------------<br>';
 		              if ($check_workday_type == 0){
 		              		// 0 = Non working day
								//echo "In 0 <br>";
								$ab_log_date = $q_date[$dcnt];
								$log_date = $q_date[$dcnt];
				
								$staffname = $this->Reports_model->getStaffName($sta[$j]);
								$shift_info = $this->Reports_model->getShiftDetails_v2($in_shift, $check_day);
								
								$attendance_status = "<span class='label label-default'>Non Work Day</span>";
	                     $log_time = "NA";
	                     $a_in_file = "NA";
	                     $a_out_file = "NA";
	                     $attendance_time = "NA";
	                     $attendance_end_time = "NA";

	                     $staff_logout_time = "NA";
	                     $attendance_out_status = "<span class='label label-default'>Non Work Day</span>";
	                     unset($in_mobile);
                        unset($out_mobile);
	                     
 		              }elseif ($check_workday_type == 1){
 		              		// 1 = Grave Yard Work Day - Need Add 1 Day
 		              		$p_log_date = $log_date;
 		              		$out_log_date = date('Y-m-d', strtotime($p_log_date . ' + 1 day'));
 		              		$staff_work_day_info = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "in");
 		              		$staffname = $this->Reports_model->getStaffName($sta[$j]);
 		              		
 		              		
 		              		// Check in clock in.
 		              		if (count($staff_work_day_info)==0||$staff_work_day_info["log_time"] == ""){
 		              			
 		              			$attendance_status = "<span class='label label-danger'>Absent</span>"; //compute difference
 		              			// Process for show in table
                           //$staffname = $adminfunc->getStaffName($srow["staff_id"]);
                           $staffname = $this->Reports_model->getStaffName($sta[$j]);
                           $log_time = "NA";
                           $a_in_file = "NA";
                           $a_out_file = "NA";
                           
                           $abs_checkintime_infoz = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "ab");
 		              			$abs_checkouttime_infoz = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "nc");
 		              			if (!empty($abs_checkintime_infoz["base_log_time"]))
 		              			{
 		              				$attendance_time = $abs_checkintime_infoz["base_log_time"];
 		              			}
 		              			else
 		              			{
 		              				$attendance_time = $base_start_time;
 		              			}
 		              			
 		              			if (!empty($abs_checkouttime_infoz["base_log_time"]))
 		              			{
 		              				$attendance_end_time = $abs_checkouttime_infoz["base_log_time"];
 		              			}
 		              			else
 		              			{
 		              				$attendance_end_time = $base_end_time;
 		              			}
	                   		
                           $staff_logout_time = "NA";
									//$staff_work_day_infoz = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "ab");  
//									$dispute_msg = $staff_work_day_info["notes"];	                         
                           
                           $attendance_out_status = "<span class='label label-danger'>Absent</span>";
                           unset($in_mobile);
                        	unset($out_mobile);
                        	
 		              		}else{
 		              			// Get shift details
                           $p_shift_info = $this->Reports_model->getShiftDetails($in_shift, $check_day);
                           $shift_info   = $p_shift_info->row_array();
                           
                           // Compute Clock in
                           $d_attendance_in_time = strtotime($staff_work_day_info["base_log_time"]);
                           $d_staff_time_in = strtotime($staff_work_day_info["log_time"]);
                           $p_in_undertime = $d_staff_time_in - $d_attendance_in_time;
                           $in_undertime = gmdate('H:i:s', $p_in_undertime);
                           $in_file_name = $staff_work_day_info["attendance_file"];
                           $a_in_file = "<a href=\"$file_path$in_file_name\" target=\"_blank\">$staffname</a>";
                           if ($p_in_undertime > 0){
                           	$attendance_status = "<span class='label label-warning'>Late by : ".$in_undertime."</span>";
                           }else{
                           	$attendance_status = "<span class='label label-success'>On Time</span>";
                           }
                           $log_time = $staff_work_day_info["log_time"];
                           $attendance_time = $staff_work_day_info["base_log_time"];
                           $log_time = $staff_work_day_info["log_time"];
                           
                           $in_mobile = $staff_work_day_info["mobile"];
                           // Compute Clock out
                           $staff_work_day_out_info = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $out_log_date, "out");
                           //echo '<br>--------------------Clock out 1--------------------<br>';
									//print_r($staff_work_day_out_info);
                           if (count($staff_work_day_out_info)>0&&$staff_work_day_out_info["log_time"] != ""){
                           	
                           	$d_attendance_out_time = strtotime($staff_work_day_out_info["base_log_time"]);
                           	$staff_logout_time = $staff_work_day_out_info["log_time"];
                           	$d_staff_time_out = strtotime($staff_work_day_out_info["log_time"]);
                           	$p_out_undertime = $d_attendance_out_time - $d_staff_time_out;
                           	$out_undertime = gmdate('H:i:s', $p_out_undertime);
                           	if ($p_out_undertime > 0){
                           		$attendance_out_status = "<span class='label label-primary'>Early check out by : ".$out_undertime."</span>";
                           	}else{
                           		$attendance_out_status = "<span class='label label-success'>Ok.</span>";
                           	}
                           	// Process for show in table
                           	$file_name = $staff_work_day_out_info["attendance_file"];
                           	$a_out_file = "<a href=\"$file_path$file_name \" target=\"_blank\">$staffname </a>";
                           	$attendance_end_time = $staff_work_day_out_info["base_log_time"];
                           	$out_mobile = $staff_work_day_out_info["mobile"];
                           }else{
                           	$a_out_file = "";
                           	$staff_logout_time ='';
                           	$attendance_end_time = $shift_info["pday_endtime"];
                           	$attendance_out_status = "<span class='label label-warning'>Did Not Clock Out.</span>";
                           	unset($out_mobile);
                           }
 		              		}
 		              }elseif ($check_workday_type == 2){
 		              		// 2 = Non Grave Yard Work Day
 		              		$staff_work_day_info = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "in");
 		              		
 		              		// Check in clock in.
 		              		if (count($staff_work_day_info)==0||$staff_work_day_info["log_time"] == ""){
 		              			$attendance_status = "<span class='label label-danger'>Absent</span>";
 		              			// Process for show in table
 		              			$staffname = $this->Reports_model->getStaffName($sta[$j]);
 		              			
                         	$log_time = "NA";
                         	$a_in_file = "NA";
                         	$a_out_file = "NA";
                         	
                           $abs_checkintime_infoz = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "ab");
 		              			$abs_checkouttime_infoz = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "nc");
 		              			if (!empty($abs_checkintime_infoz["base_log_time"]))
 		              			{
 		              				$attendance_time = $abs_checkintime_infoz["base_log_time"];
 		              			}
 		              			else
 		              			{
 		              				$attendance_time = $base_start_time;
 		              			}
 		              			
 		              			if (!empty($abs_checkouttime_infoz["base_log_time"]))
 		              			{
 		              				$attendance_end_time = $abs_checkouttime_infoz["base_log_time"];
 		              			}
 		              			else
 		              			{
 		              				$attendance_end_time = $base_end_time;
 		              			}
	                   		
									$staff_logout_time = "NA";

									//$staff_work_day_infoz = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "ab");  
//									$dispute_msg = $staff_work_day_info["notes"];										
									
									$attendance_out_status = "<span class='label label-danger'>Absent</span>";
									unset($in_mobile);
									unset($out_mobile);
 		              		}else{
 		              			// Get shift details
 		              			$p_shift_info = $this->Reports_model->getShiftDetails($in_shift, $check_day);
 		              			$shift_info   = $p_shift_info->row_array();
 		              			$staffname = $this->Reports_model->getStaffName($sta[$j]);
 		              			
 		              			// ---------- Compute Clock in ------------
 		              			$d_attendance_in_time = strtotime($staff_work_day_info["base_log_time"]);
 		              			$d_staff_time_in = strtotime($staff_work_day_info["log_time"]);
                           $p_in_undertime = $d_staff_time_in - $d_attendance_in_time;
                           $in_undertime = gmdate('H:i:s', $p_in_undertime);
                           $in_file_name = $staff_work_day_info["attendance_file"];
                           $a_in_file = "<a href=\"$file_path$in_file_name\" target=\"_blank\">$staffname</a>";
                           if ($p_in_undertime > 0){
                           	$attendance_status = "<span class='label label-warning'>Late by : ".$in_undertime."</span>";
                           }else{
                           	$attendance_status = "<span class='label label-success'>On Time</span>";
                           }
                           // Process for show in table
                           $staffname = $this->Reports_model->getStaffName($sta[$j]);
                           $log_time = $staff_work_day_info["log_time"];
                           $attendance_time = $shift_info["pday_starttime"]; // Compute
                           $attendance_time = $staff_work_day_info["base_log_time"];
                           $in_mobile = $staff_work_day_info["mobile"];
                           
                           // --------- Compute Clock out ---------------
									$staff_work_day_out_info = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "out");
									//echo '<br>--------------------Clock out 2--------------------<br>';
									//print_r($staff_work_day_out_info);
									if (count($staff_work_day_out_info)>0&&$staff_work_day_out_info["log_time"] != ""){
										$d_attendance_out_time = strtotime($staff_work_day_out_info["base_log_time"]);
										$staff_logout_time = $staff_work_day_out_info["log_time"];
										$d_staff_time_out = strtotime($staff_work_day_out_info["log_time"]);
										$p_out_undertime = $d_attendance_out_time - $d_staff_time_out;
										$out_undertime = gmdate('H:i:s', $p_out_undertime);
										if ($p_out_undertime > 0){
											$attendance_out_status = "<span class='label label-primary'>Early check out by : ".$out_undertime."</span>";
										}else{
											$attendance_out_status = "<span class='label label-success'>Ok</span>";
										}
										// Process for show in table
										$out_file_name = $staff_work_day_out_info["attendance_file"];
										$a_out_file = "<a href=\"$file_path$out_file_name \" target=\"_blank\">$staffname </a>";
										$attendance_time = $staff_work_day_info["base_log_time"];
										$attendance_end_time = $staff_work_day_out_info["base_log_time"]; 
										$out_mobile = $staff_work_day_out_info["mobile"];
										
									}else{
										// Process for show in table
										$out_file_name = "NA";
										$a_out_file = "";
										$staff_logout_time ='';
                              $attendance_time = $base_start_time;
                              $attendance_end_time = $shift_info["pday_endtime"]; 		
										$attendance_out_status = "<span class='label label-warning'>Did Not Clock Out.</span>";
										unset($out_mobile);
									}
 		              		}
 		              }

 		              //check if user is on leave today
				        $userAbsentOrNot = $this->site_settings->checkUserAbsentOrNot($sta[$j],$log_date);
				        if($userAbsentOrNot==1) //on leave
				        {
				      	 $attendance_status = "<span class='label label-primary'>On Leave</span>";
				      	 $attendance_out_status = "<span class='label label-primary'>On Leave</span>";
				        }
						}
						
						$selfie_in_icon	=	(isset($in_mobile))?(($in_mobile==0)?'<i class="fa fa-desktop"></i>':'<i class="fa fa-mobile"></i>'):'';
						$selfie_out_icon	=	(isset($out_mobile))?(($out_mobile==0)?'<i class="fa fa-desktop"></i>':'<i class="fa fa-mobile"></i>'):'';
						
						$attendance_user	.= "<tr>
                               <td class=\"botline\">$r_cnt</td>
                               <td class=\"botline\">$staffname</td>
                               <td class=\"botline\">$log_date</td>
                               <td class=\"botline\">$attendance_time</td>
                               <td class=\"botline\">$attendance_status</td>
										 <td class=\"botline\">$attendance_end_time</td>
										 <td class=\"botline\">$attendance_out_status</td>
                              </tr>";
		           $r_cnt++;   
                 $dispute_msg="";    
                 unset($in_mobile);                                    
                 unset($out_mobile);                                         
					}
					
				}
				if($r_cnt==1){
					$attendance_user	.= "<tr>
                                        <td class=\"botline\"></td>
                                        <td class=\"botline\"></td>
                                        <td class=\"botline\"></td>
                                        <td class=\"botline\">Sorry No Data Found</td>
													 <td class=\"botline\"></td>
													 <td class=\"botline\"></td>
													 <td class=\"botline\"></td>
                                       </tr>";
				}
				$attendance_user	.= "</tbody>
																</table>";

			return $attendance_user;	

	}	
	
	
	
	
	
	//Function to fetch shift attendance tabular data
	//Dominic; Dec 20,2016
	//Feb 11, 2017: Added leave checking and info
	function shiftAttendanceTabulaData($f_from_date,$f_to_date,$shifts)
	{
		$attendance_shift='';
		$staff 		 = $this->session->userdata('mid');
		$file_path 	 =  "../../selfies/aLog/";
		
		// Store date to process due to BETWEEN difficiency
		$q_date = array();
		$p_date =  $f_from_date;
		while ($p_date <= $f_to_date)
		{
			//echo "Array ".$p_date." ";
			array_push($q_date, $p_date);	
			$p_date = date("Y-m-d", strtotime($p_date . ' + 1 day'));
		}
		
		$staff_attendance_result	=	$this->Reports_model->getAllStaffWorkList_dept($shifts);
		$r_cnt 		 = 1;	
		for($dcnt=0; $dcnt < count($q_date); $dcnt++){
			$sta = array();
			foreach ($staff_attendance_result as $srow){
				array_push($sta, $srow["staff_id"]);
			}

			
			for ($j=0;$j<count($sta);$j++){
				// filter holder for future use
				$dispute_msg	=	"";  
				$in_invfilter = "non";
				if ($in_invfilter == "non"){
				  // Get Day - Monday, Tuesday etc.
              $log_date = $q_date[$dcnt];
              $timestamp = strtotime($log_date);
              $check_day = date("l", $timestamp);
              
              $p_check_workday_type = $this->Reports_model->getStaffShiftTypeviaDay($sta[$j], $check_day);
              $check_workday_type = $p_check_workday_type["shifttype"];
              $base_start_time = $p_check_workday_type["basestart"];
 		              $base_end_time = $p_check_workday_type["baseend"];
 		              $in_shift 	= $p_check_workday_type["shiftid"];
 		              //echo '<br>--------------------check_workday_type : '.$check_workday_type.'--------------------<br>';
 		              if ($check_workday_type == 0){
 		              		// 0 = Non working day
						//echo "In 0 <br>";
						$ab_log_date = $q_date[$dcnt];
						$log_date = $q_date[$dcnt];
		
						$staffname = $this->Reports_model->getStaffName($sta[$j]);
						$shift_info = $this->Reports_model->getShiftDetails_v2($in_shift, $check_day);
						
						$attendance_status = "<span class='label label-default'>Non Work Day</span>";
						$attendance_out_status = "<span class='label label-default'>Non Work Day</span>";
		            $log_time = "NA";
		            $attendance_time = 'NA';
		            $attendance_end_time = 'NA';
		            $staff_logout_time = "NA";
		                  

                  $a_in_file = "NA";
                  $a_out_file = "NA";
                  
                  unset($in_mobile);
                  unset($out_mobile);
                  
 		              }elseif ($check_workday_type == 1){
 		              		// 1 = Grave Yard Work Day - Need Add 1 Day
 		              		$p_log_date = $log_date;
 		              		$out_log_date = date('Y-m-d', strtotime($p_log_date . ' + 1 day'));
 		              		$staff_work_day_info = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "in");
 		              		$staffname = $this->Reports_model->getStaffName($sta[$j]);
 		              		
 		              		// Check in clock in.
 		              		if (count($staff_work_day_info)==0||$staff_work_day_info["log_time"] == ""){
 		              			
 		              			$attendance_status = "<span class='label label-danger'>Absent</span>"; //compute difference
 		              			// Process for show in table
                     //$staffname = $adminfunc->getStaffName($srow["staff_id"]);
                     $staffname = $this->Reports_model->getStaffName($sta[$j]);
                     $log_time = "NA";
                     $a_in_file = "NA";
                     $a_out_file = "NA";
                     
                     		$abs_checkintime_infoz = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "ab");
 		              			$abs_checkouttime_infoz = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "nc");
 		              			if (!empty($abs_checkintime_infoz["base_log_time"]))
 		              			{
 		              				$attendance_time = $abs_checkintime_infoz["base_log_time"];
 		              			}
 		              			else
 		              			{
 		              				$attendance_time = $base_start_time;
 		              			}
 		              			
 		              			if (!empty($abs_checkouttime_infoz["base_log_time"]))
 		              			{
 		              				$attendance_end_time = $abs_checkouttime_infoz["base_log_time"];
 		              			}
 		              			else
 		              			{
 		              				$attendance_end_time = $base_end_time;
 		              			}
 		              			
                     $staff_logout_time = "NA";
                     $attendance_out_status = "<span class='label label-danger'>Absent</span>";
                     unset($in_mobile);
                     unset($out_mobile);
 		              		}else{
 		              			// Get shift details
                     $p_shift_info = $this->Reports_model->getShiftDetails($in_shift, $check_day);
                     $shift_info   = $p_shift_info->row_array();
                     
                     // Compute Clock in
                     $d_attendance_in_time = strtotime($staff_work_day_info["base_log_time"]);
                     $d_staff_time_in = strtotime($staff_work_day_info["log_time"]);
                     $p_in_undertime = $d_staff_time_in - $d_attendance_in_time;
                     $in_undertime = gmdate('H:i:s', $p_in_undertime);
                     $in_file_name = $staff_work_day_info["attendance_file"];
                     $a_in_file = "<a href=\"$file_path$in_file_name\" target=\"_blank\">$staffname</a>";
                     if ($p_in_undertime > 0){
                     	$attendance_status = "<span class='label label-warning'>Late by : ".$in_undertime."</span>";
                     }else{
                     	$attendance_status = "<span class='label label-success'>On Time</span>";
                     }
                     $log_time = $staff_work_day_info["log_time"];
                     $attendance_time = $staff_work_day_info["base_log_time"];
                     $log_time = $staff_work_day_info["log_time"];
                     
                     $in_mobile=$staff_work_day_info["mobile"];
                     
                     // Compute Clock out
                     $staff_work_day_out_info = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $out_log_date, "out");
                     //echo '<br>--------------------Clock out 1--------------------<br>';
							//print_r($staff_work_day_out_info);
                     if (count($staff_work_day_out_info)>0&&$staff_work_day_out_info["log_time"] != ""){
                     	
                     	$d_attendance_out_time = strtotime($staff_work_day_out_info["base_log_time"]);
                     	$staff_logout_time = $staff_work_day_out_info["log_time"];
                     	$d_staff_time_out = strtotime($staff_work_day_out_info["log_time"]);
                     	$p_out_undertime = $d_attendance_out_time - $d_staff_time_out;
                     	$out_undertime = gmdate('H:i:s', $p_out_undertime);
                     	if ($p_out_undertime > 0){
                     		$attendance_out_status = "<span class='label label-primary'>Early check out by : ".$out_undertime."</span>";
                     	}else{
                     		$attendance_out_status = "<span class='label label-success'>Ok.</span>";
                     	}
                     	// Process for show in table
                     	$file_name = $staff_work_day_out_info["attendance_file"];
                     	$a_out_file = "<a href=\"$file_path$file_name \" target=\"_blank\">$staffname </a>";
                     	$attendance_end_time = $staff_work_day_out_info["base_log_time"];
                     	$out_mobile=$staff_work_day_out_info["mobile"];
                     }else{
                     	$a_out_file = "";
                     	$staff_logout_time ='';
                     	$attendance_end_time = $shift_info["pday_endtime"];
                     	$attendance_out_status = "<span class='label label-warning'>Did Not Clock Out.</span>";
                     	unset($out_mobile);
                     }
 		              		}
 		              }elseif ($check_workday_type == 2){
 		              		// 2 = Non Grave Yard Work Day
 		              		$staff_work_day_info = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "in");
 		              		
 		              		// Check in clock in.
 		              		if (count($staff_work_day_info)==0||$staff_work_day_info["log_time"] == ""){
 		              			$attendance_status = "<span class='label label-danger'>Absent</span>";
 		              			// Process for show in table
 		              			$staffname = $this->Reports_model->getStaffName($sta[$j]);
                   	$log_time = "NA";
                   	$a_in_file = "NA";
                   	$a_out_file = "NA";

                     		$abs_checkintime_infoz = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "ab");
 		              			$abs_checkouttime_infoz = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "nc");
 		              			if (!empty($abs_checkintime_infoz["base_log_time"]))
 		              			{
 		              				$attendance_time = $abs_checkintime_infoz["base_log_time"];
 		              			}
 		              			else
 		              			{
 		              				$attendance_time = $base_start_time;
 		              			}
 		              			
 		              			if (!empty($abs_checkouttime_infoz["base_log_time"]))
 		              			{
 		              				$attendance_end_time = $abs_checkouttime_infoz["base_log_time"];
 		              			}
 		              			else
 		              			{
 		              				$attendance_end_time = $base_end_time;
 		              			}

							$staff_logout_time = "NA";
							$attendance_out_status = "<span class='label label-danger'>Absent</span>";
							unset($in_mobile);
							unset($out_mobile);
 		              		}else{
 		              			// Get shift details
 		              			$p_shift_info = $this->Reports_model->getShiftDetails($in_shift, $check_day);
 		              			$shift_info   = $p_shift_info->row_array();
 		              			$staffname = $this->Reports_model->getStaffName($sta[$j]);
 		              			
 		              			// ---------- Compute Clock in ------------
 		              			$d_attendance_in_time = strtotime($staff_work_day_info["base_log_time"]);
 		              			$d_staff_time_in = strtotime($staff_work_day_info["log_time"]);
                     $p_in_undertime = $d_staff_time_in - $d_attendance_in_time;
                     $in_undertime = gmdate('H:i:s', $p_in_undertime);
                     $in_file_name = $staff_work_day_info["attendance_file"];
                     $a_in_file = "<a href=\"$file_path$in_file_name\" target=\"_blank\">$staffname</a>";
                     if ($p_in_undertime > 0){
                     	$attendance_status = "<span class='label label-warning'>Late by : ".$in_undertime."</span>";
                     }else{
                     	$attendance_status = "<span class='label label-success'>On Time</span>";
                     }
                     // Process for show in table
                     $staffname = $this->Reports_model->getStaffName($sta[$j]);
                     $log_time = $staff_work_day_info["log_time"];
                     $attendance_time = $shift_info["pday_starttime"]; // Compute
                     $attendance_time = $staff_work_day_info["base_log_time"];
                     
                     $in_mobile=$staff_work_day_info["mobile"];
                     
                     // --------- Compute Clock out ---------------
							$staff_work_day_out_info = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "out");
							//echo '<br>--------------------Clock out 2--------------------<br>';
							//print_r($staff_work_day_out_info);
							if (count($staff_work_day_out_info)>0&&$staff_work_day_out_info["log_time"] != ""){
								$d_attendance_out_time = strtotime($staff_work_day_out_info["base_log_time"]);
								$staff_logout_time = $staff_work_day_out_info["log_time"];
								$d_staff_time_out = strtotime($staff_work_day_out_info["log_time"]);
								$p_out_undertime = $d_attendance_out_time - $d_staff_time_out;
								$out_undertime = gmdate('H:i:s', $p_out_undertime);
								if ($p_out_undertime > 0){
									$attendance_out_status = "<span class='label label-primary'>Early check out by : ".$out_undertime."</span>";
								}else{
									$attendance_out_status = "<span class='label label-success'>Ok</span>";
								}
								// Process for show in table
								$out_file_name = $staff_work_day_out_info["attendance_file"];
								$a_out_file = "<a href=\"$file_path$out_file_name \" target=\"_blank\">$staffname </a>";
								$attendance_time = $staff_work_day_info["base_log_time"];
								$attendance_end_time = $staff_work_day_out_info["base_log_time"]; 
								$out_mobile=$staff_work_day_out_info["mobile"];
								
							}else{
								// Process for show in table
								$out_file_name = "NA";
								$a_out_file = "";
								$staff_logout_time ='';
                        $attendance_time = $base_start_time;
                        $attendance_end_time = $shift_info["pday_endtime"]; 		
								$attendance_out_status = "<span class='label label-warning'>Did Not Clock Out.</span>";
								unset($out_mobile);
							}
 		              		}
 		              }
 		              
 		            //check if user is on leave today
				      $userAbsentOrNot = $this->site_settings->checkUserAbsentOrNot($sta[$j],$log_date);
				      if($userAbsentOrNot==1) //on leave
				      {
				      	$attendance_status = "<span class='label label-primary'>On Leave</span>";
				      	$attendance_out_status = "<span class='label label-primary'>On Leave</span>";

				      }
				}
				
				$selfie_in_icon	=	(isset($in_mobile))?(($in_mobile==0)?'<i class="fa fa-desktop"></i>':'<i class="fa fa-mobile"></i>'):'';
				$selfie_out_icon	=	(isset($out_mobile))?(($out_mobile==0)?'<i class="fa fa-desktop"></i>':'<i class="fa fa-mobile"></i>'):'';
				
				$attendance_shift	.= "<tr>
                                        <td class=\"botline\">$r_cnt</td>
                                        <td class=\"botline\">$staffname</td>
                                        <td class=\"botline\">$log_date</td>
                                        <td class=\"botline\">$attendance_time</td>
                                        <td class=\"botline\">$log_time</td>
                                        <td class=\"botline\">$attendance_status</td>
                                        <td class=\"botline\">$selfie_in_icon</td>
													 <td class=\"botline\">$attendance_end_time</td>
													 <td class=\"botline\">$staff_logout_time</td>
													 <td class=\"botline\">$attendance_out_status</td>
													 <td class=\"botline\">$selfie_out_icon</td>
                                        <td class=\"botline\">$a_in_file</td>
                                        <td class=\"botline\">$a_out_file</td>
													 <td class=\"botline\">$dispute_msg</td>
                                       </tr>";
           $r_cnt++;   
           $dispute_msg="";     
           unset($in_mobile);                                    
           unset($out_mobile);                                    
			}
			
		}
		if($r_cnt==1){
			$attendance_shift	.= "<tr>
                                  <td class=\"botline\"></td>
                                  <td class=\"botline\"></td>
                                  <td class=\"botline\"></td>
                                  <td class=\"botline\"></td>
                                  <td class=\"botline\"></td>
                                  <td class=\"botline\"></td>
                                  <td class=\"botline\">Sorry No Data Found</td>
											 <td class=\"botline\"></td>
											 <td class=\"botline\"></td>
											 <td class=\"botline\"></td>
                                  <td class=\"botline\"></td>
                                  <td class=\"botline\"></td>
                                  <td class=\"botline\"></td>
											 <td class=\"botline\"></td>
                                 </tr>";
		}
		$attendance_shift	.= "</tbody>
											</table>";
		return $attendance_shift;
	}
	
	
	//Function to fetch basic shift attendance tabular data
	//Dominic; Jan 14,2017
	//Feb 11, 2017: Added leave checking and info
	//Dominic March 04, 2017: Fixed clock in/out status issues
	function basicShiftAttendanceTabulaData($f_from_date,$f_to_date,$shifts)
	{
		$attendance_shift='';
		$staff 		 = $this->session->userdata('mid');
		$file_path 	 =  "../../selfies/aLog/";
		
		// Store date to process due to BETWEEN difficiency
		$q_date = array();
		$p_date =  $f_from_date;
		while ($p_date <= $f_to_date)
		{
			//echo "Array ".$p_date." ";
			array_push($q_date, $p_date);	
			$p_date = date("Y-m-d", strtotime($p_date . ' + 1 day'));
		}
		
		$staff_attendance_result	=	$this->Reports_model->getAllStaffWorkList_dept($shifts);
		$r_cnt 		 = 1;	
		for($dcnt=0; $dcnt < count($q_date); $dcnt++){
			$sta = array();
			foreach ($staff_attendance_result as $srow){
				array_push($sta, $srow["staff_id"]);
			}

			
			for ($j=0;$j<count($sta);$j++){
				// filter holder for future use
				$dispute_msg	=	"";  
				$in_invfilter = "non";
				if ($in_invfilter == "non"){
				  // Get Day - Monday, Tuesday etc.
              $log_date = $q_date[$dcnt];
              $timestamp = strtotime($log_date);
              $check_day = date("l", $timestamp);
              
              $p_check_workday_type = $this->Reports_model->getStaffShiftTypeviaDay($sta[$j], $check_day);
              $check_workday_type = $p_check_workday_type["shifttype"];
              $base_start_time = $p_check_workday_type["basestart"];
 		              $base_end_time = $p_check_workday_type["baseend"];
 		              $in_shift 	= $p_check_workday_type["shiftid"];
 		              //echo '<br>--------------------check_workday_type : '.$check_workday_type.'--------------------<br>';
 		              if ($check_workday_type == 0){
 		              		// 0 = Non working day
						//echo "In 0 <br>";
						$ab_log_date = $q_date[$dcnt];
						$log_date = $q_date[$dcnt];
		
						$staffname = $this->Reports_model->getStaffName($sta[$j]);
						$shift_info = $this->Reports_model->getShiftDetails_v2($in_shift, $check_day);
						
						$attendance_status = "<span class='label label-default'>Non Work Day</span>";
						$attendance_out_status = "<span class='label label-default'>Non Work Day</span>";
		            $log_time = "NA";
		            $attendance_time = 'NA';
		            $attendance_end_time = 'NA';
		            $staff_logout_time = "NA";
		                  

                  $a_in_file = "NA";
                  $a_out_file = "NA";
                  
                  unset($in_mobile);
                  unset($out_mobile);
                  
 		              }elseif ($check_workday_type == 1){
 		              		// 1 = Grave Yard Work Day - Need Add 1 Day
 		              		$p_log_date = $log_date;
 		              		$out_log_date = date('Y-m-d', strtotime($p_log_date . ' + 1 day'));
 		              		$staff_work_day_info = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "in");
 		              		$staffname = $this->Reports_model->getStaffName($sta[$j]);
 		              		
 		              		// Check in clock in.
 		              		if (count($staff_work_day_info)==0||$staff_work_day_info["log_time"] == ""){
 		              			
 		              			$attendance_status = "<span class='label label-danger'>Absent</span>"; //compute difference
 		              			// Process for show in table
                     //$staffname = $adminfunc->getStaffName($srow["staff_id"]);
                     $staffname = $this->Reports_model->getStaffName($sta[$j]);
                     $log_time = "NA";
                     $a_in_file = "NA";
                     $a_out_file = "NA";
                     
                     		$abs_checkintime_infoz = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "ab");
 		              			$abs_checkouttime_infoz = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "nc");
 		              			if (!empty($abs_checkintime_infoz["base_log_time"]))
 		              			{
 		              				$attendance_time = $abs_checkintime_infoz["base_log_time"];
 		              			}
 		              			else
 		              			{
 		              				$attendance_time = $base_start_time;
 		              			}
 		              			
 		              			if (!empty($abs_checkouttime_infoz["base_log_time"]))
 		              			{
 		              				$attendance_end_time = $abs_checkouttime_infoz["base_log_time"];
 		              			}
 		              			else
 		              			{
 		              				$attendance_end_time = $base_end_time;
 		              			}
 		              			
                     $staff_logout_time = "NA";
                     $attendance_out_status = "<span class='label label-danger'>Absent</span>";
                     unset($in_mobile);
                     unset($out_mobile);
 		              		}else{
 		              			// Get shift details
                     $p_shift_info = $this->Reports_model->getShiftDetails($in_shift, $check_day);
                     $shift_info   = $p_shift_info->row_array();
                     
                     // Compute Clock in
                     $d_attendance_in_time = strtotime($staff_work_day_info["base_log_time"]);
                     $d_staff_time_in = strtotime($staff_work_day_info["log_time"]);
                     $p_in_undertime = $d_staff_time_in - $d_attendance_in_time;
                     $in_undertime = gmdate('H:i:s', $p_in_undertime);
                     $in_file_name = $staff_work_day_info["attendance_file"];
                     $a_in_file = "<a href=\"$file_path$in_file_name\" target=\"_blank\">$staffname</a>";
                     if ($p_in_undertime > 0){
                     	$attendance_status = "<span class='label label-warning'>Late by : ".$in_undertime."</span>";
                     }else{
                     	$attendance_status = "<span class='label label-success'>On Time</span>";
                     }
                     $log_time = $staff_work_day_info["log_time"];
                     $attendance_time = $staff_work_day_info["base_log_time"];
                     $log_time = $staff_work_day_info["log_time"];
                     
                     $in_mobile=$staff_work_day_info["mobile"];
                     
                     // Compute Clock out
                     $staff_work_day_out_info = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $out_log_date, "out");
                     //echo '<br>--------------------Clock out 1--------------------<br>';
							//print_r($staff_work_day_out_info);
                     if (count($staff_work_day_out_info)>0&&$staff_work_day_out_info["log_time"] != ""){
                     	
                     	$d_attendance_out_time = strtotime($staff_work_day_out_info["base_log_time"]);
                     	$staff_logout_time = $staff_work_day_out_info["log_time"];
                     	$d_staff_time_out = strtotime($staff_work_day_out_info["log_time"]);
                     	$p_out_undertime = $d_attendance_out_time - $d_staff_time_out;
                     	$out_undertime = gmdate('H:i:s', $p_out_undertime);
                     	if ($p_out_undertime > 0){
                     		$attendance_out_status = "<span class='label label-primary'>Early check out by : ".$out_undertime."</span>";
                     	}else{
                     		$attendance_out_status = "<span class='label label-success'>Ok.</span>";
                     	}
                     	// Process for show in table
                     	$file_name = $staff_work_day_out_info["attendance_file"];
                     	$a_out_file = "<a href=\"$file_path$file_name \" target=\"_blank\">$staffname </a>";
                     	$attendance_end_time = $staff_work_day_out_info["base_log_time"];
                     	$out_mobile=$staff_work_day_out_info["mobile"];
                     }else{
                     	$a_out_file = "";
                     	$staff_logout_time ='';
                     	$attendance_end_time = $shift_info["pday_endtime"];
                     	$attendance_out_status = "<span class='label label-warning'>Did Not Clock Out.</span>";
                     	unset($out_mobile);
                     }
 		              		}
 		              }elseif ($check_workday_type == 2){
 		              		// 2 = Non Grave Yard Work Day
 		              		$staff_work_day_info = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "in");
 		              		
 		              		// Check in clock in.
 		              		if (count($staff_work_day_info)==0||$staff_work_day_info["log_time"] == ""){
 		              			$attendance_status = "<span class='label label-danger'>Absent</span>";
 		              			// Process for show in table
 		              			$staffname = $this->Reports_model->getStaffName($sta[$j]);
                   	$log_time = "NA";
                   	$a_in_file = "NA";
                   	$a_out_file = "NA";

                     		$abs_checkintime_infoz = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "ab");
 		              			$abs_checkouttime_infoz = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "nc");
 		              			if (!empty($abs_checkintime_infoz["base_log_time"]))
 		              			{
 		              				$attendance_time = $abs_checkintime_infoz["base_log_time"];
 		              			}
 		              			else
 		              			{
 		              				$attendance_time = $base_start_time;
 		              			}
 		              			
 		              			if (!empty($abs_checkouttime_infoz["base_log_time"]))
 		              			{
 		              				$attendance_end_time = $abs_checkouttime_infoz["base_log_time"];
 		              			}
 		              			else
 		              			{
 		              				$attendance_end_time = $base_end_time;
 		              			}

							$staff_logout_time = "NA";
							$attendance_out_status = "<span class='label label-danger'>Absent</span>";
							unset($in_mobile);
							unset($out_mobile);
 		              		}else{
 		              			// Get shift details
 		              			$p_shift_info = $this->Reports_model->getShiftDetails($in_shift, $check_day);
 		              			$shift_info   = $p_shift_info->row_array();
 		              			$staffname = $this->Reports_model->getStaffName($sta[$j]);
 		              			
 		              			// ---------- Compute Clock in ------------
 		              			$d_attendance_in_time = strtotime($staff_work_day_info["base_log_time"]);
 		              			$d_staff_time_in = strtotime($staff_work_day_info["log_time"]);
                     $p_in_undertime = $d_staff_time_in - $d_attendance_in_time;
                     $in_undertime = gmdate('H:i:s', $p_in_undertime);
                     $in_file_name = $staff_work_day_info["attendance_file"];
                     $a_in_file = "<a href=\"$file_path$in_file_name\" target=\"_blank\">$staffname</a>";
                     if ($p_in_undertime > 0){
                     	$attendance_status = "<span class='label label-warning'>Late by : ".$in_undertime."</span>";
                     }else{
                     	$attendance_status = "<span class='label label-success'>On Time</span>";
                     }
                     // Process for show in table
                     $staffname = $this->Reports_model->getStaffName($sta[$j]);
                     $log_time = $staff_work_day_info["log_time"];
                     $attendance_time = $shift_info["pday_starttime"]; // Compute
                     $attendance_time = $staff_work_day_info["base_log_time"];
                     
                     $in_mobile=$staff_work_day_info["mobile"];
                     
                     // --------- Compute Clock out ---------------
							$staff_work_day_out_info = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "out");
							//echo '<br>--------------------Clock out 2--------------------<br>';
							//print_r($staff_work_day_out_info);
							if (count($staff_work_day_out_info)>0&&$staff_work_day_out_info["log_time"] != ""){
								$d_attendance_out_time = strtotime($staff_work_day_out_info["base_log_time"]);
								$staff_logout_time = $staff_work_day_out_info["log_time"];
								$d_staff_time_out = strtotime($staff_work_day_out_info["log_time"]);
								$p_out_undertime = $d_attendance_out_time - $d_staff_time_out;
								$out_undertime = gmdate('H:i:s', $p_out_undertime);
								if ($p_out_undertime > 0){
									$attendance_out_status = "<span class='label label-primary'>Early check out by : ".$out_undertime."</span>";
								}else{
									$attendance_out_status = "<span class='label label-success'>Ok</span>";
								}
								// Process for show in table
								$out_file_name = $staff_work_day_out_info["attendance_file"];
								$a_out_file = "<a href=\"$file_path$out_file_name \" target=\"_blank\">$staffname </a>";
								$attendance_time = $staff_work_day_info["base_log_time"];
								$attendance_end_time = $staff_work_day_out_info["base_log_time"]; 
								$out_mobile=$staff_work_day_out_info["mobile"];
								
							}else{
								// Process for show in table
								$out_file_name = "NA";
								$a_out_file = "";
								$staff_logout_time ='';
                        $attendance_time = $base_start_time;
                        $attendance_end_time = $shift_info["pday_endtime"]; 		
								$attendance_out_status = "<span class='label label-warning'>Did Not Clock Out.</span>";
								unset($out_mobile);
							}
 		              		}
 		              }
 		              
 		            //check if user is on leave today
				      $userAbsentOrNot = $this->site_settings->checkUserAbsentOrNot($sta[$j],$log_date);
				      if($userAbsentOrNot==1) //on leave
				      {
				      	$attendance_status = "<span class='label label-primary'>On Leave</span>";
				      	$attendance_out_status = "<span class='label label-primary'>On Leave</span>";

				      }
				}
				
				$selfie_in_icon	=	(isset($in_mobile))?(($in_mobile==0)?'<i class="fa fa-desktop"></i>':'<i class="fa fa-mobile"></i>'):'';
				$selfie_out_icon	=	(isset($out_mobile))?(($out_mobile==0)?'<i class="fa fa-desktop"></i>':'<i class="fa fa-mobile"></i>'):'';
				
				$attendance_shift	.= "<tr>
                            <td class=\"botline\">$r_cnt</td>
                            <td class=\"botline\">$staffname</td>
                            <td class=\"botline\">$log_date</td>
                            <td class=\"botline\">$attendance_time</td>
                            <td class=\"botline\">$attendance_status</td>
									 <td class=\"botline\">$attendance_end_time</td>
									 <td class=\"botline\">$attendance_out_status</td>
                           </tr>";
           $r_cnt++;   
           $dispute_msg="";     
           unset($in_mobile);                                    
           unset($out_mobile);                                    
			}
			
		}
		
		if($r_cnt==1)
		{
			$attendance_shift	.= "<tr>
                                  <td class=\"botline\"></td>
                                  <td class=\"botline\"></td>
                                  <td class=\"botline\"></td>
                                  <td class=\"botline\">Sorry No Data Found</td>
											 <td class=\"botline\"></td>
											 <td class=\"botline\"></td>
											 <td class=\"botline\"></td>
                                 </tr>";
		}
		$attendance_shift	.= "</tbody>
											</table>";
		return $attendance_shift;

	}
	
	//Function to download_user_attendance
   //@Author Farveen
   function downloadAttendance()
   {
   	$reportDownload		= $this->authentication->reportType(); 
		if($reportDownload==DETAILED_REPORT)
		{
			$this->download_user_attendance();
		}
		else 
		{
			$this->basic_download_user_attendance();
		}
   }
   
   //Function to download_user_attendance
   //@Author Farveen	
   //Modified by Dominic, March 11,2017: Added sort by feature
   function download_user_attendance(){
   	$users		 = $this->input->post('umultiSelect');
   	$sortBy		 = $this->input->post('sortBy');
		$in_fromdate = $this->input->post('udate_from');
		$in_todate 	 = $this->input->post('udate_to');
		$in_users 	 = $users;
		$file_path 	 =  "../../selfies/aLog/";
		$r_cnt		 = 1;	
		$csv_filename = time().".csv";
		
		$attendance_report_path = $this->lang->line("absolute_path")."attendance_report/";
		$attendance_report_url = base_url()."images/attendance_report/";
		$attendance_end_time='';
		$filename = $attendance_report_path.$csv_filename;
		$fp = fopen($filename,"w");
		
		$f_from_date = $this->formatStorageDate($in_fromdate);
		$f_to_date 	 = $this->formatStorageDate($in_todate);
		
		$q_date = array();
		$p_date =  $f_from_date;
		
		while ($p_date <= $f_to_date){
			//echo "Array ".$p_date." ";
			array_push($q_date, $p_date);	
			$p_date = date("Y-m-d", strtotime($p_date . ' + 1 day'));
		}
		$list = "";
		$list .= "No,Name,Day,Date,Schedule Time in,Actual Clock in Time,Clock in Status,D/M,Clock in Explaination Notes,Schedule Clock Out Time,Actual Clock Out Time,Clock Out Status,D/M,Clock Out Explaination Notes, Total Break, Total Break Hours,Total Working Hours, Working Hours Less Break"."\r\n";
		$staff_attendance_result = $this->Reports_model->getAllStaffWorkList_users($users);
		for($dcnt=0; $dcnt < count($q_date); $dcnt++){
			$sta = array();
			foreach ($staff_attendance_result as $srow){
				array_push($sta, $srow["staff_id"]);
			}
			for ($j=0;$j<count($sta);$j++){
				// filter holder for future use
				$in_invfilter = "non";
				$p_staff_id = $sta[$j];
				if ($in_invfilter == "non"){
					// Get Day - Monday, Tuesday etc.
					$log_date = $q_date[$dcnt];
					$timestamp = strtotime($log_date);
					$check_day = date("l", $timestamp);
					$p_check_workday_type = $this->Reports_model->getStaffShiftTypeviaDay($sta[$j], $check_day);
					$check_workday_type = $p_check_workday_type["shifttype"];
		         $base_start_time = $p_check_workday_type["basestart"];
               $base_end_time = $p_check_workday_type["baseend"];
               $in_shift 	= $p_check_workday_type["shiftid"];
               
               if ($check_workday_type == 0){
               	$ab_log_date = $q_date[$dcnt];
						$log_date = $q_date[$dcnt];
				
						$staffname = $this->Reports_model->getStaffName($sta[$j]);
						$shift_info = $this->Reports_model->getShiftDetails($in_shift, $check_day);
						$attendance_status = "Non Work Day";
                  $log_time = "NA";
                  $a_in_file = "NA";
                  $a_out_file = "NA";
                  $attendance_time = "NA";
                  $attendance_end_time = "NA";
                  $staff_logout_time = "NA";
                  $attendance_out_status = "Non Work Day";
						$in_explaination_notes = $staff_work_day_info["notes"];
						unset($in_mobile);
                  unset($out_mobile);
						
               }elseif ($check_workday_type == 1){
               	
               	$p_log_date = $log_date;
               	$out_log_date = date('Y-m-d', strtotime($p_log_date . ' + 1 day'));
               	$staff_work_day_info = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "in");
						$staffname = $this->Reports_model->getStaffName($sta[$j]);
						
						// Check in clock in.
                  if (count($staff_work_day_info)==0||$staff_work_day_info["log_time"] == ""){
                  	 $attendance_status = "Absent"; //compute difference
                  	 // Process for show in table
                  	 
                  	 $staffname = $this->Reports_model->getStaffName($sta[$j]);
                  	 $log_time = "NA";
                      $a_in_file = "NA";
                      $a_out_file = "NA";
                      $attendance_time = $base_start_time;
                      $attendance_end_time = $base_end_time;
                      $attendance_out_status = "Absent";
                      $staff_logout_time = "NA";
                      $in_explaination_notes = '';
                      unset($in_mobile);
                  	 unset($out_mobile);
                  }else{
                  	 // Get shift details
                  	 $p_shift_info = $this->Reports_model->getShiftDetails($in_shift, $check_day);
                  	 $shift_info = mysqli_fetch_assoc($p_shift_info);
                  	 
                  	 // Compute Clock in
                  	 $d_attendance_in_time = strtotime($staff_work_day_info["base_log_time"]);
                  	 $d_staff_time_in = strtotime($staff_work_day_info["log_time"]);
                  	 $p_in_undertime = $d_staff_time_in - $d_attendance_in_time;
                  	 $in_undertime = gmdate('H:i:s', $p_in_undertime);
                  	 $in_file_name = $staff_work_day_info["attendance_file"];
                  	 $a_in_file = "<a href=\"$file_path$in_file_name\" target=\"_blank\">$staffname</a>";
                  	 $in_explaination_notes = $staff_work_day_info["notes"];
                  	 if ($p_in_undertime > 0){
                  	 	$attendance_status = "Late by : ".$in_undertime;
                  	 }else{
                  	  $attendance_status = "On Time";
                  	 }
                  	 $log_time = $staff_work_day_info["log_time"];
                  	 $attendance_time = $staff_work_day_info["base_log_time"];
                  	 $in_mobile = $staff_work_day_info["mobile"];
                  	 
                  	 // Compute Clock out
                  	 $staff_work_day_out_info = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $out_log_date, "out");
                  	 if (count($staff_work_day_out_info)>0&&$staff_work_day_out_info["log_time"] != ""){
                  	 	$d_attendance_out_time = strtotime($staff_work_day_out_info["base_log_time"]);
                  	 	$staff_logout_time = $staff_work_day_out_info["log_time"];
                  	 	$d_staff_time_out = strtotime($staff_work_day_out_info["log_time"]);
                  	 	$p_out_undertime = $d_attendance_out_time - $d_staff_time_out;
                  	 	$out_undertime = gmdate('H:i:s', $p_out_undertime);
                  	 	$out_explaination_notes = $staff_work_day_info["notes"];
                  	 	if ($p_out_undertime > 0){
                  	 		$attendance_out_status = "Early clock out by : ".$out_undertime;
                  	 	}else{
									$attendance_out_status = "Ok.";
								}
								// Process for show in table
								$file_name = $staff_work_day_out_info["attendance_file"];
								$a_out_file = "<a href=\"$file_path$file_name \" target=\"_blank\">$staffname </a>";
								$attendance_end_time = $staff_work_day_out_info["base_log_time"];
								$out_explaination_notes = $staff_work_day_info["notes"];
								$out_mobile = $staff_work_day_info["mobile"];
                  	 }else{
                  	 	$a_out_file = "";
                  	 	$staff_logout_time = "";
                  	 	$attendance_end_time = $shift_info["pday_endtime"];
                  	 	$attendance_out_status = "Did Not Clock Out.";
                  	 	$out_explaination_notes = $staff_work_day_info["notes"];
                  	 	unset($out_mobile);
                  	 }
                  }
                                                                
               }elseif($check_workday_type == 2){
               	$staff_work_day_info = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "in");
               	if (count($staff_work_day_info)==0||$staff_work_day_info["log_time"] == ""){
               			$attendance_status = "Absent";
               			// Process for show in table              			
               			
               			$staffname = $this->Reports_model->getStaffName($sta[$j]);
               			$log_time = "NA";
                      	$a_in_file = "NA";
                      	$a_out_file = "NA";
                      	$attendance_time = $base_start_time; 
                      	$attendance_end_time = $base_end_time;
                      	$staff_logout_time = "NA";
								$attendance_out_status = "Absent";
								$in_explaination_notes = '';
								unset($in_mobile);
                  	 	unset($out_mobile);
               	}else{
               		$p_shift_info = $this->Reports_model->getShiftDetails($in_shift, $check_day);
               		$shift_info   = $p_shift_info->row_array();
               		$staffname = $this->Reports_model->getStaffName($sta[$j]);
               		$in_explaination_notes = $staff_work_day_info["notes"];
               		// ---------- Compute Clock in ------------
               		$d_attendance_in_time = strtotime($staff_work_day_info["base_log_time"]);
               		$d_staff_time_in = strtotime($staff_work_day_info["log_time"]);
               		$p_in_undertime = $d_staff_time_in - $d_attendance_in_time;
               		$in_undertime = gmdate('H:i:s', $p_in_undertime);
               		$in_file_name = $staff_work_day_info["attendance_file"];
               		$a_in_file = "<a href=\"$file_path$in_file_name\" target=\"_blank\">$staffname</a>";
               		if ($p_in_undertime > 0){
               			$attendance_status = "Late by : ".$in_undertime;
               		}else{
               			$attendance_status = "On Time";
               		}
               		// Process for show in table
               		$staffname = $this->Reports_model->getStaffName($sta[$j]);
               		$log_time = $staff_work_day_info["log_time"];
               		$attendance_time = $shift_info["pday_starttime"]; // Compute
               		$attendance_time = $staff_work_day_info["base_log_time"];
               		$in_mobile = $staff_work_day_info["mobile"];
               		// --------- Compute Clock out ---------------
               		$staff_work_day_out_info = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "out");
               		if (count($staff_work_day_out_info)>0&&$staff_work_day_out_info["log_time"] != ""){
               			$d_attendance_out_time = strtotime($staff_work_day_out_info["base_log_time"]);
               			$staff_logout_time = $staff_work_day_out_info["log_time"];
               			$d_staff_time_out = strtotime($staff_work_day_out_info["log_time"]);
               			$p_out_undertime = $d_attendance_out_time - $d_staff_time_out;
               			$out_undertime = gmdate('H:i:s', $p_out_undertime);
               			if ($p_out_undertime > 0){
               				$attendance_out_status = "Early Clock out by : ".$out_undertime;
               			}else{
               				$attendance_out_status = "Ok";
               			}
               			// Process for show in table
               			$out_file_name = $staff_work_day_out_info["attendance_file"];
               			$a_out_file = "<a href=\"$file_path$out_file_name \" target=\"_blank\">$staffname </a>";
               			$attendance_time = $staff_work_day_info["base_log_time"];
               			$attendance_end_time = $staff_work_day_out_info["base_log_time"]; 
               			$out_explaination_notes = $staff_work_day_info["notes"];
               			$out_mobile = $staff_work_day_info["mobile"];
               		}else{
               			// Process for show in table
               			 $out_file_name = "NA";
               			$staff_logout_time = "";
               			$attendance_time = $base_start_time;
               			$attendance_end_time = $shift_info["pday_endtime"]; 	
               			$attendance_out_status = "Did Not Clock Out.";
               			$out_explaination_notes = $staff_work_day_info["notes"];
               			unset($out_mobile);
               		}
               	}
               }	
				}
				//check if user is on leave today
		      $userAbsentOrNot = $this->site_settings->checkUserAbsentOrNot($sta[$j],$log_date);
		      if($userAbsentOrNot==1) //on leave
		      {
		      	$attendance_status = "On Leave";
		      	$attendance_out_status = "On Leave";
		      }
				
				// Get Explaination Notes
				$in_explaination_notes=$this->Reports_model->getUserExplainationNotes($p_staff_id, $log_date, "in");
				$out_explaination_notes=$this->Reports_model->getUserExplainationNotes($p_staff_id, $log_date, "Out");
				
				$in_explaination_notes_datetime=$this->Reports_model->getUserExplainationNotesLogTime($p_staff_id, $log_date, "in");
            $out_explaination_notes_datetime=$this->Reports_model->getUserExplainationNotesLogTime($p_staff_id, $log_date, "Out");
            
            // Get Number of Breaks						
				$num_break = $this->Reports_model->getUserNumberofBreak($p_staff_id, $log_date);
				
				// Get and compute Break timing
				$break_out_list = $this->Reports_model->getUserBreakOutTiming($p_staff_id, $log_date);
				$break_in_list = $this->Reports_model->getUserBreakInTiming($p_staff_id, $log_date);
				
				//$break_list_result = array();
				$accumulated_break_time = 0;
				for ($b=0;$b<count($break_out_list);$b++){
					$hourdiff = round((strtotime($break_in_list[$b]) - strtotime($break_out_list[$b]))/3600, 1);
					$accumulated_break_time = $accumulated_break_time+$hourdiff;
				}
				
				// Work Hours							
				$f_clock_in_time = $this->Reports_model->getUserClockInTiming($p_staff_id, $log_date);
				$f_clock_out_time = $this->Reports_model->getUserClockOutTiming($p_staff_id, $log_date);
				
				$workhourdiff = round((strtotime($f_clock_out_time) - strtotime($f_clock_in_time))/3600, 1);
				
				// Work Hours Less Breaks
				$fwork_hours = $workhourdiff - $accumulated_break_time;
				if (($f_clock_in_time == "00:00:00" || $f_clock_in_time == "" ) || ($f_clock_out_time == "00:00:00" || $f_clock_out_time == ""))
				{
					$workhourdiff = "Cannot Calculate Work Hours";
					$fwork_hours = "Cannot Calculate Work Hours";
				}
				
				if ($accumulated_break_time < 0 )
				{
					$accumulated_break_time = "Cannot Calculate Break Hours";
				}
				
				$selfie_in_icon	=	(isset($in_mobile))?(($in_mobile==0)?'D':'M'):'';
				$selfie_out_icon	=	(isset($out_mobile))?(($out_mobile==0)?'D':'M'):'';
				
				$list .= $r_cnt.",".$staffname.",".$check_day.",".$log_date.",".$attendance_time.",".$log_time.",".$attendance_status.",".$selfie_in_icon.",".$in_explaination_notes.",".
			   $attendance_end_time.",".$staff_logout_time.",".$attendance_out_status.",".$selfie_out_icon.",".$out_explaination_notes.",".$num_break.",".$accumulated_break_time.",".
			   $workhourdiff.",".$fwork_hours."\r\n";
			   
			   $r_cnt++;
			   
			   unset($in_mobile);
				unset($out_mobile);
			   
			   $log_time = $staff_logout_time = $f_clock_in_time = $f_clock_out_time = $workhourdiff = $fwork_hours = "";
				
			}
			
			$list .= "\r\n";	
			$log_time = $staff_logout_time = $f_clock_in_time = $f_clock_out_time = $workhourdiff = $fwork_hours = "";
			
		}
		
		fputs($fp,$list);
		fclose($fp);
		
		if($sortBy==2)
		{
			$lines = array();
			$lines = file($attendance_report_url.$csv_filename, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
	
	      //print_r($lines);
	      foreach ($lines as $newline)
			{
			    $csv2array[] = explode(',', $newline);
			}
	      
			$heading = array("No","Name","Day","Date","Schedule Time in","Actual Clock in Time","Clock in Status,D/M",
									"Clock in Explaination Notes","Schedule Clock Out Time","Actual Clock Out Time","Clock Out Status","D/M","Clock Out Explaination Notes",
									"Total Break","Total Break Hours","Total Working Hours","Working Hours Less Break");
			$userInfoArray = $this->removeElementWithValue($csv2array, 1, "Name");
			
			foreach ($userInfoArray as $key => $row) 
			{
			    $newArray[$key]  = $row[1];
			}
			array_multisort($newArray, SORT_ASC, $userInfoArray);
			array_unshift($userInfoArray , $heading);
			
			foreach($userInfoArray as $k1 => $inner) 
			{
			    unset($userInfoArray[$k1][0]);
			}
			
			$csv_data = $this->array_2_csv($userInfoArray);
			
			$f = fopen($filename, "r+");
			if ($f !== false) 
			{
			    ftruncate($f, 0);
			    fputs($f,$csv_data);
			    fclose($f);
			}			
		}
		
		$url = $attendance_report_url.$csv_filename;
		echo $url;
		
   }
   

  
//Function to remove a row having an element from a multi-dimensional array
//Dominic, March 11,2017   
function removeElementWithValue($array, $key, $value)
{
  foreach($array as $subKey => $subArray)
  {
       if($subArray[$key] == $value)
       {
            unset($array[$subKey]);
       }
  }
  return $array;
}   

//Function to convert an array into csv data
//Dominic, March 11,2017 
function array_2_csv($array) 
{
     $csv = '';
     foreach ($array as $item) 
     {
         if (is_array($item)) 
         {
             $csv .= implode(',',$item);
             $csv .="\r\n";
         }else{
           $csv .= $item;
           $csv .="\r\n";
         } 

     }
     return $csv;
}

	//Function to download basic attendance report
	//Dominic; Jan 14,2016
	function basic_download_user_attendance(){
   	$users		 = $this->input->post('umultiSelect');
   	$sortBy		 = $this->input->post('sortBy');
		$in_fromdate = $this->input->post('udate_from');
		$in_todate 	 = $this->input->post('udate_to');
		$in_users 	 = $users;
		$file_path 	 =  "../../selfies/aLog/";
		$r_cnt		 = 1;	
		$csv_filename = time().".csv";
		
		$attendance_report_path = $this->lang->line("absolute_path")."attendance_report/";
		$attendance_report_url = base_url()."images/attendance_report/";
		$attendance_end_time='';
		$filename = $attendance_report_path.$csv_filename;
		$fp = fopen($filename,"w");
		
		$f_from_date = $this->formatStorageDate($in_fromdate);
		$f_to_date 	 = $this->formatStorageDate($in_todate);
		
		$q_date = array();
		$p_date =  $f_from_date;
		
		while ($p_date <= $f_to_date){
			//echo "Array ".$p_date." ";
			array_push($q_date, $p_date);	
			$p_date = date("Y-m-d", strtotime($p_date . ' + 1 day'));
		}
		$list = "";
		$list .= "No,Name,Day,Date,Schedule Time in,Clock in Status,Schedule Clock Out Time,Clock Out Status"."\r\n";
		$staff_attendance_result = $this->Reports_model->getAllStaffWorkList_users($users);
		for($dcnt=0; $dcnt < count($q_date); $dcnt++){
			$sta = array();
			foreach ($staff_attendance_result as $srow){
				array_push($sta, $srow["staff_id"]);
			}
			for ($j=0;$j<count($sta);$j++){
				// filter holder for future use
				$in_invfilter = "non";
				$p_staff_id = $sta[$j];
				if ($in_invfilter == "non"){
					// Get Day - Monday, Tuesday etc.
					$log_date = $q_date[$dcnt];
					$timestamp = strtotime($log_date);
					$check_day = date("l", $timestamp);
					$p_check_workday_type = $this->Reports_model->getStaffShiftTypeviaDay($sta[$j], $check_day);
					$check_workday_type = $p_check_workday_type["shifttype"];
		         $base_start_time = $p_check_workday_type["basestart"];
               $base_end_time = $p_check_workday_type["baseend"];
               $in_shift 	= $p_check_workday_type["shiftid"];
               
               if ($check_workday_type == 0){
               	$ab_log_date = $q_date[$dcnt];
						$log_date = $q_date[$dcnt];
				
						$staffname = $this->Reports_model->getStaffName($sta[$j]);
						$shift_info = $this->Reports_model->getShiftDetails($in_shift, $check_day);
						$attendance_status = "Non Work Day";
                  $log_time = "NA";
                  $a_in_file = "NA";
                  $a_out_file = "NA";
                  $attendance_time = "NA";
                  $attendance_end_time = "NA";
                  $staff_logout_time = "NA";
                  $attendance_out_status = "NA";
						$in_explaination_notes = $staff_work_day_info["notes"];
						unset($in_mobile);
                  unset($out_mobile);
						
               }elseif ($check_workday_type == 1){
               	
               	$p_log_date = $log_date;
               	$out_log_date = date('Y-m-d', strtotime($p_log_date . ' + 1 day'));
               	$staff_work_day_info = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "in");
						$staffname = $this->Reports_model->getStaffName($sta[$j]);
						
						// Check in clock in.
                  if (count($staff_work_day_info)==0||$staff_work_day_info["log_time"] == ""){
                  	 $attendance_status = "Absent"; //compute difference
                  	 // Process for show in table
                  	 
                  	 $staffname = $this->Reports_model->getStaffName($sta[$j]);
                  	 $log_time = "NA";
                      $a_in_file = "NA";
                      $a_out_file = "NA";
                      $attendance_time = $base_start_time;
                      $attendance_end_time = $base_end_time;
                      $attendance_out_status = "Absent";
                      $staff_logout_time = "NA";
                      $in_explaination_notes = '';
                      unset($in_mobile);
                  	 unset($out_mobile);
                  }else{
                  	 // Get shift details
                  	 $p_shift_info = $this->Reports_model->getShiftDetails($in_shift, $check_day);
                  	 $shift_info = mysqli_fetch_assoc($p_shift_info);
                  	 
                  	 // Compute Clock in
                  	 $d_attendance_in_time = strtotime($staff_work_day_info["base_log_time"]);
                  	 $d_staff_time_in = strtotime($staff_work_day_info["log_time"]);
                  	 $p_in_undertime = $d_staff_time_in - $d_attendance_in_time;
                  	 $in_undertime = gmdate('H:i:s', $p_in_undertime);
                  	 $in_file_name = $staff_work_day_info["attendance_file"];
                  	 $a_in_file = "<a href=\"$file_path$in_file_name\" target=\"_blank\">$staffname</a>";
                  	 $in_explaination_notes = $staff_work_day_info["notes"];
                  	 if ($p_in_undertime > 0){
                  	 	$attendance_status = "Late by : ".$in_undertime;
                  	 }else{
                  	  $attendance_status = "On Time";
                  	 }
                  	 $log_time = $staff_work_day_info["log_time"];
                  	 $attendance_time = $staff_work_day_info["base_log_time"];
                  	 $in_mobile = $staff_work_day_info["mobile"];
                  	 
                  	 // Compute Clock out
                  	 $staff_work_day_out_info = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $out_log_date, "out");
                  	 if (count($staff_work_day_out_info)>0&&$staff_work_day_out_info["log_time"] != ""){
                  	 	$d_attendance_out_time = strtotime($staff_work_day_out_info["base_log_time"]);
                  	 	$staff_logout_time = $staff_work_day_out_info["log_time"];
                  	 	$d_staff_time_out = strtotime($staff_work_day_out_info["log_time"]);
                  	 	$p_out_undertime = $d_attendance_out_time - $d_staff_time_out;
                  	 	$out_undertime = gmdate('H:i:s', $p_out_undertime);
                  	 	$out_explaination_notes = $staff_work_day_info["notes"];
                  	 	if ($p_out_undertime > 0){
                  	 		$attendance_out_status = "Early clock out by : ".$out_undertime;
                  	 	}else{
									$attendance_out_status = "Ok.";
								}
								// Process for show in table
								$file_name = $staff_work_day_out_info["attendance_file"];
								$a_out_file = "<a href=\"$file_path$file_name \" target=\"_blank\">$staffname </a>";
								$attendance_end_time = $staff_work_day_out_info["base_log_time"];
								$out_explaination_notes = $staff_work_day_info["notes"];
								$out_mobile = $staff_work_day_info["mobile"];
                  	 }else{
                  	 	$a_out_file = "";
                  	 	$staff_logout_time = "";
                  	 	$attendance_end_time = $shift_info["pday_endtime"];
                  	 	$attendance_out_status = "Did Not Clock Out.";
                  	 	$out_explaination_notes = $staff_work_day_info["notes"];
                  	 	unset($out_mobile);
                  	 }
                  }
                                                                
               }elseif($check_workday_type == 2){
               	$staff_work_day_info = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "in");
               	if (count($staff_work_day_info)==0||$staff_work_day_info["log_time"] == ""){
               			$attendance_status = "Absent";
               			// Process for show in table              			
               			
               			$staffname = $this->Reports_model->getStaffName($sta[$j]);
               			$log_time = "NA";
                      	$a_in_file = "NA";
                      	$a_out_file = "NA";
                      	$attendance_time = $base_start_time; 
                      	$attendance_end_time = $base_end_time;
                      	$staff_logout_time = "NA";
								$attendance_out_status = "Absent";
								$in_explaination_notes = '';
								unset($in_mobile);
                  	 	unset($out_mobile);
               	}else{
               		$p_shift_info = $this->Reports_model->getShiftDetails($in_shift, $check_day);
               		$shift_info   = $p_shift_info->row_array();
               		$staffname = $this->Reports_model->getStaffName($sta[$j]);
               		$in_explaination_notes = $staff_work_day_info["notes"];
               		// ---------- Compute Clock in ------------
               		$d_attendance_in_time = strtotime($staff_work_day_info["base_log_time"]);
               		$d_staff_time_in = strtotime($staff_work_day_info["log_time"]);
               		$p_in_undertime = $d_staff_time_in - $d_attendance_in_time;
               		$in_undertime = gmdate('H:i:s', $p_in_undertime);
               		$in_file_name = $staff_work_day_info["attendance_file"];
               		$a_in_file = "<a href=\"$file_path$in_file_name\" target=\"_blank\">$staffname</a>";
               		if ($p_in_undertime > 0){
               			$attendance_status = "Late by : ".$in_undertime;
               		}else{
               			$attendance_status = "On Time";
               		}
               		// Process for show in table
               		$staffname = $this->Reports_model->getStaffName($sta[$j]);
               		$log_time = $staff_work_day_info["log_time"];
               		$attendance_time = $shift_info["pday_starttime"]; // Compute
               		$attendance_time = $staff_work_day_info["base_log_time"];
               		$in_mobile = $staff_work_day_info["mobile"];
               		// --------- Compute Clock out ---------------
               		$staff_work_day_out_info = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "out");
               		if (count($staff_work_day_out_info)>0&&$staff_work_day_out_info["log_time"] != ""){
               			$d_attendance_out_time = strtotime($staff_work_day_out_info["base_log_time"]);
               			$staff_logout_time = $staff_work_day_out_info["log_time"];
               			$d_staff_time_out = strtotime($staff_work_day_out_info["log_time"]);
               			$p_out_undertime = $d_attendance_out_time - $d_staff_time_out;
               			$out_undertime = gmdate('H:i:s', $p_out_undertime);
               			if ($p_out_undertime > 0){
               				$attendance_out_status = "Early Clock out by : ".$out_undertime;
               			}else{
               				$attendance_out_status = "Ok";
               			}
               			// Process for show in table
               			$out_file_name = $staff_work_day_out_info["attendance_file"];
               			$a_out_file = "<a href=\"$file_path$out_file_name \" target=\"_blank\">$staffname </a>";
               			$attendance_time = $staff_work_day_info["base_log_time"];
               			$attendance_end_time = $staff_work_day_out_info["base_log_time"]; 
               			$out_explaination_notes = $staff_work_day_info["notes"];
               			$out_mobile = $staff_work_day_info["mobile"];
               		}else{
               			// Process for show in table
               			 $out_file_name = "NA";
               			$staff_logout_time = "";
               			$attendance_time = $base_start_time;
               			$attendance_end_time = $shift_info["pday_endtime"]; 	
               			$attendance_out_status = "Did Not Clock Out.";
               			$out_explaination_notes = $staff_work_day_info["notes"];
               			unset($out_mobile);
               		}
               	}
               }	
				}
				
				//check if user is on leave today
		      $userAbsentOrNot = $this->site_settings->checkUserAbsentOrNot($sta[$j],$log_date);
		      if($userAbsentOrNot==1) //on leave
		      {
		      	$attendance_status = "On Leave";
		      	$attendance_out_status = "On Leave";
		      }
		      
				// Get Explaination Notes
				$in_explaination_notes=$this->Reports_model->getUserExplainationNotes($p_staff_id, $log_date, "in");
				$out_explaination_notes=$this->Reports_model->getUserExplainationNotes($p_staff_id, $log_date, "Out");
				
				$in_explaination_notes_datetime=$this->Reports_model->getUserExplainationNotesLogTime($p_staff_id, $log_date, "in");
            $out_explaination_notes_datetime=$this->Reports_model->getUserExplainationNotesLogTime($p_staff_id, $log_date, "Out");
            
            // Get Number of Breaks						
				$num_break = $this->Reports_model->getUserNumberofBreak($p_staff_id, $log_date);
				
				// Get and compute Break timing
				$break_out_list = $this->Reports_model->getUserBreakOutTiming($p_staff_id, $log_date);
				$break_in_list = $this->Reports_model->getUserBreakInTiming($p_staff_id, $log_date);
				
				//$break_list_result = array();
				$accumulated_break_time = 0;
				for ($b=0;$b<count($break_out_list);$b++){
					$hourdiff = round((strtotime($break_in_list[$b]) - strtotime($break_out_list[$b]))/3600, 1);
					$accumulated_break_time = $accumulated_break_time+$hourdiff;
				}
				
				// Work Hours							
				$f_clock_in_time = $this->Reports_model->getUserClockInTiming($p_staff_id, $log_date);
				$f_clock_out_time = $this->Reports_model->getUserClockOutTiming($p_staff_id, $log_date);
				
				$workhourdiff = round((strtotime($f_clock_out_time) - strtotime($f_clock_in_time))/3600, 1);
				
				// Work Hours Less Breaks
				$fwork_hours = $workhourdiff - $accumulated_break_time;
				if (($f_clock_in_time == "00:00:00" || $f_clock_in_time == "" ) || ($f_clock_out_time == "00:00:00" || $f_clock_out_time == ""))
				{
					$workhourdiff = "Cannot Calculate Work Hours";
					$fwork_hours = "Cannot Calculate Work Hours";
				}
				
				if ($accumulated_break_time < 0 )
				{
					$accumulated_break_time = "Cannot Calculate Break Hours";
				}
				
				$selfie_in_icon	=	(isset($in_mobile))?(($in_mobile==0)?'D':'M'):'';
				$selfie_out_icon	=	(isset($out_mobile))?(($out_mobile==0)?'D':'M'):'';
				
				$list .= $r_cnt.",".$staffname.",".$check_day.",".$log_date.",".$attendance_time.",".$attendance_status.",".
			   $attendance_end_time.",".$attendance_out_status."\r\n";
			   
			   
			   
			   $r_cnt++;
			   
			   unset($in_mobile);
				unset($out_mobile);
			   
			   $log_time = $staff_logout_time = $f_clock_in_time = $f_clock_out_time = $workhourdiff = $fwork_hours = "";
				
			}
			
			$list .= "\r\n";	
			$log_time = $staff_logout_time = $f_clock_in_time = $f_clock_out_time = $workhourdiff = $fwork_hours = "";
			
		}
		
		fputs($fp,$list);
		fclose($fp);
		
		if($sortBy==2)
		{
			$lines = array();
			$lines = file($attendance_report_url.$csv_filename, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
	
	      //print_r($lines);
	      foreach ($lines as $newline)
			{
			    $csv2array[] = explode(',', $newline);
			}

			$heading = array("No","Name","Day","Date","Schedule Time in","Clock in Status","Schedule Clock Out Time","Clock Out Status");
			$userInfoArray = $this->removeElementWithValue($csv2array, 1, "Name");
			
			foreach ($userInfoArray as $key => $row) 
			{
			    $newArray[$key]  = $row[1];
			}
			array_multisort($newArray, SORT_ASC, $userInfoArray);
			array_unshift($userInfoArray , $heading);
			
			foreach($userInfoArray as $k1 => $inner) 
			{
			    unset($userInfoArray[$k1][0]);
			}
			
			$csv_data = $this->array_2_csv($userInfoArray);
			
			$f = fopen($filename, "r+");
			if ($f !== false) 
			{
			    ftruncate($f, 0);
			    fputs($f,$csv_data);
			    fclose($f);
			}			
		}	
			
		$url = $attendance_report_url.$csv_filename;
		echo $url;		
	}
	/*
   function basic_download_user_attendance(){
   	$users		 = $this->input->post('umultiSelect');
		$in_fromdate = $this->input->post('udate_from');
		$in_todate 	 = $this->input->post('udate_to');
		$in_users 	 = $users;
		$file_path 	 =  "../../selfies/aLog/";
		$r_cnt		 = 1;	
		$csv_filename = time().".csv";
		
		$attendance_report_path = $this->lang->line("absolute_path")."attendance_report/";
		$attendance_report_url = base_url()."images/attendance_report/";
		$attendance_end_time='';
		$filename = $attendance_report_path.$csv_filename;
		$fp = fopen($filename,"w");
		
		$f_from_date = $this->formatStorageDate($in_fromdate);
		$f_to_date 	 = $this->formatStorageDate($in_todate);
		
		$q_date = array();
		$p_date =  $f_from_date;
		
		while ($p_date <= $f_to_date){
			//echo "Array ".$p_date." ";
			array_push($q_date, $p_date);	
			$p_date = date("Y-m-d", strtotime($p_date . ' + 1 day'));
		}
		$list = "";
		$list .= "No,Name,Day,Date,Schedule Clock In,Clock in Status,Schedule Clock Out Time,Clock Out Status"."\r\n";
		$staff_attendance_result = $this->Reports_model->getAllStaffWorkList_users($users);
		for($dcnt=0; $dcnt < count($q_date); $dcnt++)
		{
			$sta = array();
			foreach ($staff_attendance_result as $srow)
			{
				array_push($sta, $srow["staff_id"]);
			}
			for ($j=0;$j<count($sta);$j++)
			{
				// filter holder for future use
				$in_invfilter = "non";
				$p_staff_id = $sta[$j];
				if ($in_invfilter == "non")
				{
					// Get Day - Monday, Tuesday etc.
					$log_date = $q_date[$dcnt];
					$timestamp = strtotime($log_date);
					$check_day = date("l", $timestamp);
					$p_check_workday_type = $this->Reports_model->getStaffShiftTypeviaDay($sta[$j], $check_day);
					$check_workday_type = $p_check_workday_type["shifttype"];
		         $base_start_time = $p_check_workday_type["basestart"];
               $base_end_time = $p_check_workday_type["baseend"];
               $in_shift 	= $p_check_workday_type["shiftid"];
               
               if ($check_workday_type == 0)
               {
               	$ab_log_date = $q_date[$dcnt];
						$log_date = $q_date[$dcnt];
				
						$staffname = $this->Reports_model->getStaffName($sta[$j]);
						$shift_info = $this->Reports_model->getShiftDetails($in_shift, $check_day);
						$attendance_status = "Non Work Day";
                  $log_time = "Non";
                  $attendance_time = $base_start_time;
                  $attendance_end_time = $base_end_time;
                  $staff_logout_time = "Non";

						unset($in_mobile);
                  unset($out_mobile);
						
               }
               elseif ($check_workday_type == 1)
               {
               	$p_log_date = $log_date;
               	$out_log_date = date('Y-m-d', strtotime($p_log_date . ' + 1 day'));
               	$staff_work_day_info = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "in");
						$staffname = $this->Reports_model->getStaffName($sta[$j]);
						
						// Check in clock in.
                  if (count($staff_work_day_info)==0||$staff_work_day_info["log_time"] == "")
                  {
                  	 $attendance_status = "Absent"; //compute difference
                  	 // Process for show in table
                  	 
                  	 $staffname = $this->Reports_model->getStaffName($sta[$j]);
                  	 $log_time = "NA";
                      $attendance_time = $base_start_time;
                      $attendance_end_time = $base_end_time;
                      $staff_logout_time = "Non";
                      unset($in_mobile);
                  	 unset($out_mobile);
                  }
                  else
                  {
                  	 // Get shift details
                  	 $p_shift_info = $this->Reports_model->getShiftDetails($in_shift, $check_day);
                  	 $shift_info = mysqli_fetch_assoc($p_shift_info);
                  	 
                  	 $log_time = $staff_work_day_info["log_time"];
                  	 $attendance_time = $staff_work_day_info["base_log_time"];
                  	 
                  	 // Compute Clock out
                  	 $staff_work_day_out_info = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $out_log_date, "out");
                  	 if (count($staff_work_day_out_info)>0&&$staff_work_day_out_info["log_time"] != "")
                  	 {
                  	 	$staff_logout_time = $staff_work_day_out_info["log_time"];
								$attendance_end_time = $staff_work_day_out_info["base_log_time"];

                  	 }
                  	 else
                  	 {
                  	 	$staff_logout_time = "";

                  	 	unset($out_mobile);
                  	 }
                  }
                                                                
               }
               elseif($check_workday_type == 2)
               {
               	$staff_work_day_info = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "in");
               	if (count($staff_work_day_info)==0||$staff_work_day_info["log_time"] == "")
               	{
               			$attendance_status = "Absent";
               			// Process for show in table              			
               			
               			$staffname = $this->Reports_model->getStaffName($sta[$j]);
               			$log_time = "NA";
                      	$attendance_time = $base_start_time; 
                      	$staff_logout_time = "NA";

								unset($in_mobile);
                  	 	unset($out_mobile);
               	}
               	else
               	{
               		$p_shift_info = $this->Reports_model->getShiftDetails($in_shift, $check_day);
               		$shift_info   = $p_shift_info->row_array();
               		$staffname = $this->Reports_model->getStaffName($sta[$j]);
               		// Process for show in table
               		$staffname = $this->Reports_model->getStaffName($sta[$j]);
               		$log_time = $staff_work_day_info["log_time"];
               		$attendance_time = $staff_work_day_info["base_log_time"];

               		$staff_work_day_out_info = $this->Reports_model->getStaffClockInfobyDate($sta[$j], $log_date, "out");
               		if (count($staff_work_day_out_info)>0&&$staff_work_day_out_info["log_time"] != "")
               		{
               			$staff_logout_time = $staff_work_day_out_info["log_time"];
               			$attendance_time = $staff_work_day_info["base_log_time"];
               			$attendance_end_time = $staff_work_day_out_info["base_log_time"]; 
               		}
               		else
               		{

               			$staff_logout_time = "";
               			$attendance_time = $base_start_time;
               			$attendance_end_time = $shift_info["pday_endtime"]; 	
               			unset($out_mobile);
               		}
               	}
               }	
				}
				
				$list .= $r_cnt.",".$staffname.",".$check_day.",".$log_date.",".$attendance_time.",".$log_time.",".$attendance_end_time.",".$staff_logout_time."\r\n";
			   
			   $r_cnt++;
			   
			   unset($in_mobile);
				unset($out_mobile);
			   
			   $log_time = $staff_logout_time = $f_clock_in_time = $f_clock_out_time = $workhourdiff = $fwork_hours = "";
				
			}
			
			$list .= "\r\n";	
			$log_time = $staff_logout_time = $f_clock_in_time = $f_clock_out_time = $workhourdiff = $fwork_hours = "";
			
		}
		
		fputs($fp,$list);
		fclose($fp);
		$url = $attendance_report_url.$csv_filename;
		echo $url;
   }
   */

	function get_common()
	{
		$this->data['mynotifications']			=	$this->site_settings->fetchMyNotifications();
		$this->data['footer_includes']			=	'<script src="'.base_url().'js/cc/reports.js" type="text/javascript"></script>';			
	}
}

