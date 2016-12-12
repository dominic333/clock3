<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add / Edit User
            <small>User Management</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-cogs"></i> Setup Attendance</a></li>
            <li class="active"><a href="<?php echo base_url();?>ccshifts/shifts/users"> Add / Edit User</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModalHorizontal">Add New
                    User <span class="fa fa-plus-circle"></span></button>
            </div>
            <?php if($companyType==3){ ?>
            <div class="col-md-12">
               <select name="department" id="department" data-placeholder="-- Select A Department* --"  class="" onchange="document.getElementById('dept_id').value	=this.value;">
	                  <option value="">-- All Departments --</option>
	                  <?php foreach($company_departments as $row){?>
	                  <option value="<?php echo $row->dept_id;?>" <?php echo (isset($department) && ($department==$row->dept_id)? 'selected="selected"' : set_select('department',$row->dept_id));?> >
	                  <?php echo $row->department_name;?>
	                  </option>
	                  <?php } ?> 
	             </select>
				</div>
				<?php } else{ ?>
				<div class="col-md-12">
               <select name="shifts" id="shifts" data-placeholder="-- Select A Shift* --"  class="" >
	                  <option value="">-- All Shifts --</option>
	                  <?php foreach($company_shifts as $shift){?>
	                  <option value="<?php echo $shift->shift_id;?>">
	                  <?php echo $shift->shift_name;?>
	                  </option>
	                  <?php } ?> 
	             </select>
				</div>
				<?php } ?>
        </div>

        </br>

        <div id="listUserGrid" class="row">
				<?php foreach($company_members as $member)
				{
					if($member->staff_photo==''||$member->staff_photo==' ')
					{
						$staff_photo=base_url().'assets/cc/images/admin-user.png';
					}
					else
					{
						$staff_photo=base_url().'images/users/'.$member->staff_photo;
					}
					
				?>
            <div class="col-md-4 <?php echo 'd'.$member->dept_id; ?> <?php echo 's'.$member->shift_id; ?>">
                <!-- USERS LIST -->
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $member->login_name; ?></h3>

                        <div class="box-tools pull-right">
                            <div class="checkbox">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- Widget: user widget style 1 -->
                        <div class="box box-widget widget-user-2">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-gray-light">
                                <div class="widget-user-image">
                                    <img class="img-circle" src="<?php echo $staff_photo; ?>" alt="User Avatar">
                                </div>
                                <!-- /.widget-user-image -->
                                <h4 class="widget-user-username"><?php echo $member->staff_name; ?></h4>
                                <h5 class="widget-user-desc"><?php echo $member->shift_name; ?></h5>
                            </div>
                        </div>
                        <!-- /.widget-user -->

                        <div class="box-footer text-center">
                            <a href="javascript:void(0)" class="btn btn-success fa fa-edit edit_user_link" data-toggle="tooltip" data-placement="bottom" title="Edit User?" data-staff_id="<?php echo $member->staff_id; ?>" data-staff_name="<?php echo $member->staff_name; ?>" data-login_name="<?php echo $member->login_name; ?>"  data-email="<?php echo $member->email; ?>" data-contact_number="<?php echo $member->contact_number; ?>" data-staff_photo="<?php echo $staff_photo; ?>" ></a>
                            <a href="javascript:void(0)" class="btn btn-success fa fa-tag forgot_user_link" data-toggle="tooltip" data-placement="bottom" title="Change Password?" data-staff_id="<?php echo $member->staff_id; ?>" data-staff_name="<?php echo $member->staff_name; ?>" data-login_name="<?php echo $member->login_name; ?>"  data-email="<?php echo $member->email; ?>"  ></a>
                            <a href="javascript:void(0)" class="btn btn-success fa fa-map-marker rremote_login_link" data-toggle="tooltip" data-placement="bottom" title="Remote Login?" data-staff_id="<?php echo $member->staff_id; ?>" data-staff_name="<?php echo $member->staff_name; ?>" data-remotelogin="<?php echo $member->work_from_home; ?>" data-staff_photo="<?php echo $staff_photo; ?>" ></a>
                            <a href="javascript:void(0)" class="btn btn-success fa fa-shield mmonitor_attendance_link" data-toggle="tooltip" data-placement="bottom" title="Monitor Attendance?" data-staff_id="<?php echo $member->staff_id; ?>" data-staff_name="<?php echo $member->staff_name; ?>" data-monitor="<?php echo $member->monitor; ?>" ></a>
                            <a href="javascript:void(0)" class="btn btn-danger fa fa-trash delete_user_link"	data-toggle="tooltip" data-placement="bottom" title="Delete User?" data-staff_id="<?php echo $member->staff_id; ?>" data-staff_name="<?php echo $member->staff_name; ?>"  data-staff_photo="<?php echo $staff_photo; ?>"></a>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!--/.box -->
            </div>
            <?php } ?>
            
        </div>
        <!-- /.row -->


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!--=======================================Modal Form========================================-->
<div class="modal fade" id="myModalHorizontal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Add New User
                </h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">

                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Full Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Full Name" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Login Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Login Name" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Company</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Company" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Address</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Address" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Email" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Contact Number</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Contact Number" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-3 control-label">Department</label>
                        <div class="col-sm-9">
                            <select class="form-control selectdept" style="width: 100%;">
                                <option selected="selected">-- Select a Department --</option>
                                <option>All Departments</option>
                                <option>Finance Department</option>
                                <option>IT Department</option>
                                <option>GA Department</option>
                                <option>HR Department</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Shift</label>
                        <div class="col-sm-9">
                            <select class="form-control selectshift" style="width: 100%;">
                                <option selected="selected">-- Select a Shift --</option>
                                <option>08.00am - 05.00pm</option>
                                <option>09.00am - 06.00pm</option>
                                <option>10.00am - 07.00pm</option>
                                <option>11.00am - 08.00pm</option>
                            </select>
                        </div>
                    </div>

            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger"
                        data-dismiss="modal">
                    Cancel
                </button>
                <button type="submit" class="btn btn-success">
                    Add
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--=======================================End Of Modal Form========================================-->

 <!-- Remote Login facility Modal starts -->
<div class="modal fade" id="remote_login_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Remote Login</h4>
      </div>
      <div class="modal-body">
         <form  role="form" id="remote_login_frm" name="remote_login_frm" action="<?php echo base_url();?>ccshifts/shifts/edit_remote_login" method="post" >
            <div class="">
			    	<div class="profile text-center no-box-shadow">
			      	<div class="profile-head"></div>
			          	<div class="edit-profile-photo">
			            	<img class="" id="rstaff_photo_src" src="">
			            </div>
			      </div>
			   </div>
			   
	        <div class="form-group">
	            <label>Name</label>
	            <input type="text" name="rstaff_name" id="rstaff_name"  class="form-control" placeholder="Staff Name" value=""  >	            
	         </div>	         
	         
	         
	         <div class="form-group">	            
               <select  name="rremotelogin"  id="rremotelogin" class="selectpicker form-control">
                  <option value="">-- Work from home? --</option>
                  <option value="1" >Remote login enabled</option>
                	<option value="0" >Remote login disabled </option>                         
               </select>
	         </div>  	         
	         
	         <input type="hidden" name="rstaff_id"  id="rstaff_id" value=""/>
	         <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
            <input type="hidden" name="Submit" value="Submit"/> 
	               
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left show_active" data-dismiss="modal">Close</button>
          <button  form="remote_login_frm" type="submit"  id="reset_pass_subt" name="Submit" value="Submit"  class="btn btn-success show_active" >Update</button>
      </div>
    </div>
  </div>
</div>
<!-- Remote Login facility Modal ends -->


<!-- Monitor Attendance Modal starts -->
<div class="modal fade" id="monitor_attendance_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Monitor Attendance</h4>
      </div>
      <div class="modal-body">
         <form role="form" id="monitor_attendance_frm" name="monitor_attendance_frm" action="<?php echo base_url();?>ccshifts/shifts/edit_monitor_attendance" method="post" >
            <div class="">
			    	<div class="profile text-center no-box-shadow">
			      	<div class="profile-head"></div>
			          	<div class="edit-profile-photo">
			            	<img class="" id="mstaff_photo_src" src="">
			            </div>
			      </div>
			   </div>
			   
	        <div class="form-group">
	            <label>Name</label>
	            <input type="text" name="mstaff_name" id="mstaff_name"  class="form-control" placeholder="Staff Name" value="" >	            
	         </div>
	         
	         <div class="form-group">	            
               <select  name="mmonitor"  id="mmonitor" class="selectpicker form-control">
                  <option value="">-- Monitor This User Attendance? --</option>
                  <option value="1" >Yes. Monitor User Attendance</option>
                	<option value="0" >DO NOT Monitor User Attendance</option>                         
               </select>
	         </div>  	         
	         
	         <input type="hidden" name="mstaff_id"  id="mstaff_id" value=""/>
	         <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
            <input type="hidden" name="Submit" value="Submit"/> 
	               
       </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left show_active" data-dismiss="modal">Close</button>
          <button  form="monitor_attendance_frm" type="submit"  id="reset_pass_subt" name="Submit" value="Submit"  class="btn btn-success show_active" >Update</button>
      </div>
    </div>
  </div>
</div>
<!-- Monitor AttendanceModal ends -->
     
      
      
      
      
<!-- Edit Profile Modal starts -->
<div class="modal fade" id="edit_user_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Staff Information</h4>
      </div>
      <div class="modal-body">
         <form role="form" id="edit_user_frm" name="edit_user_frm" action="<?php echo base_url();?>ccshifts/shifts/edit_user" method="post" >
            <div class="">
			    	<div class="profile text-center no-box-shadow">
			      	<div class="profile-head"></div>
			          	<div class="edit-profile-photo">
			            	<img class="" id="staff_photo_src" src="">
			            </div>
			      </div>
			   </div>
			   
	        <div class="form-group">
	            <label>Name</label>
	            <input type="text" name="staff_name" id="staff_name"  class="form-control" placeholder="Staff Name" value="" >	            
	         </div>
	         
	         <div class="form-group">
	            <label>UserName</label>
	            <input type="text" name="login_name" id="login_name" class="form-control" placeholder="Login name of Staff"  value="" readonly>
	         </div>
	         
	         <div class="form-group">
	            <label>Email</label>
	            <input type="email" name="email" id="email" class="form-control" placeholder="User Email" value=""  >
	         </div>
	         
	         <div class="form-group">
	            <label>Contact Number</label>
	            <input type="text"  name="contact_number" id="contact_number" class="form-control"  value="" placeholder="Contact No of Staff" >
	         </div>  	         	         
	         
	         <input type="hidden" name="staff_id"  id="staff_id" value=""/>
	         <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
            <input type="hidden" name="Submit" value="Submit"/> 
	               
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left show_active" data-dismiss="modal">Close</button>
          <button  form="edit_user_frm" type="submit"  id="reset_pass_subt" name="Submit" value="Submit"  class="btn btn-success show_active" >Update</button>
      </div>
    </div>
  </div>
</div>
<!-- Edit Profile Modal ends -->


<!--reset password starts-->
 <div class="modal fade for_hide" id="forgot_user_modal" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header reset-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
          <h4 class="modal-title">Reset Password</h4>
        </div>
        <div class="modal-body reset-pass">
         <form role="form" id="forgot_user_frm" name="forgot_user_frm" action="<?php echo base_url();?>ccshifts/shifts/forgot_user" method="post" >
            <div class="">
            	 
            	 <div class="form-group">
                      <label class="reset_password">Enter New Password<span class="mandatory">*</span></label>
                      <input class="reset_password form-control" type="password" name="password" id="password" value="" />
                </div>
                
                <div class="form-group">
                      <label class="reset_password">Confirm Password<span class="mandatory">*</label>
                      <input class="reset_password form-control" type="password" name="confrim_password" id="confrim_password" value="" />
                </div>
                
               <input type="hidden" name="user_name" id="user_name" value="" >
               <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
               <input type="hidden" name="user_login" id="user_login" value="" >
               <input type="hidden" name="user_email" id="user_email" value="" >
            	<input type="hidden" name="user_id"  id="user_id" value=""/>
            	<input type="hidden" name="Submit" value="Submit"/>
            
            </div>          
       </form>
       </div>
       <div class="modal-footer reset-footer">
          <button type="button" class="btn btn-danger pull-left show_active" data-dismiss="modal">Close</button>
          <button  form="forgot_user_frm" type="submit"  id="forgot_user_subt" name="Submit" value="Submit"  class="btn btn-success show_active" >Update</button> 
       </div>   
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
	</div><!-- /.modal --> 
		
<!--reset password ends-->