<div class="content-wrapper" style="min-height: 946px;">
	<section class="content-header">
         <h1>
            <?php echo (isset($admin_page_title) ? $admin_page_title :''); ?>
            <small></small>
           <a href="#" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_website_settings'); ?>">
            <i class="fa fa-question-circle tooltip-icon-header"></i>
           </a></h1>        
            <?php $this->load->view('breadcrumb'); ?>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<!-- general form elements -->
				<div class="box box-primary">
<?php echo (isset($alert) ? $alert :''); ?>
               <!-- form start -->
               <?php $attributes = array('name' => 'settings','id' => 'settings', 'method' =>'POST');//To enable CSRF protection
        					echo form_open('/'.$this->lang->line('users').'/settings', $attributes);  ?><!-- To enable CSRF protection-->
               <div class="box-body">
                    <div class="col-md-4">
		         	<div class="form-group">
	               	 <label for="admin_email"><?php echo $this->lang->line('admin_email'); ?> <span class="mandatory">*</span></label>
			             <a href="#" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_admin_email'); ?>">
	                       <i class="fa fa-question-circle"></i>
	                   </a>
	                	 <br/>
	               	 <input type="text" name="admin_email" id="admin_email" value="<?php if(isset($admin_email)){echo $admin_email;}?>" placeholder="<?php echo $this->lang->line('admin_email'); ?>" class="form-control">
						
	               	 <span class="error"><?php echo form_error('admin_email'); ?></span>		
		         	</div>
                   </div>
                   <div class="col-md-4">
		         	<div class="form-group">
	               	 <label for="site_name"><?php echo $this->lang->line('site_name'); ?></label>
			             <a href="#" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_site_name'); ?>">
	                       <i class="fa fa-question-circle"></i>
	                   </a>
	                	 <br/>
	               	<input type="text" name="site_name" id="site_name" value="<?php if(isset($site_name)){echo $site_name;}?>" placeholder="<?php echo $this->lang->line('site_name'); ?>" class="form-control">
						
	               	 <span class="error"><?php echo form_error('site_name'); ?></span>		
		         	</div>
                   </div>
                   <div class="col-md-4">
                        <div class="form-group">
                         <label for="copyright_year"><?php echo $this->lang->line('copyright_year'); ?> <span class="mandatory">*</span></label>
                         <a href="#" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_copyright_year'); ?>">
                               <i class="fa fa-question-circle"></i>
                              </a>
                             <input type="text" name="copyright_year" id="copyright_year" value="<?php if(isset($copyright_year)){echo $copyright_year;}?>" placeholder="<?php echo $this->lang->line('copyright_year'); ?>" class="form-control">
                         <span class="error"><?php echo form_error('copyright_year'); ?></span>		
                        </div>
                   </div>
                </div><!-- /.box-body -->
					<div class="box-footer">
                        <button class="btn btn-primary pull-right" name="submit" value="submit" type="submit"><?php echo $this->lang->line('submit'); ?> </button>
						<button type="button" class="btn btn-danger pull-right m-r-5" type="button" onClick="self.location='<?php echo base_url();?>'"><?php echo $this->lang->line('cancel'); ?></button>
					</div>
					<?php echo form_close(); ?> 
				</div><!-- /.box -->
			</div><!--/.col (left) -->
		</div>   <!-- /.row -->
	</section><!-- /.content -->
</div>