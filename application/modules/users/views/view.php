<?php
	$form_token = uniqid();          
	$this->session->set_userdata('form_token',  $form_token); 	
	if(isset($selected_user)) {
		if(!empty($selected_user)){
			$en_user_id = $this->site_settings->get_encrypt_id($selected_user->id_user);
			$user_firstname 	= $selected_user->firstname;
			$user_lastname 	= $selected_user->lastname;
			$user_email 		= $selected_user->email;
			$user_dob 			= $selected_user->dob;
			$user_dob   		= date("d-F-Y", strtotime($user_dob));            		 
			$user_roles 		= $selected_user->role;
			$user_gender 		= $selected_user->gender;
			$user_designation = $selected_user->designation;
			$user_mobile 		= $selected_user->mobile;
			$user_sec_mob 		= $selected_user->secondary_number;
			$user_address 		= $selected_user->contact_address;
			$user_address 		= nl2br(str_replace('\\r\\n', "\r\n", $user_address));
			$user_address 		= stripslashes($user_address);
			if($user_address 	== '')
				$user_address  = 'NIL';
			$user_pincode 		= $selected_user->pincode;
			$user_about_me		= $selected_user->about_me;
			$user_join_date	= $selected_user->join_date;
			$user_join_date 	= date("d-F-Y", strtotime($user_join_date));            		 
			$user_photo			= $selected_user->photo;
		}
	}  
?>
    <div class="content-wrapper" style="min-height: 946px;">
        <section class="content-header">
            <h1>
            <?php echo (isset($admin_page_title) ? $admin_page_title :''); ?>
            <small></small>
          </h1>
            <!--<ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url().$this->lang->line('users');?>"><?php echo $this->lang->line('user_heading'); ?></a></li>
            <li class="active"><?php if(isset($user_firstname)) echo $user_firstname.' '.$user_lastname;?></li>
          </ol>-->
          <?php $this->load->view('breadcrumb'); ?>
        </section>
        <!-- Main content -->                    
 			<section class="content">
			<div class="box box-primary">
			<div class="box-head">
				<div class="col-xs-12">
					<h2 class="page-header">
						<?php if(isset($user_firstname)) echo $user_firstname.' '.$user_lastname; ?>
							<small class="pull-right">
							<a class="btn btn-app pull-right" href="<?php echo base_url().$this->lang->line('users').'/edit/'?><?php echo (isset($en_user_id) ? $en_user_id :''); ?>"><span class="fa fa-pencil-square-o centeralign"></span></a>
							</small>
					</h2>
				</div>
				<!-- /.col -->
			</div>
				<div class="box-body">
				<table class="table table-striped table-hover">
				<tbody>
				<tr>
					<td class="text-bold" style="width:25%;"><label><?php echo $this->lang->line('user_firstname'); ?> </label></td>
		 			<td><?php if(isset($user_firstname)) {echo $user_firstname;}?></td>
		 		</tr>
		 		<tr>
		 			<td class="text-bold"><label><?php echo $this->lang->line('user_lastname'); ?> </label></td>
		 			<td><?php if(isset($user_lastname)) {echo $user_lastname;}?></td>
		 		</tr>
		 		<tr>
		 			<td class="text-bold"><label><?php echo $this->lang->line('user_email'); ?> </label></td>
		 			<td><?php if(isset($user_email)) {echo $user_email;}?></td>
		 		</tr>
		 		<tr>
		 			<td class="text-bold"><label><?php echo $this->lang->line('user_dob'); ?> </label></td>
		 			<td><?php if(isset($user_dob)) {echo $user_dob;}?></td>
		 		</tr>
		 		<tr>
		 			<td class="text-bold"><label><?php echo $this->lang->line('user_roles'); ?> </label></td>
		 			<td><?php if(isset($user_roles)) {echo $user_roles;}?></td>
		 		</tr>
		 		<tr>
		 			<td class="text-bold"><label><?php echo $this->lang->line('user_gender'); ?> </label></td>
		 			<td><?php if(isset($user_gender)) {echo $user_gender;}?></td>
		 		</tr>
		 		<tr>
		 			<td class="text-bold"><label><?php echo $this->lang->line('user_designation'); ?> </label></td>
		 			<td><?php if(isset($user_designation)) {echo $user_designation;}?></td>
		 		</tr>
		 		<tr>
		 			<td class="text-bold"><label><?php echo $this->lang->line('user_mobile'); ?> </label></td>
		 			<td><?php if(isset($user_mobile)) {echo $user_mobile;}?></td>
		 		</tr>
		 		<tr>
		 			<td class="text-bold"><label><?php echo $this->lang->line('user_sec_mob'); ?> </label></td>
		 			<td><?php if(isset($user_sec_mob)) {echo $user_sec_mob;}?></td>
		 		</tr>
		 		<tr>
		 			<td class="text-bold"><label><?php echo $this->lang->line('user_join_date'); ?> </label>
		 			<td><?php if(isset($user_join_date)) {echo $user_join_date;}?>
		 		</tr>
		 		<tr>
		 			<td class="text-bold"><label><?php echo $this->lang->line('user_address'); ?> </label></td>
		 			<td><?php if(isset($user_address)) {echo $user_address;}?></td>
		 		</tr>
		 		<tr>
		 			<td class="text-bold"><label><?php echo $this->lang->line('user_pincode'); ?> </label></td>
		 			<td><?php if(isset($user_pincode)) {echo $user_pincode;}?></td>
				</tr>
		 		<tr>
		 			<td class="text-bold"><label><?php echo $this->lang->line('user_about_me'); ?></label></td>
		 			<td><?php if(isset($user_join_date)) {echo $user_about_me;}?></td>
		 		</tr>
		 		<tr>
		 			<td class="text-bold"><label><?php echo $this->lang->line('photo_view'); ?> </label></td>
		 			<td><?php if(((isset($user_photo)) ? $user_photo:'')&&( $user_photo!='') ){  ?>
									<img class="image-upload" src="<?php echo base_url();?>images/users/<?php echo $user_photo;?> "  alt="">
			       			<?php } else {?>
			       	 			<img src=""  alt="">
			       			<?php	}?>
			      </td>
		 		</tr>
		 		</table>
	 			</div>
	 			<div class="box-footer">
            	<button class="btn btn-danger pull-right" type="button" onclick="javascript:window.history.go(-1)"> 
            	<?php echo $this->lang->line('back'); ?>
               </button>
            </div>
            </div>
 			</section>
 			</div>
		