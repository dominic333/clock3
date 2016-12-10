<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add / Edit User
            <small>User Management</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-cogs"></i> Setup Attendance</a></li>
            <li class="active"><a href="<?php echo base_url();?>ccshifts/shifts/users"> Add / Edit User</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModalHorizontal">Add New
                    User <span class="fa fa-plus-circle"></span></button>
            </div>
            <?php if($companyType==3){ ?>
            <div class="col-md-12">
               <select name="department" id="department" data-placeholder="-- Select A Department* --"  class="" onchange="document.getElementById('dept_id').value	=this.value;">
	                  <option value="">-- Select A Department* --</option>
	                  <?php foreach($company_departments as $row){?>
	                  <option value="<?php echo $row->dept_id;?>" <?php echo (isset($department) && ($department==$row->dept_id)? 'selected="selected"' : set_select('department',$row->dept_id));?> >
	                  <?php echo $row->department_name;?>
	                  </option>
	                  <?php } ?> 
	             </select>
				</div>
				<?php } ?>
        </div>

        </br>

        <div class="row">

            <div class="col-md-4">
                <!-- USERS LIST -->
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">User</h3>

                        <div class="box-tools pull-right">
                            <div class="checkbox">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- Widget: user widget style 1 -->
                        <div class="box box-widget widget-user-2">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-gray-light">
                                <div class="widget-user-image">
                                    <img class="img-circle" src="<?php echo base_url();?>assets/cc/images/admin-user.png" alt="User Avatar">
                                </div>
                                <!-- /.widget-user-image -->
                                <h4 class="widget-user-username">Maria Dela Cruz</h4>
                                <h5 class="widget-user-desc">One Global Place</h5>
                            </div>
                        </div>
                        <!-- /.widget-user -->

                        <div class="box-footer text-center">
                            <a href="javascript:void(0)" class="btn btn-success fa fa-edit"></a>
                            <a href="javascript:void(0)" class="btn btn-success fa fa-tag"></a>
                            <a href="javascript:void(0)" class="btn btn-success fa fa-map-marker"></a>
                            <a href="javascript:void(0)" class="btn btn-success fa fa-shield"></a>
                            <a href="javascript:void(0)" class="btn btn-danger fa fa-trash"></a>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!--/.box -->
            </div>
            <!-- /.col-md-4 -->

            <div class="col-md-4">
                <!-- USERS LIST -->
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">User</h3>
                        <div class="box-tools pull-right">
                            <div class="checkbox">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- Widget: user widget style 1 -->
                        <div class="box box-widget widget-user-2">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-gray-light">
                                <div class="widget-user-image">
                                    <img class="img-circle" src="<?php echo base_url();?>assets/cc/images/admin-user.png" alt="User Avatar">
                                </div>
                                <!-- /.widget-user-image -->
                                <h4 class="widget-user-username">Maria Dela Cruz</h4>
                                <h5 class="widget-user-desc">One Global Place</h5>
                            </div>
                        </div>
                        <!-- /.widget-user -->

                        <div class="box-footer text-center">
                            <a href="javascript:void(0)" class="btn btn-success fa fa-edit"></a>
                            <a href="javascript:void(0)" class="btn btn-success fa fa-tag"></a>
                            <a href="javascript:void(0)" class="btn btn-success fa fa-map-marker"></a>
                            <a href="javascript:void(0)" class="btn btn-success fa fa-shield"></a>
                            <a href="javascript:void(0)" class="btn btn-danger fa fa-trash"></a>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!--/.box -->
            </div>
            <!-- /.col-md-4 -->

            <div class="col-md-4">
                <!-- USERS LIST -->
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">User</h3>
                        <div class="box-tools pull-right">
                            <div class="checkbox">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- Widget: user widget style 1 -->
                        <div class="box box-widget widget-user-2">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-gray-light">
                                <div class="widget-user-image">
                                    <img class="img-circle" src="<?php echo base_url();?>assets/cc/images/admin-user.png" alt="User Avatar">
                                </div>
                                <!-- /.widget-user-image -->
                                <h4 class="widget-user-username">Maria Dela Cruz</h4>
                                <h5 class="widget-user-desc">One Global Place</h5>
                            </div>
                        </div>
                        <!-- /.widget-user -->

                        <div class="box-footer text-center">
                            <a href="javascript:void(0)" class="btn btn-success fa fa-edit"></a>
                            <a href="javascript:void(0)" class="btn btn-success fa fa-tag"></a>
                            <a href="javascript:void(0)" class="btn btn-success fa fa-map-marker"></a>
                            <a href="javascript:void(0)" class="btn btn-success fa fa-shield"></a>
                            <a href="javascript:void(0)" class="btn btn-danger fa fa-trash"></a>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!--/.box -->
            </div>
            <!-- /.col-md-4 -->

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
                    Add New User
                </h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">

                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Full Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Full Name" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Login Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Login Name" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Company</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Company" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Address</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Address" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Email" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Contact Number</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Contact Number" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-3 control-label">Department</label>
                        <div class="col-sm-9">
                            <select class="form-control selectdept" style="width: 100%;">
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
                        <label class="col-sm-3 control-label">Shift</label>
                        <div class="col-sm-9">
                            <select class="form-control selectshift" style="width: 100%;">
                                <option selected="selected">-- Select a Shift --</option>
                                <option>08.00am - 05.00pm</option>
                                <option>09.00am - 06.00pm</option>
                                <option>10.00am - 07.00pm</option>
                                <option>11.00am - 08.00pm</option>
                            </select>
                        </div>
                    </div>

            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger"
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


<script>
    $(function () {
        //Initialize department Elements
        $(".selectdept").select2();

        //Initialize Shift Elements
        $(".selectshift").select2();
    });
</script>