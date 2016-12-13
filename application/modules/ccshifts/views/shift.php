<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add / Edit Shift
            <small>Lorem Ipsum...</small>
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
                        <a href="#" class="btn btn-primary btn-sm pull-right" data-toggle="modal"
                           data-target="#addNewShift">Add Shift <span
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
                                <tr>
                                    <td>1</td>
                                    <td>Morning Shift</td>
                                    <td><a class="btn btn-success btn-sm" href="#"><span class="fa fa-edit"></span>
                                            <a class="btn btn-danger btn-sm" href="#"><span class="fa fa-trash"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Afternoon Shift</td>
                                    <td><a class="btn btn-success btn-sm" href="#"><span class="fa fa-edit"></span>
                                            <a class="btn btn-danger btn-sm" href="#"><span class="fa fa-trash"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Evening Shift</td>
                                    <td><a class="btn btn-success btn-sm" href="#"><span class="fa fa-edit"></span>
                                            <a class="btn btn-danger btn-sm" href="#"><span class="fa fa-trash"></span>
                                    </td>
                                </tr>

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


<!--=======================================Modal Form========================================-->
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
            <div class="modal-body">

                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Shift Name</label>
                        <div class="col-sm-6">
                            <input type="text" name="shift_name" id="shift_name" class="form-control" placeholder="Shift Name" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <select name="timezone" id="timezone" class="selectpicker form-control chosen-select">
                        <option value="">-- Select A Time Zone* --</option>
                        <?php foreach($timezone_lists as $row){?>
                        <option value="<?php echo $row['zone'];?>" ><?php echo $row['diff_from_GMT'] . ' - ' . str_replace("/", " / ",$row['zone'])?></option>
                        <?php } ?>  
                   </select>
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
                    <div class="form-group">
                        <div class="col-sm-12 col-sm-offset-1">
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
                <button type="reset" class="btn btn-danger"
                        data-dismiss="modal">
                    Cancel
                </button>
                <button type="submit" class="btn btn-success">
                    Add
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--=======================================End Of Modal Form========================================-->

