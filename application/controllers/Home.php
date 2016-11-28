<?php
class Home extends MX_Controller
{	

		public $data;

		function __construct()
		{
			parent::__construct();
			$this->site_settings->get_site_settings();	
			$this->load->model('Home_model');	
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->form_validation->CI =& $this;
		}

		//Index Function
		//By Dominic, Nov 24, 2016
		function index()
		{
			$this->data= array();
			$this->authentication->is_logged_in();
			if($this->session->userdata('mid') && $this->session->userdata('logged_in'))
			{	
				$isadmin=$this->session->userdata('isadmin');	
		
				//staff
				if($isadmin==0)
				{
					redirect($this->lang->line("snap").'/dashboard');
				}
				else
				{
					redirect($this->lang->line("cc").'/dashboard');		
				}			
			}
			else
			{
				$this->load->view('login', $this->data);
			}		 
		}

		//Function to login
		//By Dominic, Nov 24, 2016
		public function login()
		{	

			$this->site_settings->get_site_settings();
			// Form validation
			if ($this->form_validation->run('login') === FALSE) 
			{
				$this->load->view('login');
				return;
			}
			else
			{   
				$staff_id=$this->Home_model->check_login();
				if($staff_id!=0)
				{
      			
      			
					$user_data	=	array();
					$user_data	=	modules::load('users')->getUserDataFromUserID($staff_id);

					foreach($user_data as $row)
					{
						ini_set( 'session.name', 'vattdashb' );
						$this->session->set_userdata('mid', $row->staff_id);
						$this->session->set_userdata('coid', $row->id);
						$this->session->set_userdata('staffname', $row->staff_name);						
						$this->session->set_userdata('isadmin', $row->is_admin);											
						$this->session->set_userdata('baseurl', base_url());						
						$this->session->set_userdata('logged_in', true);						
					}

					//$this->site_settings->loginlog(1);
					
					//if staff, redirect to snap dashboard; no need to go to cc dashboard
					if($row->is_admin==0)
					{
						redirect($this->lang->line("snap").'/dashboard');
					}
					else
					{
						redirect($this->lang->line("cc").'/dashboard');
					}	
					
					
				}
				else
				{
					  $this->data = array(
						   'alert' => '<span class="log_fail">Login Failed</span>'
					  );
					  //$this->data['is_mobile']=$this->check_mobile();
					  //$this->site_settings->loginlog(0);
					  $this->load->view('login', $this->data);
				}
			}		
		}
		
		//Function to logout
		//By Dominic, Nov 24, 2016
		function logout()
		{
			// save to log table 
			//$operation = $this->lang->line('log_logout_msg');
			//$this->site_settings->adminlog($operation);
			
			//unset and destroy session variables
			$data = array('mid' => '', 'coid' => '', 'staffname' => '' , 'isadmin' => '' , 'baseurl' => '' , 'logged_in' => '');
			$this->session->unset_userdata($data);
			$this->session->sess_destroy();
			redirect(base_url().'login');
		}
		

/*  ---------------------------------------------------------------------clockin v3 ends ----------------------------------------------------------          */
		
		//Function to check mobile or table or computer
		function check_mobile()
		{
			$this->load->library('Mobile_Detect');
			$detect = new Mobile_Detect();
	    	if ($detect->isMobile() || $detect->isTablet() || $detect->isAndroidOS()) 
	    	{
	        return true;
	    	}
	    	else
	    	{
	    		return false;
	    	}
		}

		

			
				
}