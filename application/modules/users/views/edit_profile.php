<?php  
	$iam_client = ($this->session->userdata('role') == 3 ? true : false);      
	$en_user_id ='';	
	if(isset($selected_user)) {
		if(!empty($selected_user)){
			$en_user_id = $this->site_settings->get_encrypt_id($selected_user->id_user);
			$user_firstname 	= $selected_user->firstname;
			$user_lastname 	= $selected_user->lastname;
			$user_dob 			= $selected_user->dob;
			$user_gender 		= $selected_user->gender;
			$user_mobile 		= $selected_user->mobile;
			$user_address 		= $selected_user->contact_address;
			$user_address 		= stripslashes ( $selected_user->contact_address);
			$user_address 		= nl2br(str_replace('\\r\\n', "\r\n", $user_address));
			$user_address 		= stripslashes($user_address);
			if(($this->session->userdata('role') != '2')&&($this->session->userdata('role') != '3')&&($this->session->userdata('role') != '4'))//coordinators
			{
				$user_sec_mob 		= $selected_user->secondary_number;
				$user_pincode 		= $selected_user->pincode;
				$user_about_me		= $selected_user->about_me;
			}else {
				$user_telephone 		= $selected_user->telephone;
			}
			$user_photo			= $selected_user->photo;
			$image_path			= 'images/users/';
			if($user_sec_mob =='0' )
			$user_sec_mob ='';
			//echo validation_errors();
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
           </a>
         </h1> 
         <!--<ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Edit Profile</li>
         </ol>-->
         <?php $this->load->view('breadcrumb'); ?>
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
               <?php $attributes = array('name' => 'edit_profile','id' => 'edit_profile', 'method' =>'POST');//To enable CSRF protection
        					echo form_open('/'.$this->lang->line('users').'/profile/'.$en_user_id, $attributes);  ?><!-- To enable CSRF protection-->
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
                 <div class="col-md-2">
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
                  <div class="col-md-2">
		         	<div class="form-group">
	               	 <label for="user_dob"><?php echo $this->lang->line('user_dob'); ?> <span class="mandatory">*</span></label>
	               	 <a href="#" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_user_dob'); ?>">
	                       <i class="fa fa-question-circle"></i>
	                   </a>
								<div class="input-group date" id='date_profile_dob'>
									<input type="text" name="user_dob" id="user_dob" readonly="" value="<?php echo (isset($user_dob)) ? $user_dob :set_value('user_dob'); ?>" class="form-control hasDatepicker" placeholder="<?php echo $this->lang->line('user_dob'); ?>">
									<span class="input-group-addon">
			                    <span class="fa fa-calendar">
			                    </span>
			                	</span>
		               	      </div>
                                <div class="col-md-12 p-0">
                                     <div class="my-group error-my-group">
                                            <label id="user_dob-error" class="error" for="user_dob"></label>
                                     </div>
                                </div>
	              	</div>
	              	<span class="error"><?php echo form_error('user_dob');?></span>		
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
                   <?php if(($this->session->userdata('role') != '2')&&($this->session->userdata('role') != '3')&&($this->session->userdata('role') != '4')){?>
	               <div class="form-group">
	               	 <label for="user_pincode"><?php echo $this->lang->line('user_pincode'); ?></label>
	               	 <a href="#" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_user_pincode'); ?>">
	                       <i class="fa fa-question-circle"></i>
	                      </a>
	                	 <input type="text" name="user_pincode" id="user_pincode" value="<?php if(isset($user_sec_mob)){echo $user_pincode;}?>" placeholder="<?php echo $this->lang->line('user_pincode'); ?>" class="form-control">
	               	 <span class="error"><?php echo form_error('user_pincode'); ?></span>		
		         	</div>
		         	<input type="hidden" name="user_department" value='1'>
		         	<?php 
		         		}else{
		         			if(!$iam_client){ //if client dont show the department
		         	?>
		         	<div class="form-group">
               	 <label for="user_department"><?php echo $this->lang->line('user_department'); ?> *</label>
               	 <a href="#" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_user_department'); ?>">
                       <i class="fa fa-question-circle"></i>
                      </a>
               			<select id="user_department" name="user_department" class="form-control" placeholder="<?php echo $this->lang->line('coordinator_deptmnt'); ?>">	                   
									<option value="">-Select-</option>
									<?php if(isset($all_departments)) { ?>
										<?php foreach($all_departments as $row_deptmnt){?>
		                           <option value="<?php echo $row_deptmnt->id ; ?>" <?php echo (isset($user_department) && ($user_department==$row_deptmnt->id)? 'selected="selected"' : set_select('user_department',$row_deptmnt->id));?>><?php echo $row_deptmnt->name ; ?></option>
	             					<?php } }?>
	         				</select>
	         				<span class="error"><?php echo form_error('user_department'); ?></span>	
	         	  </div>
	         	  <input type="hidden" name="user_pincode" value='123456'>
						<input type="hidden" name="user_telephone" value="<?php echo (isset($user_telephone)? $user_telephone : set_select('user_telephone'))?>">
		         	<?php 
		         			} 
		         		} 
		         	?>		         	
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
                  <div class="clearfix"></div>
                   <!-- Image Upload Starts  --> 
		         	<div class="col-md-4">
		         		<label for="user_photo"><?php echo $this->lang->line('user_photo'); ?>*</label>
	               	<input type="file" id="file_img" name="file" class="form-control dev_upload_image" data-id="image" multiple="multiple" accept="image/*,jpg|png|jpeg|gif">
							<div class="">	    
								<div class="croped-img">
								<?php if(((isset($user_photo)) ? $user_photo:'')&&( $user_photo!='') ){  ?>
										<img src="<?php echo base_url();?><?php echo $image_path.$user_photo;?> "  alt="">
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
						<button type="button" class="btn btn-danger pull-right m-r-5" type="button" onClick="self.location='<?php echo base_url();?>'"><?php echo $this->lang->line('cancel'); ?></button>
					</div>
					<?php echo form_close(); ?> 
				</div><!-- /.box -->
			</div><!--/.col (left) -->
		</div>   <!-- /.row -->
	</section><!-- /.content --><!-- /.content -->
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
			<!--<input type="button" id="btnZoomIn" value="+" style="float: right;display:none;">
			<input type="button" id="btnZoomOut" value="-" style="float: right;display:none;">-->
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
	
	 <button id="image_sub" type="button" class="show_active btn btn-primary" >Crop & Upload</button> 
 	</div>   
   </div><!-- /.modal-content -->
 	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->