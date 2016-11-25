<?php
/**
	* File: Designation.php
	* Class Designation
	*
	*	PHP version 5.3
	* @category	BACK_END_Designation
	* @package		Designation
	* @author		Lijiya Babu <lijiya@cliffsupport.com>
	* @license		Cliff Creation
	* @link        http://heims.com/Designation/
	* @since			01-03-2016
	* @Version		1.0
	*/
	/**
	* Designation Class Doc Comment
	* Classs Designation
	*	PHP version 5.3
	* @category	BACK_END_Designation
	* @package		Designation
	* @author		Lijiya Babu <lijiya@cliffsupport.com>
	* @license		Cliff Creation
	* @link        http://heims.com/Designation
	* @since			01-03-2016
	* @Version		1.0
	*/
	class Designation extends MX_Controller {
	/**
	* @var string $data
	*/
	public $data;   
	/**  	   
	*	@author Lijiya
	*	@date	01-03-2016
	*  @desc Define Designation
	*/	
	public function __construct()
	{
		parent::__construct();
		$this->authentication->is_logged_in();		
		$this->load->model('users/Designation_model');
		$this->get_common();
	}
	/**
	* @author : "Lijiya Babu"
	*	@date	01-03-2016
	* @desc:Function for list desgntns
	* @return true/false  
	*/
	public function index()
	{
		if(!$this->site_settings->has_privilege('List Designation'))
		{
			redirect('home/permission_error');
		}	
		$this->breadcrumbcomponent->add('<i class="fa fa-dashboard"></i>Home', base_url());
		$this->breadcrumbcomponent->add($this->lang->line('bread_crumb_designation'),  '#');
	   $this->data['breadcrumb']=$this->breadcrumbcomponent->output();	
		//set page title	
		$this->data['admin_page_title'] 	= $this->lang->line('designation_heading').'s';
		$this->data['pagetitle'] 	= 	$this->lang->line('pagetitle_designation_list');	
		//function to initialize data table library
		$this->list_datatable();
		$this->data['view']					= $this->lang->line('designation').'/list';
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
		$tmpl = array ('table_open'  => '<table id="list_designation"  class="table table-bordered responsive my_table table-striped">' );
		$this->table->set_template($tmpl); 
		//set  th heading for table		
		$this->table->set_heading('<input type="checkbox"  class="checkall" />', 'Designation', 'Edit');	
		$this->table->set_caption('<colgroup> <col class="con0"> <col class="con1"><col class="con0"> <col class="con1">  <col class="con0"><col class="con1">     
                          </colgroup>');
	}	
	/**
	* @author : "Lijiya Babu"
	* @date	01-03-2016
	* @desc : Function to list the designation using server side data table
	* @return array
	*/
	function datatable_designation()
	{
		//function to initialize datatable library
		$this->datatable_initialize();
		$this->datatables->select('UD.id,UD.designation');
		$this->datatables->add_column('Edit', '$1', 'encrypt_edit_modal(UD.id,'.$this->lang->line('designation').'/edit,UD.designation) ');
		//$this->datatables->edit_column('UD.id', '<input type="checkbox" name="checked_item[]" class="jchecker dt_checkbox" value="$1"/>', 'UD.id');
		$this->datatables->from('user_designation as UD');
		echo $this->datatables->generate();    
	}
	/**
	* @author : "Lijiya Babu"
	* @date :01-03-2016
	* @desc:For adding designation
	* @param: nil
	* @return value save to database 
	*/	
	function add()
	{
		if(!$this->site_settings->has_privilege('Add Designation'))
		{
			redirect('home/permission_error');
		}	
		$this->data['admin_page_title']  = 'Add '.$this->lang->line('designation_heading');
		$this->data['pagetitle'] 			= 	$this->lang->line('pagetitle_designation_add');	
		if (($this->form_validation->run('designation') === FALSE) OR ($this->check_exists($this->input->post('designation_name'))))
		{
			$this->data['designation_validate'] 	= 1;
			//function to initialize data table library
			$this->list_datatable();
			$this->data['view']						= $this->lang->line('designation').'/list';
			$this->data['alert']			 = '';
			if($this->check_exists($this->input->post('designation_name'))){
					$this->data['alert']  = 'Designation Already exists';
			}
			$this->load->view('master', $this->data);
		}
		else {
			$designation		= $this->db->escape_str($this->input->post('designation_name'));
			//Function to save location to DB
			$this->Designation_model->save($designation);					
			// save to log table 
			$operation = $this->lang->line('log_designation_add');
			$this->site_settings->adminlog($operation);
			redirect($this->lang->line('users').'/'.$this->lang->line('designation'));
		}		
	}	
	/**
	* @author : "Lijiya Babu"
	* @date :01-03-2016
	* @desc:Function for edit designation 
	* @return true/false  
	*/
	public function edit()
	{
		if(!$this->site_settings->has_privilege('Edit Designation'))
		{
			redirect('home/permission_error');
		}	
		$designation_id = $this->input->post('designation_id');
		//set page title		
		$this->data['admin_page_title'] 	= 'Edit '.$this->lang->line('designation_heading');
		//get details of designation with id  $designation_id
		$this->data['selected_designation']	= $this->get_designation_details($designation_id);
		if (($this->form_validation->run('designation') === FALSE) OR ($this->check_exists_edit($this->input->post('designation_name'), $designation_id)) )
		{
			$this->data['designation_edit_validate'] 	= 1;
			//function to initialize data table library
			$this->list_datatable();
			$this->data['view']			 = $this->lang->line('designation').'/list';
			$this->data['alert']			 = '';
			if($this->check_exists_edit($this->input->post('designation_name'), $designation_id)){
					$this->data['alert']  = 'Designation Already exists';
			}
			$this->load->view('master', $this->data);
		}
		else {
			$designation		= $this->db->escape_str($this->input->post('designation_name'));
			//Function to update location details to DB
			$this->Designation_model->update($designation_id, $designation);
			// save to log table 
			$operation = $this->lang->line('log_designation_edit').$designation_id;
			$this->site_settings->adminlog($operation);
			redirect($this->lang->line('users').'/'.$this->lang->line('designation'));
		}
	}
	/**
	* @author : "Lijiya Babu"
	* @date :01-03-2016
	* @desc:Function for select details of designation from id
	* @param int $designation_id designation_id
	* @return name  
	*/
	public function get_designation_details($designation_id)
	{
		$selected_designation	= array();		
		//function to get designation details		
		$selected_designation	= $this->Designation_model->get_selected($designation_id);
		return $selected_designation;
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
		*  @author	jisha
		*  @date		31-03-2016
		*  @desc		Function for get common label message
		*  @return	json_encoded array
		*/
	function get_label_messages()
	{
		$path_list_designation	= base_url().$this->lang->line('users').'/'.$this->lang->line('designation'); 
		$error_designation_name	= $this->lang->line('error_designation_name');  
		$path_designation			= base_url().$this->lang->line('users').'/'.$this->lang->line('designation').'/datatable_designation';  
		$data=array(
			'path_list_designation'		=> $path_list_designation,
			'error_designation_name'	=> $error_designation_name,
			'path_designation'			=> $path_designation
		);
		echo json_encode($data);
	}
	/**
	* @author : "Jisha Jacob"
	* @date :4-03-2016
	* @desc:for get all active designation
	* @param: nil
	* @return result array of designations
	*/
	function get_active_designations() 
	{
		$res_designation_array		= $this->Designation_model->get_active_designations();
		return $res_designation_array;
	}
	/**
		*  @author : Jisha
		*  @date :13-04-2016
		*  @desc:Function for get check Designation name exists
		*  @param	var $name Designation_name
		*  @return array row
		*/
	function check_exists($name)
	{
		//function to check unitname exists		
		$selected_name	= $this->Designation_model->check_exists($name);
		if( ! empty($selected_name))
			return TRUE;
		else	
			return FALSE;
	}
	/**
		*  @author : Jisha
		*  @date :13-04-2016
		*  @desc:Function for get check designation name exists in edit
		*  @param	var $name    designation_name
		*  @param	int $des_id  designation_id
		*  @return array row
		*/
	function check_exists_edit($name, $des_id)
	{
		//function to check Designation name exists		
		$selected_name	= $this->Designation_model->check_exists_edit($name, $des_id);
		if( ! empty($selected_name))
			return TRUE;
		else	
			return FALSE;
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
		$this->data['menus_all']		= 	modules::load('menus')->get_menus();
		$this->data['myprivileges']	=	$this->site_settings->myprivileges();
		$this->data['tree1']				=	'settings';
		$this->data['footer']    = '<script src="'.base_url().'/assets/'.$this->lang->line('users').'/js/designation.js" type="text/javascript"></script>';
	}	
	}//End of file Designation.php
/* Location: ./modules/users/controllers/Designation.php*/