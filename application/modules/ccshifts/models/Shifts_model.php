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
	//Dominic, December 12,2016 
	function getCompanyMembers($compIdSess)
	{
	   //SELECT staff_info.staff_id,department_shifts.shift_id,departments.dept_id,staff_info.is_admin,staff_info.staff_name,staff_info.login_name,
	   //staff_info.email,staff_info.contact_number,staff_info.staff_photo,staff_info.monitor,staff_info.work_from_home,staff_info.staff_type,
	   //department_shifts.shift_name,departments.department_name 
		//FROM staff_info
		//LEFT JOIN staff_dept_shift ON staff_dept_shift.staff_id=staff_info.staff_id
		//LEFT JOIN department_shifts ON department_shifts.shift_id=staff_dept_shift.shift_id
		//LEFT JOIN departments ON departments.dept_id=department_shifts.dept_id
		//WHERE staff_info.staff_status=1 AND staff_info.company_id=84
		
	  $this->db->select('staff_info.staff_id,department_shifts.shift_id,departments.dept_id,staff_info.is_admin,staff_info.staff_name,staff_info.login_name,
	  							staff_info.email,staff_info.contact_number,staff_info.staff_photo,staff_info.monitor,staff_info.work_from_home,staff_info.staff_type,
	  							department_shifts.shift_name,departments.department_name');
	  $this->db->from('staff_info');
  	  $this->db->join('staff_dept_shift','staff_dept_shift.staff_id=staff_info.staff_id','LEFT');
  	  $this->db->join('department_shifts','department_shifts.shift_id=staff_dept_shift.shift_id');
  	  $this->db->join('departments','departments.dept_id=department_shifts.dept_id');
  	  $this->db->where('staff_info.staff_status',1);
  	  $this->db->where('staff_info.company_id',$compIdSess);
     $this->db->order_by("staff_info.staff_id", "ASC");
	  $query= $this->db->get(); 
	  //echo $this->db->last_query();                                    
	  return $query->result();
	}
	
	//Function to fetch shifts for a company
	//Dominic, December 12,2016
	function fetchCompanyShifts($compId)
	{
	  //SELECT shift_id,shift_name FROM department_shifts WHERE shift_status=1 AND comp_id=84
	  $this->db->select('DS.*');
	  $this->db->from('department_shifts as DS');
  	  $this->db->where('DS.comp_id',$compId);
  	  $this->db->where('DS.shift_status',1);
	  $query= $this->db->get(); 
	  //echo $this->db->last_query();                                    
	  return $query->result();
	}
	
		//Function to manage Users	
	function save($type='' ,$filename='' ,$user_id='')
   {
			switch($type){
				          
	        case 'Add_Users':	
												$data = array(		
													'company_id' 	  => $this->session->userdata('coid'),                        
													'is_admin' 		  => $this->db->escape_str($this->input->post('is_admin')),                        
													'staff_name' 	  => $this->db->escape_str($this->input->post('staff_name')),                        
													'login_name' 	  => $this->db->escape_str($this->input->post('login_name')),                        
													'password' 		  => md5($this->db->escape_str($this->input->post('password'))),                        
													'email' 			  => $this->db->escape_str($this->input->post('email')),                      
													'contact_number' => $this->db->escape_str($this->input->post('contact_number')),                      
													'monitor' 		  => $this->db->escape_str($this->input->post('monitor')), 
													'work_from_home' 		  => $this->db->escape_str($this->input->post('remotelogin'))                      
	                      	 			);
												$this->db->insert('staff_info', $data);
	               
	         							break; 
	         							
	        case 'Edit_Users':	
												$data = array(		
													                        
													'staff_name' 			=> $this->db->escape_str($this->input->post('staff_name')),                        
													'email' 			=> $this->db->escape_str($this->input->post('email')),                        
													'contact_number' 			=> $this->db->escape_str($this->input->post('contact_number'))                                             	                      	 				
	                      	 				                           
						  		 				);
						  		 				
												$this->db->where('staff_id',$this->input->post('staff_id'));
												$this->db->update('staff_info', $data);
	               
	         							break;
	         							
	        case 'Edit_Monitoring':	
												$data = array(		                      
													'monitor' 	=> $this->db->escape_str($this->input->post('mmonitor'))                       	                      	 				                    	                      	 				
	                      	 				                           
						  		 				);
						  		 				
												$this->db->where('staff_id',$this->input->post('mstaff_id'));
												$this->db->update('staff_info', $data);
	               
	         							break;
	         							
	        case 'Edit_RemoteL':	
												$data = array(		                   	                      	 				
													'work_from_home' 	=> $this->db->escape_str($this->input->post('rremotelogin'))                       	                      	 					                      	 				                           
						  		 				);
						  		 				
												$this->db->where('staff_id',$this->input->post('rstaff_id'));
												$this->db->update('staff_info', $data);
	               
	         							break;	         								         							
	         							
	         							
	          
           default		:break;
	  }   
	                      
	}
	
	
	
	
}

