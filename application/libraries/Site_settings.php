<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Site Sentry security library for Code Igniter applications
 * Class Login
 *
 *	PHP version 5.3
 * @category	Settings
 * @package		common
 * @subpackage	settings
 * @author		Bigil Michael <bigil@cliffsupport.com>
 * @license		Cliff Creation
 * @link        http://heims.com/
 * @since		10-02-2016
 * @Version		1.0
 */
/**
 * File: site_settings.php
 * Class settings
 *
 *	PHP version 5.3
 * @category	Settings
 * @package		common
 * @subpackage	Settings
 * @author		Bigil Michael <bigil@cliffsupport.com>
 * @license		Cliff Creation
 * @link        http://heims.com
 * @since		10-02-2016
 * @Version		1.0
 */
class Site_settings 
{
	function Site_settings()
	{
		$CI = $this->obj =& get_instance();
      //$CI->load->library('session');
		$CI->load->library('encryption');
		$CI->load->library('Mobile_Detect');
	}
	/**
		*  @author : Bigil Michael
		*  @date :11-02-2016
		*  @desc:Function to set common details  
		*  @return true/false
		*/
	function get_site_settings()
	{		
		date_default_timezone_set('Asia/Kolkata');
		$result_settings	=	$this->obj->db->query('SELECT * FROM settings');
		$rows	=	$result_settings->result();
		foreach($rows as $row){
			$this->obj->config->set_item($row->config_key, $row->config_value);
		}
		return true;  		
	}
	
   // Function to log operations
   // Dominic: December 06,2016
	function adminlog($description)
	{	
		$data['description'] = ascii_to_entities($description);
		$data['username'] = $this->obj->session->userdata('mid');
		$data['date'] = date('Y-m-d');
		$data['time'] = date('H:i:s');
		$data['ipaddress'] = $_SERVER['REMOTE_ADDR'];	
		$data['device']=$this->check_mobile();
		$data['log'] = $data['date']." : ".$data['time']." : User ".$data['username']." : ".$data['description']." : from ".$data['ipaddress']." device: ".$data['device'].PHP_EOL;
		$path= $this->obj->lang->line("absolute_path")."log/".date('MY').".txt";	
		write_file($path, $data['log'], 'a+');			
	}   
	
	//Function to add a notification
	// Dominic: December 09,2016
	function addNotification($nType,$nMsg,$absenteeID='')
	{
	   $compId						= $this->obj->session->userdata('coid');
	  	$data['companyid'] 		= $compId;
	  	$data['nType'] 			= $nType;
	  	$data['nMsg'] 				= $nMsg;
	  	$data['absenteeID'] 		= $absenteeID;
	  	$data['actionBy'] 		= $this->obj->session->userdata('mid');
		
		
		$result_settings	=	$this->obj->db->query("SELECT staff_id FROM staff_info WHERE company_id=".$compId." AND is_admin=1 AND staff_status=1");
		$rows	=	$result_settings->result();
		foreach($rows as $row)
		{
			$data['userID'] 			= $row->staff_id;
			$data['nDateTime'] 		=  date('Y-m-d H:i:s');
			
			$this->obj->db->insert('notifications',$data);
		}
	}
	
	//Function to fetch my notifications
	//Dominic, December 10,2016
	public function fetchMyNotifications()
	{
	  	$this->obj->db->select('N.*, SI.staff_name');
		$this->obj->db->where('N.userID',$this->obj->session->userdata('mid'));     	
	  	$this->obj->db->from('notifications AS N');			  		
		$this->obj->db->join('staff_info AS SI', 'N.actionBy = SI.staff_id','LEFT');		
		$this->obj->db->order_by('N.nDateTime','DESC');	
		$result_notif = $this->obj->db->get();	
		return $result_notif->result();
	}
     
  
	//Function to check mobile or table or computer
	function check_mobile()
	{
		
		$detect = new Mobile_Detect();
    	if ($detect->isMobile() || $detect->isTablet() || $detect->isAndroidOS()) 
    	{
        return 'Mobile';
    	}
    	else
    	{
    		return 'PC';
    	}
	}  
   
	  /**
		*  @author : Lissy SR
		*  @date :25-02-2016
		*  @desc: Function to prevent multiple form submission
		*  @return true/false
		*/
		function is_valid_form_submission($token,$back)
		{		
			if($token === $this->obj->session->userdata('form_token'))
			{	 
			    $this->obj->session->unset_userdata('form_token');		  
			    return TRUE; 			    
		   }
		   else{
				redirect($back);		
		   }
	   }
	   /**
		* @author : "Lissy SR"
		* @date :27-02-2016
		* @desc:Function to decrypt the encrypted id
		* @param int $id id
		* @return id  
		*/
		public function get_decrypt_id($id)
		{
			$id=str_replace(array('-', '_', '~'), array('+', '/', '='), $id);
			$id	= $this->obj->encryption->decrypt($id);
			return $id;
		}
		/**
		* @author : "Lissy SR"
		* @date :27-02-2016
		* @desc:Function to decrypt the encrypted id
		* @param int $id id
		* @return id  
		*/
		public function get_encrypt_id($id)
		{
			$id = $this->obj->encryption->encrypt($id);
         $id=str_replace(array('+', '/', '='), array('-', '_', '~'), $id);
			return $id;
		}
		/**
		* @author : "Lissy SR"
		* @date :03-03-2016
		* @desc:Function to encrypt the password
		* @param int $pass password
		* @return pass  
		*/
		public function get_encrypt_password($pass)
		{
			$pass = $this->obj->encryption->encrypt($pass);		
			return $pass;
		}
		/**
		* @author : "Jisha Jacob"
		* @date :03-03-2016
		* @desc:Function to check privilege exist or not
		* @param int $privilege privilege
		* @return nil  
		*/
		public function has_privilege($privilege)
		{
			//role=1 for admin
			$flag=false;
			if($this->obj->session->userdata('role') != '1')
			{
				$priv_id = $this->get_privilege($privilege);
				$priv = $this->myprivileges();
				$myprivileges = explode(",", $priv->role_privileges);
				if(in_array($priv_id, $myprivileges))
				{
					$flag= true;
				}
			}
			else {
					$flag= true;
			}
			return $flag;
		} 
		/**
		* @author : "Jisha Jacob"
		* @date :03-03-2016
		* @desc:function to get privileges
		* @param int $privilege privilege
		* @return nil  
		*/
		public function myprivileges()
		{
		  	$this->obj->db->select('U.*, UR.role, UR.privileges as role_privileges, UR.menu_privileges');
			$this->obj->db->where('U.id',$this->obj->session->userdata('user_id'));     	
		  	$this->obj->db->from('users AS U');		
			$this->obj->db->join('user_role AS UR', 'UR.id = U.role','LEFT');		
			$result_users = $this->obj->db->get();	
			return $result_users->row();
		}
		/**
		* @author : "Jisha Jacob"
		* @date :03-03-2016
		* @desc:Function to fetch the privilege ID
		* @param int $privilege privilege
		* @return nil  
		*/
		public function get_privilege($privilege)
		{
			$this->obj->db->where('privilege',$privilege);
			$this->obj->db->where('status',1);
			$this->obj->db->select('id');
			$this->obj->db->from('privileges');
			$row_privileges = $this->obj->db->get();
			if($row_privileges->num_rows()>0)
			{
				$privileges = $row_privileges->row();
				return $privileges->id;
			}
			return 0;
		} 	
		/**
		* @author : "Jisha Jacob"
		* @date :07-04-2016
		* @desc:Function to send Email
		* @param var $to         to
		* @param var $subject    subject
		* @param var $msg_header msg_header
		* @param var $msg_body   msg_body
		* @return nil  
		*/ 
	function send_email($to, $subject, $msg_header, $msg_body)
	{     	      	  
		$smtp_server = $this->obj->config->item('smtp_server'); 
		$smtp_port = $this->obj->config->item('smtp_port'); 
		$email_address = $this->obj->config->item('email_address'); 
		$smtp_password = $this->obj->config->item('password');     
		$this->obj->load->library('email');
		$config['protocol'] = "smtp"; 
		$config['smtp_host'] = $smtp_server;
		$config['smtp_port'] = $smtp_port;
		$config['smtp_user'] = $email_address; 
		$config['smtp_pass'] = $smtp_password;
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";
		$this->obj->email->initialize($config);
		$this->data['msg_header'] =  $msg_header;
		$this->data['msg_body'] =  $msg_body;
		$message = $this->obj->load->view('email_template',$this->data,TRUE); // this will return you html data as message
		
		$this->obj->email->from($email_address);
		$this->obj->email->to($to);
		$this->obj->email->subject($subject);
		$this->obj->email->message($message);
		if($this->obj->email->send()){
				return "Done";
		}else{
			return "Not";
		
		}
	}
}
?>