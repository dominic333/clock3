<?php if(!defined('BASEPATH')) exit('No direct script access is allowed');

class Authentication
{
     //Constructor method, we need the super CI object in order to use core libraries
     function Authentication()
     {
           //We can use this object anywhere in this class
           $this->CI = &get_instance();
           $this->CI->load->library('encryption');
     }

     //First the login procedure
     /*
       We assume that we have table in the database, called users, with fields like: id, username, password, email, 
       //activation_code and active which will be 1 if the user has been activated and 0 if the user is not active.
     */
 
     function login($name, $password,$companyName)
     {
           //New boolean variable which will be FALSE
           $result = FALSE;           
           //$this->CI->load->library('encrypt');
           //Escape them to use in the database
           $name = $this->CI->db->escape_str($name);
           $password = $this->CI->db->escape_str($password);
           $companyName = $this->CI->db->escape_str($companyName);

           //Build the query and assign it to a variable
           //Note, we are not matching the password, but you can if you want to.
           
           //SELECT SI.* FROM staff_info AS SI LEFT JOIN company_info AS CI ON CI.id=SI.company_id WHERE CI.company_login='' AND SI.login_name='' AND SI.password=''
           $sql = "SELECT SI.* 
           			 FROM staff_info AS SI 
           			 LEFT JOIN company_info AS CI ON CI.id=SI.company_id 
           			 WHERE CI.company_login='".$companyName."' AND SI.login_name='".$name."' AND SI.password='".md5($password)."' LIMIT 1 ";
           $query = $this->CI->db->query($sql);

           //Make sure we have only one result
           if($query->num_rows() == 1)
           {
                 //Fetch the query row into a $row object
                 $row = $query->row();

                 //Load the encryption library in order to decode the password
                 //Decode the password from the database and compare it with the entered one
				 
                 //if($this->CI->encrypt->encode($password) == $row->password)
                 if($row->num_rows() > 0)
                 {
                        //The result becomes true
                        $result = TRUE;

                       //Prepare new session data to be inserted into the session user data
                       $sess_data = array('user_id' => $row->id, 'logged_in' => $result);
                       $this->CI->session->set_userdata($sess_data);
                 }
                 $result_user->free_result();
           }
                      //Finally we return the $result, which will be true only if there is matching record in the database with the ones entered by the user
                 return $result;
     } 
     

     //Next we need little function to check if the user is logged in on some pages
     function is_logged_in()
     {
           //Check if we have session userdata which is possible after successful login
           if($this->CI->session->userdata('mid') && $this->CI->session->userdata('logged_in'))
           {
                 return TRUE;
           }           
           else{
             $this->CI->session->set_flashdata('feedback','Please login!');
             redirect('/home/login');
       	 }
     }
     
     //Function to check if user has access to allow this function
     //Dominic, December 17,2016
     function check_admin_access()
     {
     	  //Check if we have session userdata which is possible after successful login
        if($this->CI->session->userdata('mid') && $this->CI->session->userdata('logged_in'))
        {
           if($this->CI->session->userdata('isadmin')==1)
           {
             return TRUE;
           }
           else
           {
           	 $this->CI->session->set_flashdata('feedback','Please login!');
       		 redirect('/home/logout');
           }
        }           
        else
        {
          $this->CI->session->set_flashdata('feedback','Please login!');
          redirect('/home/logout');
    	 }
    	 
     }
     
     //Function to check reports access available or not
     //Dominic, December 21,2016 (for menu link)
     function checkReportsAccess()
     {
		 $reportAcces=0;
     	 $compIdSess= $this->CI->session->userdata('coid');
     	 $result_settings	=	$this->CI->db->query("SELECT company_plans.company_id,company_plans.max_users,plans.departments,plans.reports 
			FROM company_plans
			LEFT JOIN plans ON plans.id=company_plans.planId
			WHERE company_plans.company_id=".$compIdSess."
     	 ");
		 if($result_settings->num_rows() > 0)
		 {
		 	 $rows	=	$result_settings->result();
		 	 foreach($rows as $row)
			 {
				$reportAcces 			= $row->reports;
			 }
		 }
		 return $reportAcces;
     }
     
     //Function to check reports controller access available or not
     //Dominic, December 21,2016 (for controller)
     function checkReportsFeaturesAccess()
     {
		 $reportAcces=0;
     	 $compIdSess= $this->CI->session->userdata('coid');
     	 $result_settings	=	$this->CI->db->query("SELECT company_plans.company_id,company_plans.max_users,plans.departments,plans.reports 
			FROM company_plans
			LEFT JOIN plans ON plans.id=company_plans.planId
			WHERE company_plans.company_id=".$compIdSess."
     	 ");
     	 if($result_settings->num_rows() > 0)
     	 {
     	 	 $rows	=	$result_settings->result();
			 foreach($rows as $row)
			 {
				$reportAcces 			= $row->reports;
				if($reportAcces==1)
				{
					return TRUE;
				}
				else
				{
					$this->CI->session->set_flashdata('feedback','Please login!');
	       		redirect('/home/logout');
				}
			 }
     	 }
     	 else 
     	 {
     	 	$this->CI->session->set_flashdata('feedback','Please login!');
	      redirect('/home/logout');
     	 }
     }
     
     //Function to check reports access available or not
     //Dominic, December 21,2016 (for menu link)
     function checkDepartmentAccess()
     {
		 $departmentsAcces=0;
     	 $compIdSess= $this->CI->session->userdata('coid');
     	 $result_settings	=	$this->CI->db->query("SELECT company_plans.company_id,company_plans.max_users,plans.departments,plans.reports 
			FROM company_plans
			LEFT JOIN plans ON plans.id=company_plans.planId
			WHERE company_plans.company_id=".$compIdSess."
     	 ");
     	 if($result_settings->num_rows() > 0)
     	 {
     	 	 $rows	=	$result_settings->result();
			 foreach($rows as $row)
			 {
				$departmentsAcces 	= $row->departments;
			 }
     	 }
		 return $departmentsAcces;
     }
     
     //Function to check department function access available or not
     //Dominic, December 21,2016 (for controller)
     function checkDepartmentFeaturesAccess()
     {
		 $departmentsAcces=0;
     	 $compIdSess= $this->CI->session->userdata('coid');
     	 $result_settings	=	$this->CI->db->query("SELECT company_plans.company_id,company_plans.max_users,plans.departments,plans.reports 
			FROM company_plans
			LEFT JOIN plans ON plans.id=company_plans.planId
			WHERE company_plans.company_id=".$compIdSess."
     	 ");
     	 if($result_settings->num_rows() > 0)
     	 {
     		 $rows	=	$result_settings->result();
			 foreach($rows as $row)
			 {
				$departmentsAcces 	= $row->departments;
				if($departmentsAcces==1)
				{
					return TRUE;
				}
				else
				{
					$this->CI->session->set_flashdata('feedback','Please login!');
	       		redirect('/home/logout');
				}
			 } 
     	 }
     	 else
     	 {
     	 	$this->CI->session->set_flashdata('feedback','Please login!');
	      redirect('/home/logout');
     	 }
     }
     
     //Function to check if whitelistip feature available or not
     //Dominic, Jan 12, 2017
     function checkWhiteListIPAccess()
     {
		
		 $whiteIPAcces=0;
     	 $compIdSess= $this->CI->session->userdata('coid');
     	 $result_settings	=	$this->CI->db->query("SELECT plans.ipWhiteListing  
			FROM company_plans
			LEFT JOIN plans ON plans.id=company_plans.planId
			WHERE company_plans.company_id=".$compIdSess."
     	 ");
     	 if($result_settings->num_rows() > 0)
     	 {
     	 	 $rows	=	$result_settings->result();
			 foreach($rows as $row)
			 {
				$whiteIPAcces 	= $row->ipWhiteListing;
			 }
     	 }
		 return $whiteIPAcces;
     }
     
     //Function to check if whitelistip CRUD feature available or not
     //Dominic, Jan 12, 2017
     function checkWhiteListIPFeaturesAccess()
     {
		 $whiteIPAcces=0;
     	 $compIdSess= $this->CI->session->userdata('coid');
     	 $result_settings	=	$this->CI->db->query("SELECT plans.ipWhiteListing  
			FROM company_plans
			LEFT JOIN plans ON plans.id=company_plans.planId
			WHERE company_plans.company_id=".$compIdSess."
     	 ");
     	 if($result_settings->num_rows() > 0)
     	 {
     		 $rows	=	$result_settings->result();
			 foreach($rows as $row)
			 {
				$whiteIPAcces 	= $row->ipWhiteListing;
				if($whiteIPAcces==1)
				{
					return TRUE;
				}
				else
				{
					$this->CI->session->set_flashdata('feedback','Please login!');
	       		redirect('/home/logout');
				}
			 } 
     	 }
     	 else
     	 {
     	 	$this->CI->session->set_flashdata('feedback','Please login!');
	      redirect('/home/logout');
     	 }
     }
     
     //Function to check leave management feature access
     //Dominic, Jan 13, 2017
     function checkLeaveManagementFeatureAccess()
     {
     	 $leaveManagement=0;
     	 $compIdSess= $this->CI->session->userdata('coid');
     	 $result_settings	=	$this->CI->db->query("SELECT plans.leaveManagement  
			FROM company_plans
			LEFT JOIN plans ON plans.id=company_plans.planId
			WHERE company_plans.company_id=".$compIdSess."
     	 ");
     	 if($result_settings->num_rows() > 0)
     	 {
     		 $rows	=	$result_settings->result();
			 foreach($rows as $row)
			 {
				$leaveManagement 	= $row->leaveManagement;
				if($leaveManagement==1)
				{
					return TRUE;
				}
				else
				{
					$this->CI->session->set_flashdata('feedback','Please login!');
	       		redirect('/home/logout');
				}
			 } 
     	 }
     	 else
     	 {
     	 	$this->CI->session->set_flashdata('feedback','Please login!');
	      redirect('/home/logout');
     	 }
     }
     
     //Function to check leave management access
     //Dominic, Jan 13, 2017
     function checkLeaveManagementAccess()
     {
		
		 $leaveManagement=0;
     	 $compIdSess= $this->CI->session->userdata('coid');
     	 $result_settings	=	$this->CI->db->query("SELECT plans.leaveManagement  
			FROM company_plans
			LEFT JOIN plans ON plans.id=company_plans.planId
			WHERE company_plans.company_id=".$compIdSess."
     	 ");
     	 if($result_settings->num_rows() > 0)
     	 {
     	 	 $rows	=	$result_settings->result();
			 foreach($rows as $row)
			 {
				$leaveManagement 	= $row->leaveManagement;
			 }
     	 }
		 return $leaveManagement;
     }
     
     //Function to fetch report download limit
     //Dominic, Jan 13, 2017
     function reportMonthLimit()
     {
		
		 $reportMonthLimit=3;
     	 $compIdSess= $this->CI->session->userdata('coid');
     	 $result_settings	=	$this->CI->db->query("SELECT plans.reportMonthLimit  
			FROM company_plans
			LEFT JOIN plans ON plans.id=company_plans.planId
			WHERE company_plans.company_id=".$compIdSess."
     	 ");
     	 if($result_settings->num_rows() > 0)
     	 {
     	 	 $rows	=	$result_settings->result();
			 foreach($rows as $row)
			 {
				$reportMonthLimit 	= $row->reportMonthLimit;
			 }
     	 }
		 return $reportMonthLimit;
     }
	
     function logout()
     {
           //destroy the session after logging out
           $this->CI->session->sess_destroy();
     }
}
?>