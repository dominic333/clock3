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

														  
		 if ($this->form_validation->run('frm_attendance_search') === FALSE) 
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
			$this->data['attendance_table']	.= $this->myAttendanceTablulaData($f_from_date,$f_to_date,$staff);

			$this->data['view']					=	'ccattendance/my-attendance';
			$this->load->view('master', $this->data);	

		}
	}
	
	//Function to compute attendance for my attendance view
	//Dominic; Dec 14,2016
	function myAttendanceTablulaData($f_from_date,$f_to_date,$staff)
	{			
		$attendance_table='';
		$file_path 	 =  "../selfies/aLog/";
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
   	$absent_image 		= "admin-user.png";
		$non_work_image 	= "admin-user.png";
		$no_selfies_image = "admin-user.png";
		$del_image 			= "icon-delete.png";
		$avatar_path		=	base_url()."assets/cc/images"; 
   	$department_attendance='';  
   		
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
	       	}
	       	else
	       	{
	            $attendance_status = "Status : On Time";
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
			         
					}
					else if (count($check_user_shift)>0&&$check_user_shift["checkday"] == 0)
					{			      	
		         	$fullpath = $avatar_path."/".$non_work_image;
						$attendance_status = "Non Work Day";
						$logtime = "NA";
			         $baselogtime = "NA";
			         unset($mobile);
			         
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
						}
						else
						{
							$fullpath = $avatar_path."/".$non_work_image;
							$attendance_status = "Non Work Day";
							$logtime = "NA";
			         	$baselogtime = "NA";
			         	unset($mobile);
						}								         
			      }
				
	       }
				
				$selfie_icon	=	(isset($mobile))?(($mobile==0)?'<i class="fa fa-desktop"></i>':'<i class="fa fa-mobile"></i>'):'';
				$map_icon		=	(isset($geolocation)&&($geolocation!='')&&($geolocation!=0))?'<a href="#" data-image="http://maps.googleapis.com/maps/api/staticmap?center='.$geolocation.'&zoom=18&markers=color:red|label:A|'.$geolocation.'&scale=false&size=560x370&maptype=roadmap&format=png&visual_refresh=true" data-alt="Google Map of '.$geolocation.'" class="attendance_map_link" ><i class="fa fa-map-marker"></i></a>':'';
						
				$department_attendance	.=	'<div class="col-md-4" data-user_id="'.$staffid.'">
													                <div class="box box-danger">
													                    <div class="box-header with-border">
													                        <h3 class="box-title">Department</h3>
													
													                        <div class="box-tools pull-right">
													                            <span class="label label-success">v</span>
													                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
													                                    class="fa fa-minus"></i>
													                            </button>
													                        </div>
													                    </div>
													                    <div class="box-body">
													                        <div class="box box-widget widget-user-2">
													                            <!-- Add the bg color to the header using any of the bg-* classes -->
													                            <div class="widget-user-header bg-gray-light">
													                                <div class="widget-user-image">
													                                    <img class="img-circle" src="'.$fullpath.'" alt="User Avatar">
													                                </div>
													                                <h4 class="widget-user-username">'.$staffname.'</h4>
													                                <h5 class="widget-user-desc">Scheduled Clock in @ <b> '.$baselogtime.'</b></h5>
													                                <h5 class="widget-user-desc">Actual Clock in @ <b> '.$logtime.'</b></h5>
													                                <a class="on-time">'.$attendance_status.'</a>
													                                <h6 class="widget-user-desc">'.$selfie_icon.$map_icon.'</h6>
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


	function get_common()
	{
		$this->data['mynotifications']			=	$this->site_settings->fetchMyNotifications();
		$this->data['footer_includes']			=	'<script src="'.base_url().'js/cc/my-attendance.js" type="text/javascript"></script>';
		/*
		$this->site_settings->get_site_settings();
		$this->data['profile']			=	$this->site_settings->personal_details();	
		$this->data['menus_all']		= 	modules::load('menus')->get_menus();
		$this->data['myprivileges']	=	$this->site_settings->myprivileges();
		
		*/
			
	}
}

