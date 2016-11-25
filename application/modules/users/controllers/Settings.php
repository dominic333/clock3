<?php
/**
	* File: Settings.php
	* Class settings
	*
	*	PHP version 5.3
	* @category	BACK_END_settings
	* @package		Settings
	* @author		Jisha <jisha@cliffsupport.com>
	* @license		Cliff Creation
	* @link        http://ksktu.com/Settings/
	* @since			01-03-2016
	* @Version		1.0
	*/
	/**
	* Settings Class Doc Comment
	* Classs Settings
	*	PHP version 5.3
	* @category	BACK_END_Settings
	* @package		Settings
	* @author		Jisha <Jisha@cliffsupport.com>
	* @license		Cliff Creation
	* @link        http://heims.com/Settings
	* @since			01-03-2016
	* @Version		1.0
	*/
	class Settings extends MX_Controller {
	/**
	* @var string $data
	*/
	public $data;   
	/**  	   
	*	@author Jisha
	*	@date	14-06-2016
	*  @desc Define Settings
	*/	
	public function __construct()
	{
		parent::__construct();
		$this->authentication->is_logged_in();		
		$this->load->model('users/Settings_model');
		$this->get_common();
	}

	/**
		*  @author	Jisha
		*  @date		05-03-2016
		*	@desc: For adding roles
		*  @param: nil
		*  @return value save to database 
	**/
	function index()
	{
		if(!$this->site_settings->has_privilege('Edit Website'))
		{
			redirect('home/permission_error');
		}	
		$this->data['admin_page_title'] 	= $this->lang->line('website_settings');
		$this->data['pagetitle']			= $this->lang->line('pagetitle_settings');
		//for bread crumb
		$this->breadcrumbcomponent->add('Home', base_url());
	   $this->breadcrumbcomponent->add($this->lang->line('website_settings'), base_url().'users/settings');
	   $this->data['breadcrumb']			= $this->breadcrumbcomponent->output();
		$this->data['view']					= $this->lang->line('users').'/settings';
		$this->get_settings()	;
      if (($this->form_validation->run('settings') === FALSE) ){				
				$this->load->view('master', $this->data);		
		}
		else{
         $this->Settings_model->save();
			$operations = "Settings Updated ";
			$this->site_settings->adminlog($operations); 
			$this->get_settings();
			$this->data['alert'] = 'Page Updated Successfully'; 	
			$this->load->view('master', $this->data);		
		}	
	}	
	/**
		*  @author	Jisha
		*  @date		01-03-2016
		*  @desc		Function for get all common details
		*  @return	array
		*/
	function get_settings(){
		$rows	=	array();
		$rows	=  $this->Settings_model->get_settings();			
		foreach($rows as $row){
			$this->data[$row->config_key]	=$row->config_value;
		}
		return $this->data;
	}
	
	/**
		*  @author	Jisha
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
		$this->data['footer']    		= '';
	}
}
//End of file Settings.php
/* Location: ./modules/users/controllers/Settings.php */