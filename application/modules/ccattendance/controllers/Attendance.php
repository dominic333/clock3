<?php

class Attendance extends MX_Controller
{
	public $data;	

	function __construct()
	{
		parent::__construct();
		/*		
		$this->load->model('Products_model');
		$this->load->library('encryption');
		$this->authentication->is_logged_in();
		
		*/
		$this->get_common();
	}
	
	public function index()
	{

		$this->data['view']					=	'ccattendance/my-attendance';
		$this->data['footer_includes']			=	'<script src="'.base_url().'js/cc/my-attendance.js" type="text/javascript"></script>';
		$this->load->view('master', $this->data);	
		
	}	
	
	public function whosaroundtoday()
	{

		$this->data['view']					=	'ccattendance/whos-around-today';
		$this->data['footer_includes']			=	'<script src="'.base_url().'js/cc/whos-around-today.js" type="text/javascript"></script>';
		$this->load->view('master', $this->data);	
		
	}	


	function get_common()
	{
		$this->data['mynotifications']			=	$this->site_settings->fetchMyNotifications();
		/*
		$this->site_settings->get_site_settings();
		$this->data['profile']			=	$this->site_settings->personal_details();	
		$this->data['menus_all']		= 	modules::load('menus')->get_menus();
		$this->data['myprivileges']	=	$this->site_settings->myprivileges();
		
		*/
			
	}
}

