<?php

class Users extends MX_Controller
{	

	public $data;	

	function __construct()
	{
		parent::__construct();
		$this->load->model('Users_model');
		$this->load->library('encryption');
		//$this->authentication->is_logged_in();
		//$this->get_common();
	}

	public function index()
	{				
		if(!$this->site_settings->has_privilege('List Users'))
		{
			redirect('home/permission_error');
		}	
		$this->breadcrumbcomponent->add('<i class="fa fa-dashboard"></i>Home', base_url());		
		$this->breadcrumbcomponent->add($this->lang->line('bread_crumb_users'),  '#');
	   $this->data['breadcrumb']=$this->breadcrumbcomponent->output();	
		//set page title	
		$this->data['admin_page_title'] 	= $this->lang->line('user_heading');
		$this->data['pagetitle'] 			= 	$this->lang->line('pagetitle_user_list');	
		$this->list_datatable();
		$this->data['view']					= $this->lang->line('users').'/list';
		$this->load->view('master', $this->data);
	} 
	
	//Bridge: To fetch user info based on user Id
	//Dominic: Nov 24,2016
	function getUserDataFromUserID($staffId)
	{
		$build_array 	= array();
      $build_array   = $this->getThisUserDataFromUserID($staffId);
      return $build_array;     
	}

	//Function: To fetch user info based on user Id
	//Dominic: Nov 24,2016
	function getThisUserDataFromUserID($staffId)
	{
		$userInfo=$this->Users_model->getThisUserDataFromUserID($staffId);
		return $userInfo;
	}

	function get_common()
	{
		$this->site_settings->get_site_settings();
		$this->data['profile']			=  $this->site_settings->personal_details();	
		$this->data['menus_all']		= 	modules::load('menus')->get_menus();
		$this->data['myprivileges']	=	$this->site_settings->myprivileges();
		$this->data['tree1']				=	'settings';
		$this->data['footer']    		= '<script src="'.base_url().'js/plugins/cropbox.js" type="text/javascript"></script>';
		$this->data['footer']    		.= '<script src="'.base_url().'/assets/'.$this->lang->line('users').'/js/users.js" type="text/javascript"></script>';
		
	}	
}