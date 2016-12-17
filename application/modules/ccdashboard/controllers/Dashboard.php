<?php

class Dashboard extends MX_Controller
{

	public $data;	

	function __construct()
	{
		parent::__construct();
		$this->load->library('encryption');
		$this->authentication->is_logged_in();
		/*		
		$this->load->model('Products_model');		
		*/
		$this->get_common();
	}
	
	public function index()
	{
		$this->authentication->check_admin_access();
		$compIdSess =$this->session->userdata('coid');
		//print_r($user_data);
		$this->data['company_details']	=	modules::load('ccadministration/Administration')->getCompanyInfo($compIdSess);
		$limit=4;
		$this->data['listAnnouncements']	=	modules::load('ccannouncements/announcements')->getLatestAnnouncements($compIdSess,$limit);
		
		$this->data['view']					=	'ccdashboard/index';
		$this->load->view('master', $this->data);	
		
	}	


	function get_common()
	{
		$this->data['footer_includes']			=	'<script src="'.base_url().'js/cc/announcements.js" type="text/javascript"></script>';	
		$this->data['mynotifications']			=	$this->site_settings->fetchMyNotifications();	
		/*
		$this->site_settings->get_site_settings();
		
		$this->data['menus_all']		= 	modules::load('menus')->get_menus();
		$this->data['myprivileges']	=	$this->site_settings->myprivileges();
		$this->data['footer']			=	'<script src="'.base_url().'assets/products/js/products.js" type="text/javascript"></script>';	
		*/
	}
}

