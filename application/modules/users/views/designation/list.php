<div class="content-wrapper" style="min-height: 946px;">
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
            <li class="active"><?php echo $this->lang->line('designation_heading').'s';?></li>
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
                 <div class="clearfix">
                  	<div class="col-md-12 col-sm-12 col-xs-12 p-0">
                        <a class="btn btn-secondary text-white text-uppercase text-bold pull-right fa-hover" data-toggle="modal" data-target="#add_designation"  href="#"><i class="fa fa-plus"></i> Add <?php echo $this->lang->line('designation_heading'); ?>&nbsp;
                        </a>	    
                	</div>  
                	</div>  
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php $attributes = array('name' => 'frm_designation','id' => 'frm_designation', 'method' =>'POST' , 'action' => 'echo base_url()');   //To enable CSRF protection
        echo form_open($this->lang->line('designation'), $attributes);  ?>    <!-- To enable CSRF protection      -->
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

<div class="modal fade for_hide <?php if(isset($designation_validate)){echo 'in';} ?>"  <?php if(isset($designation_validate)){echo 'style="display: block; padding-right: 0px; aria-hidden=false"';} ?> id="add_designation" >
          <div class="modal-dialog edited-modal" style=" z-index: 1050;" >
            <div class="modal-content">
              <div class="modal-header bg-brick-red text-white">
                <button type="button" class="close for_modal" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
                <h4 class="modal-title">Add <?php echo $this->lang->line('designation'); ?> </h4>
              </div>
              <div class="modal-body">
        

       <?php /* FORM STARTS */ ?>
    <?php $attributes = array('name' => 'form_designation', 'id' => 'form_designation' ,'method' =>'POST' , 'action' => 'echo base_url()'); 
       
       echo form_open('/'.$this->lang->line('users').'/'.$this->lang->line('designation').'/add',$attributes);  ?>   
          
        
             <div class="box-body">
          
          		<label><?php echo $this->lang->line('designation_name'); ?> *</label>	
               <input class="form-control input-sm show_value_edit" type="text" id="designation_name" required="" name="designation_name" value="">
               <span></span>
               <br />
               <span class="error"><?php echo (isset($alert) ? $alert :'').form_error('designation_name');?></span>

            
          </div>      
    <div class="clearfix"></div>
     <!-- </form>-->
   	         <div class="modal-footer p-b-0">
                <button type="button" form='form_designation' class="show_active btn btn-danger for_modal" data-dismiss="modal">Close</button>
                <!-- form='' ==> Here Form id should be given -->
					 <button  form="form_designation" name="Submit" value="Submit" type="submit" class="show_active btn btn-primary" >Submit</button> 
                   
              </div>   
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->  
		  <?php echo form_close(); ?> 
	</div>
	
<!-----------------modal pop up for edit starts here---------------------------------------->
<div class="modal fade for_hide <?php if(isset($designation_edit_validate)){echo 'in';} ?>"<?php if(isset($designation_edit_validate)){echo 'style="display: block; padding-right: 0px; aria-hidden=false"';} ?> id="edit_row" >
          <div class="modal-dialog edited-modal">
            <div class="modal-content">
              <div class="modal-header bg-brick-red text-white">
                <button type="button" class="close for_modal" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
                <h4 class="modal-title">Update <?php echo $this->lang->line('designation'); ?> </h4>
              </div>
              <div class="modal-body">
        

       <?php /* FORM STARTS */ ?>
    <?php $attributes = array('name' => 'form_designation_edit', 'id' => 'form_designation_edit' ,'method' =>'POST' ,'class'=>'form_edit_checktype_head', 'action' => 'echo base_url()'); 
       
       echo form_open('/'.$this->lang->line('users').'/'.$this->lang->line('designation').'/edit',$attributes);  ?>   
          
        
             <div class="box-body">
          
          		<label><?php echo $this->lang->line('designation_name'); ?> *</label>	
            <input class="form-control input-sm show_value_edit" type="text" id="designation_name_edit" required="" name="designation_name" value="">
            <span></span>
            <br />
            <span class="error"><?php echo (isset($alert) ? $alert :'').form_error('designation_name'); ?></span>
           <input type="hidden" name="designation_id" id="designation_id" value="">
          </div>      
			   <br />
    <div class="clear"></div>
     <!-- </form>-->
   	         <div class="modal-footer">
                <button form="form_designation_edit" type="button" class="show_active btn btn-danger for_modal" data-dismiss="modal">Close</button>
                <!-- form='' ==> Here Form id should be given -->
					 <button  form="form_designation_edit" name="Submit" value="Submit" type="submit" class="show_active btn btn-primary" >Update</button> 
                   
              </div>   
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->  
		  <?php echo form_close(); ?> 
	</div>
<!---modal pop up for edit ends here-------------------------------------------------->
		