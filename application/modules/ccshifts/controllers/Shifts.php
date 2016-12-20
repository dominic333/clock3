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
	
	//Function to list departments
	public function index()
	{
		$this->authentication->check_admin_access();
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
		$this->authentication->check_admin_access();
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
		$this->authentication->check_admin_access();
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
		$this->authentication->check_admin_access();
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
	
	//Function to list all users
	public function users()
	{
		$this->authentication->check_admin_access();
		//check company type
		//if sme or free, don't show department dropdown
		$compIdSess =$this->session->userdata('coid');
		
		$this->data['companyType']				=  $this->Shifts_model->getCompanyType($compIdSess);
		$this->data['company_departments']	=	$this->Shifts_model->departmentsCRUD($compIdSess,'read');
		$this->data['company_shifts']			=	$this->Shifts_model->fetchCompanyShifts($compIdSess);
		$this->data['company_members']		=  $this->Shifts_model->getCompanyMembers($compIdSess);
		$this->data['view']					=	'ccshifts/user';
		$this->data['footer_includes']			=	'<script src="'.base_url().'js/cc/administration.js" type="text/javascript"></script>';
		$this->load->view('master', $this->data);	
		
	}

	//Function to add users 
	//By Dominic, Dec 19,2016
	function add_users()
	{
		$this->authentication->check_admin_access();
		if ($this->form_validation->run('frm_add_users') === FALSE)
		{
		redirect('ccshifts/shifts/users');
		}
		else
		{
			$max_user 		=	$this->Shifts_model->getCompanyMaxStaff();
	  		$current_user 	=	$this->Shifts_model->getCurrentNumUsers();
	  		if($max_user>$current_user)
			{
				if($this->Shifts_model->check_company_user_login_exists())
				{
					$this->data['alert'] = 'Login Name already exist';
					$this->load->view('admin/users/add',$this->data);
				}
				else
				{
					$this->Shifts_model->save('Add_Users','' );
			      $staff_id = $this->db->insert_id();	
			      if($staff_id!='')
			      {
			      	$this->Shifts_model->add_user_shifts($staff_id);
			     		//$this->send_user_welcomemail($staff_id);
				   	
				   	$operation = 'New User Added with staff ID '.$staff_id;
						$this->site_settings->adminlog($operation);
			
						$nType = 1; //company updates
						$nMsg  = 'New User Added '.$this->input->post('staff_name');
						$this->site_settings->addNotification($nType,$nMsg,'');
			      }
			      echo "<script>
						alert('Staff Added Successfully');
						window.location.href='".base_url()."ccshifts/shifts/users';
						</script>";
					exit();
				}	
			}
			else
			{
				$this->data['alert'] = 'Maximum Nunber User(s) ( '.$max_user.' ) Reached. Please contact us to upgrade your Plan.';
				redirect('ccshifts/shifts/users');
			}			
		}	
	}
	
	//function to modify remote login feature
	//By Dominic, Dec 12,2016
	function edit_remote_login()
	{
		$this->authentication->check_admin_access();
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
		$this->authentication->check_admin_access();
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
		$this->authentication->check_admin_access();
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
		$this->authentication->check_admin_access();		
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
		$this->authentication->check_admin_access();
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
		$this->authentication->check_admin_access();
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
			$this->authentication->check_admin_access();
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
			$this->authentication->check_admin_access();			
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
			$this->authentication->check_admin_access();
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
			$this->authentication->check_admin_access();
			$id=$this->db->escape_str($this->input->post('id'));
			$ip=$this->db->escape_str($this->input->post('ip'));
			$this->Shifts_model->delete_department_ip($id,$ip);
			
			// save to log table	
			$operation = 'Deleted White listed IP '.$ip;
			$this->site_settings->adminlog($operation);
			
			$nType = 3; //announcements updates
			$nMsg  = 'Removed White listed IP '.$ip;
			$this->site_settings->addNotification($nType,$nMsg,'');
			
			echo 'deleted';
		}	
		
	//Function to load shifts
	//By Dominic, Dec 13,2016
	public function shifts()
	{
		$this->authentication->check_admin_access();
		$compIdSess 					=	 $this->session->userdata('coid');
		$this->data['shifts'] 			= 	 $this->Shifts_model->get_all_shifts($compIdSess);
		$this->data['timezone_lists'] 	= 	 $this->Shifts_model->get_all_timezones();
		$this->data['view']				=	'ccshifts/shift';
		$this->data['footer_includes']	=	'<script src="'.base_url().'js/cc/shifts.js" type="text/javascript"></script>';
		$this->load->view('master', $this->data);		
	}

	//Function to add a shift
	//By Dominic, Dec 13,2016
	function add_shifts()
	{
		$this->authentication->check_admin_access();
		if ($this->form_validation->run('frm_add_shifts') === FALSE)
		{
			redirect('ccshifts/shifts/shifts');
		}
		else
		{
			$compIdSess =$this->session->userdata('coid');
			$this->Shifts_model->shiftsCRUD('Add_Shifts','' );
			$shift_id = $this->db->insert_id();
			// save to log table
			$operation = 'Added Shift with ID '.$shift_id.' for company '.$compIdSess;
			$this->site_settings->adminlog($operation);

			$nType = 3; //announcements updates
			$nMsg  = 'New Shift Added '.$this->input->post('shift_name');
			$this->site_settings->addNotification($nType,$nMsg,'');

			redirect('ccshifts/shifts/shifts');
		}
	}

	//Function to modify a shift
	//By Dominic, Dec 13,2016
	function modify_shifts()
	{
		$this->authentication->check_admin_access();
		if ($this->form_validation->run('frm_edit_shifts') === FALSE)
		{
			redirect('ccshifts/shifts/shifts');
		}
		else
		{
			$compIdSess =$this->session->userdata('coid');
			$this->Shifts_model->shiftsCRUD('Modify_Shifts','' );
			$shift_id = $this->input->post('shift_id');
			// save to log table
			$operation = 'Modified Shift with ID '.$shift_id.' for company '.$compIdSess;
			$this->site_settings->adminlog($operation);

			$nType = 3; //announcements updates
			$nMsg  = 'Shift Modified '.$this->input->post('shift_name');
			$this->site_settings->addNotification($nType,$nMsg,'');

			redirect('ccshifts/shifts/shifts');
		}
	}

	//Function to update Notification Time
	//By Dominic, Dec 13,2016
	function  updateNotificationTime()
	{
		$this->authentication->check_admin_access();
		if ($this->form_validation->run('formUpdateNotificationTime') === FALSE)
		{
			redirect('ccshifts/shifts/shifts');
		}
		else
		{
			$compIdSess =$this->session->userdata('coid');
			$this->Shifts_model->shiftsCRUD('Updated_Notify_Time','' );
			$shift_id = $this->input->post('shift_id');
			// save to log table
			$operation = 'Updated Notification TIme for Shift with ID '.$shift_id.' for company '.$compIdSess;
			$this->site_settings->adminlog($operation);

			$nType = 3; //announcements updates
			$nMsg  = 'Notification Time Updated for Shift '.$this->input->post('shift_name');
			$this->site_settings->addNotification($nType,$nMsg,'');

			redirect('ccshifts/shifts/shifts');
		}
	}
	
	//Function to fetch shifts of a company
	//By Dominic, Dec 14,2016
	function fetchCompanyShifts($compIdSess)
	{
		$company_shifts		=	$this->Shifts_model->fetchCompanyShifts($compIdSess);
		return $company_shifts;
	}
	
	//Bridge to fetch shifts of a company
	//By Dominic, Dec 14,2016
	function fetchShiftsofaCompany($compIdSess)
	{
		$build_array 	= array();
      $build_array   = $this->fetchCompanyShifts($compIdSess);
      return $build_array;  
	}
	
	//Function to load attendance monitor view
	//By Dominic, Dec 19,2016
	public function assignmonitor()
	{
		$this->authentication->check_admin_access();
		
		$compIdSess =$this->session->userdata('coid');
		$this->data['company_shifts']			=	$this->Shifts_model->fetchCompanyShifts($compIdSess);
		$this->data['company_members']		=  $this->Shifts_model->getCompanyMembers($compIdSess);
		$this->data['view']					=	'ccshifts/assignment';
		$this->data['footer_includes']	=	'<script src="'.base_url().'js/cc/assign.js" type="text/javascript"></script>';
		$this->load->view('master', $this->data);		
	}
	
	//Function to fetch users under a shift
	//By Dominic, Dec 19,2016
	function fetchUsersUnderThisShift()
	{
		$build_array 	= array();
		$shiftId=$this->db->escape_str($this->input->post('shiftId'));
		if($shiftId!='')
		{
			$build_array   =$this->Shifts_model->fetchUsersUnderThisShift($shiftId);
		}
		echo json_encode($build_array);
	}
	
	//Function to fetch users who monitor attendance for a shift
	//By Dominic, Dec 19,2016
	function fetchUsersMonitoringAttendanceForShift()
	{
		$build_array 	= array();
		$shiftId=$this->db->escape_str($this->input->post('shiftId'));
		if($shiftId!='')
		{
			$build_array   =$this->Shifts_model->fetchUsersMonitoringAttendanceForShift($shiftId);
		}
		echo json_encode($build_array);
	}

	//Function to assign users to a shift
	//By Dominic, Dec 19,2016
	function assignUsersToShift()
	{
		$users	=	$this->db->escape_str($this->input->post('users'));
		$shift	=	$this->db->escape_str($this->input->post('shift'));
		$this->Shifts_model->removeUserShifts($users);
		$this->Shifts_model->assignUsersToShift($shift,$users);
		$inserted = $this->db->insert_id();
		if($inserted!='')
		{
			echo 'updated';
		}
		else
		{
			echo 'rejected';
		}
	}

	//Function to remove monitors from shift
	//By Dominic, Dec 19,2016
	function removeMonitorForShift()
	{
		$users	=	$this->db->escape_str($this->input->post('users'));
		$shift	=	$this->db->escape_str($this->input->post('shift'));
		$this->Shifts_model->removeMonitorUserShifts($users,$shift);
		echo 'updated';
	}

	//Function to assign monitors to a shift
	//By Dominic, Dec 19,2016
	function assignMonitorForShift()
	{
		$users	=	$this->db->escape_str($this->input->post('users'));
		$shift	=	$this->db->escape_str($this->input->post('shift'));
		$this->Shifts_model->removeMonitorUserShifts($users,$shift);
		$this->Shifts_model->assignMonitorForShift($shift,$users);
		$inserted = $this->db->insert_id();
		if($inserted!='')
		{
			echo 'updated';
		}
		else
		{
			echo 'rejected';
		}
	}
	
	//Bridge to fetch company members
	function getAllCompanyMembers($compIdSess)
	{
		
		$build_array 	= array();
      $build_array   = $this->Shifts_model->getCompanyMembers($compIdSess);
      return $build_array;
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