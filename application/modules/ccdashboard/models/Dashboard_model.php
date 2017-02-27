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
	
	//Function to mark all notifications as read
	//Dominic, Feb 27, 2017
	function markThisNotificationsAsRead($notification)
	{
		//UPDATE `clock2`.`notifications` SET `readStatus` = '1' WHERE `notifications`.`id` = 1;
		$data			=	array(
							'readStatus'	=> 1	
						);	
				
		$this->db->where('id',$notification);
		$this->db->update('notifications',$data);
		if($this->db->affected_rows() > 0)
		{
			return true;		
		}
		else
		{
			return false;		
		}
	}
	
}

