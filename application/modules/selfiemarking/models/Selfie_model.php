<?php

class Selfie_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
	}
	
	function getStaffShiftid($staff_id){
		//$data_q = "SELECT shift_id FROM staff_dept_shift WHERE staff_id='$staff_id'";
		$this->db->select('shift_id');
		$this->db->from('staff_dept_shift');
		$this->db->where('staff_id',$staff_id);
		$result=$this->db->get();
		if($result->num_rows()>0){
	 		return $result->row()->shift_id;
	 	}else{
	 		return '';
	 	}
		
	}
	
	function getStaffCoid($staff_id){
		
		$this->db->select('company_id');
		$this->db->from('staff_info');
		$this->db->where('staff_id',$staff_id);
		$result=$this->db->get();
		
		if($result->num_rows()>0){
	 		return $result->row()->company_id;
	 	}else{
	 		return '';
	 	}
	}
	
	function getStaffTimeZone($shift_id){
		
		$this->db->select('time_zone');
		$this->db->from('department_shifts');
		$this->db->where('shift_id',$shift_id);
		$result=$this->db->get();
		
		if($result->num_rows()>0){
	 		return $result->row()->time_zone;
	 	}else{
	 		return '';
	 	}
	}

 	function checkAttendanceIn($staff_id, $datein)
 	{
      //$data_q = "SELECT id FROM attendance_log WHERE staff_id='$staffid' AND log_date= '$datein' AND clock_type='in'";

		$this->db->select('id');
		$this->db->from('attendance_log');
		$this->db->where('staff_id',$staff_id);
		$this->db->where('log_date',$datein);
		$this->db->where('clock_type','in');
		$result=$this->db->get();
		
		if($result->num_rows()>0){
	 		return $result->row()->id;
	 	}else{
	 		return '';
	 	}
 	}

	function checkAttendanceAbsent($staff_id, $datein)
   {
          
		//$data_q = "SELECT id FROM attendance_log WHERE staff_id='$staffid' AND log_date= '$datein' AND clock_type='ab'";
		
		$this->db->select('id');
		$this->db->from('attendance_log');
		$this->db->where('staff_id',$staff_id);
		$this->db->where('log_date',$datein);
		$this->db->where('clock_type','ab');
		$result=$this->db->get();
		if($result->num_rows()>0){
	 		return $result->row()->id;
	 	}else{
	 		return '';
	 	}
   }
   
	function checkAttendanceOut($staff_id, $datein)
   {
          
		//$data_q = "SELECT id FROM attendance_log WHERE staff_id='$staffid' AND log_date= '$datein' AND clock_type='Out'";
		
		$this->db->select('id');
		$this->db->from('attendance_log');
		$this->db->where('staff_id',$staff_id);
		$this->db->where('log_date',$datein);
		$this->db->where('clock_type','Out');
		$result=$this->db->get();
		if($result->num_rows()>0){
	 		return $result->row()->id;
	 	}else{
	 		return '';
	 	}
   }
   
 	function checkAttendanceBreakState($staff_id)
 	{
		//$data_q = "SELECT break_state FROM staff_info WHERE staff_id='$staffid'";
		
		$this->db->select('break_state');
		$this->db->from('staff_info');
		$this->db->where('staff_id',$staff_id);
		$result=$this->db->get();
		if($result->num_rows()>0){
	 		return $result->row()->break_state;
	 	}else{
	 		return '';
	 	}
 	}
 	
	function getStaffShiftTypeviaDay($staff_id, $in_day){
                
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
	
	function updateStaffBreakState($staffid, $state)
	{
          
		//$data_q = "UPDATE staff_info SET break_state='$state' WHERE staff_id='$staffid'";
      $data['break_state']   = $state;	
      $this->db->where('staff_id',$staffid);   	
		$this->db->update('staff_info',$data);
 	}
 	

	function updateStaffAttendanceState($id, $state, $att_file,$geolocation,$mobile,$flexiUser)
	{
		//$data_q = "UPDATE attendance_log SET clock_type='$state', attendance_file='$att_file', log_time='$logtime' WHERE id='$id'";
		$logtime = date("H:i:s",time());
		
		if($flexiUser==1)
		{
			$data['log_time']   			= $logtime;
			$data['base_log_time']   	= $logtime;
		}
		else
		{
			$data['log_time']   			= $logtime;
		}
      $data['clock_type']   		= $state;	
      $data['geolocation']   		= $geolocation;	
      $data['mobile']   			= $mobile;	
      $data['attendance_file']   = $att_file;		
      $this->db->where('id',$id);   	
		$this->db->update('attendance_log',$data);
	}
	
	function logStaffAttendance($staffid, $clocktype, $jpgpath, $tzone, $base_time, $shift_type,$geolocation,$mobile,$flexiUser)
	{
		$logdate = date("Y-m-d",time());
		$logtime = date("H:i:s",time());        
	
		if($flexiUser==1)
		{
			$data = array(		
								'staff_id' 			=> $staffid,                           
          	 				'clock_type' 		=> $clocktype,   
          	 				'attendance_file' => $jpgpath,                         
          	 				'log_date' 			=> $logdate,                         
          	 				'log_time' 			=> $logtime,                         
          	 				'base_log_time' 	=> $logtime,                         
          	 				'shift_type' 		=> $shift_type,                         
          	 				'geolocation' 		=> $geolocation,                         
          	 				'mobile' 			=> $mobile,                         
	  		 				);
		}
		else
		{
			$data = array(		
								'staff_id' 			=> $staffid,                           
          	 				'clock_type' 		=> $clocktype,   
          	 				'attendance_file' => $jpgpath,                         
          	 				'log_date' 			=> $logdate,                         
          	 				'log_time' 			=> $logtime,                         
          	 				'base_log_time' 	=> $base_time,                         
          	 				'shift_type' 		=> $shift_type,                         
          	 				'geolocation' 		=> $geolocation,                         
          	 				'mobile' 			=> $mobile,                         
	  		 				);
		}
		$this->db->insert('attendance_log', $data);

	}
	
	function getCoAnnouncements($coid)
  	{
      //$data_q = "SELECT * FROM announcements WHERE co_id='$coid' AND active='1'";
		$this->db->select('*');
		$this->db->from('announcements');
		$this->db->where('co_id',$coid);
		$this->db->where('active',1);
		$result=$this->db->get();
		return $result->result();
         

  	}
  	
	function getAnnouncementStat($anid,$staff)
	{
      //$data_q = "SELECT id FROM announcements_log WHERE an_id='$anid' AND staff_id='$staff'";
		$this->db->select('id');
		$this->db->from('announcements_log');
		$this->db->where('an_id',$anid);
		$this->db->where('staff_id',$staff);
		$result=$this->db->get();
		if($result->num_rows()>0){
	 		return $result->row()->id;
	 	}else{
	 		return '';
	 	}
	}
	
	//Function to obtain a user's shift type
	//Dominic, Jan 16,2017
	function fetchUserShiftType()
	{
		//SELECT staff_type FROM staff_info WHERE staff_id=1 AND staff_status=1
		$staff_id 	= $this->session->userdata('mid');
		$this->db->select('staff_type');
		$this->db->where('staff_id',$staff_id);
		$this->db->where('staff_status',1);
		$results=$this->db->get('staff_info');
		if($results->num_rows()>0)
		{
	 		return $results->row()->staff_type;
	 	}
	 	else
	 	{
	 		return 0;
	 	}
	}
	
	//Function to fetch attendance watchers for a shift
	//Dominic, Feb 09 2017
	function get_attendance_watchers($shiftid)
	{
	  //SELECT staff_info.email as email FROM monitor_info, staff_info WHERE 
	  //monitor_info.staff_id = staff_info.staff_id AND monitor_info.shift_id = '$shiftid' AND monitor_info.monitor='1'
	   $this->db->select('staff_info.email as email');
		$this->db->from('monitor_info, staff_info');
		$this->db->where('monitor_info.staff_id = staff_info.staff_id');
		$this->db->where('monitor_info.shift_id',$shiftid);
		$this->db->where('monitor_info.monitor',1);
		$result=$this->db->get();
		return $result->result();
	}

	
}

