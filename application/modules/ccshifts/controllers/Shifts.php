<?php

class Shifts extends MX_Controller
{
	public $data;	

	function __construct()
	{
		parent::__construct();
		$this->load->model('Shifts_model');
		/*		
		
		$this->load->library('encryption');
		$this->authentication->is_logged_in();
		
		*/
		$this->get_common();
	}
	
	public function index()
	{
		$compIdSess =$this->session->userdata('coid');
		$this->data['company_departments']	=	$this->Shifts_model->departmentsCRUD($compIdSess,'read');
		$this->data['view']						=	'ccshifts/department';
		$this->data['footer_includes']		=	'<script src="'.base_url().'js/cc/departments.js" type="text/javascript"></script>';
		$this->load->view('master', $this->data);	
		
	}	
	
	//Function to add a department under a company
	//Dominic, December 09,2016
	public function addDepartments()
	{
		if ($this->form_validation->run('addDepartmentForm') === FALSE) 
		{
			redirect('ccshifts/shifts');
		}
		else
		{
			$check_department_exist=$this->Shifts_model->department_exist();
			if(count($check_department_exist)>0)
			{
				$this->data['alert'] = 'Department already exist';
				redirect('ccshifts/shifts');
			}
			else 
			{
				$compIdSess =$this->session->userdata('coid');
				$this->Shifts_model->departmentsCRUD($compIdSess,'create');
				$dept_id=$this->db->insert_id();	
				// save to log table	
				$operation = 'New department added with ID '.$dept_id.' under company '.$compIdSess;
				$this->site_settings->adminlog($operation);

				$nType = 3; //company updates
				$nMsg  = 'New Department Added: '.$this->input->post('department');
				$this->site_settings->addNotification($nType,$nMsg,'');
				
				redirect('ccshifts/shifts');
			}			
		}			
	}	
	
	
	//Function to edit departments
	//Dominic, December 09,2016
	function editDepartment()
	{	
	
		if ($this->form_validation->run('editDepartmentForm') === FALSE) 
		{
			redirect('ccshifts/shifts');
		}
		else
		{
			$check_department_exist=$this->Shifts_model->department_exist();
			if(count($check_department_exist)>0)
			{
				$this->data['alert'] = 'Department already exist';
				redirect('ccshifts/shifts');
			}
			else 
			{
				$compIdSess =$this->session->userdata('coid');
		  		$check_department_exist=$this->Shifts_model->department_exist_edit();
				if(count($check_department_exist)>0)
				{
		  			$this->data['alert']	= 'Another Department Exists';
		  		}
		  		else
		  		{
		  			$dept_id=$this->input->post('dept_id');
		  			$newDepartment=$this->input->post('department');
	  			   $this->Shifts_model->departmentsCRUD($compIdSess,'update');
	  				$this->data['alert']	= 'Udpated Sucessfully';	
	  				
	  				// save to log table	
					$operation = 'Changed department name of dept '.$dept_id.' under company '.$compIdSess;
					$this->site_settings->adminlog($operation);
					
					$nType = 3; //company updates
					$nMsg  = 'Department Name Changed to: '.$newDepartment;
					$this->site_settings->addNotification($nType,$nMsg,'');
		  		}				
				redirect('ccshifts/shifts');
			}			
		}		
	} 	
	
	//Function to delete a department
	//Dominic, December 10,2016
	function deleteDepartments()
	{
		if($this->input->post('dept_id')&&$this->input->post('company_id'))
		{
			if($this->Shifts_model->check_department_shift_exists()||$this->Shifts_model->check_department_shift_user_exists())
			{
				echo 'exists';
			}
			else
			{ 
				$dept_id=$this->input->post('dept_id');
				$compIdSess =$this->session->userdata('coid');
				
			   //If not Exists Okay to delete
				$this->Shifts_model->departmentsCRUD($compIdSess,'delete');
				
				// save to log table	
				$operation = 'Deleted department '.$dept_id.' under company '.$compIdSess;
				$this->site_settings->adminlog($operation);
				
				$nType = 3; //company updates
				$nMsg  = 'Deleted Department Sl. No: '.$dept_id;
				$this->site_settings->addNotification($nType,$nMsg,'');
					
				echo 'deleted';
			}
		}
	}
	
	public function shifts()
	{

		$this->data['view']					=	'ccshifts/shift';
		$this->data['footer_includes']			=	'<script src="'.base_url().'js/cc/shifts.js" type="text/javascript"></script>';
		$this->load->view('master', $this->data);	
		
	}	
	
	public function users()
	{
		//check company type
		//if sme or free, don't show department dropdown
		$compIdSess =$this->session->userdata('coid');
		
		$this->data['companyType']				=  $this->Shifts_model->getCompanyType($compIdSess);
		$this->data['company_departments']	=	$this->Shifts_model->departmentsCRUD($compIdSess,'read');
		$this->data['companyMembers']			=  $this->Shifts_model->getCompanyMembers($compIdSess);
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
		$this->data['mynotifications']			=	$this->site_settings->fetchMyNotifications();
		/*
		$this->site_settings->get_site_settings();
		$this->data['profile']			=	$this->site_settings->personal_details();	
		$this->data['menus_all']		= 	modules::load('menus')->get_menus();
		$this->data['myprivileges']	=	$this->site_settings->myprivileges();
		
		*/
			
	}
}

