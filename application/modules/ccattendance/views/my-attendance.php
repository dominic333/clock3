<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            My Attendance
            <small>Report</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>ccattendance/attendance"><i class="fa fa-calendar"></i> My Attendance</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-9">
                <div class="box box-danger">

                    <div class="box-header">

                    </div>
                    <!-- /.box-header -->
                  

														  
                    <div class="box-body">
                        <div class="table-responsive">
                        	<?php echo (isset($attendance_table)) ? $attendance_table :'Please Select The dates'; ?> 
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>
            <!-- /.col-md-8 -->

            <div class="col-md-3">
                <!-- Calendar -->
                <div>
                <?php /*
                <div class="box box-solid ">
                    <div class="box-header">
                        <i class="fa fa-calendar"></i>

                        <h3 class="box-title">Calendar</h3>
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <!-- /.box-header -->
                    <div >
                        <!--The calendar -->
                        
                    </div>
                   */ ?>
							<div id="calendar" style="width: 100%"></div>
                </div>
                <div> 
                	  <form id="frm_attendance_search" name="frm_attendance_search" class="form-horizontal" role="form" 
								action="<?php echo base_url();?>ccattendance/attendance" method="post">
                        <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
                        <div class="row">
                            <div class="">

                                <div class="col-md-6 ">
                                     <div id="dateRanges"></div>
                                		<input id="altField" name="altField" type="hidden" class="form-control">
                                		 <input id="date_from" name="date_from" data-date-format="dd-mm-yyyy" type="hidden" class="form-control" placeholder="From">
                                		 <input id="date_to"  name="date_to" data-date-format="dd-mm-yyyy" type="hidden" class="form-control" placeholder="To">
                                </div>
											
											
                                <div class="col-md-3">
                                    <button type="submit" id="submitThis" name="Submit" value="Submit" class="btn btn-success" disabled><span
                                            class="fa fa-search"
                                            aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
							</form>
                </div>
                <!-- /.box -->

            </div>
            <!-- /.col-md-4 -->

        </div>
        <!-- /.row -->


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper --><!-- /.content-wrapper -->