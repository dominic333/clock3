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
    
    //Function to update company info 
    //Dominic : Nov 28, 2016
    function updateCompanyInfo($companyId)
    {
    	$data = array(		
								         
                	 'contact_person' 	=> $this->db->escape_str($this->input->post('companyContactPerson')),                              
                	 'contact_number' 	=> $this->db->escape_str($this->input->post('companyContactNumber')),                              
                	 'contact_email' 		=> $this->db->escape_str($this->input->post('companyEmail')),                              
                	 'company_address' 	=> $this->db->escape_str($this->input->post('companyAddress'))                              
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
           
       $this->db->where('id',$companyId);
       $this->db->update('company_info',$data);
    }
	
}

