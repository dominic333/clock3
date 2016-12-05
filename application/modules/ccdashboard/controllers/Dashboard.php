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
		/*
		if(!$this->site_settings->has_privilege('List Product'))
		{
			redirect('home/permission_error');
		}
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
		/*
		$this->site_settings->get_site_settings();
		$this->data['profile']			=	$this->site_settings->personal_details();	
		$this->data['menus_all']		= 	modules::load('menus')->get_menus();
		$this->data['myprivileges']	=	$this->site_settings->myprivileges();
		$this->data['footer']			=	'<script src="'.base_url().'assets/products/js/products.js" type="text/javascript"></script>';	
		*/
	}
}

