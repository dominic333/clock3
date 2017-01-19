<?php

class Announcements extends MX_Controller
{
	public $data;	

	function __construct()
	{
		parent::__construct();
		$this->load->model('Announcements_model');
		$this->authentication->is_logged_in();
		$this->get_common();
	}
	
	public function index()
	{
		$this->authentication->check_admin_access();
		$compIdSess =$this->session->userdata('coid');
		$limit='';
		$this->data['listAnnouncements']	=	$this->Announcements_model->fetchAnnouncementsList($compIdSess,$limit);
		$this->data['view']					=	'ccannouncements/announcements';
		$this->load->view('master', $this->data);	
		
	}	
	
	//Function to add an announcement
	//By Dominic; Dec 01,2016 
	function addAnnouncement()
	{
		$this->authentication->check_admin_access();	
		if ($this->form_validation->run('addAnnouncementForm') === FALSE) 
		{
			redirect('ccannouncements/announcements');
		}
		else
		{
			$this->Announcements_model->announcementCRUD('Add');
			$announcement_id=$this->db->insert_id();	
			// save to log table	
			$operation = 'Announcement Has Been Posted with ID '.$announcement_id;
			$this->site_settings->adminlog($operation);
			
			$nType = 2; //announcements updates
			$nMsg  = 'New Announcement Added: '.$this->input->post('title');
			$this->site_settings->addNotification($nType,$nMsg,'');
			
			redirect('ccannouncements/announcements');
		}	
	}
	
	//Function to edit an announcement
	//By Dominic; Dec 01,2016 
	function editAnnouncement()
	{
		$this->authentication->check_admin_access();
		if ($this->form_validation->run('editAnnouncementForm') === FALSE) 
		{
			redirect('ccannouncements/announcements');
		}
		else
		{
			$announcement_id=$this->input->post('ancId');	
			$this->Announcements_model->announcementCRUD('Edit');
			
			// save to log table	
			$operation = 'Announcement Has Been Edited with ID '.$announcement_id;
			$this->site_settings->adminlog($operation);
			
			$nType = 2; //announcements updates
			$nMsg  = 'Announcement Edited: Sl No.'.$announcement_id;
			$this->site_settings->addNotification($nType,$nMsg,'');
			
			redirect('ccannouncements/announcements');
		}	
	}
	
	//Function to delete an announcement
	//By Dominic; Dec 01,2016 
	function deleteAnnouncement()
	{
		$this->authentication->check_admin_access();
		$announcement_id=$this->input->post('announcementId');
		$this->Announcements_model->announcementCRUD('Delete');
		
		// save to log table	
		$operation = 'Announcement Has Been Deleted with ID '.$announcement_id;
		$this->site_settings->adminlog($operation);
		
		$nType = 2; //announcements updates
		$nMsg  = 'Announcement Deleted Sl No.: '.$announcement_id;
		$this->site_settings->addNotification($nType,$nMsg,'');
		
		redirect('ccannouncements/announcements');
	}
	
	//Bridge to fetch latest announcements and display it in dashboard
	//By Dominic; Dec 05, 2016
	function getLatestAnnouncements($compIdSess,$limit)
	{
		$build_array 	= array();
      $build_array   = $this->getAllLatestAnnouncements($compIdSess,$limit);
      return $build_array;
	}
	
	//Function to fetch latest announcements and display it in dashboard
	//By Dominic; Dec 05, 2016
	function getAllLatestAnnouncements($compIdSess,$limit)
	{
		$latestAnnouncements	=	$this->Announcements_model->fetchAnnouncementsList($compIdSess,$limit);
		return $latestAnnouncements;
	}
	

	function get_common()
	{
		$this->site_settings->get_site_settings();
		$this->data['mynotifications']			=	$this->site_settings->fetchMyNotifications();
		$this->data['footer_includes']			=	'<script src="'.base_url().'js/cc/announcements.js" type="text/javascript"></script>';		
	}
}

