<?php

class Administration_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
	}
	
	//Function To fetch company info based on company Id
	//Dominic: Nov 25,2016
	function getThisCompanyInfo($compId)
   {    
		$this->db->select('CI.*,CP.max_users');
		$this->db->where('CI.id',$compId);
		$this->db->where('CI.company_status',1);
		$this->db->from('company_info as CI');
		$this->db->join('company_plans as CP','CP.company_id=CI.id','LEFT');
		$result_company=$this->db->get();
		//echo $this->db->last_query();
		return $result_company->row();	
    }
	
}

