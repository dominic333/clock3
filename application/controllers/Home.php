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
						$userID= $row->staff_id;
						ini_set( 'session.name', 'vattdashb' );
						$this->session->set_userdata('mid', $row->staff_id);
						$this->session->set_userdata('coid', $row->id);
						$this->session->set_userdata('staffname', $row->staff_name);						
						$this->session->set_userdata('isadmin', $row->is_admin);											
						$this->session->set_userdata('baseurl', base_url());						
						$this->session->set_userdata('logged_in', true);						
					}

					// save to log table	
					$operation = 'Login Success: user ID '.$userID;
					$this->site_settings->adminlog($operation);
					
					//if staff, redirect to snap dashboard; no need to go to cc dashboard
					if($row->is_admin==0)
					{
						//redirect($this->lang->line("snap").'/dashboard');
						redirect('selfiemarking/selfie');
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
					  
					  $this->load->view('login', $this->data);
				}
			}		
		}
		
		//Function to login
		//By Dominic, Nov 24, 2016
		public function forgotpassword()
		{	
			$this->data['alert'] ='';
			$this->site_settings->get_site_settings();
			if ($this->form_validation->run('forgotPassResForm') === FALSE) 
			{
				$this->load->view('forgotpassword');
				return;
			}
			else
			{   
				if(!$this->Home_model->email_company_exists($this->input->post('email'),$this->input->post('companyName')))
				{					
					$this->data['alert'] .= '<p>Email Doesnt Not Exists in Company Login</p><br>';
					//echo validation_errors();
					$this->load->view('forgotpassword', $this->data);
					echo "<script>
						alert('Incorrect information provided');
						window.location.href='".base_url()."home/forgotpassword';
						</script>";
					exit();
				}
				else
				{
	  				//To email
				   $email = $this->input->post('email');
				   $cologin = $this->input->post('companyName');
	            
	            $password=$this->generateRandomString();
	            
	            $this->Home_model->save_new_password($email,$password);
	            $this->send_password_reset_email($email,$password);
	            $this->data['word'] ='Password';
	            echo "<script>
						alert('Password Reset And Successfully Mailed');
						window.location.href='".base_url()."home/login';
						</script>";
					exit();

				}
			}		
		}
		
		
		function generateRandomString($length = 6) 
		{
		    //$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		    $characters = 'ABCDEFGHJKMNPQRSTUVWXYZ';
		    $charactersLength = strlen($characters);
		    $randomString = '';
		    for ($i = 0; $i < $length; $i++) {
		        $randomString .= $characters[rand(0, $charactersLength - 1)];
		    }
		    return $randomString;
		} 
		
		//Function to send username and password to client for resetting
	   //Author FArveen
	   function send_password_reset_email($email,$password)
	   { 	   	
         $config = array(
			    'protocol'  => EMAIL_PROTOCOL,
			    'smtp_host' => EMAIL_SMTP_HOST,
			    'smtp_port' => EMAIL_SMTP_PORT,
			    'smtp_user' => EMAIL_SMTP_USER,
			    'smtp_pass' => EMAIL_SMTP_PASS,
			    'mailtype'  => EMAIL_MAILTYPE,
	       	 'charset'   => EMAIL_CHARSET,
	       	 'crlf' 		 => EMAIL_CRLF,
	  			 'newline'   => EMAIL_NEWLINE
	      );
			////$config['protocol']= "sendmail";
	      $this->load->library('email', $config);
	      $this->email->set_mailtype("html");
	      
	      $password=$password;
         $email_to=$email;
         $user=$this->Home_model->get_user_name($email);
         $login=$this->Home_model->get_login_name($email);
			$subject="clock-in.me : Password Reset Request.";
			$this->site_settings->get_site_settings();
         //$from = $this->config->item('smtp_server');
         $from = "cs@clock-in.me";
			
         $this->data['word'] 		=	'Password';
 	      $this->data['user'] 		=	$user;
 	      $this->data['email_to'] =	$email_to;
 	      $this->data['login'] 	=	$login;
 	      $this->data['pass'] 		=	$password;
 	      
 	      $this->data['phone']		=	'+632 917 8111';
 		 	$this->data['site']		=	'clock-in.me';	
 		 		   
		   $template = $this->load->view('email_templates/reset_template',$this->data,TRUE); 
			$this->email->from($from, 'Clock-in.me Customer Care');		
  			$this->email->to($email_to);
			$this->email->message($template);	
			$this->email->subject($subject);		
  	 		$this->email->send();
	  	 		      	   
	   }
		
		//Function to logout
		//By Dominic, Nov 24, 2016
		function logout()
		{			
			//unset and destroy session variables
			$data = array('mid' => '', 'coid' => '', 'staffname' => '' , 'isadmin' => '' , 'baseurl' => '' , 'logged_in' => '');
			$this->session->unset_userdata($data);
			$this->session->sess_destroy();
			redirect(base_url().'login');
		}
		

/*  ---------------------------------------------------------------------clockin v3 ends ----------------------------------------------------------          */
				
				
}