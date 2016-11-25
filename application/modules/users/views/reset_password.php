<?php        
        $form_token = uniqid();          
        $this->session->set_userdata('form_token',  $form_token);   
?>
<div class="content-wrapper" style="min-height: 946px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php if(isset($admin_page_title)){ echo $admin_page_title; } ?>
                        <small></small>
             <a href="#" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_change_password'); ?>">
				 <i class="fa fa-question-circle tooltip-icon-header"></i>
				 </a>
          </h1>
<?php $this->load->view('breadcrumb'); ?>        
        <!--<ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?php if(isset($admin_page_title)){ echo $admin_page_title; } ?></li>
          </ol>-->
    </section>
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h4></h4>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                       <?php $attributes = array('name' => 'ch_pass', 'id' => 'ch_pass' ,'method' =>'POST' , 'action' => 'echo base_url()' );   //To enable CSRF protection
           echo form_open('/users/reset_password',$attributes);  ?>    <!-- To enable CSRF protection  -->
                        <div class="box-body">
                        <input type="hidden" name="form_token" value="<?php if(isset($form_token)){echo $form_token;} ?>" />
                         <div class="col-md-3">
                                <div class="form-group">
                                    <label for="menu_name"><?php echo $this->lang->line('new_password_change'); ?> *</label>
                                    <a href="#" data-toggle="tooltip" title="" tabindex="-1" data-original-title="<?php echo $this->lang->line('tooltip_new_password'); ?>">
                                        <i class="fa fa-question-circle"></i>
                                    </a>
                                    <input id="new_password" class="form-control input-sm" type="password" name="new_password" value="<?php echo (isset($new_password)) ? $new_password :set_value('new_password'); ?>" />
												<span class="error"><?php echo form_error('new_password'); ?></span>
                                 </div>
                            </div>
				            
                            <div class="col-md-3">
                            		<div class="form-group">
                                    <label for="menu_url"><?php echo $this->lang->line('confirm_password'); ?> *</label>
                                    <a href="#" data-toggle="tooltip" title="" tabindex="-1" data-original-title="<?php echo $this->lang->line('tooltip_confirm_password'); ?>">
                                        <i class="fa fa-question-circle"></i>
                                    </a>
                                    <input id="confirm_password" type="password" class="form-control input-sm"  name="confirm_password" value="<?php echo (isset($confirm_password)) ? $confirm_password :set_value('confirm_password'); ?>" />
												<span class="error"><?php echo form_error('confirm_password'); ?></span>
                                 </div>  
                            </div>
      							<!--/.col-md-12-->
      						</div>
                        <div class="box-footer">
                            <button class="btn btn-primary pull-right" name="submit" value="submit" id="reset_submit_btn" type="submit"><?php echo $this->lang->line('submit'); ?> </button>
                            <button type="button" class="btn btn-danger pull-right m-r-5" onclick="window.location.href='<?php echo base_url(); ?>'"><?php echo $this->lang->line('cancel'); ?></button>
                        </div>
                    <?php echo form_close(); ?> 
                </div>
                <!-- /.box -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </section>
</div>