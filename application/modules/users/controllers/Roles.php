<?php
/**
	* File: Roles.php
	* Class Roles
	*
	*	PHP version 5.3
	* @category	BACK_END_Roles
	* @package		Roles
	* @author		Lijiya Babu <lijiya@cliffsupport.com>
	* @license		Cliff Creation
	* @link        http://heims.com/Roles/
	* @since			01-03-2016
	* @Version		1.0
	*/
	/**
	* Roles Class Doc Comment
	* Classs Roles
	*	PHP version 5.3
	* @category	BACK_END_Roles
	* @package		Roles
	* @author		Lijiya Babu <lijiya@cliffsupport.com>
	* @license		Cliff Creation
	* @link        http://heims.com/Roles
	* @since			01-03-2016
	* @Version		1.0
	*/
	class Roles extends MX_Controller {
	/**
	* @var string $data
	*/
	public $data;   
	/**  	   
	*	@author Lijiya
	*	@date	01-03-2016
	*  @desc Define Roles
	*/	
	public function __construct()
	{
		parent::__construct();
		$this->authentication->is_logged_in();		
		$this->load->model('users/Roles_model');
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
		if(!$this->site_settings->has_privilege('List Role'))
		{
			redirect('home/permission_error');
		}
		$this->breadcrumbcomponent->add('<i class="fa fa-dashboard"></i>Home', base_url());
		$this->breadcrumbcomponent->add($this->lang->line('bread_crumb_roles'),  '#');
	   $this->data['breadcrumb']=$this->breadcrumbcomponent->output();	
		//set page title	
		$this->data['admin_page_title'] 	= $this->lang->line('role_heading').'s';
		$this->data['pagetitle'] 	= 	$this->lang->line('pagetitle_role_list');	
		//function to initialize data table library
		$this->datatable_initialize();
		//set template for table		
		$tmpl = array ('table_open'  => '<table id="list_roles"  class="table table-bordered responsive my_table table-striped">' );
		$this->table->set_template($tmpl); 
		//set  th heading for table		
		$this->table->set_heading('<input type="checkbox"  class="checkall" />', 'Role', 'Edit');	
		$this->table->set_caption('<colgroup> <col class="con0"> <col class="con1"><col class="con0"> <col class="con1">  <col class="con0"><col class="con1">     
                          </colgroup>');
		$this->data['view']					= $this->lang->line('users').'/'.$this->lang->line('roles').'/list';
		$this->load->view('master', $this->data);	
	}
	/**
	* @author : "Lijiya Babu"
	* @date :01-03-2016
	* @desc : Function to list the roles using server side data table
	* @return array
	*/
	function datatable_roles()
	{
		//function to initialize datatable library
		$this->datatable_initialize();
		$this->datatables->select('UR.id,UR.role');
		$this->datatables->add_column('Edit', '$1', 'encrypt_edit(UR.id,'.$this->lang->line('users').'/'.$this->lang->line('roles').'/edit)');
		//$this->datatables->edit_column('UR.id', '<input type="checkbox" name="checked_item[]" class="jchecker dt_checkbox" value="$1"/>', 'UR.id');
		$this->datatables->from('user_role as UR');
		echo $this->datatables->generate();    
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
		*  @author	Jisha
		*  @date		05-03-2016
		*	@desc: For adding roles
		*  @param: nil
		*  @return value save to database 
	**/
	function add()
	{
		if(!$this->site_settings->has_privilege('Add Role'))
		{
			redirect('home/permission_error');
		}
		$this->breadcrumbcomponent->add('<i class="fa fa-dashboard"></i>Home', base_url());
		$this->breadcrumbcomponent->add($this->lang->line('bread_crumb_roles'),  base_url().'users/roles');
		$this->breadcrumbcomponent->add($this->lang->line('bread_crumb_roles_add'),  '#');
	   $this->data['breadcrumb']=$this->breadcrumbcomponent->output();		
		$this->data['admin_page_title'] 	= 'Add '.$this->lang->line('role_heading');
		$this->data['pagetitle']			= 	$this->lang->line('pagetitle_role_add');
		//To Get Dynamic Privileges for Adding Roles
		$this->data['module_array']		=  $this->get_privilege_details();
		//by shibon to get menus
		$this->data['all_menus']		=	modules::load('menus')->get_menus();
		//end shibon
		//form validation
		if (($this->form_validation->run('roles') === FALSE) ){				
				$this->data['view']					= $this->lang->line('users').'/'.$this->lang->line('roles').'/add';
				$this->load->view('master', $this->data);		
		}
		else{
			$privileges = $this->input->post('role_privileges');
			$privl 		= '';			
			if( ! empty($privileges))
			{
				$privl 	= implode(',', $privileges);
			}
			$role 		= $this->db->escape_str($this->input->post('role'));
			//by shibon to get detils of menu Privileges
			$menu_privileges=$this->input->post('menu');
			$menu_privl	= '';
			if( ! empty($menu_privileges))
			{
				$menu_privl = implode(',', $menu_privileges);
			}
			//end shibon
			//save role to db 
			$this->Roles_model->save($role, $privl, $menu_privl); 
			// save to log table 
			$operation 	= $this->lang->line('log_role_add');
			$this->site_settings->adminlog($operation);
			redirect($this->lang->line('users').'/'.$this->lang->line('roles'));
		}	
	}	
	/**
		*  @author	Lijiya
		*  @date		01-03-2016
		*	@desc:  For getting Dynamic Privileges for Adding Roles 
		*  @param: nil
		*  @return data
	**/
	public function get_privilege_details()
	{
			$privileges				= modules::load('users/Privileges/')->get_all();
			//To Get Dynamic Privileges for Adding Roles Starts
			$modules             = array();
			foreach ($privileges as $privilege)
			{
				list($type, $name)= explode(' ', $privilege->privilege.' ');
				$name 				= ucfirst($name);
				array_push($modules, $name);
			}
			$modules               = array_filter(array_unique($modules));
			$modules_array         = array();
			foreach ($modules as $row_id)
			{	
				$modules_array[] = array(
				'modules' => $row_id,
				'roles' => modules::load('users/Privileges/')->get_module_privileges($row_id)
				);       
			}
			return $modules_array;
			//To Get Dynamic Privileges for Adding Roles ends
	}
	/**
	* @author : Jisha Jacob
	* @date :05-03-2016
	* @desc:Function for edit roles
	* @param int $role_id role_id
	* @return true/false  
	*/
	function edit($role_id='')
	{
		if(!$this->site_settings->has_privilege('Edit Role'))
		{
			redirect('home/permission_error');
		}	
		$this->data['admin_page_title'] 	= 'Edit '.$this->lang->line('role_heading');
		$this->data['pagetitle']			= 	$this->lang->line('pagetitle_role_edit');
		$this->data['module_array'] 		=  $this->get_privilege_details();
		//decrypt role id 
		$role_id=$this->site_settings->get_decrypt_id($role_id);
		//get details of role with id  $role_id
		$this->data['selected_role']		=  $selecte_role	=	$this->get_selected_role($role_id);
		if(isset($selecte_role))
		{
			$this->breadcrumbcomponent->add('<i class="fa fa-dashboard"></i>Home', base_url());
			$this->breadcrumbcomponent->add($this->lang->line('bread_crumb_roles'),  base_url().'users/roles');
			$this->breadcrumbcomponent->add($selecte_role->role,  '#');
	   	$this->data['breadcrumb']=$this->breadcrumbcomponent->output();
	   }			
		//by shibon to get all menu
		$this->data['all_menus']		=	modules::load('menus')->get_menus();
		//end shibon
		//form validation
		if (($this->form_validation->run('roles') === FALSE) ){
				$this->data['selected_role']	= $this->get_selected_role($role_id);		
				$this->data['view']				= $this->lang->line('users').'/'.$this->lang->line('roles').'/edit';
				$this->load->view('master', $this->data);		
		}
		else{
			$privileges = $this->input->post('role_privileges');
			$privl 		= '';			
			if( ! empty($privileges))
			{
				$privl 	= implode(',', $privileges);
			}
			$role 		= $this->db->escape_str($this->input->post('role'));
			//by shibon to get detils of menu Privileges
			$menu_privileges=$this->input->post('menu');
			$menu_privl	='';
			if( ! empty($menu_privileges))
			{
				$menu_privl = implode(',', $menu_privileges);
			}
			//end shibon
			//update roles to database
			$this->Roles_model->update($role_id, $role, $privl, $menu_privl);     
			// save to log table 
			$operation = $this->lang->line('log_role_edit').$role_id;
			$this->site_settings->adminlog($operation);
			redirect($this->lang->line('users').'/'.$this->lang->line('roles'));
		}
	}
	/**
	* @author : "Lijiya Babu"
	* @date :01-03-2016
	* @desc:Function for select details of role from id
	* @param int $role_id role_id
	* @return name  
	*/
	public function get_selected_role($role_id)
	{
		$selected_role	= array();		
		//function to get role details		
		$selected_role	= $this->Roles_model->get_selected_details($role_id);
		return $selected_role;
	}
	
	/**
	* @author : "Jisha Jacob"
	* @date :4-03-2016
	* @desc:for get all active roles other than admin,insp,coodinator,client
	* @param: nil
	* @return result
	*/
	function get_active_roles() 
	{
		$res_roles_array		= $this->Roles_model->get_active_roles();
		return $res_roles_array;
	}
	/**
		*  @author	jisha
		*  @date		21-03-2016
		*  @desc		Function for get common label message
		*  @return	json_encoded array
		*/
	function get_label_messages()
	{
		$path_roles						= base_url().$this->lang->line('users').'/'.$this->lang->line('roles').'/datatable_roles'; 
		$error_role						= $this->lang->line('error_role');  
		$error_role_privilege		= $this->lang->line('error_role_privilege');  
		$data=array(
			'path_roles'					=> $path_roles,
			'error_role'					=> $error_role,
			'error_role_privilege'		=> $error_role_privilege
		);
		echo json_encode($data);
	}
	/**
		*  @author	Lijiya
		*  @date		01-03-2016
		*  @desc		Function for get all common details
		*  @return	array
		*/
	function get_common()
	{
		$this->site_settings->get_site_settings();
		$this->data['profile']=$this->site_settings->personal_details();	
		$this->data['menus_all']	= 	modules::load('menus')->get_menus();
		$this->data['myprivileges']	=	$this->site_settings->myprivileges();
		$this->data['tree1']				=	'settings';
		$this->data['footer']    = '<script src="'.base_url().'/assets/'.$this->lang->line('users').'/js/roles.js" type="text/javascript"></script>';
	}	
	}
//End of file Roles.php
/* Location: ./modules/users/controllers/Roles.php */
