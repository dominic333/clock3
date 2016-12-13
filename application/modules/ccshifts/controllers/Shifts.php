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
	//By Dominic, Dec 12,2016
	function edit_remote_login()
	{
		if ($this->form_validation->run('remote_login_frm') === FALSE) 
		{
			redirect('ccshifts/shifts/users');
		}
		else
		{
			$this->Shifts_model->save('Edit_RemoteL','' );
	      	$staff_id = $this->input->post('rstaff_id');
			$rvaule=$this->input->post('rremotelogin');
			if($rvaule==1)
			{
				$rval='Enabled';
			}
			else
			{
				$rval='Disabled';
			}
			// save to log table
			$operation = 'Modified Remote Login for staff ID '.$staff_id;
         	$this->site_settings->adminlog($operation);
				
			$nType = 3; //company updates
			$nMsg  = 'Remote Login '.$rval.' for '.$this->input->post('rstaff_name');
			$this->site_settings->addNotification($nType,$nMsg,'');
				
			redirect('ccshifts/shifts/users');
		}	
	}

	//Function to change monitor attendance feature
	//By Dominic, Dec 12,2016
	function edit_monitor_attendance()
	{
		if ($this->form_validation->run('monitor_attendance_frm') === FALSE)
		{
			redirect('ccshifts/shifts/users');
		}
		else
		{
			$this->Shifts_model->save('Edit_Monitoring','' );
			$staff_id = $this->input->post('mstaff_id');
			$mvalue=$this->input->post('mmonitor');
			if($mvalue==1)
			{
				$mval='Enabled';
			}
			else
			{
				$mval='Disabled';
			}
			// save to log table
			$operation = 'Edited Monitor Attendance for staff with ID '.$staff_id;
			$this->site_settings->adminlog($operation);

			$nType = 3; //company updates
			$nMsg  = 'Attendance Monitoring '.$mval.' for '.$this->input->post('mstaff_name');
			$this->site_settings->addNotification($nType,$nMsg,'');
			redirect('ccshifts/shifts/users');
		}
	}
	
	//Function to change staff type of a user
	//By Dominic, Dec 13,2016
	function change_user_shift_type()
	{
		if ($this->form_validation->run('user_shiftchange_frm') === FALSE)
		{
			redirect('ccshifts/shifts/users');
		}
		else
		{
			$this->Shifts_model->save('Edit_StaffType','' );
			$staff_id = $this->input->post('ststaff_id');
			$ststaffType=$this->input->post('ststaffType');
			if($ststaffType==1)
			{
				$staffType='Normal Shift User';
			}
			else
			{
				$staffType='Flexible Shift User';
			}
			// save to log table
			$operation = 'Edited Staff Type for staff with ID '.$staff_id;
			$this->site_settings->adminlog($operation);

			$nType = 3; //company updates
			$nMsg  = $this->input->post('ststaff_name').' changed to '.$staffType;
			$this->site_settings->addNotification($nType,$nMsg,'');
			redirect('ccshifts/shifts/users');
		}
	}

	//Function to reset password
	//By Dominic, Dec 12,2016
	function forgot_user()
	{
		if ($this->form_validation->run('forgot_user_frm') === FALSE)
		{
			echo "failed";
		}
		else
		{
			//$this->send_password_reset_email();
			$this->Shifts_model->reset_password();
			$staff_id = $this->input->post('user_id');
			// save to log table
			$operation = 'Password Changed for staff with ID '.$staff_id;
			$this->site_settings->adminlog($operation);

			$nType = 3; //company updates
			$nMsg  = 'Password Changed for '.$this->input->post('user_name');
			$this->site_settings->addNotification($nType,$nMsg,'');
			echo "password";
		}
	}

	//Function to edit user info
	//By Dominic, Dec 12,2016
	function edit_user()
	{
		if ($this->form_validation->run('edit_user_frm') === FALSE)
		{
			redirect('ccshifts/shifts/users');
		}
		else
		{
			$this->Shifts_model->save('Edit_Users','' );
			$staff_id = $this->input->post('staff_id');
			// save to log table
			$operation = 'Edited staff with ID '.$staff_id;
			$this->site_settings->adminlog($operation);

			$nType = 3; //company updates
			$nMsg  = 'Updated Info of '.$this->input->post('staff_name');
			$this->site_settings->addNotification($nType,$nMsg,'');
			redirect('ccshifts/shifts/users');
		}
	}
	
	//Function to delete users
	//By Dominic, Dec 12,2016
	function delete_users($staff_id,$staff_name)
	{
		if($staff_id!='')
		{
			$this->Shifts_model->delete_users($staff_id);
			// save to log table 
			$operation = 'Deleted staff with ID '.$staff_id;
         	$this->site_settings->adminlog($operation);

			$nType = 3; //company updates
			$nMsg  = 'Deleted user '.$staff_name;
			$this->site_settings->addNotification($nType,$nMsg,'');

			redirect('ccshifts/shifts/users');
		}
		else
		{
			redirect('ccshifts/shifts/users');
		}
	}
	
		//Function to list white-listed IPs
		//By Dominic, Dec 13,2016
		public function whitelistips()
		{
			$compIdSess =$this->session->userdata('coid');
		
			$this->data['whitelistedIps']				=  $this->Shifts_model->getWhiteListedIPs($compIdSess);
			$this->data['view']					=	'ccshifts/white-list-ips';
			$this->data['footer_includes']			=	'<script src="'.base_url().'js/cc/whitelistips.js" type="text/javascript"></script>';
			$this->load->view('master', $this->data);	
		}
	
	
		//Function to add white-listed IPs
		//By Dominic, Dec 13,2016
		function add_department_ips()
		{			
			if ($this->form_validation->run('frm_add_department_ip') === FALSE) 
			{
				redirect('ccshifts/shifts/whitelistips');
			}
			else
			{	
				$compIdSess =$this->session->userdata('coid');
				$check_ip_exist=$this->Shifts_model->check_ip_exist();
				if(count($check_ip_exist)>0)
				{
					redirect('ccshifts/shifts/whitelistips');
				}
				else 
				{		
					$ip_addr=$this->input->post('department_ip');					
					$this->Shifts_model->add_department_ip($ip_addr);
					
	            // save to log table	
					$operation = 'New IP whitelisted '.$ip_addr.' for company '.$compIdSess;
					$this->site_settings->adminlog($operation);
					
					$nType = 3; //company updates
					$nMsg  = 'White-listed IP: '.$ip_addr;
					$this->site_settings->addNotification($nType,$nMsg,'');
					
					redirect('ccshifts/shifts/whitelistips');
			   }							
			}				
		}
	
	
		//Function to modify white-listed IPs
		//By Dominic, Dec 13,2016
		function modify_department_ips()
		{
			if ($this->form_validation->run('frm_edit_whitelisted_ip') === FALSE) 
			{
				redirect('ccshifts/shifts/whitelistips');
			}
			else
			{	
				$compIdSess =$this->session->userdata('coid');
				$check_ip_exist=$this->Shifts_model->check_ip_exist();
				if(count($check_ip_exist)>0)
				{
					redirect('ccshifts/shifts/whitelistips');
				}
				else 
				{	
		
					$whitelist_id=$this->input->post('whitelist_id');			
					$ip_addr=$this->input->post('department_ip');					
					$this->Shifts_model->edit_department_ip($whitelist_id,$ip_addr);
					
	            // save to log table	
					$operation = 'Edited whitelisted IP'.$ip_addr.' for company '.$compIdSess;
					$this->site_settings->adminlog($operation);
					
					$nType = 3; //company updates
					$nMsg  = 'Edited White-listed IP: '.$ip_addr;
					$this->site_settings->addNotification($nType,$nMsg,'');
					
					redirect('ccshifts/shifts/whitelistips');
			   }							
			}
		}
		
		//Function to delete a whitelisted ip
		//By Dominic, Dec 13,2016
		function deleteWhiteListedIP()
		{
			$id=$this->input->post('id');
			$ip=$this->input->post('ip');
			$this->Shifts_model->delete_department_ip($id,$ip);
			
			// save to log table	
			$operation = 'Deleted White listed IP '.$ip;
			$this->site_settings->adminlog($operation);
			
			$nType = 3; //announcements updates
			$nMsg  = 'Removed White listed IP '.$ip;
			$this->site_settings->addNotification($nType,$nMsg,'');
			
			echo 'deleted';
		}	
		
	
	public function assignmonitor()
	{
		$this->data['view']					=	'ccshifts/assignment';
		$this->load->view('master', $this->data);		
	}
	
	public function shifts()
	{
		$compIdSess 							=	 $this->session->userdata('coid');
		$shifts 									= 	 $this->Shifts_model->get_department_shifts($compIdSess);
		$this->data['view']					=	'ccshifts/shift';
		$this->data['footer_includes']	=	'<script src="'.base_url().'js/cc/shifts.js" type="text/javascript"></script>';
		$this->load->view('master', $this->data);		
	}

	function get_common()
	{
		$this->data['mynotifications']			=	$this->site_settings->fetchMyNotifications();
		$this->site_settings->get_site_settings();
		/*
		$this->data['profile']			=	$this->site_settings->personal_details();	
		$this->data['menus_all']		= 	modules::load('menus')->get_menus();
		$this->data['myprivileges']	=	$this->site_settings->myprivileges();
		
		*/
			
	}
}