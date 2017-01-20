<?php

class Home_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
	}
	
	//Function to check login valid or not
	//Dominic: Nov 24,2016
	function check_login()
   {    
   	//SELECT SI.staff_id,SI.is_admin,ST.id AS staffTypeId
		//FROM staff_info AS SI 
		//LEFT JOIN company_info AS CI ON CI.id=SI.company_id 
		//LEFT JOIN staff_types AS ST ON ST.id=SI.staff_type
		//WHERE CI.company_login='' AND SI.login_name='' AND SI.password=''
		       
      $this->username = $this->input->post('name');
      $this->db->where('SI.login_name', $this->username);	
      $this->password = md5($this->input->post('password'));
      $this->db->where('SI.password', $this->password);
      $this->companyname = $this->input->post('companyName');
      
      $this->db->where('CI.company_login', $this->companyname);
      
      $this->db->where('SI.staff_status', 1);
  		$this->db->select('SI.staff_id,CI.id,SI.staff_name,SI.is_admin,ST.id AS staffTypeId');
   	$this->db->from('staff_info AS SI');
   	$this->db->join('company_info AS CI','CI.id = SI.company_id');	   
   	$this->db->join('staff_types AS ST','ST.id=SI.staff_type');	   
   	$result_user = $this->db->get();	
   	//echo $this->db->last_query();
   	
   	if($result_user->num_rows() > 0)
   	{ 
			return $result_user->row()->staff_id;
		}
		else
		{
			return 0;
		}
		
		//$result_user->free_result();
		
    }
    
        // function to collect userdate
    // return result
    // @author Bigil Michael

    function get_user_data()
    {    	
			
   	$this->db->where('SI.login_name', $this->username);	
   	$this->db->where('SI.password', $this->password);
		$this->db->where('CI.company_login', $this->companyname);
   	$this->db->where('SI.staff_status', 1);
  		$this->db->select('SI.staff_id,CI.id,SI.staff_name,SI.is_admin');
   	$this->db->from('staff_info AS SI');
   	$this->db->join('company_info AS CI','CI.id = SI.company_id');	     
   	$result_user = $this->db->get();
	   return $result_user->result();
		$result_user->free_result();
    }
    
    //Function to insert log 
    
   //Function to check  whether email is exist or not 
   //AUthor Farveen
	function email_company_exists($email,$cologin)
	{
		$this->db->select('SI.staff_id');
		$this->db->from('staff_info as SI');		
		$this->db->join('company_info as CI','CI.id=SI.company_id','LEFT');		
		$this->db->where('SI.email',$email);		
		$this->db->where('CI.company_login',$cologin);		
		$exists=$this->db->get();
		//echo $this->db->last_query();
	   $row_exists = $exists->row();
		if(count($row_exists)>0)
			return true;
		else	
			return false;
	}
	
	
	//Function to get login name
	//@Author Farveen
	function get_login_name($email){
		$this->db->select('login_name as login',FALSE);
		$this->db->where('email',$email);	
		$this->db->from('staff_info');
		$result=$this->db->get();
		return $result->row()->login;
	}
	
	
	//Function to get Username
	//@Author Farveen
	function get_user_name($email){
		$this->db->select('staff_name as name',FALSE);
		$this->db->where('email',$email);	
		$this->db->from('staff_info');
		$result=$this->db->get();
		return $result->row()->name;
	}
	
	//Function to save new pasword
	//@Author Farveen
	function save_new_password($email,$password){
		$data['password']=  md5($password);
		$this->db->where('email',$email);
	   $this->db->update('staff_info',$data);
	}
	

	
	function get_user_data_email($email)
    {    	
			
   	$this->db->where('U.email', $email);   
   	$this->db->where('U.status', 1);
   	$this->db->where('U.designation', 2);
		$this->db->select('U.id, U.designation as designation_id, UD.designation');
   	$this->db->from('users AS U');
   	$this->db->join('user_designation AS UD','UD.id = U.designation');
   	$this->db->join('user_personal AS UP','UP.user_id = U.id');		     
   	$result_user = $this->db->get();
	   return $result_user->row();
		$result_user->free_result();
    }
    
    
    
 	function generateRandomString($length = 4) {
    //$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $characters = 'ABCDEFGHJKMNPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
	}
	
}

