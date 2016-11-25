<?php 
	/**
	* My404 File Doc Comment
	* 
	* PHP version 5
	* @category    My404_Agent
	* @package     CodeIgniter
	* @author      Lijiya Babu  <lijiya@cliffsupport.com>
	* @license 		Cliff Creation
	* @link        http://heims.com/My404.html
	*/
	/**
	* My404 Class Doc Comment
	* 
	* PHP version 5
	* @category    My404_Agent
	* @package     CodeIgniter
	* @author      Lijiya Babu  <lijiya@cliffsupport.com>
	* @license 		Cliff Creation
	* @link        http://heims.com/My404.html
	*/
class My404 extends MX_Controller
{
		/**
		* @var string $data
		*/
		public $data;
		/** 
		* Define Constructor
		* @author "Lijiya Babu"
		*/	
		public function __construct() 
		{
			parent::__construct(); 
		} 
	/**
	* @author : "Lijiya Babu"
	* @date :26-02-2016
	* @desc:Function for showing custom 404 page
	* @return true/false  
	*/
		public function index() 
		{ 
			$this->output->set_status_header('404'); 
			$data['content'] = 'error_404'; // View name 
			$this->load->view('my404', $data);//loading in my template 
		} 
}
//End of file My404.php
/*Location: ./controllers/My404.php */ 