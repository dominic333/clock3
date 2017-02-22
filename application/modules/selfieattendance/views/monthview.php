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
				 <?php /* $leaveManagement= $this->authentication->checkLeaveManagementAccess(); if($leaveManagement==1){ ?>
             <div class="col-md-3">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h4 class="box-title">Drag & Drop Your Leave Application</h4>
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
<?php */?>

				<div id="exTab1" class="col-md-12">
					<ul class="nav nav-pills">
						<li class="active border-btn">
							<a href="#1a" data-toggle="tab">My Attendance</a>
						</li>
						<li class="border-btn">
							<a href="#2a" data-toggle="tab">Leave Calendar</a>
						</li>
					</ul>
					<br>

					<div class="tab-content clearfix">
						<div class="tab-pane active" id="1a">

							<div class="row">
								<div class="col-md-12">
										<div class="box box-primary">
											<div class="box-body no-padding">
												<!-- THE CALENDAR -->
												<div id="calendar"></div>
											</div>
											<!-- /.box-body -->
										</div>
										<!-- /. box -->
								</div>
								<!-- /.col-md-12 -->
							</div>
							<!-- /.row -->


						</div>
						<div class="tab-pane" id="2a">
							<div class="row">
								<div class="col-md-12">
									<div id="toggle" class="article">
										<h3><span>Leave Calendar</span></h3>
										<h4>You can toggle date and get those dates as array.</h4>
										<div class="toggle-calendar"></div>
										<div class="box"></div>

									</div>

								</div>
								<!-- /.col-md-12 -->
							</div>

							<div class="row">
								<div class="col-md-12">
									<h4>Step 2: Add Note & Select Leave Type</h4>
									<div class="box box-default">
										<div class="box-header with-border">
											<h3 class="box-title">Fill Form</h3>
										</div>
										<form id="formLeaveRequest2" name="formLeaveRequest2" method="POST" class="form-horizontal">
											<div class="box-body">
												<div class="form-group">
													<label for="inputEmail3" class="col-sm-2 control-label">Add Note</label>

													<div class="col-sm-10">
														<textarea class="form-control" rows="3" name="leaveNote" id="leaveNote" ></textarea>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Leave Type</label>
													<div class="col-sm-10">
														<select id="leavetype" name="leavetype" class="form-control">
															<option value="">Select a Leave Form</option>
															<option value="medical">Medical Leave</option>
															<option value="casual">Casual Leave</option>
															<option value="annual">Annual Leave</option>
														</select>
													</div>
												</div>
											</div>
											<div class="box-footer">
												<button type="submit" class="btn btn-success pull-right">Submit</button>
											</div>
										</form>
									</div>
								</div>

							</div>
							<!-- /.row -->

						</div>
					</div>





				</div>

				<!-- /.col -->
			</div>
			<!-- /.row -->
		</section>
        <!-- /.content -->


        </section>

    </div>