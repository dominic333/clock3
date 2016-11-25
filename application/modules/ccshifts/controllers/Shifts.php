<?php

class Shifts extends MX_Controller
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

		$this->data['view']					=	'ccshifts/department';
		$this->data['footer_includes']			=	'<script src="'.base_url().'js/cc/departments.js" type="text/javascript"></script>';
		$this->load->view('master', $this->data);	
		
	}	
	
	public function shifts()
	{

		$this->data['view']					=	'ccshifts/shift';
		$this->data['footer_includes']			=	'<script src="'.base_url().'js/cc/shifts.js" type="text/javascript"></script>';
		$this->load->view('master', $this->data);	
		
	}	
	
	public function users()
	{

		$this->data['view']					=	'ccshifts/user';
		$this->load->view('master', $this->data);	
		
	}
	
	public function whitelistips()
	{

		$this->data['view']					=	'ccshifts/white-list-ips';
		$this->data['footer_includes']			=	'<script src="'.base_url().'js/cc/whitelistips.js" type="text/javascript"></script>';
		$this->load->view('master', $this->data);	
		
	}
	
	public function assignmonitor()
	{

		$this->data['view']					=	'ccshifts/assignment';
		$this->load->view('master', $this->data);	
		
	}


	function get_common()
	{
		/*
		$this->site_settings->get_site_settings();
		$this->data['profile']			=	$this->site_settings->personal_details();	
		$this->data['menus_all']		= 	modules::load('menus')->get_menus();
		$this->data['myprivileges']	=	$this->site_settings->myprivileges();
		
		*/
			
	}
}

