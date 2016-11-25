<?php

class Administration extends MX_Controller
{
	public $data;	

	function __construct()
	{
		parent::__construct();
		$this->load->library('encryption');
		$this->authentication->is_logged_in();
		$this->load->model('Administration_model');
		
		//$this->get_common();
	}
	
	public function index()
	{

		$this->data['view']					=	'ccadministration/company';
		$this->load->view('master', $this->data);	
		
	}	
	
	public function contactsupport()
	{

		$this->data['view']					=	'ccadministration/contact-support';
		$this->load->view('master', $this->data);	
		
	}	
	
	//Bridge: To fetch user's company info based on user Id
	//Dominic: Nov 25,2016
	function getUserCompanyInfo($staffId)
	{
		$build_array 	= array();
      $build_array   = $this->getThisUserCompanyInfo($staffId);
      return $build_array;     
	}

	//Function: To fetch user's company info based on user Id
	//Dominic: Nov 25,2016
	function getThisUserCompanyInfo($staffId)
	{
		$userInfo=$this->Users_model->getThisUserDataFromLoginInfo($staffId);
		return $userInfo;
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

