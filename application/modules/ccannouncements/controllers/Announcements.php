<?php

class Announcements extends MX_Controller
{
	public $data;	

	function __construct()
	{
		parent::__construct();
		$this->load->model('Announcements_model');
		/*		
		
		$this->load->library('encryption');
		$this->authentication->is_logged_in();
		
		*/
		$this->get_common();
	}
	
	public function index()
	{
		$compIdSess =$this->session->userdata('coid');
		$this->data['listAnnouncements']	=	$this->Announcements_model->fetchAnnouncementsList($compIdSess);
		
		$this->data['view']					=	'ccannouncements/announcements';
		$this->load->view('master', $this->data);	
		
	}	
	
	//Function to add an announcement
	//By Dominic; Dec 01,2016 
	function addAnnouncement()
	{	
		if ($this->form_validation->run('addAnnouncementForm') === FALSE) 
		{
			$this->index();
		}
		else
		{
			$this->Announcements_model->announcementCRUD('Add');
			$announcement_id=$this->db->insert_id();	
			// save to log table	
			//$operation = 'Announcement Has Been Posted with ID '.$announcement_id;
			//$this->site_settings->adminlog($operation);
			
			$this->index();
		}	
	}
	
	//Function to edit an announcement
	//By Dominic; Dec 01,2016 
	function editAnnouncement()
	{
		if ($this->form_validation->run('editAnnouncementForm') === FALSE) 
		{
			$this->index();
		}
		else
		{
			$this->Announcements_model->announcementCRUD('Edit');
			$announcement_id=$this->db->insert_id();	
			
			// save to log table	
			//$operation = 'Announcement Has Been Edited with ID '.$announcement_id;
			//$this->site_settings->adminlog($operation);
			
			$this->index();
		}	
	}
	
	//Function to delete an announcement
	//By Dominic; Dec 01,2016 
	function deleteAnnouncement()
	{
		$this->Announcements_model->announcementCRUD('Delete');
		$announcement_id=$this->db->insert_id();	
		
		// save to log table	
		//$operation = 'Announcement Has Been Deleted with ID '.$announcement_id;
		//$this->site_settings->adminlog($operation);
		
		$this->index();
	}


	function get_common()
	{
		$this->site_settings->get_site_settings();
		$this->data['footer_includes']			=	'<script src="'.base_url().'js/cc/announcements.js" type="text/javascript"></script>';		
	}
}

