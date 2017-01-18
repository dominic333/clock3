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
		/*
		$this->breadcrumbcomponent->add('<i class="fa fa-dashboard"></i>Home', base_url());		
		$this->breadcrumbcomponent->add($this->lang->line('bread_crumb_products'),  '#');
	   $this->data['breadcrumb']=$this->breadcrumbcomponent->output();
		$this->data['admin_page_title'] 	= 	$this->lang->line('admin_page_title_products');
		$this->data['pagetitle'] 	= 	$this->lang->line('pagetitle_products_list');
		$this->datatable_initialize();
		$tmpl = array ('table_open'  => '<table id="list_products"  class="table table-bordered responsive my_table table-striped">' );
		$this->table->set_template($tmpl); 
		$this->table->set_heading('ID', 'Location', 'Category','Title','Status','Edit', 'Delete');	
		$this->table->set_caption('<colgroup> <col class="con0"><col class="con1"><col class="con0"><col class="con1"></colgroup>');
		*/	
		
		$userIdSess =$this->session->userdata('mid');
		$this->data['user_data']	=	modules::load('users')->getUserDataFromUserID($userIdSess);
		$this->data['view']					=	'selfiedashboard/index';
		$this->load->view('master_selfie', $this->data);	
		
	}	


	function get_common()
	{
		$this->data['listAnnouncements']	=	$this->site_settings->fetchLatestAnnouncementsforUser();
		$this->site_settings->get_site_settings();
	}
}

