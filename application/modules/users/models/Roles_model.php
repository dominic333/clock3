<?php
/**
* Roles Model File Doc Comment
* 
* PHP version 5
* @category    Roles_Model_Agent
* @package     CodeIgniter
* @author      Lijiya Babu  <lijiya@cliffsupport.com>
* @license 		Cliff Creation
* @link        http://heims.com/roles/roles_model.html
*/

/**
* Roles Model Class Doc Comment
* 
* PHP version 5
* @category    Roles_Model_Agent
* @package     CodeIgniter
* @author      Lijiya Babu  <lijiya@cliffsupport.com>
* @license 		Cliff Creation
* @link        http://192.168.11.13/projects/heims/roles/roles_model.html
*/
class Roles_model extends CI_Model {
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
		*  @date :05-03-2016
		*  @desc:Function to save role
		*  @param var $role       role
		*  @param int $priv       privileges
		*	@param var $menu_privl menu privilege
		*  @return true/false  
	*/
	function save($role, $priv, $menu_privl)
	{
		$data['role']			= $role;
		$data['privileges']	= $priv;
		$data['menu_privileges']	= $menu_privl;
		$this->db->insert('user_role', $data); 
	}
	/**
		*  @author : Jisha Jacob
		*  @date :05-03-2016
		*  @desc:Function to update role
		*  @param int $role_id    roleid
		*  @param var $role       role
		*  @param int $priv       privileges
		*	@param var $menu_privl menu privilege
		*  @return true/false  
	*/
	function update($role_id, $role, $priv, $menu_privl)
	{	 	
		$data['role']			= $role;
		$data['privileges']	= $priv;
		$data['menu_privileges']	= $menu_privl;
		$this->db->where('id', $role_id);
		$this->db->update('user_role', $data); 	
	}
	/**
		*  @author : Lijiya
		*  @date :01-03-2016
		*  @desc:Function for get selected role
		*  @param int $role_id role_id
		*  @return row
		*/
	function get_selected_details($role_id)
	{
		$this->db->where('id', $role_id);
		$row_role=$this->db->get('user_role');
		return $row_role->row();
	}
	/**
	*@author jisha
	*@date 4-3-16
	*@return result
	*@desc:get all active roles
 	*/
	function get_active_roles() 
	{  	 
		$this->db->from('user_role as UR');
		$this->db->where('UR.status', '1');
		$this->db->where('UR.id !=', '1');
		$this->db->where('UR.id !=', '2');
		$this->db->where('UR.id !=', '3');
		$this->db->where('UR.id !=', '4');
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result();
	}
}
//End of file Roles_model.php
/*Location: ./modules/users/models/Roles_model.php*/