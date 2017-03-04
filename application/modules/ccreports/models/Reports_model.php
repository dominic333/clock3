<?php

class Reports_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
	}
	
	//Function to get Company Departments
	//@Author Farveen
	function get_company_departments(){
		
		$this->db->where('company_id',$this->session->userdata('coid'));
		$result=$this->db->get('departments');
		return $result->result();
	}
	
	//Function to get company wise department wise shifts
	//@Author Farveen
	function departments_shifts($dept_id){
		$this->db->select('DS.shift_id,DS.dept_id,DS.shift_name');
		$this->db->where('DS.dept_id',$dept_id);
		$this->db->from('department_shifts as DS');
		$result=$this->db->get();
		//echo $this->db->last_query();    
		return $result->result_array();	
		
	}
	
	//Function to get department 
	//@Author Farveen
	function getAllStaffWorkList_dept($shifts){
		$this->db->select('SDS.id as id, SDS.staff_id as staff_id, SDS.dept_id as dept_id, SDS.shift_id as shift_id');
		$this->db->where_in('SDS.shift_id', $shifts);
		$this->db->where('SI.monitor',1);
		$this->db->from('staff_dept_shift as SDS');
		$this->db->join('staff_info as SI','SI.staff_id= SDS.staff_id');
		$result=$this->db->get();
		//echo $this->db->last_query();    
		return $result->result_array();
	}
	
		//Function to get users  
	//@Author Farveen
	function getAllStaffWorkList_users($users){
		
		$compIdSess =$this->session->userdata('coid');
		$this->db->select('SDS.id as id, SDS.staff_id as staff_id, SDS.dept_id as dept_id, SDS.shift_id as shift_id');
		if($users!='all')
		{
			$this->db->where_in('SI.staff_id', $users);
		}
		$this->db->where('SI.monitor',1);
		$this->db->where('SI.company_id',$compIdSess);
		$this->db->from('staff_dept_shift as SDS');
		$this->db->join('staff_info as SI','SI.staff_id= SDS.staff_id');
		$result=$this->db->get();
		//echo $this->db->last_query();    
		return $result->result_array();
	}
	
	function getStaffName($staffid){
      //$data_q = "SELECT staff_name FROM staff_info WHERE staff_id='$staffid'";
      
	   $this->db->select('staff_name');
		$this->db->from('staff_info');
		$this->db->where('staff_id',$staffid);
		$result=$this->db->get();
		return $result->row()->staff_name;

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
	
	function getStaffShiftTypeviaDay($staff_id, $in_day)
	{                
		
      /*$data_q = "SELECT department_shifts.$in_day as shifttype, department_shifts.$starttime as basestart, department_shifts.$endtime as baseend,department_shifts.shift_id as shiftid  
		FROM staff_dept_shift, department_shifts
		WHERE staff_dept_shift.shift_id = department_shifts.shift_id AND staff_dept_shift.staff_id='$staff_id'";*/
		$starttime = $in_day."_starttime";
		$endtime = $in_day."_endtime";

		$this->db->select('DS.'.$in_day.' as shifttype, DS.'.$starttime.' as basestart, DS.'.$endtime.' as baseend,DS.shift_id as shiftid,AL.base_log_time,AL.log_date,AL.log_time',FALSE);
		$this->db->from('staff_dept_shift as SDS');
		$this->db->join('department_shifts as DS','DS.shift_id= SDS.shift_id');
		$this->db->join('attendance_log as AL','AL.staff_id= SDS.staff_id');
		$this->db->where('SDS.staff_id',$staff_id);
		$result=$this->db->get();
		//echo $this->db->last_query();
		//return $result->result_array();
		return $result->row_array();
		
		
		
		
	}
	function getClockTime($staff_id,$day,$clocktype)
	{
		
		$this->db->where('staff_id',$staff_id);
		$this->db->where('log_date',$day);
		$this->db->where('clock_type',$clocktype);
		$result	=	$this->db->get('attendance_log');
		return $result->row_array();
		
	}
	
	function getStaffClockInfobyDate($staff_id, $f_from_date, $clocktype)
	{
		/*$data_q = "SELECT id, log_time, attendance_file, log_date, base_log_time, shift_type FROM attendance_log WHERE clock_type = '$clocktype' 
		AND staff_id = '$staff_id' AND log_date='$f_from_date' ORDER BY id DESC";*/
		
		$this->db->select('id, log_time, attendance_file, log_date, base_log_time, shift_type,notes, geolocation, mobile');
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
	
	//function to get_company_users
	//@Author Farveen
	function get_company_users(){
		$this->db->select('staff_id,staff_name');
		$this->db->from('staff_info');
		$this->db->where('company_id',$this->session->userdata('coid'));
		$this->db->order_by("staff_name", "asc");
		$result=$this->db->get();
		//echo $this->db->last_query();
		//return $result->result_array();
		return $result->result();
	}
	
		function getUserExplainationNotes($userid, $indate, $clktype)
      {
          //$tz_data_q = "SELECT notes FROM attendance_log WHERE staff_id='$userid' AND log_date='$indate' AND clock_type='$clktype'";
			 
			 $this->db->select('notes');
			 $this->db->from('attendance_log');
			 $this->db->where('staff_id',$userid);
			 $this->db->where('log_date',$indate);
			 $this->db->where('clock_type',$clktype);
			 $result = $this->db->get();
			 if($result->num_rows()>0){
			 	return $result->row()->notes;
			 }else{
			 	return '';
			 }                
      }


	function getUserExplainationNotesLogTime($userid, $indate, $clktype)
	{
       $this->db->select('notes_date');
		 $this->db->from('attendance_log');
		 $this->db->where('staff_id',$userid);
		 $this->db->where('log_date',$indate);
		 $this->db->where('clock_type',$clktype);
		 $result = $this->db->get();
       if($result->num_rows()>0){
		 	return $result->row()->notes_date;
		 }else{
		 	return '';
		 }
  }
  
  function getUserNumberofBreak($userid, $indate)
  {
       $this->db->select('id');
		 $this->db->from('attendance_log');
		 $this->db->where('staff_id',$userid);
		 $this->db->where('log_date',$indate);
		 $this->db->where('clock_type','brkOut');
		 $result = $this->db->get();
		 return $result->num_rows();
  }
  
  //Modified By Sajeev: Result array to resultset ( dec 8,2015) 
function getUserBreakOutTiming($userid, $indate)
  {
      

 	       	//$tz_data_q = "SELECT log_time FROM attendance_log WHERE staff_id='$userid' AND log_date='$indate' AND clock_type='brkOut'";

		$store_list = array();

      $this->db->select('log_time');
		$this->db->from('attendance_log');
		$this->db->where('staff_id',$userid);
		$this->db->where('log_date',$indate);
		$this->db->where('clock_type','brkOut');
		$result = $this->db->get();
		//$result= $result->result_array();
		$result= $result->result();
		foreach($result as $rrows){
			///array_push($store_list, $rrows["log_time"]);
			array_push($store_list, $rrows->log_time);
		}
		return $store_list;
  }
  
  
  //Modified By Sajeev: Result array to resultset ( dec 8,2015)
  function getUserBreakInTiming($userid, $indate)
  {
 	   //$tz_data_q = "SELECT log_time FROM attendance_log WHERE staff_id='$userid' AND log_date='$indate' AND clock_type='brkOut'";

		$store_list = array();
	
	   $this->db->select('log_time');
		$this->db->from('attendance_log');
		$this->db->where('staff_id',$userid);
		$this->db->where('log_date',$indate);
		$this->db->where('clock_type','brkin');
		$result = $this->db->get();
		//$result= $result->result_array();
		$result= $result->result();
		foreach($result as $rrows){
			//array_push($store_list, $rrows["log_time"]);
			array_push($store_list, $rrows->log_time);
		}
		return $store_list;
  }
  
  
	function getUserClockInTiming($userid, $indate)
   {
       $this->db->select('log_time');
		 $this->db->from('attendance_log');
		 $this->db->where('staff_id',$userid);
		 $this->db->where('log_date',$indate);
		 $this->db->where('clock_type','in');
		 $result = $this->db->get();
       if($result->num_rows()>0){
		 	return $result->row()->log_time;
		 }else{
		 	return '';
		 }
   }
  
  	function getUserClockOutTiming($userid, $indate)
   {
       $this->db->select('log_time');
		 $this->db->from('attendance_log');
		 $this->db->where('staff_id',$userid);
		 $this->db->where('log_date',$indate);
		 $this->db->where('clock_type','Out');
		 $result = $this->db->get();
       if($result->num_rows()>0){
		 	return $result->row()->log_time;
		 }else{
		 	return '';
		 }	
   }
}

