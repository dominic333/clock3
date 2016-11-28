<?php

class Administration extends MX_Controller
{
	public $data;	

	function __construct()
	{
		parent::__construct();
		$this->load->library('encryption');
		$this->authentication->is_logged_in();
		$this->load->model('Administration_model');
		
		$this->get_common();
	}
	
	//Function to load company details view
	//By Dominic, Nov 28,2016
	public function index()
	{
		$compIdSess =$this->session->userdata('coid');
		//print_r($user_data);
		$this->data['company_details']	=	$this->getThisCompanyInfo($compIdSess);
		$this->data['view']					=	'ccadministration/company';
		$this->load->view('master', $this->data);	
		
	}	
	
	//Function to update company info
	//By Dominic, Nov 28,2016
	public function updateCompanyInfo()
	{
		if ($this->form_validation->run('editCompanyInfoForm') === FALSE) 
		{
			$this->index();
		}
		else
		{
			$companyId=$this->session->userdata('coid');   
			$this->Administration_model->updateCompanyInfo($companyId);
	
         // save to log table	
			//$operation = 'Edited Company Information with ID '.$companyId;
			//$this->site_settings->adminlog($operation);
			
		   $this->index();
		}	
		
	}	
	
	//Function to send mail to support
	//By Dominic, Nov 28,2016
	public function contactsupport()
	{

		if ($this->form_validation->run('editCompanyInfoForm') === FALSE) 
		{
			$this->data['view']					=	'ccadministration/contact-support';
		   $this->load->view('master', $this->data);	
		}
		else
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
			//$config['protocol']= "sendmail";
	      $this->load->library('email', $config);
	      $this->email->set_mailtype("html");
	      
	      //$email_to 	= 	"ask@clock-in.me";
	      $email_to 	= 	"dominic@cliffsupport.com";
	      $email_from	=	$this->input->post('sender_email');
	      $user			=	$this->input->post('sender_name');
	      $message		=	$this->input->post('sender_message');
	      $subject		=	"clock-in.me : New Query from ".$user;
	      
			//$this->site_settings->get_site_settings();
	      
	 	      
	    	$this->data['user'] 			=	$user;
	 	   $this->data['email_to'] 	=	$email_to;
	 	   $this->data['email_from'] 	=	$email_from;
	 	   $this->data['message']		=	$message;
	 	   $this->data['phone']			=	'+1617 778 2299';
	 		$this->data['site']			=	'clock-in.me';	   
		   
		   //$bcc_list = array('sean@flexiesolutions.com', 'albert.goh@flexiesolutions.com');
		   $bcc_list = array('dominiccliff88@gmail.com');
		   
		   
		   //$template = $this->load->view($this->lang->line('admin').'/company/contact_template',$this->data,TRUE); 
			$this->email->from($email_from, $user);			
	  		$this->email->to($email_to);
	  		$this->email->reply_to($email_to,'Clock-in.me Support');
	  		$this->email->bcc($bcc_list);
			$this->email->message('hola');	
			$this->email->subject($subject);		
	  	 	$this->email->send();
	  	 	
	  	 	$this->data['view']					=	'ccadministration/contact-support';
		   $this->load->view('master', $this->data);	

		}	
		
	}	
	
	//Bridge: To fetch company info based on company Id
	//Dominic: Nov 25,2016
	public function getCompanyInfo($compId)
	{
		$build_array 	= array();
      $build_array   = $this->getThisCompanyInfo($compId);
      return $build_array;     
	}

	//Function: To fetch company info based on company Id
	//Dominic: Nov 25,2016
	function getThisCompanyInfo($compId)
	{
		$companyInfo=$this->Administration_model->getThisCompanyInfo($compId);
		return $companyInfo;
	}
	
	

	function get_common()
	{
		$this->data['footer_includes']			=	'<script src="'.base_url().'js/cc/administration.js" type="text/javascript"></script>';
		/*
		$this->site_settings->get_site_settings();
		$this->data['profile']			=	$this->site_settings->personal_details();	
		$this->data['menus_all']		= 	modules::load('menus')->get_menus();
		$this->data['myprivileges']	=	$this->site_settings->myprivileges();
		
		*/
			
	}
	
	
}

