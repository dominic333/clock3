<?php
/**
* Designation Model File Doc Comment
* 
* PHP version 5
* @category    Designation_Model_Agent
* @package     CodeIgniter
* @author      Lijiya Babu  <lijiya@cliffsupport.com>
* @license 		Cliff Creation
* @link        http://heims.com/users/designation_model.html
*/

/**
* Designation Model Class Doc Comment
* 
* PHP version 5
* @category    Designation_Model_Agent
* @package     CodeIgniter
* @author      Lijiya Babu  <lijiya@cliffsupport.com>
* @license 		Cliff Creation
* @link        http://heims.com/users/designation_model.html
*/
class Designation_model extends CI_Model {
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
		*  @desc:Function for save designation
		*  @param	var $designation designation
		*  @return true/false  
		*/
	function save($designation)
	{
		$data['designation']		= $designation;
		$this->db->insert('user_designation', $data);
	}
	/**
		*  @author : Lijiya
		*  @date :01-03-2016
		*  @desc:Function for get designation details
		*  @param	int $designation_id designation_id
		*  @return true/false  
	*/
	function get_selected($designation_id)
	{
		$this->db->from('user_designation as UD');
		$this->db->where('UD.id', $designation_id);
		$result=$this->db->get();
		return $result->row();
	}
	/**
		*  @author : Jisha
		*  @date :29-02-2016
		*  @desc:Function to update designation
		*  @param	int $designation_id designation_id
		*  @param	var $designation    designation
		*  @return true/false  
	*/
	function update($designation_id, $designation)
	{
		$data['designation']		= $designation;
		$this->db->where('id', $designation_id);
		$this->db->update('user_designation', $data);
	}
	/**
	*@author jisha
	*@date 4-3-16
	*@return result
	*@desc:get all active designation
 	*/
	function get_active_designations() 
	{  	 
		$this->db->from('user_designation as UD');
		//$this->db->where('UD.status', '1');
		$result = $this->db->get();
		//echo $this->db->last_query();
		return $result->result();
	}
	/**
		*  @author : Jisha
		*  @date :14-03-2016
		*  @desc:Function for get check designation name exists
		*  @param	var $name designation_name
		*  @return array row
		*/
	function check_exists($name)
	{
		$this->db->where('designation', $name);
		$row_unit=$this->db->get('user_designation');
		return $row_unit->row();
	}
	/**
		*  @author : Jisha
		*  @date :13-04-2016
		*  @desc:Function for get check designation name exists
		*  @param	var $name    designation_name
		*  @param	var $des_id  designation_id
		*  @return array row
		*/
	function check_exists_edit($name, $des_id)
	{
		$this->db->where('id !=', $des_id);
		$this->db->where('designation', $name);
		$row_unit=$this->db->get('user_designation AS UD');
		return $row_unit->row();
	}
}	
//End of file Designation_model.php
/*Location: ./modules/users/models/Designation_model.php */