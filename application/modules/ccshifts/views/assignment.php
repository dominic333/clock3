<style>
    input[type=search] {
        width: 200px;
        box-sizing: border-box;
        border: 2px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        background-color: white;
        background-image: url('searchicon.png');
        background-position: 10px 10px;
        background-repeat: no-repeat;
        padding: 12px 20px 12px 40px;
        -webkit-transition: width 0.4s ease-in-out;
        transition: width 0.4s ease-in-out;
    }

    input[type=search]:focus {
        width: 100%;
    }
</style>

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Assignment
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>ccshifts/shifts/assignmonitor"><i class="fa fa-file-text-o"></i>
                    Assignment</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">


        <div class="row">

            <div class="col-md-4">
                <!-- USERS LIST -->
                <div class="box box-default">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="form-group">
                            <label>Select a Shift</label>
                            <select name="shifts" id="shifts" data-placeholder="-- Select A Shift* --"
                                    class="form-control select2" style="width: 100%;">
                                <option value="">-- All Shifts --</option>
                                <?php foreach ($company_shifts as $shift) { ?>
                                    <option value="<?php echo $shift->shift_id; ?>">
                                        <?php echo $shift->shift_name; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!--/.box -->
            </div>
            <!-- /.col-md-4 -->
        </div>
        <!--/row-->

        <div class="row">
            <div id="exTab1" class="col-md-12">
                <ul class="nav nav-pills">
                    <li class="active border-btn">
                        <a href="#1a" data-toggle="tab">Add Users to Shifts</a>
                    </li>
                    <li class="border-btn">
                        <a href="#2a" data-toggle="tab">Assign Attendance Supervisors</a>
                    </li>
                </ul>

                <br>

                <div class="tab-content clearfix">
                    <div class="tab-pane active" id="1a">

                        <div class="row">
                            <div class="col-md-12">

                                <div id="users_in_shifts" class="row">
                                    <div class="col-md-12">
                                        <h3>Users in Shifts</h3>
                                    </div>

                                    <div class="col-md-4">
                                        <input type="search" class="search" name="search" placeholder="Search.."/> </br></br>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul id="listalist" class="list">
                                                <?php foreach ($company_members as $member) {
                                                	/*

                                                    if ($member->staff_photo == '' || $member->staff_photo == ' ') {
                                                        $staff_photo = base_url() . 'assets/cc/images/admin-user.png';
                                                    } else {
                                                        $staff_photo = base_url() . 'images/users/' . $member->staff_photo;
                                                    }
                                                    */


														if($member->staff_photo==''||$member->staff_photo==' ')
														{
															$staff_photo=base_url().'assets/cc/images/admin-user.png';
														}
														else
														{
                                                    //https://clock-in.me/webapp/images/avatars
                                                    //$staff_photo=base_url().'images/users/'.$member->staff_photo;
															$staff_photo='https://clock-in.me/webapp/images/avatars/'.$member->staff_photo;

															$url=getimagesize($staff_photo);
															if(!is_array($url))
															{
																$staff_photo=base_url().'assets/cc/images/admin-user.png';
															}
														}

                                                    ?>
                                                    <li>
                                                        <div id="<?php echo 'user' . $member->staff_id; ?>"
                                                             class="col-md-4">
                                                            <!-- USERS LIST -->
                                                            <div class="box box-danger">
                                                                <div class="box-header with-border">
                                                                    <h3 class="box-title"><?php echo $member->login_name; ?></h3>

                                                                    <div class="box-tools pull-right">
                                                                        <div class="checkbox">
                                                                            <label><input
                                                                                    id="<?php echo 'shiftUsers' . $member->staff_id; ?>"
                                                                                    class="shiftUsersClass"
                                                                                    name="shiftUsers"
                                                                                    type="checkbox"
                                                                                    value="<?php echo $member->staff_id; ?>"></label>
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
                                                                                <img class="img-circle"
                                                                                     src="<?php echo $staff_photo; ?>"
                                                                                     alt="User Avatar">
                                                                            </div>
                                                                            <!-- /.widget-user-image -->
                                                                            <h4 class="widget-user-username searchStaff"><?php echo $member->staff_name; ?></h4>
                                                                            <h5 class="widget-user-desc"><?php echo $member->shift_name; ?></h5>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.widget-user -->
                                                                </div>
                                                                <!-- /.box-body -->
                                                            </div>
                                                            <!--/.box -->
                                                        </div>
                                                    </li>

                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col=md-12" style="padding-left: 15px;">
                                        <ul class="pagination"></ul>
                                    </div>

                                </div>

                                <!-- /.row -->

                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button class="btn btn-danger">Cancel</button>
                                        <button id="assignStafftoShiftBtn" name="assignStafftoShiftBtn"
                                                class="btn btn-success">Assign
                                        </button>
                                    </div>
                                </div>

                            </div>
                            <!-- /.col-md-12 -->
                        </div>
                        <!-- /.row -->


                    </div>
                    <div class="tab-pane" id="2a">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="attendance_monitoring_staff" class="row">

                                    <div class="col-md-12">
                                        <h3>Attendance Supervising Staff</h3>
                                    </div>

                                    <div class="col-md-4">
                                        <input type="search" class="search" name="search" placeholder="Search.."/> </br></br>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul id="listalist2" class="list">
                                                <?php foreach ($company_members as $member) {
                                                	/*

                                                    if ($member->staff_photo == '' || $member->staff_photo == ' ') {
                                                        $staff_photo = base_url() . 'assets/cc/images/admin-user.png';
                                                    } else {
                                                        $staff_photo = base_url() . 'images/users/' . $member->staff_photo;
                                                    }
                                                    */


																if($member->staff_photo==''||$member->staff_photo==' ')
																{
																	$staff_photo=base_url().'assets/cc/images/admin-user.png';
																}
																else
																{
                                                    //https://clock-in.me/webapp/images/avatars
                                                    //$staff_photo=base_url().'images/users/'.$member->staff_photo;
																	$staff_photo='https://clock-in.me/webapp/images/avatars/'.$member->staff_photo;

																	$url=getimagesize($staff_photo);
																	if(!is_array($url))
																	{
																		$staff_photo=base_url().'assets/cc/images/admin-user.png';
																	}
																}

                                                    ?>
                                                    <li>
                                                        <div id="<?php echo 'monitor' . $member->staff_id; ?>"
                                                             class="col-md-4">
                                                            <!-- USERS LIST -->
                                                            <div class="box box-danger">
                                                                <div class="box-header with-border">
                                                                    <h3 class="box-title"><?php echo $member->login_name; ?></h3>

                                                                    <div class="box-tools pull-right">
                                                                        <div class="checkbox">
                                                                            <label><input
                                                                                    id="<?php echo 'monitorUsers' . $member->staff_id; ?>"
                                                                                    class="monitorUsersClass"
                                                                                    name="monitorUsers" type="checkbox"
                                                                                    value="<?php echo $member->staff_id; ?>"></label>
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
                                                                                <img class="img-circle"
                                                                                     src="<?php echo $staff_photo; ?>"
                                                                                     alt="User Avatar">
                                                                            </div>
                                                                            <!-- /.widget-user-image -->
                                                                            <h4 class="widget-user-username searchWatcher"><?php echo $member->staff_name; ?></h4>
                                                                            <h5 class="widget-user-desc"><?php echo $member->shift_name; ?></h5>
                                                                        </div>
                                                                    </div>
                                                                    <!-- /.widget-user -->
                                                                </div>
                                                                <!-- /.box-body -->
                                                            </div>
                                                            <!--/.box -->
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col=md-12" style="padding-left: 15px;">
                                        <ul class="pagination"></ul>
                                    </div>
                                    <!-- /.col-md-4 -->

                                </div>
                                <!-- /.row -->

                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button id="removeMonitor" name="removeMonitor" class="btn btn-danger">Remove
                                            Monitoring
                                        </button>
                                        <button id="assignMonitor" name="assignMonitor" class="btn btn-success">Assign
                                            Monitoring
                                        </button>
                                    </div>
                                </div>

                            </div>
                            <!-- /.col-md-12 -->

                        </div>
                        <!-- /.row -->

                    </div>
                </div>
            </div>
        </div>


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<script>
    $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();

    });
</script>
