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
					//$username = $this->input->post('name');	
      			//$password = md5($this->input->post('password'));
      			//$companyname = $this->input->post('companyName');
      				
					$user_data	=	array();
					$user_data	=	modules::load('users')->getUserDataFromLoginInfo($staff_id);
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
	/**
	*  @author: Lissy(modified jisha on 30-3-16// change to link to reset password)
	*  @date :24-02-2016
	*  @return a new password
	*  @desc:For creating a new password and send an email notification
	*/
		function forgot_password()
		{
			// Form validation
			if ($this->form_validation->run('signout') === FALSE) {
				$this->data['email_validate'] = 1;
				$this->load->view('login', $this->data);
				return;
			}
			else {
				$email = $this->input->post('pass_forgot');
				$user_details = $this->Home_model->get_user_details($email);
				if (count($user_details) > 0) {
					$this->load->library('encryption');
					$en_user_id = $this->site_settings->get_encrypt_id($user_details->id);
					$link			= '<div class="contentEditable" align="center"><a target="_blank" href="'.base_url().'home/reset_password/'.$en_user_id.'" class="link2" style="bcolor:#ffffff;font-weight: bold;background:#B91D35; padding:15px 18px;-webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px;margin-top:20px;">
										Reset your Password</a></div>';
					$to_email 	= $user_details->email;
					$subject 	= 'Forgot Password (BIPS)';
					$message 	= 'Here’s the link for you to reset the password. Thanks again for using our services!  Click the button below the section to get the password changed for your account. 
                             <br><br>
                             Have questions? Get in touch with us via Facebook or Twitter, or email our support team.
                             <br><br>Thanking You,
                             <br><span style="color:#222222;">BIPS</span><br>'.$link;
					$this->site_settings->get_site_settings();
					$headers = $user_details->firstname . ' ' . $user_details->lastname ;
					$this->site_settings->send_email($to_email, $subject, $headers, $message);
					//mail($to_email, $subject, $message, $headers);
					$this->data['success_mail']='Password Reset Link Has Been Send To your E-mail';
					$this->load->view('login', $this->data);
				}
			}
		}
	/**
	*  @author: Jisha Jacob
	*  @date :30-03-2016
	*  @return a new password
	*  @param int $en_user_id id
	*  @desc:For resetting password
	*/
		function reset_password($en_user_id)
		{
			$this->load->library('encryption');
			$user_id 								= $this->site_settings->get_decrypt_id($en_user_id);
			$this->data['en_user_id']			= $en_user_id;
			$this->data['admin_page_title']	= $this->lang->line('reset_password');
			// Form validation
			if ($this->form_validation->run('reset_password') === FALSE) {
				$this->load->view('reset_password', $this->data);
				return;
			}
			else{
				$password				= $this->db->escape_str($this->input->post('password'));
				$confirm_password		= $this->db->escape_str($this->input->post('cnfm_password'));
				$password				= $this->site_settings->get_encrypt_password($password);
				$this->Home_model->update_password($user_id, $password);
				$operation 				= $this->lang->line('log_update_password').$user_id;
				$this->site_settings->adminlog($operation);
				$this->data['alert'] = $this->lang->line('reset_success_msg');
				$this->load->view('login', $this->data);			
			}
		}
	/**
	*  @author: Lissy SR
	*  @date :24-02-2016
	*  @param str $email email
	*  @return true or false
	*  @desc:For checking whether the entered email is exist or not
	*/	
		public function email_exist_check()
		{
			$email=$this->input->post('pass_forgot');
			$validate_email=$this->Home_model->check_email($email);
			if($validate_email===TRUE){
				return TRUE;
			}
			else {
				$this->form_validation->set_message('email_exist_check', 'The {field} Does Not Exist');
				return FALSE;		
			}	
		}

		/**
		*  @author: Jisha Jacob
		*  @date :15-03-2016
		*  @return nil
		*  @desc:For permission error redirection
		*/
		function permission_error()
		{
			$this->data['alert']    = "Sorry !!!!!!!!  You don't have Permission to Access this facility !!!!!!!!!";
			$this->data['back_url'] = strval(isset($_SERVER['HTTP_REFERER']));
			$this->load->view('permission_error', $this->data);
		}
		

			
				
}