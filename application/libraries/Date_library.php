<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
  * Date Library
  *
  * This is a Library to get The Details Within Two Given Dates
  * 
  * @package    CodeIgniter
  * @subpackage libraries
  * @category   library
  * @project    Edify
  * @author     Farveen Hassan,Bigil Micheal
  * @Team Lead  Bigil Micheal
  * @link       
  */
  class Date_library
  {
  	/**
    * Global container variables for chained argument results
    *
    */
    
	    
    	// Define Constructor
		// @author Farveen
		function Date_library(){
			define('ONE_WEEK', 604800); // 7 * 24 * 60 * 60
		}
		
		
	   //Function To Get Sundays
		//@Author Farveen
		//@returns Num of Sundays
		function get_sundays($start_date,$end_date){
			 $start=strtotime($start_date);
			 $end=strtotime($end_date);
			 $sundays=$this->date_engine(0x01,$start,$end);
			 return $sundays;
		}
		
		//Function To Get Saturdays
		//@Author Farveen
		//@returns Num of Saturdays
		function get_saturdays($start_date,$end_date){
			 $start=strtotime($start_date);
			 $end=strtotime($end_date);
			 $saturdays=$this->date_engine(0x40,$start,$end);
			 return $saturdays;
		}
		
		//Function To Process Date Library
		function date_engine($days,$start,$end){
		
			 $w = array(date('w', $start), date('w', $end));
		    $x = floor(($end-$start)/ONE_WEEK);
		    $sum = 0;
		
		    for ($day = 0;$day < 7;++$day) {
		        if ($days & pow(2, $day)) {
		            $sum += $x + ($w[0] > $w[1]?$w[0] <= $day || $day <= $w[1] : $w[0] <= $day && $day <= $w[1]);
		        }
		    }
		
		    return $sum;
		}
		
		//Function To Get Number Of Days
		//@Author Farveen
		//@returns Num of days Between Start Date and End Date
		function get_days($start_date,$end_date){
			  
			  $start=strtotime($start_date);
			  $end=strtotime($end_date);
		     $datediff = abs($start - $end);
		     $days = floor($datediff/(60*60*24));
		
		    return $days;
		}
		
		//Author anju Krishnan
		//function set date format
		function set_date_format($date){
			if($date != '0000-00-00')
			{
				if(strtotime($date) && 1 === preg_match('~[0-9]~', $date)){
				    return date('d M Y', strtotime($date));
				} else {
				    return $date;
				}
			}
			else {
				return 'Nil';
			}		
	}
    
  }
  
  
  
  /* End of file Someclass.php */