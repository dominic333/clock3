<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Staff Attendance Calendar View
            <small>Report</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="my-attendance.php"><i class="fa fa-calendar"></i> My Attendance</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php /* ?>
            <div class="col-md-3">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h4 class="box-title">Draggable Attendance</h4>
                    </div>
                    <div class="box-body">
                        <!-- the events -->
                        <div id="external-events">
                            <div class="external-event bg-green">On Time</div>
                            <div class="external-event bg-yellow">Late Clock In</div>
                            <div class="external-event bg-aqua">Holiday</div>
                            <div class="external-event bg-red">Absent</div>
                            <div class="external-event bg-gray">Did Not Clock Out</div>
                            <div class="external-event bg-purple">Early Clock Out</div>
                            <div class="checkbox">
                                <label for="drop-remove">
                                    <input type="checkbox" id="drop-remove">
                                    remove after drop
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /. box -->
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
            </div>
            <?php */ ?>
            <!-- /.col -->
            <div>

            </div>


            <div class="col-md-4">
                <!-- USERS LIST -->
                <div class="box box-default">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="form-group">
                            <label>Select User</label>
                            <select name="users" id="users" data-placeholder="-- Select A User* --"
                                    class="form-control select2" style="width: 100%;">
                                <?php foreach ($users as $user) { ?>
                                    <option
                                        value="<?php echo $user->staff_id; ?>" <?php echo(isset($users) && ($myID == $user->staff_id) ? 'selected="selected"' : set_select('users', $user->staff_id)); ?> >
                                        <?php echo $user->staff_name; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <input type="hidden" name="user_id" id="user_id" value=""/>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!--/.box -->
            </div>
            <!-- /.col-md-4 -->

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body no-padding">
                        <!-- THE CALENDAR -->
                        <div id="staffCalendar"></div>
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
</div>
<!-- /.content-wrapper -->

<!-- **************** Modal PopUp for Attendance ******************* -->

<div class="modal fade for_hide my-fade" id="attendance_modal">
    <div class="modal-dialog my-modal">
        <div class="modal-content">
            <div class="modal-header reset-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only"></span></button>
                <h4 class="modal-title">Attendance Amendments</h4>
            </div>
            <div class="modal-body">

                <?php $attributes = array('name' => 'attendance_frm', 'id' => 'attendance_frm', 'method' => 'POST', 'action' => 'echo base_url()');   //To enable CSRF protection
                echo form_open(base_url() . 'ccattendance/attendance/add_notes/' . $this->session->userdata('mid'), $attributes); ?>
                <!-- To enable CSRF protection      -->
                <div class="col-md-12">

                    <div class="form-group">
                        <label for="clock" class="col-sm-4 control-label">Clock Type</label>

                        <div class="col-sm-7" style="padding-bottom: 20px;">
                            <select name="clock" id="clock" class="form-control" style="width:50%;">
                                <option>--Select--</option>
                                <option value="in">Clock In</option>
                                <option value="nc">Clock Out</option>
                            </select>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="notes" class="col-sm-4 control-label">Notes</label>

                        <div class="col-sm-7" style="padding-bottom: 20px;">
                            <textarea name="notes" placeholder="Add notes" id="notes" class="form-control"
                                      required></textarea>
                            <!--                            <input id="notes" name="notes" type="text" class="form-control" placeholder="Add notes" required>-->
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4">
                            <label>Amend Schedule Clock IN / OUT Time?</label>
                        </div>
                        <div class="col-sm-2">

                            <input type="radio" class="set_time" name="set_time" value="yes" class=""/> YES

                        </div>
                        <div class="col-sm-2">
                            <input type="radio" class="set_time" name="set_time" value="no" checked class=""/> NO
                        </div>

                    </div>
                    <div class="clearfix"></div>


                    <div class="form-group time">
                        <div class="col-sm-4"><label class="control-label">Select New Schedule Clock IN / OUT
                                Time </label></div>

                        <div class="col-sm-3">
                            <div class="input-group bootstrap-timepicker timepicker">
                                <input id="timepicker1" name="clocktime" type="text" class="form-control input-small"
                                       placeholder="Clock Time">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="clearfix"></div>
            </div><!-- /.modal-content -->
            <input id="logdate" name="logdate" type="hidden" class="form-control"/>
            <input type="hidden" name="userid" id="userid" value=""/>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left show_active" style="margin-right:5px;"
                        data-dismiss="modal">Close
                </button>
                <button name="Submit" value="Submit" class="btn btn-success show_active">Submit</button>
                </button>
            </div>
            <?php echo form_close(); ?>
        </div>

    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- ****************End of Modal popup ************************-->