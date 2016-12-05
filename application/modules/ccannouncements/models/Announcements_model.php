<?php

class Announcements_model extends CI_Model 
{
	
	function __construct()
	{
		parent::__construct();
	}
	
	
	//Function to fetch all announcements for a company
	//By Dominic; Dec 01,2016
	function fetchAnnouncementsList($compId,$limit='')
   {    
		$this->db->select('A.id,A.title,A.msg,A.date');
		$this->db->where('A.co_id',$compId);
		$this->db->where('A.active',1);
		$this->db->from('announcements as A');
		$this->db->order_by('A.date','DESC');
		if($limit!='') 
		{
			$this->db->limit($limit);
		}
		$result_company=$this->db->get();
		//echo $this->db->last_query();
		return $result_company->result();	
    }
    
    //Function to add,edit and delete announcements
    //By Dominic; Dec 01,2016
    function announcementCRUD($type='')
    {
			switch($type)
			{
				          
	        case 'Add':	
							$data = array(		
									'co_id' 	=> $this->session->userdata('coid'),                           
             	 				'title' 	=> $this->db->escape_str($this->input->post('title')),                            
             	 				'msg' 	=> $this->input->post('message'),                            
		  		 			);
							$this->db->insert('announcements', $data);
      
							break; 
	        
	        case 'Edit':	
							 $data = array(		
								'title' 	=> $this->db->escape_str($this->input->post('title')),                            
          	 				'msg' 	=> $this->input->post('message'),                            
	  		 				 );
							 $this->db->where('id',$this->input->post('ancId'));
							 $this->db->where('co_id',$this->session->userdata('coid'));
							 $this->db->update('announcements', $data);
   
						    break; 
			  
			  case 'Delete':
			  				 $this->db->where('id', $this->db->escape_str($this->input->post('announcementId')));
			  				 $this->db->where('co_id',$this->session->userdata('coid'));
							 $this->db->delete('announcements');
							 
							 break;
	          
           default	:break;
	  }   
	                      
	}
	
}

