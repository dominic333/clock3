<div class="content-wrapper" style="min-height: 946px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo (isset($admin_page_title) ? $admin_page_title :''); ?>
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url().$this->lang->line('home');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a  href="<?php echo base_url().$this->lang->line('users').url_suffix(); ?>"><?php echo $this->lang->line('user_heading');?></a></li>
            <li class="active"><?php echo $this->lang->line('privileges_heading').'s';?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                 <div class="clearfix">
                  	<div class="col-md-12 col-sm-12 col-xs-12 p-0">
                        <a class="btn btn-primary text-uppercase text-bold pull-right fa-hover" data-toggle="modal" data-target="#add_privilege"  href="#"><i class="fa fa-plus"></i> Add <?php echo $this->lang->line('privileges_heading'); ?>&nbsp;
                        </a>	    
                	</div>  
                	</div>  
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php $attributes = array('name' => 'frm_privileges','id' => 'frm_privileges', 'method' =>'POST' , 'action' => 'echo base_url()');   //To enable CSRF protection
        echo form_open($this->lang->line('privileges'), $attributes);  ?>    <!-- To enable CSRF protection      -->
         <div class="box-body">
                  <?php	echo $this->table->generate(); ?>
                  </div>
                  <?php echo form_close(); ?> 
              </div><!-- /.box -->
            </div><!--/.col (left) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div>
<!-- /.modal for Add checkType Starts -->

<div class="modal fade for_hide <?php if(isset($privilege_validate)){echo 'in';} ?>"  <?php if(isset($privilege_validate)){echo 'style="display: block; padding-right: 0px; aria-hidden=false"';} ?> id="add_privilege" >
          <div class="modal-dialog edited-modal" style=" z-index: 1050;" >
            <div class="modal-content">
              <div class="modal-header bg-brick-red text-white">
                <button type="button" class="close for_modal" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
                <h4 class="modal-title">Add <?php echo $this->lang->line('privilege'); ?> </h4>
              </div>
              <div class="modal-body">
        

       <?php /* FORM STARTS */ ?>
    <?php $attributes = array('name' => 'form_privilege', 'id' => 'form_privilege' ,'method' =>'POST', 'action' => 'echo base_url()'); 
       
       echo form_open($this->lang->line('users').'/'.$this->lang->line('privileges').'/add',$attributes);  ?>   
          
        
             <div class="box-body">
          
          		<label><?php echo $this->lang->line('privilege_name'); ?> *</label>	
               <input class="form-control input-sm show_value_edit" type="text" id="privilege_name" required="" name="privilege_name" value="">
               <span></span>
               <br />
               <span class="error"><?php echo form_error('privilege_name'); ?></span>

            
          </div>      
			   <br />
    <div class="clear"></div>
     <!-- </form>-->
   	         <div class="modal-footer">
                <button type="button" class="show_active btn btn-danger for_modal" data-dismiss="modal">Close</button>
                <!-- form='' ==> Here Form id should be given -->
					 <button  form="form_privilege" name="Submit" value="Submit" type="submit" class="show_active btn btn-primary" >Update</button> 
                   
              </div>   
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->  
		  <?php echo form_close(); ?> 
	</div>
	
<!-----------------modal pop up for edit starts here---------------------------------------->
<div class="modal fade for_hide <?php if(isset($privilege_validate)){echo 'in';} ?>"<?php if(isset($privilege_validate)){echo 'style="display: block; padding-right: 0px; aria-hidden=false"';} ?> id="edit_row" >
          <div class="modal-dialog edited-modal">
            <div class="modal-content">
              <div class="modal-header bg-brick-red text-white">
                <button type="button" class="close for_modal" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
                <h4 class="modal-title">Update <?php echo $this->lang->line('privileges_heading'); ?> </h4>
              </div>
              <div class="modal-body">
        

       <?php /* FORM STARTS */ ?>
    <?php $attributes = array('name' => 'form_privilege_edit', 'id' => 'form_privilege_edit' ,'method' =>'POST' , 'action' => 'echo base_url()'); 
       
       echo form_open('/'.$this->lang->line('users').'/'.$this->lang->line('privileges').'/edit',$attributes);  ?>   
          
        
             <div class="box-body">
          
          		<label><?php echo $this->lang->line('privilege_name'); ?> *</label>	
            <input class="form-control input-sm show_value_edit" type="text" id="privilege_name_edit" required="" name="privilege_name" value="">
            <span></span>
            <br />
            <span class="error"><?php echo form_error('privilege_name'); ?></span>
           <input type="hidden" name="privilege_id" id="privilege_id" value="">
          </div>      
			   <br />
    <div class="clear"></div>
     <!-- </form>-->
   	         <div class="modal-footer">
                <button type="button" class="show_active btn btn-danger for_modal" data-dismiss="modal">Close</button>
                <!-- form='' ==> Here Form id should be given -->
					 <button  form="form_privilege_edit" name="Submit" value="Submit" type="submit" class="show_active btn btn-primary" >Update</button> 
                   
              </div>   
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->  
		  <?php echo form_close(); ?> 
	</div>
<!---modal pop up for edit ends here-------------------------------------------------->
		