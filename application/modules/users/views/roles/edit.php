<?php        
        $form_token = uniqid();          
        $this->session->set_userdata('form_token',  $form_token);   
?>
<?php
$role_id				= '';
if(isset($selected_role)){
	$role_id			= $this->site_settings->get_encrypt_id($selected_role->id);
	$role		= $selected_role->role;
	$myprivileges	= $selected_role->privileges;
	$my_menu_privileges	= $selected_role->menu_privileges;
}
?>
<div class="content-wrapper" style="min-height: 946px;">
 <?php $attributes = array('name' => 'add_role','id' => 'add_role', 'method' =>'POST');//To enable CSRF protection
        					echo form_open('/'.$this->lang->line('users').'/'.$this->lang->line('roles').'/edit/'.$role_id, $attributes);  ?><!-- To enable CSRF protection-->
               <input type="hidden" name="form_token" value="<?php if(isset($form_token)){echo $form_token;} ?>" /> 
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo (isset($admin_page_title) ? $admin_page_title :''); ?>
            <small></small>
          </h1>
 <?php $this->load->view('breadcrumb'); ?>          
          <!--<ol class="breadcrumb">
            <li><a href="<?php echo base_url().$this->lang->line('home');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a  href="<?php echo base_url().$this->lang->line('users').url_suffix(); ?>"><?php echo $this->lang->line('user_heading');?></a></li>
           	<li><a href="<?php echo base_url().$this->lang->line('users').'/'.$this->lang->line('roles').url_suffix();?>"><?php echo $this->lang->line('role_heading').'s'; ?></a></li>
            <li class="active">Edit</li>
          </ol>-->
        </section>

        <section class="content">
          <div class="col-md-12 p-0">
            <!-- left column -->
              <!-- general form elements -->
              <div class="box box-primary p-l-10 p-r-10 p-b-10">
                 <div class="form-group m-t-15">
                  <label>Role *</label>
                 <input id="role" type="text" name="role" class="form-control"  value="<?php echo (isset($role)) ? $role:set_value('role'); ?>" placeholder="role *">
                 </div>
                 <div class="clearfix"></div>
                  <div class="all-roll-selct pull-right m-t-10">
                    <label><input type="checkbox" name="check" id="check_role_add" class="checkall" > Select All</label>
                 </div> 
                <h3 class="page-header menus">Privilege Matrix</h3> 
                <?php //print_r($module_array); ?>
						<table class="table table-bordered table-striped panel-view m-b-10">
            			<thead>
	            			<tr>
								<th class="text-600 text-uppercase">Modules</th>
								<th class="text-600 text-uppercase">list</th>
								<th class="text-600 text-uppercase">view</th>
								<th class="text-600 text-uppercase">add</th>
								<th class="text-600 text-uppercase">edit</th>
								<th class="text-600 text-uppercase">delete</th>
								<th class="text-600 text-uppercase">change Status</th>	
								</tr>
							</thead>
						<?php if( ! empty($myprivileges) &&(isset($selected_role))){
									$myprivileges = explode(",", $myprivileges);
								}
								else {
									$myprivileges	=	array(0);
								}	
							?>
							<?php if( ! empty($module_array)){
								foreach($module_array as $ma){ ?>
							<tr>
								<td><?php echo $ma['modules'];?></td>
								<?php  foreach ($ma['roles'] as $row) { ?>
								<?php  	list($type,$name) = explode(" ",$row['privilege'].' ');
											$privilege_id		= $row['id'];
											$checkbox_id		= str_replace(' ','_', strtolower($row['privilege']));
											$type					= strtolower($type);
											$name					= ucfirst($name);								
										   if($type =="list"){ 
												$list_checkbox_id=$checkbox_id;$list_value=$privilege_id; // Geting List Privileges for modules
										   }elseif($type =="view") { 
												 $view_checkbox_id=$checkbox_id;$view_value=$privilege_id; // Geting View Privileges for modules
										   }elseif($type =="add") { 
												 $add_checkbox_id=$checkbox_id;$add_value=$privilege_id;  // Geting Add Privileges for modules
										   }elseif($type =="edit") { 
												 $edit_checkbox_id=$checkbox_id;$edit_value=$privilege_id; // Geting Edit Privileges for modules
										   }elseif($type =="delete") { 
												 $delete_checkbox_id=$checkbox_id;$delete_value=$privilege_id; // Geting Delete Privileges for modules
										   }elseif($type =="enable") { 
													 $status_checkbox_id=$checkbox_id;$status_value=$privilege_id; // Geting change Status Privileges for modules
											}									
											else{
												 $list_value='';$view_value='';$add_value='';$edit_value='';$delete_value='';$status_value='';$gridview_value='';$manage_value='';$accept_value=''; $reject_value='';
											}?>
								<?php } ?>
								<td class="centeralign"><?php if(isset($list_value)&&$list_value!=''){ ?><input type="checkbox" name="role_privileges[]" id="<?php echo isset($list_checkbox_id)?$list_checkbox_id:'' ?>" value="<?php echo isset($list_value)?$list_value:''; ?>" <?=(in_array($list_value, $myprivileges) ? 'checked="checked"': set_checkbox('privileges[]', $list_value))?>/><?php } ?></td>
								<td class="centeralign"><?php if(isset($view_value)&&$view_value!=''){ ?><input type="checkbox" name="role_privileges[]" id="<?php echo isset($view_checkbox_id)?$view_checkbox_id:'' ?>" value="<?php echo isset($view_value)?$view_value:''; ?>" <?=(in_array($view_value, $myprivileges) ? 'checked="checked"': set_checkbox('privileges[]', $view_value))?>/><?php } ?></td>
								<td class="centeralign"><?php if(isset($add_value)&&$add_value!=''){ ?><input type="checkbox" name="role_privileges[]" id="<?php echo isset($add_checkbox_id)?$add_checkbox_id:'' ?>" value="<?php echo isset($add_value)?$add_value:''; ?>" <?=(in_array($add_value, $myprivileges) ? 'checked="checked"': set_checkbox('privileges[]', $add_value))?>/><?php } ?></td>
								<td class="centeralign"><?php if(isset($edit_value)&&$edit_value!=''){ ?><input type="checkbox" name="role_privileges[]" id="<?php echo isset($edit_checkbox_id)?$edit_checkbox_id:'' ?>" value="<?php echo isset($edit_value)?$edit_value:''; ?>" <?=(in_array($edit_value, $myprivileges) ? 'checked="checked"': set_checkbox('privileges[]', $edit_value))?> /><?php } ?></td>
								<td class="centeralign"><?php if(isset($delete_value)&&$delete_value!=''){ ?><input type="checkbox" name="role_privileges[]" id="<?php echo isset($delete_checkbox_id)?$delete_checkbox_id:'' ?>" value="<?php echo isset($delete_value)?$delete_value:''; ?>" <?=(in_array($delete_value, $myprivileges) ? 'checked="checked"': set_checkbox('privileges[]',$delete_value))?> /><?php } ?></td>
								<td class="centeralign"><?php if(isset($status_value)&&$status_value!=''){ ?><input type="checkbox" class="role_check jchecker dt_checkbox" name="role_privileges[]" id="<?php echo isset($status_checkbox_id)?$status_checkbox_id:'' ?>" value="<?php echo isset($status_value)?$status_value:''; ?>" <?=(in_array($status_value, $myprivileges) ? 'checked="checked"': set_checkbox('privileges[]',$status_value))?> /><?php } ?></td>
									<?php /* Resetting the value */ ?> 
								<?php $list_value='';$view_value='';$add_value='';$edit_value='';$delete_value='';$status_value='';$gridview_value='';$manage_value='';$accept_value=''; $reject_value=''; ?>
								<?php $list_checkbox_id='';$view_checkbox_id='';$add_checkbox_id='';$edit_checkbox_id='';$delete_checkbox_id='';$status_checkbox_id='';$gridview_checkbox_id='';$manage_checkbox_id='';$accept_checkbox_id='';$reject_checkbox_id=''; ?>
            			</tr>
            		<?php } ?>
            		<?php } ?>
            		
            		
            	</table>		
						<em class="frm_error"><?php echo form_error('role_privileges'); ?></em>                  					
                <!--	<div class="box-footer b-0">
                        <button class="btn btn-primary pull-right" name="submit" value="submit" type="submit"><?php echo $this->lang->line('submit'); ?> </button>
						<button type="button" class="btn btn-danger pull-right m-r-5" type="button" onClick="self.location='<?php echo base_url().$this->lang->line('users').'/'.$this->lang->line('roles');?>'"><?php echo $this->lang->line('cancel'); ?></button>
					</div>
            </div>           
      </div>-->
		<?php
       if(isset($all_menus)){
          $cnt_length=0;
         	foreach($all_menus as $mn)
         	{
         		if(count($mn['child_array']) > $cnt_length) 
         		{
         			$cnt_length=count($mn['child_array']);	
        			}         			
     			}
     			}
         		//echo	$cnt_length;
		?>	
<h3 class="menus">Enable/Disable Menu</h3>           
            
<div class="table-responsive">
    <table class="table table-bordered table-hover menu-table">
        <tbody>
         <?php
         if(isset($all_menus) && isset($selected_role)) {	
         $my_menu_privileges=explode(",",$my_menu_privileges); 
         foreach($all_menus as $mn){
						?>	
            <tr id="<?php echo $mn['parent_array']['id'];?>">
                <th><?php echo $mn['parent_array']['menu_name'];?></th>
                <?php  foreach ($mn['child_array'] as $row) {
								 
							?>
                <td id="<?php echo $row['id'];?>"> <input <?php if(in_array($row['id'],$my_menu_privileges)) { echo 'checked=checked'; } ?> type="checkbox" value="<?php echo $row['id'];?>" name="menu[]" /> <?php echo $row['menu_name']?> </td>
                <?php }
                 if(count($mn['child_array'])==$cnt_length)
                {
                	
                }
                else {
                	// count($mn['child_array'])-$cnt_length;
                	for($i=1;($i<=$cnt_length-(count($mn['child_array'])));$i++)
                	{
                		echo "<td></td>";
                	}
                	}                
                 ?>
            </tr>
            <?php }
            } ?>
        </tbody>
    </table>
</div><!--/.table-responsive-->     
<div class="box-footer b-0">
                        <button class="btn btn-primary pull-right" name="submit" value="submit" type="submit"><?php echo $this->lang->line('submit'); ?> </button>
						<button type="button" class="btn btn-danger pull-right m-r-5" type="button" onClick="self.location='<?php echo base_url().$this->lang->line('users').'/'.$this->lang->line('roles');?>'"><?php echo $this->lang->line('cancel'); ?></button>
					</div>
            </div>           
      </div>
 </section> 
<?php echo form_close(); ?>   	               
</div>
     