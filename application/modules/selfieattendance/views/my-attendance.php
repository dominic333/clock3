    <div class="contentfirst">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                My Attendance
                <small>Report</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>selfiemyaccount/account"><i class="fa fa-calendar"></i> Account</a></li>
                <li><a href="<?php echo base_url();?>selfieattendance/attendance"> My Attendance</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-danger">
                        <div class="box-header">
										<form id="frm_attendance_search" name="frm_attendance_search" class="form-horizontal" role="form" 
											action="<?php echo base_url();?>selfieattendance/attendance" method="post">
			                        <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
			                        <div class="row">
			                            <div class="form-group">
			                                <div class="col-md-3">
			                                    <div class="input-group date" data-provide="datepicker"
			                                         id='date_from'>
			                                        <input id="date_from" name="date_from" data-date-format="dd-mm-yyyy" type="text" class="form-control" placeholder="From">
			                                        <div class="input-group-addon">
			                                            <span class="glyphicon glyphicon-th"></span>
			                                        </div>
			                                    </div>
			                                </div>
			
			                                <div class="col-md-3">
			                                    <div class="input-group date" data-provide="datepicker"
			                                         id='date_to'>
			                                        <input id="date_to"  name="date_to" data-date-format="dd-mm-yyyy" type="text" class="form-control" placeholder="To">
			                                        <div class="input-group-addon">
			                                            <span class="glyphicon glyphicon-th"></span>
			                                        </div>
			                                    </div>
			                                </div>
			
			                                <div class="col-md-3">
			                                    <button type="submit" name="Submit" value="Submit" class="btn btn-success"><span
			                                            class="fa fa-search"
			                                            aria-hidden="true"></span>
			                                    </button>
			                                </div>
			                            </div>
			                        </div>
										</form>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">
                            <div class="table-responsive" style='overflow: auto;'>
											<?php echo (isset($attendance_table)) ? $attendance_table :'Please Select The dates'; ?> 
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                </div>
                <!-- /.col-md-12 -->

            </div>
            <!-- /.row -->


        </section>
        <!-- /.content -->


        </section>

    </div>