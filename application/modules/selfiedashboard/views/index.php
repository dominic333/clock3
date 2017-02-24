

            <div class="contentfirst">

                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-home"></i> Dashboard</a></li>
                    </ol>
                </section>

                <section class="content">

                    <!-- Small boxes (Stat box) -->
							<?php /* ?>                    
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="info-box bg-aqua">
                                <span class="info-box-icon"><i class="fa fa-users"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Total Users</span>
                                    <span class="info-box-number">12</span>

                                    <div class="progress">
                                        <div class="progress-bar" style="width: 100%"></div>
                                    </div>
                                    <span class="progress-description">70% Increase in 30 Days</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="info-box bg-red">
                                <span class="info-box-icon"><i class="fa fa-calendar"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Absents</span>
                                    <span class="info-box-number">1</span>

                                    <div class="progress">
                                        <div class="progress-bar" style="width: 10%"></div>
                                    </div>
                                      <span class="progress-description">
                                        70% Increase in 30 Days
                                      </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="info-box bg-yellow">
                                <span class="info-box-icon"><i class="fa fa-clock-o"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Late Clock in</span>
                                    <span class="info-box-number">3</span>

                                    <div class="progress">
                                        <div class="progress-bar" style="width: 30%"></div>
                                    </div>
                                      <span class="progress-description">
                                        70% Increase in 30 Days
                                      </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="info-box bg-green">
                                <span class="info-box-icon"><i class="fa fa-circle-o"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Early Clock in</span>
                                    <span class="info-box-number">7</span>

                                    <div class="progress">
                                        <div class="progress-bar" style="width: 70%"></div>
                                    </div>
                                      <span class="progress-description">
                                        70% Increase in 30 Days
                                      </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->

                    </div>
                    <?php */ ?>
                    <!-- /.row -->

                    <!--========================================================================================================-->

                    <div class="row">

                        <div class="col-md-12">
                            <div class="box box-danger">
                                <div class="box-header with-border">
                                    <h3 class="box-title">My Profile</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <?php foreach($user_data as $row)
                                {
                                ?>
                                <div class="box-body">
                                    <!-- Widget: user widget style 1 -->
                                    <div class="box box-widget widget-user-2">
                                        <!-- Add the bg color to the header using any of the bg-* classes -->
                                        <div class="widget-user-header bg-gray-light">
                                            <div class="widget-user-image">
                                                <?php if($row->staff_photo!='') {?>
                                                    <img class="img-circle" src="<?php echo base_url();?>images/avatars/<?php echo  $row->staff_photo; ?>">
                                                <?php } else{ ?>
                                                <img class="img-circle" src="<?php echo base_url();?>assets/snap/images/admin-user.png"
                                                     alt="User Avatar">
                                                <?php } ?>
                                            </div>
                                            <!-- /.widget-user-image -->
                                            <h4 class="widget-user-username"><?php echo $row->staff_name; ?></h4>
                                             <h5 class="widget-user-desc">Web Developer</h5>
                                        </div>
                                        <div class="box-footer no-padding">
                                            <ul class="nav nav-stacked">
                                                <li><a href="#">Company : <?php echo $row->company_name; ?></a></li>
                                               <!-- <li><a href="#">Address : Kebayoran Baru</a></li> -->
                                                <li><a href="#">Phone Number : <?php echo $row->contact_number; ?></a></li>
                                                <li><a href="#">Email : <?php echo $row->email; ?></a>
                                                <li><a href="#">Department : <?php echo $row->department_name; ?></a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url();?>selfiemyaccount/account" class="btn btn-block btn-default" >View Profile
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /.widget-user -->

                                </div>
                                <?php } ?>
                                <!-- /.box-body -->

                            </div>

                        </div>
                        <!-- /.col-md-4 -->

                    </div>
                    <!-- /.row -->


                </section>

            </div>
            <!--well-->

<!--kevin@mynotepedia.com-->
<!--kevinmaulana1991@gmail.com-->

