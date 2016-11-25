<?php

class Account extends MX_Controller
{
	public $data;	

	function __construct()
	{
		parent::__construct();
		/*		
		$this->load->model('Products_model');
		$this->load->library('encryption');
		$this->authentication->is_logged_in();
		$this->get_common();
		*/
	}
	
	public function index()
	{

		$this->data['view']					=	'selfiemyaccount/profile';
		$this->load->view('master_selfie', $this->data);	
		
	}	


	function get_common()
	{
		/*
		$this->site_settings->get_site_settings();
		$this->data['profile']			=	$this->site_settings->personal_details();	
		$this->data['menus_all']		= 	modules::load('menus')->get_menus();
		$this->data['myprivileges']	=	$this->site_settings->myprivileges();
		$this->data['footer']			=	'<script src="'.base_url().'assets/products/js/products.js" type="text/javascript"></script>';	
		*/
	}
}

