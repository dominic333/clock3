<div class="content-wrapper" style="min-height: 946px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo (isset($admin_page_title) ? $admin_page_title :''); ?>
            <small></small>
          </h1>
          <!--<ol class="breadcrumb">
            <li><a href="<?php echo base_url().$this->lang->line('home');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a  href="<?php echo base_url().$this->lang->line('users').url_suffix(); ?>"><?php echo $this->lang->line('user_heading');?></a></li>
            <li class="active">Roles</li>
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
                 <div class="clearfix">
                  	<div class="col-md-12 col-sm-12 col-xs-12 p-0">
                        <a class="btn btn-secondary text-white text-uppercase text-bold pull-right fa-hover" href="<?php echo base_url().$this->lang->line('users').'/'.$this->lang->line('roles'); ?>/add"><i class="fa fa-plus"></i> Add <?php echo $this->lang->line('role_heading'); ?>&nbsp;
                        </a>	    
                	</div>  
                	</div>  
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php $attributes = array('name' => 'frm_roles','id' => 'frm_roles', 'method' =>'POST' , 'action' => 'echo base_url()');   //To enable CSRF protection
        echo form_open($this->lang->line('roles'), $attributes);  ?>    <!-- To enable CSRF protection      -->
         <div class="box-body">
                  <?php	echo $this->table->generate(); ?>
                  </div>
                  <?php echo form_close(); ?> 
              </div><!-- /.box -->
            </div><!--/.col (left) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div>
