<?php

class Dashboard_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
	}
	function readAnnouncement($an_id,$staff_id) 
	{
		// select * from announcement_log where an_id = $an_id
		
		$this->db->where('an_id',$an_id);
		$this->db->where('staff_id',$staff_id);
		$result	=	$this->db->get('announcements_log');
		if($result->num_rows()>0) 
		{
			
      		$data = array(		
                      
             	 				'status' 	=> 1,                       
		  		 			);
		  		$this->db->where('an_id',$an_id);
				$this->db->update('announcements_log', $data);
				if($this->db->affected_rows() > 0)
				{
					return true;				
				}
				else {
					return false;				
				}
			
		}
		else 
		{
				$data = array(		
									'an_id' 		=> $this->db->escape_str($this->input->post('announcementId')),                            
             	 				'staff_id' 	=> $this->session->userdata('mid'),                         
             	 				'status' 	=> 1,                       
		  		 			);
				$this->db->insert('announcements_log', $data);		
				$id = $this->db->insert_id();
				
				if($id)
				{
					return true;				
				}
				else {
					return false;				
				}
		
		}

		
	}
	
	
}

