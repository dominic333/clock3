<?php

class Users_model extends CI_Model {

	function __construct()	
	{
		parent::__construct();
	}

	function getThisUserDataFromUserID($staffId)
	{		
		//SELECT SI.staff_id,SI.is_admin,ST.id AS staffTypeId
		//FROM staff_info AS SI 
		//LEFT JOIN company_info AS CI ON CI.id=SI.company_id 
		//LEFT JOIN staff_types AS ST ON ST.id=SI.staff_type
		//WHERE CI.company_login='' AND SI.login_name='' AND SI.password=''

      $this->db->where('SI.staff_id', $staffId);
      
      $this->db->where('SI.staff_status', 1);
  		$this->db->select('SI.staff_id,SI.company_id,SI.is_admin,SI.staff_name,SI.login_name,SI.email,SI.work_from_home,SI.contact_number,SI.staff_photo,
  		  						 CI.id,CI.company_name,ST.id AS staffTypeId,D.department_name,SDS.shift_id,DS.shift_name');
   	$this->db->from('staff_info AS SI');
   	$this->db->join('company_info AS CI','CI.id = SI.company_id','LEFT');
   	$this->db->join('staff_types AS ST','ST.id=SI.staff_type','LEFT');	   
   	$this->db->join('staff_dept_shift AS SDS','SDS.staff_id=SI.staff_id','LEFT');
   	$this->db->join('departments AS D','SDS.dept_id=D.dept_id','LEFT');
   	$this->db->join('department_shifts AS DS','DS.shift_id=SDS.shift_id','LEFT');
   	$resultUser = $this->db->get();
   	//echo $this->db->last_query();
		return $resultUser->result();
	}

}