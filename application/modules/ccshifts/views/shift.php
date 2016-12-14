<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add / Edit Shift
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-cogs"></i> Setup Attendance</a></li>
            <li class="active"><a href="<?php echo base_url();?>ccshifts/shifts/shifts"> Add / Edit Shift</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">Manage Shifts</h3>
                        <a href="#" class="btn btn-primary btn-sm pull-right" id="addNewShiftBtn" name="addNewShiftBtn"
                           >Add Shift <span
                                class="fa fa-plus-circle"
                                aria-hidden="true"></span></a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="10px">No</th>
                                    <th>Shift Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1; foreach($shifts as $row){?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row->shift_name; ?></td>
                                    <td>
                                        <a data-shift_id="<?php echo $row->shift_id; ?>"
                                           data-comp_id="<?php echo $row->comp_id; ?>"
                                           data-shift_name="<?php echo $row->shift_name; ?>"
                                           data-time_zone="<?php echo $row->time_zone; ?>"

                                           data-monday="<?php echo $row->monday; ?>"
                                           data-tuesday="<?php echo $row->tuesday; ?>"
                                           data-wednesday="<?php echo $row->wednesday; ?>"
                                           data-thursday="<?php echo $row->thursday; ?>"
                                           data-friday="<?php echo $row->friday; ?>"
                                           data-saturday="<?php echo $row->saturday; ?>"
                                           data-sunday="<?php echo $row->sunday; ?>"

                                           data-monday_starttime="<?php echo $row->monday_starttime; ?>"
                                           data-tuesday_starttime="<?php echo $row->tuesday_starttime; ?>"
                                           data-wednesday_starttime="<?php echo $row->wednesday_starttime; ?>"
                                           data-thursday_starttime="<?php echo $row->thursday_starttime; ?>"
                                           data-friday_starttime="<?php echo $row->friday_starttime; ?>"
                                           data-saturday_starttime="<?php echo $row->saturday_starttime; ?>"
                                           data-sunday_starttime="<?php echo $row->sunday_starttime; ?>"

                                           data-monday_endtime="<?php echo $row->monday_endtime; ?>"
                                           data-tuesday_endtime="<?php echo $row->tuesday_endtime; ?>"
                                           data-wednesday_endtime="<?php echo $row->wednesday_endtime; ?>"
                                           data-thursday_endtime="<?php echo $row->thursday_endtime; ?>"
                                           data-friday_endtime="<?php echo $row->friday_endtime; ?>"
                                           data-saturday_endtime="<?php echo $row->saturday_endtime; ?>"
                                           data-sunday_endtime="<?php echo $row->sunday_endtime; ?>"

                                           data-notify_time="<?php echo $row->notify_time; ?>"

                                           class="btn btn-success btn-sm editShiftTime" href="#" data-toggle="tooltip" data-placement="bottom" title="Edit Shift Details">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                        <a class="btn btn-warning btn-sm updateNotificationTime" href="#"
                                           data-shift_id="<?php echo $row->shift_id; ?>"
                                           data-comp_id="<?php echo $row->comp_id; ?>"
                                           data-shift_name="<?php echo $row->shift_name; ?>"
                                           data-notify_time="<?php echo $row->notify_time; ?>"
                                           data-toggle="tooltip" data-placement="bottom" title="Update Notification time"><span class="fa fa-clock-o"></span>
                                    </td>
                                </tr>
                                <?php $i++; } ?>

                                </tbody>

                            </table>
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
</div>
<!-- /.content-wrapper -->


<!--======================================= Add Shift Modal Form Start========================================-->
<div class="modal fade" id="addNewShift" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Add Shift
                </h4>
            </div>

            <!-- Modal Body -->
            <form id="frm_add_shifts" name="frm_add_shifts" method="post" action="<?php echo base_url();?>ccshifts/shifts/add_shifts" class="form-horizontal" role="form">
            <div class="modal-body">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Shift Name</label>
                        <div class="col-sm-6">
                            <input type="text" name="shift_name" id="shift_name" class="form-control" placeholder="Shift Name" required/>
                        </div>
                    </div>
                    <?php //$timezone_lista=timezone_lists(); var_dump($timezone_lista); ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Timezones</label>
                        <div class="col-sm-6">
                            <select name="timezone" id="timezone" class="selectpicker form-control chosen-select">
                                <option value="">-- Select A Time Zone* --</option>
                                <?php foreach($timezone_lists as $row){?>
                                    <option value="<?php echo $row->zone_name;?>" ><?php echo $row->zone_name;?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Monday</label>
                        <div class="col-sm-3">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker starttimes" name="starttime_mon" id="starttime_mon"  data-field="time" readonly placeholder="Monday Shift Start Time">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <label class="col-sm-1 control-label">To</label>
                        <div class="col-sm-3">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker endtimes" name="endtime_mon" id="endtime_mon" data-field="time" readonly  placeholder="Monday Shift End Time">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-sm-3">
                        	<div class="checkbox">
                                <label class="control-label">
                                    <input type="checkbox" name="mon_off" id="mon_off" class="" value="1" />
                                    <strong>Mark as off day</strong>
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tuesday</label>
                        <div class="col-sm-3">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker starttimes" name="starttime_tues" id="starttime_tues" data-field="time" readonly  placeholder="Tuesday Shift Start Time">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <label class="col-sm-1 control-label">To</label>
                        <div class="col-sm-3">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker endtimes" name="endtime_tues" id="endtime_tues" data-field="time" readonly  placeholder="Tuesday Shift End Time">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-sm-3">
                        	<div class="checkbox">
                                <label class="control-label">
                                    <input type="checkbox" name="tues_off" id="tues_off" class="" value="1" />
                                    <strong>Mark as off day</strong>
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Wednesday</label>
                        <div class="col-sm-3">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker starttimes" name="starttime_wed" id="starttime_wed" data-field="time" readonly  placeholder="Wednesday Shift Start Time">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <label class="col-sm-1 control-label">To</label>
                        <div class="col-sm-3">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker endtimes" name="endtime_wed" id="endtime_wed" data-field="time" readonly  placeholder="Wednesday Shift End Time">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-sm-3">
                        	<div class="checkbox">
                                <label class="control-label">
                                    <input type="checkbox" name="wed_off" id="wed_off" class="" value="1" />
                                    <strong>Mark as off day</strong>
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Thursday</label>
                        <div class="col-sm-3">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker starttimes" name="starttime_thurs" id="starttime_thurs" data-field="time" readonly  placeholder="Thursday Shift Start Time">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <label class="col-sm-1 control-label">To</label>
                        <div class="col-sm-3">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker endtimes" name="endtime_thurs" id="endtime_thurs" data-field="time" readonly  placeholder="Thursday Shift End Time">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-sm-3">
                        	<div class="checkbox">
                                <label class="control-label">
                                    <input type="checkbox" name="thurs_off" id="thurs_off" class="" value="1" />
                                    <strong>Mark as off day</strong>
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Friday</label>
                        <div class="col-sm-3">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker starttimes" name="starttime_fri" id="starttime_fri" data-field="time" readonly  placeholder="Friday Shift Start Time">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <label class="col-sm-1 control-label">To</label>
                        <div class="col-sm-3">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker endtimes" name="endtime_fri" id="endtime_fri" data-field="time" readonly  placeholder="Friday Shift End Time">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-sm-3">
                        	<div class="checkbox">
                                <label class="control-label">
                                    <input type="checkbox" name="fri_off" id="fri_off" class="" value="1" />
                                    <strong>Mark as off day</strong>
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Saturday</label>
                        <div class="col-sm-3">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker starttimes" name="starttime_sat" id="starttime_sat" data-field="time" readonly  placeholder="Saturday Shift Start Time">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <label class="col-sm-1 control-label">To</label>
                        <div class="col-sm-3">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker endtimes" name="endtime_sat" id="endtime_sat" data-field="time" readonly  placeholder="Saturday Shift End Time">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-sm-3">
                        	<div class="checkbox">
                                <label class="control-label">
                                    <input type="checkbox" name="sat_off" id="sat_off" class="" value="1" />
                                    <strong>Mark as off day</strong>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Sunday</label>
                        <div class="col-sm-3">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker starttimes" name="starttime_sun" id="starttime_sun" data-field="time" readonly  placeholder="Sunday Shift Start Time">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <label class="col-sm-1 control-label">To</label>
                        <div class="col-sm-3">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker endtimes" name="endtime_sun" id="endtime_sun" data-field="time" readonly  placeholder="Sunday Shift End Time">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-sm-3">
                        	<div class="checkbox">
                                <label class="control-label">
                                    <input type="checkbox" name="sun_off" id="sun_off" class="" value="1" />
                                    <strong>Mark as off day</strong>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-4 pull-right">
                    <small>If Mark as Off Day is checked; Time set for that day won't be accounted.</small>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12 ">
                            <div class="checkbox">
                                <label class="control-label">
                                    <input type="checkbox" name="all_day_same" id="all_day_same" class="" />
                                    <strong>Use same time for all work days</strong>
                                </label>
                            </div>
                        </div>
                    </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" name="reset_times" id="reset_times" class="btn btn-primary">Reset All Work Shift Timers</button>
                <button type="reset" class="btn btn-danger"
                        data-dismiss="modal">
                    Cancel
                </button>
                <button type="submit" class="btn btn-success">
                    Add Shift
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
<!--=======================================End Of Add Shift Modal Form========================================-->


<!--======================================= Edit Shift Modal Form Start========================================-->
<div class="modal fade" id="editNewShift" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Add Shift
                </h4>
            </div>

            <!-- Modal Body -->
            <form id="frm_edit_shifts" name="frm_edit_shifts" method="post" action="<?php echo base_url();?>ccshifts/shifts/modify_shifts" class="form-horizontal" role="form">
                <div class="modal-body">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
                    <input type="hidden" name="shift_id" id="shift_id" />
                    <input type="hidden" name="comp_id" id="comp_id" />
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Shift Name</label>
                        <div class="col-sm-6">
                            <input type="text" name="shift_name" id="shift_name" class="form-control" placeholder="Shift Name" required readonly/>
                        </div>
                    </div>
                    <?php //$timezone_lists=timezone_lists();?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Timezones</label>
                        <div class="col-sm-6">
                            <select name="timezone" id="timezone" class="selectpicker form-control chosen-select">
                                <option value="">-- Select A Time Zone* --</option>
                                <?php foreach($timezone_lists as $row){?>
                                    <option value="<?php echo $row->zone_name;?>" ><?php echo $row->zone_name;?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Monday</label>
                        <div class="col-sm-3">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker starttimes" name="starttime_mon" id="starttime_mon"  data-field="time" readonly placeholder="Monday Shift Start Time">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <label class="col-sm-1 control-label">To</label>
                        <div class="col-sm-3">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker endtimes" name="endtime_mon" id="endtime_mon" data-field="time" readonly  placeholder="Monday Shift End Time">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="checkbox">
                                <label class="control-label">
                                    <input type="checkbox" name="mon_off" id="mon_off" class="" value="1" />
                                    <strong>Mark as off day</strong>
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tuesday</label>
                        <div class="col-sm-3">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker starttimes" name="starttime_tues" id="starttime_tues" data-field="time" readonly  placeholder="Tuesday Shift Start Time">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <label class="col-sm-1 control-label">To</label>
                        <div class="col-sm-3">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker endtimes" name="endtime_tues" id="endtime_tues" data-field="time" readonly  placeholder="Tuesday Shift End Time">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="checkbox">
                                <label class="control-label">
                                    <input type="checkbox" name="tues_off" id="tues_off" class="" value="1" />
                                    <strong>Mark as off day</strong>
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Wednesday</label>
                        <div class="col-sm-3">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker starttimes" name="starttime_wed" id="starttime_wed" data-field="time" readonly  placeholder="Wednesday Shift Start Time">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <label class="col-sm-1 control-label">To</label>
                        <div class="col-sm-3">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker endtimes" name="endtime_wed" id="endtime_wed" data-field="time" readonly  placeholder="Wednesday Shift End Time">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="checkbox">
                                <label class="control-label">
                                    <input type="checkbox" name="wed_off" id="wed_off" class="" value="1" />
                                    <strong>Mark as off day</strong>
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Thursday</label>
                        <div class="col-sm-3">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker starttimes" name="starttime_thurs" id="starttime_thurs" data-field="time" readonly  placeholder="Thursday Shift Start Time">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <label class="col-sm-1 control-label">To</label>
                        <div class="col-sm-3">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker endtimes" name="endtime_thurs" id="endtime_thurs" data-field="time" readonly  placeholder="Thursday Shift End Time">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="checkbox">
                                <label class="control-label">
                                    <input type="checkbox" name="thurs_off" id="thurs_off" class="" value="1" />
                                    <strong>Mark as off day</strong>
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Friday</label>
                        <div class="col-sm-3">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker starttimes" name="starttime_fri" id="starttime_fri" data-field="time" readonly  placeholder="Friday Shift Start Time">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <label class="col-sm-1 control-label">To</label>
                        <div class="col-sm-3">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker endtimes" name="endtime_fri" id="endtime_fri" data-field="time" readonly  placeholder="Friday Shift End Time">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="checkbox">
                                <label class="control-label">
                                    <input type="checkbox" name="fri_off" id="fri_off" class="" value="1" />
                                    <strong>Mark as off day</strong>
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Saturday</label>
                        <div class="col-sm-3">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker starttimes" name="starttime_sat" id="starttime_sat" data-field="time" readonly  placeholder="Saturday Shift Start Time">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <label class="col-sm-1 control-label">To</label>
                        <div class="col-sm-3">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker endtimes" name="endtime_sat" id="endtime_sat" data-field="time" readonly  placeholder="Saturday Shift End Time">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="checkbox">
                                <label class="control-label">
                                    <input type="checkbox" name="sat_off" id="sat_off" class="" value="1" />
                                    <strong>Mark as off day</strong>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Sunday</label>
                        <div class="col-sm-3">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker starttimes" name="starttime_sun" id="starttime_sun" data-field="time" readonly  placeholder="Sunday Shift Start Time">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <label class="col-sm-1 control-label">To</label>
                        <div class="col-sm-3">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker endtimes" name="endtime_sun" id="endtime_sun" data-field="time" readonly  placeholder="Sunday Shift End Time">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="checkbox">
                                <label class="control-label">
                                    <input type="checkbox" name="sun_off" id="sun_off" class="" value="1" />
                                    <strong>Mark as off day</strong>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-4 pull-right">
                        <small>If Mark as Off Day is checked; Time set for that day won't be accounted.</small>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12 ">
                            <div class="checkbox">
                                <label class="control-label">
                                    <input type="checkbox" name="all_day_same" id="all_day_same" class="" />
                                    <strong>Use same time for all work days</strong>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" name="reset_times" id="reset_times" class="btn btn-primary">Reset All Work Shift Timers</button>
                    <button type="reset" class="btn btn-danger"
                            data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-success">
                        Update This Shift
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--=======================================End Of Edit Shift Modal Form========================================-->

<!--=======================================Edit announcement Modal Form========================================-->
<div class="modal fade" id="updateNotificationTime" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                   Update Notification Time
                </h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">

                <form id="formUpdateNotificationTime" name="formUpdateNotificationTime" class="form-horizontal" role="form" action="<?php echo base_url();?>ccshifts/shifts/updateNotificationTime" method="post">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
                    <input type="hidden" name="shift_id" id="shift_id" />
                    <input type="hidden" name="comp_id" id="comp_id" />

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Shift Name</label>
                        <div class="col-sm-6">
                            <input type="text" name="shift_name" id="shift_name" class="form-control" placeholder="Shift Name" required readonly/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Notification Time</label>
                        <div class="col-sm-6">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker endtimes" name="notify_time" id="notify_time" data-field="time" readonly  placeholder="Notification Time">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                    </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="reset" class="btn btn-danger"
                        data-dismiss="modal">
                    Cancel
                </button>
                <button type="submit" class="btn btn-success">
                    Update Notification Time
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--=======================================End Of Edit announcement Modal Form========================================-->
