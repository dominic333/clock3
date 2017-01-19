<?php

class Attendance_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
	}
	
	
	//Function to get all clock info by date
	//@Author Farveen
	//Modified By Sajeev: To fetch notes (Feb 04,2016)
	function getStaffAllClockInfobyDate($staff_id, $f_from_date)
	{
               	
		$this->db->select('log_time, attendance_file, log_date, base_log_time, shift_type,notes');
		$this->db->from('attendance_log');
		$this->db->where('staff_id',$staff_id);
		$this->db->where('log_date',$f_from_date);
		$result=$this->db->get();
		return $result->result_array();
		
		/*$data_q = "SELECT log_time, attendance_file, log_date, base_log_time, shift_type FROM attendance_log WHERE staff_id = '$staff_id' AND log_date='$f_from_date'";
		$result = mysqli_query($vdbm, $data_q);
		if(!$result){
      	$errno = mysqli_errno($vdbm);
      	$error = mysqli_error($vdbm);
         die("Query Error: $error (code: $errno)");
      }
		$fdata = mysqli_fetch_assoc($result);
      return $fdata;*/
	}
	
	function getStaffShiftTypeviaDay($staff_id, $in_day)
	{           
		$starttime = $in_day."_starttime";
		$endtime = $in_day."_endtime";

      /*$data_q = "SELECT department_shifts.$in_day as shifttype, department_shifts.$starttime as basestart, department_shifts.$endtime as baseend,department_shifts.shift_id as shiftid  
		FROM staff_dept_shift, department_shifts
		WHERE staff_dept_shift.shift_id = department_shifts.shift_id AND staff_dept_shift.staff_id='$staff_id'";*/

		$this->db->select('DS.'.$in_day.' as shifttype, DS.'.$starttime.' as basestart, DS.'.$endtime.' as baseend,DS.shift_id as shiftid',FALSE);
		$this->db->from('staff_dept_shift as SDS');
		$this->db->join('department_shifts as DS','DS.shift_id= SDS.shift_id');
		$this->db->where('SDS.staff_id',$staff_id);
		$result=$this->db->get();
		//echo $this->db->last_query();
		//return $result->result_array();
		return $result->row_array();
		
	}
	
	function getShiftDetails_v2($shiftid, $inday)
	{      
		$f_inday = strtolower($inday);
		$shift_starttime = $f_inday."_starttime";
		$shift_endtime = $f_inday."_endtime";

		/*$data_q = "SELECT department_shifts.$inday as pday, department_shifts.$shift_starttime as pday_starttime, department_shifts.$shift_endtime as pday_endtime
		FROM department_shifts WHERE shift_id = '$shiftid'";*/
		
		$this->db->select('department_shifts.'.$inday.' as pday, department_shifts.'.$shift_starttime.' as pday_starttime, department_shifts.'.$shift_endtime.' as pday_endtime',FALSE);
		$this->db->from('department_shifts');
		$this->db->where('shift_id',$shiftid);
		$result=$this->db->get();
		//echo $this->db->last_query();
		//return $result->result_array();
		return $result->row_array();
	}
		
	
	function getStaffName($staffid)
	{
      //$data_q = "SELECT staff_name FROM staff_info WHERE staff_id='$staffid'";
      
	   $this->db->select('staff_name');
		$this->db->from('staff_info');
		$this->db->where('staff_id',$staffid);
		$result=$this->db->get();
		return $result->row()->staff_name;
	}
	
	//Modified By Sajeev: To fetch notes (Feb 04,2016)
	function getStaffClockInfobyDate($staff_id, $f_from_date, $clocktype)
	{
		/*$data_q = "SELECT id, log_time, attendance_file, log_date, base_log_time, shift_type FROM attendance_log WHERE clock_type = '$clocktype' 
		AND staff_id = '$staff_id' AND log_date='$f_from_date' ORDER BY id DESC";*/
		
		$this->db->select('id, log_time, attendance_file, log_date, base_log_time, shift_type, geolocation, mobile,notes');
		$this->db->from('attendance_log');
		$this->db->where('clock_type',$clocktype);
		$this->db->where('staff_id',$staff_id);
		$this->db->where('log_date',$f_from_date);
		$this->db->order_by("id", "desc");
		$result=$this->db->get();
		//echo $this->db->last_query();
		//return $result->result_array();
		return $result->row_array();		
	}
	
	function getShiftDetails($shiftid, $inday)
	{	
		$f_inday = strtolower($inday);
		$shift_starttime = $f_inday."_starttime";
		$shift_endtime = $f_inday."_endtime";

		/*$data_q = "SELECT department_shifts.$inday as pday, department_shifts.$shift_starttime as pday_starttime, department_shifts.$shift_endtime as pday_endtime 
                FROM department_shifts WHERE shift_id = '$shiftid'";*/

      $this->db->select('department_shifts.'.$inday.' as pday, department_shifts.'.$shift_starttime.' as pday_starttime, department_shifts.'.$shift_endtime.' as pday_endtime',FALSE);
		$this->db->from('department_shifts');
		$this->db->where('shift_id',$shiftid);
		$result=$this->db->get();
		return $result;
	}
	
	//Function to get Company Departments
	//@Author Farveen
	function get_company_departments()
	{		
		$this->db->where('company_id',$this->session->userdata('coid'));
		$result=$this->db->get('departments');
		return $result->result();
	}
	
	  //Function to get selected client details
  //@Author Farveen
  //Modified By Sajeev: Fetc company id (Nov 23,2015)
  function get_selected_user_details(){
  	   $this->db->select('SI.*,CI.company_login,CI.company_name,CI.company_country,CP.max_users,D.department_name,DS.shift_name,D.dept_id,D.company_id as com_id');
  	   $this->db->where('SI.staff_id',$this->session->userdata('mid'));
  		$this->db->from('staff_info as SI');
  		$this->db->join('company_info as CI','CI.id=SI.company_id');
  		$this->db->join('company_plans as CP','CP.company_id=CI.id');
  		$this->db->join('staff_dept_shift as SDS','SDS.staff_id=SI.staff_id','LEFT');
  		$this->db->join('departments as D','D.dept_id=SDS.dept_id','LEFT');
  		$this->db->join('department_shifts as DS','DS.shift_id=SDS.shift_id','LEFT');
  		$result_personal = $this->db->get();
  		//echo $this->db->last_query();
  		return $result_personal->row();
  		
  		
  }


	function getShiftTZviaStaffid($staff_id)
	{
              
		/*$tz_data_q = "SELECT department_shifts.time_zone as tz FROM department_shifts, staff_dept_shift WHERE 
			department_shifts.shift_id = staff_dept_shift.shift_id AND staff_dept_shift.staff_id = '$staff_id'";*/

      $this->db->select('DS.time_zone as tz',FALSE);
		$this->db->from('department_shifts as DS');
		$this->db->join('staff_dept_shift as SDS','SDS.shift_id=DS.shift_id');
		$this->db->where('SDS.staff_id',$staff_id);
		$result=$this->db->get();
		if($result->num_rows()>0)
		{
			return $result->row()->tz;
		}
		else
		{
			return '';
		}
		
	}

	//Modified to fetch staffs based on shift id (Dec 14,2016)
	function getAllUsersinDept($sel_shift,$company_id)
	{      	
		//$tz_data_q = "SELECT staff_id FROM staff_dept_shift WHERE dept_id='$dept_id'";
		$this->db->select('staff_dept_shift.staff_id');
		$this->db->from('department_shifts');
		$this->db->join('staff_dept_shift','staff_dept_shift.shift_id=department_shifts.shift_id','left');
		$this->db->where('department_shifts.comp_id',$company_id);
		if($sel_shift!='all')
		{
		 $this->db->where('department_shifts.shift_id',$sel_shift);
		}
		$result=$this->db->get();
		//echo $this->db->last_query();
		return $result->result_array();
		
		//SELECT department_shifts.shift_id,staff_dept_shift.staff_id
		//FROM department_shifts
		//LEFT JOIN staff_dept_shift ON staff_dept_shift.shift_id=department_shifts.shift_id
		//WHERE department_shifts.comp_id=84 AND department_shifts.shift_id=213
       
	}

	function getUserBaseLogTime($staffid, $check_day, $base_log_time_field)
	{               	
		/*$tz_data_q = "SELECT department_shifts.$check_day as checkday, department_shifts.$base_log_time_field as base_log_time 
		FROM department_shifts, staff_dept_shift WHERE 
		department_shifts.shift_id = staff_dept_shift.shift_id AND 
		staff_dept_shift.staff_id ='$staffid'";*/
		
		$this->db->select('DS.'.$check_day.' as checkday, DS.'.$base_log_time_field.' as base_log_time',FALSE);
		$this->db->from('department_shifts as DS');
		$this->db->join('staff_dept_shift as SDS','SDS.shift_id=DS.shift_id');
		$this->db->where('SDS.staff_id',$staffid);
		$result=$this->db->get();
		//echo $this->db->last_query();
		//return $result->result_array();
		return $result->row_array();    	
	}

	//Function to fetch all users under a company
	//Dominic, Jan 01,2017
	function getCompanyUsers($compIdSess)
	{
		$this->db->where('company_id',$compIdSess);
		$this->db->where('staff_status',1);
		$result=$this->db->get('staff_info');
		return $result->result();
	}
	
	//Function to fetch leaves taken by a user
	//Dominic, Jan 05,2017
	function leaveCalendarData($fromDate,$toDate,$staff)
	{
		//SELECT * FROM staff_attendance_leaves WHERE leave_date BETWEEN '2017-01-01' AND '2017-01-31' AND status IN(0,1) AND staff_id=370
		
		$this->db->where_in('status', array(0,1));
		$this->db->where('staff_id',$staff);
		$this->db->where('leave_date >=', $fromDate);
		$this->db->where('leave_date <=', $toDate);
		$result=$this->db->get('staff_attendance_leaves');
		return $result->result();
	}
	
	//Function to get Attendance Details for the selected day for the company
	//Dominic, Jan 07,2017
	function company_users_attendance_details()
	{
		$staff_id	= $this->session->userdata('mid');
   	$tz 		= $this->getShiftTZviaStaffid($staff_id);
   	if($tz!='') 
   	date_default_timezone_set($tz);
		$today = date("Y-m-d", strtotime("today"));
		//$today = '2017-01-04';
		
		$this->db->select("  SUM(IF(AL.log_time>AL.base_log_time AND AL.clock_type='in' AND AL.base_log_time != '00:00:00' ,1,0)) as late_checkins,
									SUM(IF(AL.log_time<AL.base_log_time AND AL.clock_type='Out' AND AL.base_log_time != '00:00:00' ,1,0)) as early_checkouts,
									SUM(IF(AL.log_time <= AL.base_log_time AND AL.clock_type='in'AND AL.base_log_time != '00:00:00'  ,1,0)) on_checkins,
									SUM(IF(AL.clock_type='ab' ,1,0)) as absentees",false);
									
		$this->db->from('staff_info as SI ');
		$this->db->join('attendance_log as AL','AL.staff_id = SI.staff_id','LEFT');
		$this->db->where('SI.company_id',$this->session->userdata('coid'));
		$this->db->where('SI.staff_status',1);
		$this->db->where('AL.log_date',$today);
		$result=$this->db->get();
		//echo $this->db->last_query();
		return $result->row();
		
	}
	
	//Function to fetch leave requests
	//Dominic, Jan 13,2017
	function fetchLeaverequests($compIdSess)
	{
		//SELECT staff_attendance_leaves.id,staff_attendance_leaves.staff_id,staff_attendance_leaves.leave_date,staff_attendance_leaves.status,staff_attendance_leaves.leaveType,staff_info.staff_name 
		//FROM staff_attendance_leaves
		//LEFT JOIN staff_info ON staff_info.staff_id=staff_attendance_leaves.staff_id
		//WHERE staff_attendance_leaves.status IN (0,1) AND staff_info.company_id=84
		//ORDER BY staff_attendance_leaves.leave_date ASC
		
		$this->db->select("staff_attendance_leaves.id,staff_attendance_leaves.staff_id,staff_attendance_leaves.leave_date,staff_attendance_leaves.status,staff_attendance_leaves.leaveType,staff_info.staff_name",false);									
		$this->db->from('staff_attendance_leaves');
		$this->db->join('staff_info','staff_info.staff_id=staff_attendance_leaves.staff_id','LEFT');
		$this->db->where('staff_info.company_id',$compIdSess);
		$this->db->where_in('staff_attendance_leaves.status', array(0,1));
		$this->db->order_by('staff_attendance_leaves.leave_date','ASC');
		$result=$this->db->get();
		//echo $this->db->last_query();
		return $result->result();
	}
	
	//Function to approve a leave request
	//Dominic, Jan 13,2017
	function aproveLeaveApplication($staffid,$leaveId)
	{
	  $data = array(		
							'status' 	=> 1                          
  		 				);
	  $this->db->where('staff_id',$staffid);
	  $this->db->where('id',$leaveId);
	  $this->db->update('staff_attendance_leaves', $data);
	}
	
	//Function to reject a leave request
	//Dominic, Jan 13,2017
	function rejectLeaveApplication($staffid,$leaveId)
	{
		$data = array(		
							'status' 	=> 2                         
  		 				);
	   $this->db->where('staff_id',$staffid);
	   $this->db->where('id',$leaveId);
	   $this->db->update('staff_attendance_leaves', $data);
	}
	
	
}

