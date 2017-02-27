<?php

class Account extends MX_Controller
{
	public $data;	

	function __construct()
	{
		parent::__construct();

		$this->load->model('Account_model');
		$this->authentication->is_logged_in();
		$this->get_common();
	}
	
	public function index()
	{
		$userIdSess =$this->session->userdata('mid');
		$this->data['user_data']	=	modules::load('users')->getUserDataFromUserID($userIdSess);
		$this->data['view']			=	'selfiemyaccount/profile';
		$this->load->view('master_selfie', $this->data);	
		
	}

	//Function to update user info
	//By Dominic,Dec 12,2016
	public function updateUserInfo()
	{
		if ($this->form_validation->run('editProfileForm') === FALSE)
		{
			redirect('selfiemyaccount/account');
		}
		else
		{
			$userIdSess =$this->session->userdata('mid');
			$this->Account_model->updateUserInfo($userIdSess);

			// save to log table
			$operation = 'Edited User Information with ID '.$userIdSess;
			$this->site_settings->adminlog($operation);

			$staffnameSess =$this->session->userdata('staffname');
			$nType = 5; //company updates
			$nMsg  =  'User profile updated';
			$this->site_settings->addNotification($nType,$nMsg,'');

			redirect('selfiemyaccount/account/');
		}

	}

	//Function to update profile picture
	//Gayatri ,23/02/2017
	function save_selfie()
   {	
		
		//echo "success";
		$image_fmt 	= $this->input->post('image_fmt');
		$staffid 	= $this->input->post('staffid');
		$img 			= $this->input->post('base64image');
		
		$result = substr($img, 0, 9);
		if($result=='[removed]'){ //Checking It Existed or not
		  	$img = str_replace('[removed]', '', $img);
		}    
		$img 			= str_replace('data:image/jpeg;base64,', '', $img);
		$img 			= str_replace(' ', '+', $img);
		//$img 			= substr($img,strpos($img,",")+1);// remove the prefix
		$data 		= base64_decode($img);
		
		
		$file_path	= FCPATH.'images/avatars/';
		$remove_old_selfies_file = $file_path.$staffid."-*".".".$image_fmt;
		//unlink($remove_old_selfies_file);
		system("rm -f $remove_old_selfies_file");
		
		$rand_cache  = time();
		$filename	 = $staffid."-".$rand_cache.".".$image_fmt;
		
		$upload_path = $this->lang->line('absolute_path').'avatars/'.$filename;
		//$upload_path = $file_path.$filename;
		
		
		//if ( ! file_put_contents($upload_path, $data)){
		if ( ! write_file($upload_path,$data)){
			echo "Failed";
		}else{
			$this->Account_model->update_staff_photo($filename,$staffid);
			$operation = 'Staff with id:'.$staffid.'. Has update his profile photo:'.$filename.'.';
	      $this->site_settings->adminlog($operation);
	      echo $filename;
		}
		
   }
   
   
   function resetPassword()
   {
   	if ($this->form_validation->run('resetPassword1') === FALSE)
		{
			echo "false";
		}
		else 
		{
		   	$staff_id	=		$this->session->userdata('mid');
		   	$result		= 		$this->Account_model->resetPassword($staff_id);
		   	if($result == true)
		   	{
						
					echo "true";   	
		   	
		   	}
		   	else 
		   	{
		   			echo "false";
		   	}
		}
   	
   }

	function get_common()
	{
		$this->site_settings->get_site_settings();
		$this->data['listAnnouncements']	=	$this->site_settings->fetchLatestAnnouncementsforUser();
		$this->data['footer_includes']			=	'<script src="'.base_url().'js/snap/profile.js" type="text/javascript"></script>';
	}
}

