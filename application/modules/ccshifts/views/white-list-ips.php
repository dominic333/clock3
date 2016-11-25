<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add White List Ips
            <small>Lorem Ipsum...</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-cogs"></i> Setup Attendance</a></li>
            <li class="active"><a href="<?php echo base_url();?>ccshifts/shifts/whitelistips"> Add White List Ips</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">Manage List IPs</h3>
                        <a href="#" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#myModalHorizontal">Add Department IP <span
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
                                    <th>Department Name</th>
                                    <th>IP Address</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Finance Departmnet</td>
                                    <td>112.137.442.444</td>
                                    <td><a class="btn btn-success btn-sm" href="#"><span class="fa fa-edit"></span>
                                            <a class="btn btn-danger btn-sm" href="#"><span class="fa fa-trash"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>IT Department</td>
                                    <td>112.137.442.444</td>
                                    <td><a class="btn btn-success btn-sm" href="#"><span class="fa fa-edit"></span>
                                            <a class="btn btn-danger btn-sm" href="#"><span class="fa fa-trash"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>GA Department</td>
                                    <td>112.137.442.444</td>
                                    <td><a class="btn btn-success btn-sm" href="#"><span class="fa fa-edit"></span>
                                            <a class="btn btn-danger btn-sm" href="#"><span class="fa fa-trash"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>HR Department</td>
                                    <td>112.137.442.444</td>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Add Department IP
                </h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">

                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label  class="col-sm-4 control-label">Select a Department</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" style="width: 100%;">
                                <option selected="selected">-- Select a Department --</option>
                                <option>All Departments</option>
                                <option>Finance Department</option>
                                <option>IT Department</option>
                                <option>GA Department</option>
                                <option>HR Department</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">IP Address</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" placeholder="IP Address"/>
                        </div>
                    </div>

            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger"
                        data-dismiss="modal">
                    Cancel
                </button>
                <button type="button" class="btn btn-success">
                    Add
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--=======================================End Of Modal Form========================================-->
