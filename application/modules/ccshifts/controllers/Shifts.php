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
	
	public function users()
	{
		//check company type
		//if sme or free, don't show department dropdown
		$compIdSess =$this->session->userdata('coid');
		
		$this->data['companyType']				=  $this->Shifts_model->getCompanyType($compIdSess);
		$this->data['company_departments']	=	$this->Shifts_model->departmentsCRUD($compIdSess,'read');
		$this->data['company_shifts']			=	$this->Shifts_model->fetchCompanyShifts($compIdSess);
		$this->data['company_members']			=  $this->Shifts_model->getCompanyMembers($compIdSess);
		$this->data['view']					=	'ccshifts/user';
		$this->data['footer_includes']			=	'<script src="'.base_url().'js/cc/administration.js" type="text/javascript"></script>';
		$this->load->view('master', $this->data);	
		
	}
	
	//function to modify remote login feature
	//By Sajeev (Nov 25,2015)
	function edit_remote_login()
	{
		
		if ($this->form_validation->run('remote_login_frm') === FALSE) 
		{
			redirect('ccshifts/shifts/users');
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
				$this->Shifts_model->save('Edit_RemoteL','' );
	      	$staff_id = $this->input->post('rstaff_id');	
				// save to log table	
				$operation = 'Modified Remote Login for staff ID '.$staff_id;
         	$this->site_settings->adminlog($operation);
				
				$nType = 3; //company updates
				$nMsg  = 'Remote Login Modified for '.$this->input->post('rstaff_name');
				$this->site_settings->addNotification($nType,$nMsg,'');
				
				redirect('ccshifts/shifts/users');
			}			
		}	
	}

	
	//Function to delete users
	//@Author Farveen
	function delete_users($staff_id){
		if($staff_id!=''){
			$this->Users_model->delete_users($staff_id);
			// save to log table 
			$operation = 'Deleted staff with ID '.$staff_id;
         $this->site_settings->adminlog($operation);
			echo "<script>
				alert('User Deleted Successfully');
				window.location.href='".base_url().$this->lang->line("admin")."/users/modify_users';
				</script>";
			exit();
		}else{
			echo "<script>
				alert('Sorry No Staff Id Found');
				window.location.href='".base_url().$this->lang->line("admin")."/users/modify_users';
				</script>";
			exit();
		}
	}
	
	//function to edit users
	//@author Farveen
	function edit_user(){
		if($this->input->post('Submit')&&$this->input->post('staff_id')!=''){
			$this->Users_model->save('Edit_Users','' );
	      $staff_id = $this->input->post('staff_id');	
		   // save to log table 
			$operation = 'Edited staff with ID '.$staff_id;
         $this->site_settings->adminlog($operation);
			//redirect('/'.$this->lang->line("admin").'/departments/modify_departments');
			echo "<script>
				alert('User Edited Successfully');
				window.location.href='".base_url().$this->lang->line("admin")."/users/modify_users';
				</script>";
			exit();
		}else{
			redirect('/'.$this->lang->line("admin").'/users/modify_users');
		}
	}
	
	//function to change monitor attendance feature
	//By Sajeev (Nov 25,2015)
	function edit_monitor_attendance()
	{
		if($this->input->post('Submit')&&$this->input->post('mstaff_id')!='')
		{
			$this->Users_model->save('Edit_Monitoring','' );
	      $staff_id = $this->input->post('mstaff_id');	
		   // save to log table 
			$operation = 'Edited Monitor Attendance for staff with ID '.$staff_id;
         $this->site_settings->adminlog($operation);
			//redirect('/'.$this->lang->line("admin").'/departments/modify_departments');
			echo "<script>
				alert('User Edited Successfully');
				window.location.href='".base_url().$this->lang->line("admin")."/users/modify_users';
				</script>";
			exit();
		}
		else
		{
			redirect('/'.$this->lang->line("admin").'/users/modify_users');
		}
	}
	
	//Function to reset password/passcode
	//@author FArveen
	function forgot_user() 
	{
		if(($this->input->post('user_id'))&&($this->input->post('Submit'))&&($this->input->post('user_email')))
		{
			$this->send_password_reset_email();
			$this->Users_model->reset_password();
			echo "password";
		}
		else
		{
			echo "failed";
		}	
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
	
	public function shifts()
	{
		$this->data['view']					=	'ccshifts/shift';
		$this->data['footer_includes']			=	'<script src="'.base_url().'js/cc/shifts.js" type="text/javascript"></script>';
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