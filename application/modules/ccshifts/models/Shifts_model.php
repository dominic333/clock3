<?php

class Shifts_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
	}
	
	//Function for departments CRUD
	//Dominic, Dec 07,2016
	function departmentsCRUD($compId,$action)
	{
		switch($action)
		{          
        case 'create':	
						$data = array(		                         
          	 				'company_id' 	=> $compId,                            
          	 				'department_name' 	=>  $this->db->escape_str($this->input->post('department')),                            
	  		 			);
						$this->db->insert('departments', $data);
   
						break; 
						
						
		  case 'read':	
					  $this->db->where('company_id',$compId);
					  $result=$this->db->get('departments');
					  return $result->result();
   
					  break;
        
        case 'update':	
						 $data = array(		
							'department_name' 	=> $this->db->escape_str($this->input->post('department'))                          
  		 				 );
						 $this->db->where('dept_id',$this->input->post('dept_id'));
						 $this->db->where('company_id',$compId);
						 $this->db->update('departments', $data);

					    break; 
		  
		  case 'delete':
						 $this->db->delete('departments', array('dept_id' => $this->input->post('dept_id')));
						 break;
          
        default	:break;
  		} 	
	
	}
	
	//Function to get department exist or not
	//Dominic, December 09,2016
	function department_exist()
	{
		$this->db->where('department_name',$this->input->post('department'));
		$this->db->where('company_id',$this->session->userdata('coid'));
		$departments_details = $this->db->get('departments');
		return $departments_details->result();
	}
	
	//Function to get department exist or not for edit
	//Dominic, December 09,2016
	function department_exist_edit()
	{
		$this->db->where('dept_id !=',$this->input->post('dept_id'));
		$this->db->where('department_name',$this->input->post('department'));
		$this->db->where('company_id',$this->session->userdata('coid'));
		$departments_details = $this->db->get('departments');
		//echo $this->db->last_query();
		return $departments_details->result();
	}
	
	//function to check if dept shift exists
	//Dominic, December 10,2016
	function check_department_shift_exists()
	{
		$this->db->select('shift_id');
		$this->db->where('dept_id',$this->input->post('dept_id'));
		$results=$this->db->get('department_shifts');
		if($results->num_rows() > 0)
		{
	      return TRUE;
	   } 
	   else 
	   {
	      return FALSE;
	   }
	}
	
	//function to check if dept shift user exists
	//Dominic, December 10,2016
	function check_department_shift_user_exists()
	{
		$this->db->select('id');
		$this->db->where('dept_id',$this->input->post('dept_id'));
		$results=$this->db->get('staff_dept_shift');
		if($results->num_rows() > 0)
		{
	      return TRUE;
	   } 
	   else 
	   {
	      return FALSE;
	   }
	}	

	//Function to fetch company type
	//Dominic, December 10,2016
	function getCompanyType($compIdSess)
	{
		$this->db->select('planId');
		$this->db->where('company_id',$compIdSess);
		$results=$this->db->get('company_plans');
		return $results->row()->planId;
	}
	
	//Function to fetch company members
	//Dominic, December 10,2016
	function getCompanyMembers($compIdSess)
	{
	  $this->db->select('SI.staff_id,SI.is_admin,SI.staff_name,SI.login_name,SI.email,SI.contact_number,SI.staff_status,SI.staff_photo,SI.monitor,
	  				 DS.shift_name,DS.time_zone,DS.shift_name,CI.company_name,D.department_name,SI.work_from_home');
	  $this->db->from('staff_dept_shift as SDS');
  	  $this->db->join('staff_info as SI','SI.staff_id=SDS.staff_id');
  	  $this->db->join('departments as D','D.dept_id=SDS.dept_id');
  	  $this->db->join('department_shifts as DS','DS.shift_id=SDS.shift_id');
  	  $this->db->join('company_info as CI','CI.id=D.company_id');
  	  $this->db->where('SDS.dept_id',$dept_id);
  	  $this->db->limit($limit, $start);
     $this->db->order_by("SI.staff_id", "desc");
	  $query= $this->db->get(); 
	  //echo $this->db->last_query();                                    
	  $r     = $query->result();
	}
	
	
	
	
}

