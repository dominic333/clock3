<?php
/**
* Privileges Model File Doc Comment
* 
* PHP version 5
* @category    Privileges_Model_Agent
* @package     CodeIgniter
* @author      Lijiya Babu  <lijiya@cliffsupport.com>
* @license 		Cliff Creation
* @link        http://heims.com/roles/privileges_model.html
*/

/**
* Privileges Model Class Doc Comment
* 
* PHP version 5
* @category    Privileges_Model_Agent
* @package     CodeIgniter
* @author      Lijiya Babu  <lijiya@cliffsupport.com>
* @license 		Cliff Creation
* @link        http://192.168.11.13/projects/heims/roles/privileges_model.html
*/
class Privileges_model extends CI_Model {
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
		*  @date :29-02-2016
		*  @desc:Function for save privilege
		*  @param	var $privilege privilege_name
		*  @return true/false  
		*/
	function save($privilege)
	{
		$data['privilege']					= $privilege;
		$this->db->insert('privileges', $data);
	}
	/**
		*  @author : Lijiya
		*  @date :29-02-2016
		*  @desc:Function for get privilege details
		*  @param	int $privilege_id privilege_id
		*  @return true/false  
	*/
	function get_selected($privilege_id)
	{
		$this->db->from('privileges as P');
		$this->db->where('P.id', $privilege_id);
		$result=$this->db->get();
		return $result->row();
	}
	/**
		*  @author : Lijiya
		*  @date :29-02-2016
		*  @desc:Function to update privilege
		*  @param	int $privilege_id privilege_id
		*  @param	var $privilege    privilege_name
		*  @return true/false  
	*/
	function update($privilege_id, $privilege)
	{
		$data['privilege']		= $privilege;
		$this->db->where('id', $privilege_id);
		$this->db->update('privileges', $data);
	}
	/**
		*  @author : Lijiya
		*  @date :29-02-2016
		*  @desc:Function for get all privilege details
		*  @return true/false  
	*/
	function get_all()
	{
		$result=$this->db->get('privileges');
		return $result->result();
	}
	/**
		*  @author : Lijiya
		*  @date :29-02-2016
		*  @desc:Function for get module privileges
		*  @param var $module modulename
		*  @return true/false  
	*/
	function get_module($module)
	{
		$this->db->where('status', 1);
		$this->db->like('privilege', $module, 'before');
		$result_modules = $this->db->get('privileges');
		//$result_modules = $this->db->query("SELECT * FROM privileges WHERE status = 1 AND privilege LIKE BINARY '%".$module."'");
		//echo $this->db->last_query();
		return $result_modules->result_array();
	}
	
}
//End of file Privileges_model.php
/*Location: ./modules/users/models/Privileges_model.php */