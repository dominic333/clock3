<?php

class Account_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
	}

	//Function to update user info
	//Dominic : Dec 12, 2016
	function updateUserInfo($userId)
	{
		$data = array(

			'staff_name' 	=> $this->db->escape_str($this->input->post('fullName')),
			//'login_name' 	=> $this->db->escape_str($this->input->post('loginName')),
			'email' 		=> $this->db->escape_str($this->input->post('email')),
			'contact_number' 	=> $this->db->escape_str($this->input->post('contactNumber'))
			//'company_city' 		=> $this->db->escape_str($this->input->post('company_city')),
			//'company_state' 		=> $this->db->escape_str($this->input->post('company_state')),
			//'company_postcode' 	=> $this->db->escape_str($this->input->post('company_postcode')),
			//'company_country' 	=> $this->db->escape_str($this->input->post('company_country')),
		);
		/*
        if($filename)
        {
         $data['company_logo']=$filename;
          }
          */

		$this->db->where('staff_id',$userId);
		$this->db->update('staff_info',$data);
	}
	
	

	function update_staff_photo($filename,$staffid)
	{
		
		$data['staff_photo']	=	$filename; 
    	$this->db->where('staff_id',$staffid);
	 	$this->db->update('staff_info',$data);
	
	
	}
	
	function resetPassword($staff_id)
	{
		$data			=	array(
								'password'	=> md5($this->db->escape_str($this->input->post('newPassword')))	
			
							);	
							
		//$r =$this->input->post('newPassword');
		//echo $r;				
		$this->db->where('staff_id',$staff_id);
		$this->db->update('staff_info',$data);
		if($this->db->affected_rows() > 0)
		{
			return true;		
		
		}
		else{
			return false;		
		}
	
	}
	
}

