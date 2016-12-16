<?php

class Account extends MX_Controller
{
	public $data;	

	function __construct()
	{
		parent::__construct();

		$this->load->model('Account_model');
		$this->authentication->is_logged_in();
		$this->get_common();
	}
	
	public function index()
	{
		$userIdSess =$this->session->userdata('mid');
		$this->data['user_data']	=	modules::load('users')->getUserDataFromUserID($userIdSess);
		$this->data['view']			=	'selfiemyaccount/profile';
		$this->load->view('master_selfie', $this->data);	
		
	}

	//Function to update user info
	//By Dominic,Dec 12,2016
	public function updateUserInfo()
	{
		if ($this->form_validation->run('editProfileForm') === FALSE)
		{
			redirect('selfiemyaccount/account');
		}
		else
		{
			$userIdSess =$this->session->userdata('mid');
			$this->Account_model->updateUserInfo($userIdSess);

			// save to log table
			$operation = 'Edited User Information with ID '.$userIdSess;
			$this->site_settings->adminlog($operation);

			$staffnameSess =$this->session->userdata('staffname');
			$nType = 5; //company updates
			$nMsg  =  'User profile updated';
			$this->site_settings->addNotification($nType,$nMsg,'');

			redirect('selfiemyaccount/account/');
		}

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
		$this->data['listAnnouncements']	=	$this->site_settings->fetchLatestAnnouncementsforUser();
		$this->data['footer_includes']			=	'<script src="'.base_url().'js/snap/profile.js" type="text/javascript"></script>';
	}
}

