
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Reports
            <small>Lorem Ipsum...</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>ccreports/reports"><i class="fa fa-leanpub"></i> Reports</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-danger">
                    <div class="box-header">

                        <h3 class="box-title"><p>Department / Shift Attendance Report</p></h3>


                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-3">

                                    <div class="input-group date" data-provide="datepicker"
                                         id='dpfromdepartment'>
                                        <input type="text" class="form-control" placeholder="From">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group date" data-provide="datepicker"
                                         id='dptodepartment'>
                                        <input type="text" class="form-control" placeholder="To">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <select class="form-control select2" style="width: 100%;">
                                        <option selected="selected">-- Select a Department --</option>
                                        <option>All Departments</option>
                                        <option>9am-6pm</option>
                                        <option>8am-5pm</option>
                                        <option>11am-8pm</option>
                                        <option>10am-7pm</option>
                                    </select>
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
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Scheduled Clock In</th>
                                    <th>Clock In</th>
                                    <th>Scheduled Clock Out</th>
                                    <th>Clock Out</th>
                                    <th>Notes</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Maria Dela Cruz</td>
                                    <td>01-01-2016</td>
                                    <td>9:00:00 AM</td>
                                    <td>9:00:00 AM</td>
                                    <td>18:00:00 PM</td>
                                    <td>18:00:00 PM</td>
                                    <td>Lorem Ipsum ............</td>
                                    <td><a class="btn btn-success btn-sm" href="#"><span class="fa fa-edit"></span>
                                            <a class="btn btn-danger btn-sm" href="#"><span class="fa fa-trash"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>John</td>
                                    <td>01-01-2016</td>
                                    <td>9:00:00 AM</td>
                                    <td>9:00:00 AM</td>
                                    <td>18:00:00 PM</td>
                                    <td>18:00:00 PM</td>
                                    <td>Lorem Ipsum ............</td>
                                    <td><a class="btn btn-success btn-sm" href="#"><span class="fa fa-edit"></span>
                                            <a class="btn btn-danger btn-sm" href="#"><span class="fa fa-trash"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Fifi</td>
                                    <td>01-01-2016</td>
                                    <td>9:00:00 AM</td>
                                    <td>9:00:00 AM</td>
                                    <td>18:00:00 PM</td>
                                    <td>18:00:00 PM</td>
                                    <td>Lorem Ipsum ............</td>
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



        <!-- ===============================User Attendance Report=====================================-->

        <div class="row">
            <div class="col-md-12">
                <div class="box box-danger">
                    <div class="box-header">

                        <h3 class="box-title"><p>User Attendance Report</p></h3>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-3">

                                    <div class="input-group date" data-provide="datepicker"
                                         id='dpfromuser'>
                                        <input type="text" class="form-control" placeholder="From">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group date" data-provide="datepicker"
                                         id='dptouser'>
                                        <input type="text" class="form-control" placeholder="To">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <select class="form-control select2" style="width: 100%;">
                                        <option selected="selected">-- Select a User --</option>
                                        <option>All Users</option>
                                        <option>Maria</option>
                                        <option>John</option>
                                        <option>Fifi</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <a href="#" class="btn btn-success"><span
                                            class="fa fa-search"
                                            aria-hidden="true"></span>
                                    </a>
                                    <a href="#" class="btn btn-primary"><span
                                            class="fa fa-download"
                                            aria-hidden="true"></span>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="10px">No</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Scheduled Clock In</th>
                                    <th>Clock In</th>
                                    <th>Scheduled Clock Out</th>
                                    <th>Clock Out</th>
                                    <th>Notes</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Maria Dela Cruz</td>
                                    <td>01-01-2016</td>
                                    <td>9:00:00 AM</td>
                                    <td>9:00:00 AM</td>
                                    <td>18:00:00 PM</td>
                                    <td>18:00:00 PM</td>
                                    <td>Lorem Ipsum ............</td>
                                    <td><a class="btn btn-success btn-sm" href="#"><span class="fa fa-edit"></span>
                                            <a class="btn btn-danger btn-sm" href="#"><span class="fa fa-trash"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>John</td>
                                    <td>01-01-2016</td>
                                    <td>9:00:00 AM</td>
                                    <td>9:00:00 AM</td>
                                    <td>18:00:00 PM</td>
                                    <td>18:00:00 PM</td>
                                    <td>Lorem Ipsum ............</td>
                                    <td><a class="btn btn-success btn-sm" href="#"><span class="fa fa-edit"></span>
                                            <a class="btn btn-danger btn-sm" href="#"><span class="fa fa-trash"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Fifi</td>
                                    <td>01-01-2016</td>
                                    <td>9:00:00 AM</td>
                                    <td>9:00:00 AM</td>
                                    <td>18:00:00 PM</td>
                                    <td>18:00:00 PM</td>
                                    <td>Lorem Ipsum ............</td>
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



