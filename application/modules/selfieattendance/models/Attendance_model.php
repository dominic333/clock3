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
	
	//Function to request a leave
	//Dominic, Jan 04,2016
	function requestLeave($dateofMonth,$leaveType,$staff)
	{
		$data = array(		                         
	          	 				'staff_id' 		=>  $staff,                            
	          	 				'leave_date' 	=>  $dateofMonth,                            
	          	 				'leaveType' 	=>  $leaveType,                            
		  		 			);
		$this->db->insert('staff_attendance_leaves', $data);
	}
	
	//Function to remove a leave request
	function removeRequestedLeave($dateofMonth,$leaveType,$staff)
	{
		if($leaveType=='Annual Leave')
		{
			$leave='annual';
		}
		else if($leaveType=='Casual Leave')
		{
			$leave='casual';
		}
		else if($leaveType=='Medical Leave')
		{
			$leave='medical';
		}
		else
		{
			$leave='';
		}
		$this->db->delete('staff_attendance_leaves', array('staff_id' => $staff,'leave_date' 	=>  $dateofMonth,'leaveType' 	=>  $leave));
	}

}

