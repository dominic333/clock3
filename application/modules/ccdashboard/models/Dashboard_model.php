<?php

class Dashboard_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
	}

	//Function to find the size of the company
	//Dominic; Jan 01,2017 (not in use; check site settings)
	function getCompanySize($compIdSess)
	{
		$this->db->select('COUNT(staff_id) AS totalUsers');
		$this->db->from('staff_info');
		$this->db->where('company_id',$compIdSess);
		$result=$this->db->get();
		return $result->row()->totalUsers;
	}
	
}

