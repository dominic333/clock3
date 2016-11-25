<?php

class Home_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
	}
	
	//Function to check login valid or not
	//Dominic: Nov 24,2016
	function check_login()
   {    
   	//SELECT SI.staff_id,SI.is_admin,ST.id AS staffTypeId
		//FROM staff_info AS SI 
		//LEFT JOIN company_info AS CI ON CI.id=SI.company_id 
		//LEFT JOIN staff_types AS ST ON ST.id=SI.staff_type
		//WHERE CI.company_login='' AND SI.login_name='' AND SI.password=''
		       
      $this->username = $this->input->post('name');
      $this->db->where('SI.login_name', $this->username);	
      $this->password = md5($this->input->post('password'));
      $this->db->where('SI.password', $this->password);
      $this->companyname = $this->input->post('companyName');
      
      $this->db->where('CI.company_login', $this->companyname);
      
      $this->db->where('SI.staff_status', 1);
  		$this->db->select('SI.staff_id,CI.id,SI.staff_name,SI.is_admin,ST.id AS staffTypeId');
   	$this->db->from('staff_info AS SI');
   	$this->db->join('company_info AS CI','CI.id = SI.company_id');	   
   	$this->db->join('staff_types AS ST','ST.id=SI.staff_type');	   
   	$result_user = $this->db->get();	
   	//echo $this->db->last_query();
   	
   	if($result_user->num_rows() > 0)
   	{ 
			return $result_user->row()->staff_id;
		}
		else
		{
			return 0;
		}
		
		//$result_user->free_result();
		
    }
	
}

