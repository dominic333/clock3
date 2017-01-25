    <div class="contentfirst">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                My Attendance
                <small>Calendar View</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url();?>selfiemyaccount/account"><i class="fa fa-calendar"></i> Account</a></li>
                <li><a href="<?php echo base_url();?>selfieattendance/attendance"> My Attendance</a></li>
            </ol>
        </section>

        <!-- Main content -->
		<section class="content">
			<div class="row">
				 <?php $leaveManagement= $this->authentication->checkLeaveManagementAccess(); if($leaveManagement==1){ ?>
             <div class="col-md-3">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h4 class="box-title">Draggable Attendance</h4>
                    </div>
                    <div class="box-body">
                        <!-- the events -->
                        <div id="external-events">
                            <div class="external-event bg-green" data-leavetype="medical" data-leave="leave">Medical Leave</div>
                            <div class="external-event bg-yellow" data-leavetype="casual" data-leave="leave">Casual Leave</div>
                            <div class="external-event bg-aqua" data-leavetype="annual"   data-leave="leave">Annual Leave</div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /. box -->
             </div>
            <?php } ?>
				<!-- /.col -->
				<div>

				</div>
				<?php $leaveManagement= $this->authentication->checkLeaveManagementAccess(); if($leaveManagement==1){ ?>
				<div class="col-md-9">
				<?php } else { ?>
				<div class="col-md-12">
				<?php } ?>
					<div class="box box-primary">
						<div class="box-body no-padding">
							<!-- THE CALENDAR -->
							<div id="calendar"></div>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /. box -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</section>
        <!-- /.content -->


        </section>

    </div>