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
                           data-target="#myModalHorizontal">Add Shift <span
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
<div class="modal fade" id="myModalHorizontal" tabindex="-1" role="dialog"
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
                            <input type="text" class="form-control" placeholder="Shift Name" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Monday</label>
                        <div class="col-sm-3">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker">

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
                                    <input type="text" class="form-control timepicker">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tuesday</label>
                        <div class="col-sm-3">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker">

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
                                    <input type="text" class="form-control timepicker">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tuesday</label>
                        <div class="col-sm-3">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker">

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
                                    <input type="text" class="form-control timepicker">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Thursday</label>
                        <div class="col-sm-3">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker">

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
                                    <input type="text" class="form-control timepicker">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Friday</label>
                        <div class="col-sm-3">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker">

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
                                    <input type="text" class="form-control timepicker">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Saturday</label>
                        <div class="col-sm-3">
                            <!-- time Picker -->
                            <div class="bootstrap-timepicker">
                                <div class="input-group">
                                    <input type="text" class="form-control timepicker">

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
                                    <input type="text" class="form-control timepicker">

                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12 col-sm-offset-1">
                            <div class="checkbox">
                                <label class="control-label">
                                    <input type="checkbox">
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

