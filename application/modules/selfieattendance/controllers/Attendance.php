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
		
		
		*/
		$this->authentication->is_logged_in();
		$this->get_common();
	}
	
	public function index()
	{

		$this->data['view']					=	'selfieattendance/my-attendance';
		$this->load->view('master_selfie', $this->data);	
		
	}	
	
	public function whosaroundtoday()
	{

		$this->data['view']					=	'selfieattendance/whos-around-today';
		$this->load->view('master_selfie', $this->data);	
		
	}	


	function get_common()
	{
		/*
		$this->site_settings->get_site_settings();
		$this->data['profile']			=	$this->site_settings->personal_details();	
		$this->data['menus_all']		= 	modules::load('menus')->get_menus();
		$this->data['myprivileges']	=	$this->site_settings->myprivileges();
		
		*/
		$this->data['listAnnouncements']	=	$this->site_settings->fetchLatestAnnouncementsforUser();
		$this->data['footer_includes']			=	'<script src="'.base_url().'js/snap/my-attendance.js" type="text/javascript"></script>';	
	}
}

