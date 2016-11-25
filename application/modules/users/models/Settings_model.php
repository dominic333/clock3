<?php
/**
* Settings Model File Doc Comment
* 
* PHP version 5
* @category    Settings_Model_Agent
* @package     CodeIgniter
* @author      jisha  <jisha@cliffsupport.com>
* @license 		Cliff Creation
* @link        http://heims.com/roles/roles_model.html
*/

/**
* Settings Model Class Doc Comment
* 
* PHP version 5
* @category    Settings_Model_Agent
* @package     CodeIgniter
* @author      jisha  <jisha@cliffsupport.com>
* @license 		Cliff Creation
* @link        http://192.168.11.13/projects/ksktu/users/settings_model.html
*/
class Settings_model extends CI_Model {
	/**
	 * Constructor
	 * Sets the roles 
	 * @return	void
	 */
	function __construct()	
	{
		parent::__construct();
	}
	/**
		*  @author : Jisha
		*  @date :14-06-2016
		*  @desc:Function to save role
		*  @return true/false  
	*/
	function save()
	{
		$this->db->query("UPDATE settings SET config_value='".$this->db->escape_str($this->input->post('admin_email'))."' WHERE config_key='admin_email'");
		$this->db->query("UPDATE settings SET config_value='".$this->db->escape_str($this->input->post('site_name'))."' WHERE config_key='site_name'");
		$this->db->query("UPDATE settings SET config_value='".$this->db->escape_str($this->input->post('copyright_year'))."' WHERE config_key='copyright_year'");
	}
	/**
		*  @author : jisha
		*  @date :14-06-2016
		*  @desc:Function for get settings
		*  @param int $role_id role_id
		*  @return row
		*/
	function get_settings(){
		$result_settings	=	$this->db->query('SELECT * FROM settings');
		return $result_settings->result();
	}	
}
//End of file Settings_model.php
/*Location: ./modules/users/models/Settings_model.php*/