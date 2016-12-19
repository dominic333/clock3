
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Assignment
            <small>Lorem Ipsum ....</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>ccshifts/shifts/assignmonitor"><i class="fa fa-file-text-o"></i> Assignment</a></li>
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
                            <select name="shifts" id="shifts" data-placeholder="-- Select A Shift* --"  class="form-control select2" style="width: 100%;" >
						                  <option value="">-- All Shifts --</option>
						                  <?php foreach($company_shifts as $shift){?>
						                  <option value="<?php echo $shift->shift_id;?>">
						                  <?php echo $shift->shift_name;?>
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


        <div id="users_in_shifts" class="row">
				<?php foreach($company_members as $member)
						{
							if($member->staff_photo==''||$member->staff_photo==' ')
							{
								$staff_photo=base_url().'assets/cc/images/admin-user.png';
							}
							else
							{
								$staff_photo=base_url().'images/users/'.$member->staff_photo;
							}
					
				?>
            <div id="<?php echo 'user'.$member->staff_id; ?>" class="col-md-2">
                <!-- USERS LIST -->
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $member->login_name; ?></h3>

                        <div class="box-tools pull-right">
                            <div class="checkbox">
                                <label><input id="<?php echo 'shiftUsers'.$member->staff_id; ?>" class="shiftUsersClass" name="shiftUsers" type="checkbox" value="<?php echo $member->staff_id; ?>"></label>
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
                                    <img class="img-circle" src="<?php echo $staff_photo; ?>" alt="User Avatar">
                                </div>
                                <!-- /.widget-user-image -->
                                <h4 class="widget-user-username"><?php echo $member->staff_name; ?></h4>
                                <h5 class="widget-user-desc"><?php echo $member->shift_name; ?></h5>
                            </div>
                        </div>
                        <!-- /.widget-user -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!--/.box -->
            </div>
            <?php } ?>

        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-12 text-center">
                <button class="btn btn-danger">Cancel</button>
                <button class="btn btn-success">Assign</button>
            </div>
        </div>


        <div id="attendance_monitoring_staff" class="row">

            <div class="col-md-12">
                <h3>Attendance Monitoring Staff</h3>
            </div>
				<?php foreach($company_members as $member)
						{
							if($member->staff_photo==''||$member->staff_photo==' ')
							{
								$staff_photo=base_url().'assets/cc/images/admin-user.png';
							}
							else
							{
								$staff_photo=base_url().'images/users/'.$member->staff_photo;
							}
					
				?>
            <div id="<?php echo 'monitor'.$member->staff_id; ?>" class="col-md-2">
                <!-- USERS LIST -->
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $member->login_name; ?></h3>

                        <div class="box-tools pull-right">
                            <div class="checkbox">
                                <label><input id="<?php echo 'monitorUsers'.$member->staff_id; ?>" class="monitorUsersClass" name="monitorUsers" type="checkbox" value="<?php echo $member->staff_id; ?>"></label>
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
                                    <img class="img-circle" src="<?php echo $staff_photo; ?>" alt="User Avatar">
                                </div>
                                <!-- /.widget-user-image -->
                                <h4 class="widget-user-username"><?php echo $member->staff_name; ?></h4>
                                <h5 class="widget-user-desc"><?php echo $member->shift_name; ?></h5>
                            </div>
                        </div>
                        <!-- /.widget-user -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!--/.box -->
            </div>
            <?php } ?>
            <!-- /.col-md-4 -->

        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-12 text-center">
                <button class="btn btn-danger">Remove Monitoring</button>
                <button class="btn btn-success">Assign Monitoring</button>
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
