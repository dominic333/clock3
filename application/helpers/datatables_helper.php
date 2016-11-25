<?php 
/**
*Author : Lissy SR
*Date   : 27-02-2016
*Desc   : Function For encryption of id
*/
function hide_id()
{	  
     static $count=1;     
     $html =$count++;
     return $html;
}

function encrypt_edit_modal($id,$url,$name)
{	  
     $ci = &get_instance();
     $ci->load->library('encryption');
     $non_enrypt_id = $id;
     $id = $ci->encryption->encrypt($id);
     $id=str_replace(array('+', '/', '='), array('-', '_', '~'), $id);
     $html ='<a href="'.  base_url().$url.'/'.$id.'" data-toggle="modal" data-target="#edit_row" class="for_edit" data-id="'.$non_enrypt_id.'" data-value="'.$name.'"><span class="fa fa-pencil-square-o centeralign"></span></a>';
     return $html;
}

/**
*Author : Lissy SR
*Date   : 27-02-2016
*Desc   : Function For encryption of id in edit
*/
function encrypt_edit($id,$url)
{	  
     $ci = &get_instance();
     $ci->load->library('encryption');
     $id = $ci->encryption->encrypt($id);
     $id=str_replace(array('+', '/', '='), array('-', '_', '~'), $id);
     $html ='<a href="'.  base_url().$url.'/'.$id.'"><span class="fa fa-pencil-square-o centeralign"></span></a>';
     return $html;
}


function encrypt_delete_href($id,$url)
{	  
     $ci = &get_instance();
     $ci->load->library('encryption');
     $id = $ci->encryption->encrypt($id);
     $id=str_replace(array('+', '/', '='), array('-', '_', '~'), $id);
     $html ='<a href="'.  base_url().$url.'/'.$id.'"><span class="fa fa-trash-o centeralign"></span></a>';
     return $html;
}
function encrypt_edit_schedule($id,$url, $completed)
{	  
$ci = &get_instance();
	if($completed == 0)
	{
     $ci = &get_instance();
     $ci->load->library('encryption');
     $id = $ci->encryption->encrypt($id);
     $id=str_replace(array('+', '/', '='), array('-', '_', '~'), $id);
     $html ='<a href="'.  base_url().$url.'/'.$id.'"><span class="fa fa-pencil-square-o centeralign"></span></a>';
   }
   else {
   	$html ='<a><span class="fa fa-check centeralign"></span></a>';
   }	  
     return $html;
}
/**
*Author : Lissy SR
*Date   : 04-03-2016
*Desc   : Function For encryption of id in edit which id done in modal pop up
*/
function encrypt_edit_modal_popup($id,$name,$modal_name,$url)
{	  
     $ci = &get_instance();
     $ci->load->library('encryption');
     $id = $ci->encryption->encrypt($id);
     $id=str_replace(array('+', '/', '='), array('-', '_', '~'), $id);
     $html ='<a href="#" data-id="'.$id.'" data-value="'.$name.'" data-toggle="modal" data-target="#'.$modal_name.'" class="edit_set_value"><span class="fa fa-pencil-square-o centeralign"></span></a>';
     return $html;
}
/**
*Author : Lissy SR
*Date   : 04-03-2016
*Desc   : Function For encryption of id in edit which id done in modal pop up of examination,test
*/
function encrypt_edit_modal_popup_test($id, $name, $thirdparty, $subcontractor, $durations, $modal_name, $url)
{	  
     $ci = &get_instance();
     $ci->load->library('encryption');
     $id = $ci->encryption->encrypt($id);
     $id=str_replace(array('+', '/', '='), array('-', '_', '~'), $id);
     $html ='<a href="#" data-id="'.$id.'" data-name="'.$name.'" data-thirdparty="'.$thirdparty.'" data-subcontract="'.$subcontractor.'" data-durations="'.$durations.'" data-toggle="modal" data-target="#'.$modal_name.'" class="edit_set_value align-center"><span class="fa fa-pencil-square-o centeralign"></span></a>';
     return $html;
}
/**
*Author : Lissy SR
*Date   : 01-03-2016
*Desc   : Function For encryption of id in delete
*/
function encrypt_delete($id,$url)
{	  
     $ci = &get_instance();
     $ci->load->library('encryption');
     $id = $ci->encryption->encrypt($id);
     $id=str_replace(array('+', '/', '='), array('-', '_', '~'), $id);
	  $html='<a href="#" data-id="'.$id.'" class="validate_delete"><span class="fa fa-trash-o"></span></a>';   
     return $html;
}
/**
*Author : Lissy SR
*Date   : 27-02-2016
*Desc   : Function For encryption of id in view link
*/
function encrypt_view($id,$url)
{	  
     static $count=1;
     $ci = &get_instance();
     $ci->load->library('encryption');
     $id = $ci->encryption->encrypt($id);
     $id=str_replace(array('+', '/', '='), array('-', '_', '~'), $id);
     $html ='<a href="'.  base_url().$url.'/'.$id.'">'.$count++.'</a>';
     return $html;
}
/**
*Author : Jisha Jacob
*Date   : 10-03-2016
*Desc   : Function For add space after coma
*/
function addspace($comma_separated_string)
{	  
	$comma_separated_string = explode(',', $comma_separated_string);
	$add_space_string = implode(',  ', $comma_separated_string);
	return $add_space_string;
}
/**
*Author : Lissy SR
*Date   : 27-02-2016
*Desc   : Function For encryption of id in view link
*/
function encrypt_view_heading($id,$head,$url)
{	  
     $ci = &get_instance();
     $ci->load->library('encryption');
     $id = $ci->encryption->encrypt($id);
     $id=str_replace(array('+', '/', '='), array('-', '_', '~'), $id);
     $html ='<a href="'. base_url().$url.'/'.$id.'">'.$head.'</a>';
     return $html;
}

function encrypt_view_heading_id($id,$head,$url)
{	  
     $ci = &get_instance();
     if($id !=0)
     {
     		$ci->load->library('encryption');
     		$id = $ci->encryption->encrypt($id);
     		$id=str_replace(array('+', '/', '='), array('-', '_', '~'), $id);
     		$html ='<a href="'. base_url().$url.'/'.$id.'">'.$head.'</a>';
     		return $html;
     }
     else {
     	return 'Nil';
     }		
}

/**
*Author : Lissy SR
*Date   : 27-02-2016
*Desc   : Function For encryption of id in view link
*/
function encrypt_view_id($id,$url)
{	  
     $ci = &get_instance();
     $ci->load->library('encryption');
     $dec_id=$id;
     $id = $ci->encryption->encrypt($id);
     $id=str_replace(array('+', '/', '='), array('-', '_', '~'), $id);
     $html ='<a href="'. base_url().$url.'/'.$id.'">'.$dec_id.'</a>';
     return $html;
}
/**
*Author : Lissy SR
*Date   : 27-02-2016
*Desc   : Function For encryption of id in status
*/
function status($id,$stat,$url){
	
	$ci= & get_instance();
	$ci = &get_instance();
   $ci->load->library('encryption');
   $id = $ci->encryption->encrypt($id);
   $id=str_replace(array('+', '/', '='), array('-', '_', '~'), $id);
	if($stat == 1){
	$html='<a href="'.  base_url().$url.'/'.$id.'/0'.$ci->uri->segment(4, '').'"><span class="status-active">Active</span></a>';
	}else{
	$html='<a href="'.  base_url().$url.'/'.$id.'/1'.$ci->uri->segment(4, '').'"><span class="status-inactive">Inactive</span></a>';
	}
	return $html;
	
}

/**
*Author : Shibon
*Desc   : Function to check whether a field has value otherwise return nil
*/
function check_data($data)
{
	$ci= & get_instance();
	if($data)
	{
		return $data;
	}
	else
	{
		return 'Nil';
	}
}
	/**
		*	@author	shibon
		*	@date		09-08-2016
		*	@param	int	$time_stamp
		*	@desc		this function is used to convert the time stamp to readable time
		*	@return	string	
		*/
		function date_time_log($time_stamp)
		{
			$time_stampe	=	(float)$time_stamp;
			$new_format	=	 date('d M Y h:i A',$time_stampe);
			return $new_format;
		}
?>