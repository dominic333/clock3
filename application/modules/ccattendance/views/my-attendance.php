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
            <div class="col-md-8">
                <div class="box box-danger">

                    <div class="box-header">

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-3">

                                    <div class="input-group date" data-provide="datepicker"
                                         id='dpfrom'>
                                        <input type="text" class="form-control" placeholder="From">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group date" data-provide="datepicker"
                                         id='dpto'>
                                        <input type="text" class="form-control" placeholder="To">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <a href="#" class="btn btn-success"><span
                                            class="fa fa-search"
                                            aria-hidden="true"></span>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="10px">No</th>
                                    <th>Date</th>
                                    <th>Clock in Time</th>
                                    <th>Clock out Time</th>
                                    <th>Notes</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>01-01-206</td>
                                    <td>00:00:00 AM</td>
                                    <td>00:00:00 PM</td>
                                    <td>Lorem Ipsum Dolor .....</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>02-01-206</td>
                                    <td>00:00:00 AM</td>
                                    <td>00:00:00 PM</td>
                                    <td>Lorem Ipsum Dolor .....</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>04-01-206</td>
                                    <td>00:00:00 AM</td>
                                    <td>00:00:00 PM</td>
                                    <td>Lorem Ipsum Dolor .....</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>06-01-206</td>
                                    <td>Absent</td>
                                    <td>Absent</td>
                                    <td>Lorem Ipsum Dolor .....</td>
                                </tr>

                                </tbody>

                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>
            <!-- /.col-md-8 -->

            <div class="col-md-4">
                <!-- Calendar -->
                <div class="box box-solid bg-green-gradient">
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
                    <div class="box-body no-padding">
                        <!--The calendar -->
                        <div id="calendar" style="width: 100%"></div>
                    </div>

                </div>
                <!-- /.box -->

            </div>
            <!-- /.col-md-4 -->

        </div>
        <!-- /.row -->


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->



