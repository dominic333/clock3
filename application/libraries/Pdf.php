<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * M PDF Library
 *
 * This class enables the creation of calendars
 *
 * @package		Third Party Plugin
 * @subpackage	CodeIgniter
 * @category	Libraries
 * @author		
 * @link		
 */
class pdf {
    
    //Function To Get Codeignter Instances
    function pdf()
    {
        $CI = & get_instance();
        log_message('Debug', 'mPDF class is loaded.');
    }
    
 	 //Function To Load The Mpdf Third Party
    function load($param=NULL)
    {
        include_once APPPATH.'/third_party/mpdf/mpdf.php';
         
        if ($param == NULL)
        {
            $param = '"en-GB-x","A4","","",10,10,10,10,6,3';  
        }
         
        return new mPDF($param);
       //return  $param;
    }
}
?>