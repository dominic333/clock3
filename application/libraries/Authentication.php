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
	
     function logout()
     {
           //destroy the session after logging out
           $this->CI->session->sess_destroy();
     }
}
?>