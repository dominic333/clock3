<?php
/**
	* File: Privileges.php
	* Class Privileges
	*
	*	PHP version 5.3
	* @category	BACK_END_Privileges
	* @package		Privileges
	* @author		Lijiya Babu <lijiya@cliffsupport.com>
	* @license		Cliff Creation
	* @link        http://heims.com/Privileges/
	* @since			01-03-2016
	* @Version		1.0
	*/
	/**
	* Privileges Class Doc Comment
	* Classs Privileges
	*	PHP version 5.3
	* @category	BACK_END_Privileges
	* @package		Privileges
	* @author		Lijiya Babu <lijiya@cliffsupport.com>
	* @license		Cliff Creation
	* @link        http://heims.com/Privileges
	* @since			01-03-2016
	* @Version		1.0
	*/
	class Privileges extends MX_Controller {
	/**
	* @var string $data
	*/
	public $data;   
	/**  	   
	*	@author Lijiya
	*	@date	29-02-2016
	*  @desc Define Privileges
	*/	
	public function __construct()
	{
		parent::__construct();
		$this->authentication->is_logged_in();		
		$this->load->model('users/Privileges_model');
		$this->get_common();
	}
	/**
	* @author : "Lijiya Babu"
	* @date :01-03-2016
	* @desc:Function for list roles
	* @return true/false  
	*/
	public function index()
	{
		if(!$this->site_settings->has_privilege('List Privilege'))
		{
			redirect('home/permission_error');
		}	
		//set page title	
		$this->data['admin_page_title'] 	= $this->lang->line('privileges_heading').'s';
		$this->data['pagetitle'] 	= 	$this->lang->line('pagetitle_privilege_list');
		//function to initialize data table
		$this->list_datatable();
		$this->data['view']					= $this->lang->line('privileges').'/list';
		$this->load->view('master', $this->data);	
	}
	/**
	* @author : "Lijiya Babu"
	* @date :01-03-2016
	* @desc : Function for server side data table
	* @return array
	*/
	public function list_datatable()
	{
		//function to initialize data table library
		$this->datatable_initialize();
		//set template for table		
		$tmpl = array ('table_open'  => '<table id="list_privileges"  class="table table-bordered responsive my_table table-striped">' );
		$this->table->set_template($tmpl); 
		//set  th heading for table		
		$this->table->set_heading('<input type="checkbox"  class="checkall" />', 'Privilege', 'Edit');	
		$this->table->set_caption('<colgroup> <col class="con0"> <col class="con1"><col class="con0"> <col class="con1">  <col class="con0"><col class="con1">     
                          </colgroup>');
	}
	/**
	* @author : "Lijiya Babu"
	* @date :01-03-2016
	* @desc : Function to list the roles using server side data table
	* @return array
	*/
	function datatable_privileges()
	{
		//function to initialize datatable library
		$this->datatable_initialize();
		$this->datatables->select('P.id,P.privilege');
		$this->datatables->add_column('Edit', '$1', 'encrypt_edit_modal(P.id,'.$this->lang->line('privileges').'/edit,P.privilege) ');
		//$this->datatables->edit_column('P.id', '<input type="checkbox" name="checked_item[]" class="jchecker dt_checkbox" value="$1"/>', 'P.id');
		$this->datatables->from('privileges as P');
		echo $this->datatables->generate();    
	}
	/**
	* @author : "Lijiya Babu"
	* @date :01-03-2016
	* @desc:For adding privileges
	* @param: nil
	* @return value save to database 
	*/	
	function add()
	{
		if(!$this->site_settings->has_privilege('Add Privilege'))
		{
			redirect('home/permission_error');
		}	
		$this->data['admin_page_title']  = 'Add '.$this->lang->line('privileges_heading');
		$this->data['pagetitle'] 			= 	$this->lang->line('pagetitle_privilege_add');
		if ($this->form_validation->run('privileges') === FALSE) 
		{
			$this->data['privilege_validate'] 	= 1;
			//function to initialize data table library
			$this->list_datatable();
			$this->data['view']						= $this->lang->line('privileges').'/list';
			$this->load->view('master', $this->data);
		}
		else {
				$privilege			= $this->db->escape_str($this->input->post('privilege_name'));
				//Function to save location to DB
				$this->Privileges_model->save($privilege);					
				// save to log table 
				$operation = $this->lang->line('log_privilege_add');
				$this->site_settings->adminlog($operation);
				redirect($this->lang->line('users').'/'.$this->lang->line('privileges'));
		}		
	}	
	/**
	* @author : "Lijiya Babu"
	* @date :01-03-2016
	* @desc:Function for edit location
	* @return true/false  
	*/
	public function edit()
	{
		if(!$this->site_settings->has_privilege('Edit Privilege'))
		{
			redirect('home/permission_error');
		}	
		$privilege_id = $this->input->post('privilege_id');
		//set page title		
		$this->data['admin_page_title'] 	= 'Edit '.$this->lang->line('privileges_heading');
		//get details of privilege with id  $privilege_id
		$this->data['selected_privilege']	= $this->get_details($privilege_id);
		if ($this->form_validation->run('privileges') === FALSE) 
		{
			$this->data['privilege_validate'] 	= 1;
			//function to initialize data table library
			$this->list_datatable();
			$this->data['view']						= $this->lang->line('privileges').'/list';
			$this->load->view('master', $this->data);
		}
		else {
			$privilege			= $this->db->escape_str($this->input->post('privilege_name'));
			//Function to update location details to DB
			$this->Privileges_model->update($privilege_id, $privilege);
			// save to log table 
			$operation = $this->lang->line('log_privilege_edit').$privilege_id;
			$this->site_settings->adminlog($operation);
			redirect($this->lang->line('users').'/'.$this->lang->line('privileges'));
		}
	} 
	/**
	* @author : "Lijiya Babu"
	* @date :01-03-2016
	* @desc:Function for select details of an privilege from id
	* @param int $privilege_id privilege_id
	* @return name  
	*/
	public function get_details($privilege_id)
	{
		$selected_privilege	= array();		
		//function to get location details		
		$selected_privilege	= $this->Privileges_model->get_selected($privilege_id);
		return $selected_privilege;
	}
	/**
	* @author : "Lijiya Babu"
	* @date :01-03-2016
	* @desc:for get all privileges
	* @param: nil
	* @return value result
	*/	
	function get_all()
	{
		$result		= $this->Privileges_model->get_all();
		return $result;
	} 
	/**
		*  @author : Lijiya
		*  @date :29-02-2016
		*  @desc:Function for get module privileges
		*  @param var $module modulename
		*  @return true/false  
	*/
	function get_module_privileges($module)
	{
		$result		= $this->Privileges_model->get_module($module);
		return $result;
	}
	/**
		*  @author	jisha
		*  @date		21-03-2016
		*  @desc		Function for get common label message
		*  @return	json_encoded array
		*/
	function get_label_messages()
	{
		$path_privileges				= base_url().$this->lang->line('users').'/'.$this->lang->line('privileges').'/datatable_privileges';  
		$path_list_privileges		= base_url().$this->lang->line('users').'/'.$this->lang->line('privileges');  
		$error_role_privilege		= $this->lang->line('error_role_privilege');  
		$data=array(
			'path_privileges'					=> $path_privileges,
			'path_list_privileges'			=> $path_list_privileges,
			'error_role_privilege'			=> $error_role_privilege
		);
		echo json_encode($data);
	}
	/**
		*  @author	Lijiya
		*  @date		01-03-2016
		*  @desc		Function to initialize datatatble
		*  @return	string
	*/
	function datatable_initialize()
	{
		$this->load->helper(array('datatables','html'));
		$this->load->library(array('Datatables','table'));		
	}        			
	/**
		*  @author	Lijiya
		*  @date		29-02-2016
		*  @desc		Function for get all common details
		*  @return	array
		*/
	function get_common()
	{
		$this->site_settings->get_site_settings();
		$this->data['profile']=$this->site_settings->personal_details();	
		$this->data['menus_all']		= 	modules::load('menus')->get_menus();
		$this->data['myprivileges']	=	$this->site_settings->myprivileges();
		$this->data['tree1']				=	'settings';
		$this->data['footer']    = '<script src="'.base_url().'assets/'.$this->lang->line('users').'/js/privileges.js" type="text/javascript"></script>';
	}	
	}
//End of file Privileges.php
/* Location: ./modules/users/controllers/Privileges.php*/
