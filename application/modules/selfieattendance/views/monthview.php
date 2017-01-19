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
                            <?php /*
                            <div class="external-event bg-red">Absent</div>
                            <div class="external-event bg-gray">Did Not Clock Out</div>
                            <div class="external-event bg-purple">Early Clock Out</div>
                            <div class="checkbox">
                                <label for="drop-remove">
                                    <input type="checkbox" id="drop-remove">
                                    remove after drop
                                </label>
                            </div>
                           */ ?>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /. box -->
                <?php /* ?>
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create Attendance</h3>
                    </div>
                    <div class="box-body">
                        <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                            <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                            <ul class="fc-color-picker" id="color-chooser">
                                <li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
                                <li><a class="text-gray" href="#"><i class="fa fa-square"></i></a></li>

                            </ul>
                        </div>
                        <!-- /btn-group -->
                        <div class="input-group">
                            <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                            <div class="input-group-btn">
                                <button id="add-new-event" type="button" class="btn btn-primary btn-flat">Add
                                </button>
                            </div>
                            <!-- /btn-group -->
                        </div>
                        <!-- /input-group -->
                    </div>
                </div>
                <?php */ ?>
            </div>
            
				<!-- /.col -->
				<div>

				</div>
				<div class="col-md-9">
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