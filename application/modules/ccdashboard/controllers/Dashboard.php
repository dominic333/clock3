<?php

class Dashboard extends MX_Controller
{

	public $data;	

	function __construct()
	{
		parent::__construct();
		$this->load->library('encryption');
		$this->authentication->is_logged_in();			
		$this->load->model('Dashboard_model');

		$this->get_common();
	}
	
	public function index()
	{
		$this->authentication->check_admin_access();
		$compIdSess =$this->session->userdata('coid');
		//print_r($user_data);		
		
		$this->data['usersdetails']	=	modules::load('ccattendance/Attendance')->bridge_company_users_attendance_details();
		$this->data['company_details']	=	modules::load('ccadministration/Administration')->getCompanyInfo($compIdSess);
		$limit=4;
		$this->data['listAnnouncements']	=	modules::load('ccannouncements/announcements')->getLatestAnnouncements($compIdSess,$limit);
		
		$this->data['view']					=	'ccdashboard/index';
		$this->load->view('master', $this->data);	
		
	}	
	
	//Function to mark all notifications as read
	//Dominic, Feb 27, 2017
	function markAllNotificationsAsRead()
	{
	  $staffId	=		$this->session->userdata('mid');
	  $result	= 		$this->Dashboard_model->markAllNotificationsAsRead($staffId);
   	if($result == true)
   	{	
			echo "true";   	
   	}
   	else 
   	{
   		echo "false";
   	}
	}
	
	//Function to mark a notifications a read
	//Dominic, Feb 27, 2017
	function markThisNotificationsAsRead()
	{
	  $staffId	=		$this->session->userdata('mid');
	  $notification = $this->input->post('notification');
	  $result	= 		$this->Dashboard_model->markThisNotificationsAsRead($notification);
   	if($result == true)
   	{	
			echo "true";   	
   	}
   	else 
   	{
   		echo "false";
   	}
	}


	function get_common()
	{
		$this->data['footer_includes']			=	'<script src="'.base_url().'js/cc/announcements.js" type="text/javascript"></script>';	
		$this->data['mynotifications']			=	$this->site_settings->fetchMyNotifications();	
		$this->data['companyPlanDetails']		=	$this->site_settings->companyPlanDetails();
		$this->data['total_Users']					=	$this->site_settings->getCompanySize();

		/*
		
		
		$this->data['menus_all']		= 	modules::load('menus')->get_menus();
		$this->data['myprivileges']	=	$this->site_settings->myprivileges();
		$this->data['footer']			=	'<script src="'.base_url().'assets/products/js/products.js" type="text/javascript"></script>';	
		*/
	}
}

