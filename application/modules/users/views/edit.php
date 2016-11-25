<?php        
	$en_user_id ='';	
	if(isset($selected_user)) {
		if(!empty($selected_user)){
			$en_user_id = $this->site_settings->get_encrypt_id($selected_user->id_user);
			$user_firstname 	= $selected_user->firstname;
			$user_lastname 	= $selected_user->lastname;
			$user_email 		= $selected_user->email;
			$user_dob 			= $selected_user->dob;
			$user_roles 		= $selected_user->role;
			$user_gender 		= $selected_user->gender;
			$user_designation = $selected_user->designation;
			$user_mobile 		= $selected_user->mobile;
			$user_sec_mob 		= $selected_user->secondary_number;
			$user_address 		= $selected_user->contact_address;
			$user_pincode 		= $selected_user->pincode;
			$user_about_me		= $selected_user->about_me;
			$user_photo			= $selected_user->photo;
			//$user_join_date	= $selected_user->join_date;
		}
	}  
?>
<div class="content-wrapper" style="min-height: 946px;">
	<section class="content-header">
         <h1>
            <?php echo (isset($admin_page_title) ? $admin_page_title :''); ?>
            <small></small>
           <a href="#" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_user_heading_edit'); ?>">
            <i class="fa fa-question-circle tooltip-icon-header"></i>
           </a></h1>        
<?php $this->load->view('breadcrumb'); ?>
          <!--<ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url().$this->lang->line('users');?>"><?php echo $this->lang->line('user_heading'); ?></a></li>
            <li class="active">Edit </li>
          </ol>-->
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<!-- general form elements -->
				<div class="box box-primary">
					<div class="box-header with-border">
					</div><!-- /.box-header -->
               <!-- form start -->
               <?php $attributes = array('name' => 'edit_users','id' => 'edit_users', 'method' =>'POST');//To enable CSRF protection
        					echo form_open('/'.$this->lang->line('users').'/edit/'.$en_user_id, $attributes);  ?><!-- To enable CSRF protection-->
               <div class="box-body">
                    <div class="col-md-4">
		         	<div class="form-group">
	               	 <label for="user_firstname"><?php echo $this->lang->line('user_firstname'); ?> <span class="mandatory">*</span></label>
	               	 <a href="#" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_user_firstname'); ?>">
	                       <i class="fa fa-question-circle"></i>
	                      </a>
	                	 <input type="text" name="user_firstname" id="user_firstname" value="<?php if(isset($user_firstname)){echo $user_firstname;}?>" placeholder="<?php echo $this->lang->line('user_firstname'); ?>" class="form-control">
	               	 <span class="error"><?php echo form_error('user_firstname'); ?></span>		
		         	</div>
                   </div>
                   <div class="col-md-4">
		         	<div class="form-group">
	               	 <label for="user_lastname"><?php echo $this->lang->line('user_lastname'); ?></label>
	               	 <a href="#" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_user_lastname'); ?>">
	                       <i class="fa fa-question-circle"></i>
	                      </a>
	                	 <input type="text" name="user_lastname" id="user_lastname" value="<?php if(isset($user_lastname)){echo $user_lastname;}?>" placeholder="<?php echo $this->lang->line('user_lastname'); ?>" class="form-control">
	               	 <span class="error"><?php echo form_error('user_lastname'); ?></span>		
		         	</div>
                   </div>
                   <div class="col-md-4">
                        <div class="form-group">
                         <label for="user_email"><?php echo $this->lang->line('user_email'); ?> <span class="mandatory">*</span></label>
                         <a href="#" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_user_email'); ?>">
                               <i class="fa fa-question-circle"></i>
                              </a>
                             <input type="text" name="user_email" id="user_email" value="<?php if(isset($user_email)){echo $user_email;}?>" placeholder="<?php echo $this->lang->line('user_email'); ?>" class="form-control" readonly="">
                         <span class="error"><?php echo form_error('user_email'); ?></span>		
                        </div>
                   </div>
                   <div class="clearfix"></div>
                   <div class="col-lg-2">
                        <div class="form-group">
                         <label for="user_gender"><?php echo $this->lang->line('user_gender'); ?><span class="mandatory">*</span></label>
                         <a href="#" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_user_gender'); ?>">
                               <i class="fa fa-question-circle"></i>
                           </a>
                               <select class="form-control" name="user_gender" id="user_gender">
                                  <option value=''>Gender</option>
                                  <option  value="Male" <?php echo (isset($user_gender) && ($user_gender=='Male')? 'selected="selected"' : set_select('user_gender','Male'));?> >Male</option>
                                  <option value="Female" <?php echo (isset($user_gender) && ($user_gender=='Female')? 'selected="selected"' : set_select('user_gender','Female'));?> >Female</option>
                                </select>
                            <span class="error"><?php echo form_error('user_gender'); ?></span>		
                        </div>
                   </div>
                   <div class="col-lg-2">
		         	<div class="form-group">
	               	 <label for="user_dob"><?php echo $this->lang->line('user_dob'); ?> <span class="mandatory">*</span></label>
	               	 <a href="#" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_user_dob'); ?>">
	                       <i class="fa fa-question-circle"></i>
	                   </a>
								<div class="input-group date" id='date_edit_dob'>
									<input type="text" name="user_dob" id="user_dob" readonly="" value="<?php echo (isset($user_dob)) ? $user_dob :set_value('user_dob'); ?>" class="form-control hasDatepicker" placeholder="<?php echo $this->lang->line('user_dob'); ?>">
									<span class="input-group-addon">
			                    <span class="fa fa-calendar">
			                    </span>
			                	</span>
		               	 </div>
	              	</div>
	              	<span class="error"><?php echo form_error('user_dob');?></span>		
		         	</div>
                   <div class="col-lg-4">
		         	<div class="form-group">
               	 <label for="user_roles"><?php echo $this->lang->line('user_roles'); ?> *</label>
               	 <a href="#" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_user_roles'); ?>">
                       <i class="fa fa-question-circle"></i>
                      </a>
               			<select id="user_roles" name="user_roles" class="form-control" placeholder="<?php echo $this->lang->line('user_roles'); ?>">	                   
									<option value="">-Select-</option>
									<?php if(isset($all_roles)) { ?>
										<?php foreach($all_roles as $row_roles){?>
		                           <option value="<?php echo $row_roles->id ; ?>" <?php echo (isset($user_roles) && ($user_roles==$row_roles->role)? 'selected="selected"' : set_select('user_roles',$row_roles->id));?>><?php echo $row_roles->role ; ?></option>
	             					<?php } }?>
	         				</select>
	         				<span class="error"><?php echo form_error('user_roles'); ?></span>	
	         	  </div>
                   </div>
                   <div class="col-lg-4">
                    <div class="form-group">
                     <label for="user_designation"><?php echo $this->lang->line('user_designation'); ?> *</label>
                     <a href="#" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_user_designation'); ?>">
                           <i class="fa fa-question-circle"></i>
                          </a>
                            <select id="user_designation" name="user_designation" class="form-control" placeholder="<?php echo $this->lang->line('user_designation'); ?>">	                   
                                        <option value="">-Select-</option>
                                        <?php if(isset($all_designation)) { ?>
                                            <?php foreach($all_designation as $row_designation){?>
                                       <option value="<?php echo $row_designation->id ; ?>" <?php echo (isset($user_designation) && ($user_designation==$row_designation->designation)? 'selected="selected"' : set_select('user_designation',$row_designation->id));?>><?php echo $row_designation->designation ; ?></option>
                                        <?php } }?>
                                </select>
                                <span class="error"><?php echo form_error('user_designation'); ?></span>	
                      </div>
                   </div>
                   <div class="clearfix"></div>
                   <div class="col-md-4">
		         	<div class="form-group">
	               	 <label for="user_mobile"><?php echo $this->lang->line('user_mobile'); ?> <span class="mandatory">*</span></label>
	               	 <a href="#" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_user_mobile'); ?>">
	                       <i class="fa fa-question-circle"></i>
	                      </a>
	                	 <input type="text" name="user_mobile" id="user_mobile" value="<?php if(isset($user_mobile)){echo $user_mobile;}?>" placeholder="<?php echo $this->lang->line('user_mobile'); ?>" class="form-control">
	               	 <span class="error"><?php echo form_error('user_mobile'); ?></span>		
		         	</div>
                   </div>
                   <div class="col-md-4">
		         	<div class="form-group">
	               	 <label for="user_sec_mob"><?php echo $this->lang->line('user_sec_mob'); ?></label>
	               	 <a href="#" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_user_sec_mob'); ?>">
	                       <i class="fa fa-question-circle"></i>
	                      </a>
	                	 <input type="text" name="user_sec_mob" id="user_sec_mob" value="<?php if(isset($user_sec_mob)){echo $user_sec_mob;}?>" placeholder="<?php echo $this->lang->line('user_sec_mob'); ?>" class="form-control">
	               	 <span class="error"><?php echo form_error('user_sec_mob'); ?></span>		
		         	</div>
                   </div>
                   <div class="col-md-4">
	               <div class="form-group">
	               	 <label for="user_pincode"><?php echo $this->lang->line('user_pincode'); ?></label>
	               	 <a href="#" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_user_pincode'); ?>">
	                       <i class="fa fa-question-circle"></i>
	                      </a>
	                	 <input type="text" name="user_pincode" id="user_pincode" value="<?php if(isset($user_pincode)){echo $user_pincode;}?>" placeholder="<?php echo $this->lang->line('user_pincode'); ?>" class="form-control">
	               	 <span class="error"><?php echo form_error('user_pincode'); ?></span>		
		         	</div>
                   </div>
                   <div class="clearfix"></div>
                   <div class="col-md-4">
		         	<div class="form-group">
	               	 <label for="user_address"><?php echo $this->lang->line('user_address'); ?></label>
	               	 <a href="#" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_user_address'); ?>">
	                       <i class="fa fa-question-circle"></i>
	                      </a>
	                	 <textarea id="user_address" name="user_address"  class="form-control" rows="5" placeholder="<?php echo $this->lang->line('user_address'); ?>"><?php echo (isset($user_address)) ? $user_address :set_value('user_address'); ?></textarea>
	                 	 <span class="error"><?php echo form_error('user_address'); ?></span>		
		         	</div>
                   </div>
                   <div class="col-md-8">
		         	<div class="form-group">
	               	 <label for="user_about_me"><?php echo $this->lang->line('user_about_me'); ?></label>
	               	 <a href="#" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_user_about_me'); ?>">
	                       <i class="fa fa-question-circle"></i>
	                      </a>
	                	 <textarea id="user_about_me" name="user_about_me"  class="form-control" rows="5" placeholder="<?php echo $this->lang->line('user_about_me'); ?>"><?php echo (isset($user_about_me)) ? $user_about_me :set_value('user_about_me'); ?></textarea>
	                 	 <span class="error"><?php echo form_error('user_about_me'); ?></span>		
		         	</div>
                   </div>
                   <div class="clearfix"></div>
                   <!-- Image Upload Starts  --> 
		         	<div class="col-md-4">
		         		<label for="user_photo"><?php echo $this->lang->line('user_photo'); ?>*</label>
	               	<input type="file" id="file_img" name="file" class="form-control dev_upload_image" data-id="image" multiple="multiple" accept="image/*,jpg|png|jpeg|gif">
							<div class="">	    
								<div class="croped-img">
								<?php if(((isset($user_photo)) ? $user_photo:'')&&( $user_photo!='') ){  ?>
										<img src="<?php echo base_url();?>images/users/<?php echo $user_photo;?> "  alt="">
			       			<?php } else {?>
			       	 			<img src=""  alt="">
			       			<?php	}?>
			       			</div>
								<textarea name="user_photo" id="image_photo" style="display:none"></textarea> 
								<span class="error"><?php echo form_error('user_photo'); ?></span>
							</div>       
							<br />
						 </div>
						<!-- Image Upload Ends  -->
                   <div class="clearfix"></div>
               </div><!-- /.box-body -->
					<div class="box-footer">
                        <button class="btn btn-primary pull-right" name="submit" value="submit" type="submit"><?php echo $this->lang->line('submit'); ?> </button>
						<button type="button" class="btn btn-danger pull-right m-r-5" type="button" onClick="self.location='<?php echo base_url().$this->lang->line('users');?>'"><?php echo $this->lang->line('cancel'); ?></button>
					</div>
					<?php echo form_close(); ?> 
				</div><!-- /.box -->
			</div><!--/.col (left) -->
		</div>   <!-- /.row -->
	</section><!-- /.content -->
</div>
<div class="modal fade for_hide" id="add_photo_modal" >
	<div class="modal-dialog">
	<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
		<h4 class="modal-title">Upload</h4>
	</div>
	<div class="modal-body">
		<div class="action">
			<button type="button" class="btn m-l-5 pull-right f-10" id="btnZoomIn" value="+">
         <i class="fa fa-plus"></i>
         </button>
         <button type="button" class="btn pull-right f-10" id="btnZoomOut" value="-">
         <i class="fa fa-minus"></i>
         </button>
			<input type="hidden" name="image_type" id="image_type" value="">
		</div>		
		<div class="table-responsive no-border" id="crp" >  
			<div class="imageBox">
             <div class="thumbBox thumbBox" id="thumb"></div>
             <div class="spinner" style="display: none"></div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
   <div class="modal-footer">
	 <button type="button" id="close_modal_img" class="show_active btn btn-danger" data-dismiss="modal">Close</button>
	 <!-- form='' ==> Here Form id should be given -->
	
	 <button  form="update_image" id="image_sub" type="button" class="show_active btn btn-primary" >Crop & Upload</button> 
 	</div>   
   </div><!-- /.modal-content -->
 	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->