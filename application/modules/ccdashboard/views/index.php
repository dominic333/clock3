<!--This is Dashboard Page-->


<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>ccdashboard/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="fa fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Users</span>
                        <span class="info-box-number">
                        <?php echo (isset($total_Users)) ? $total_Users :set_value('NA'); ?>/<?php echo (isset($companyPlanDetails->userLimit)) ? $companyPlanDetails->userLimit :set_value('NA'); ?>
                        </span>
								<?php 
									if(isset($total_Users) && isset($companyPlanDetails->userLimit) ) 
									{
										$userPercentage = round((($total_Users/$companyPlanDetails->userLimit)*100));
									}
									else 
									{
										$userPercentage = 100;
									}
								?>
                        <div class="progress">
                            <div class="progress-bar" style="width: <?php echo $userPercentage; ?>%"></div>
                        </div>
                        <span class="progress-description"></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-red">
                    <span class="info-box-icon"><i class="fa fa-calendar"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Absents</span>
                        <span class="info-box-number"><?php echo (isset($usersdetails['absent_checkin_users'])) ? $usersdetails['absent_checkin_users'] :'0'; ?> </span>
								<?php 
									if(isset($total_Users) && isset($usersdetails['absent_checkin_users']) ) 
									{
										$absentPercentage = round((($usersdetails['absent_checkin_users']/$total_Users)*100));
									}
									else 
									{
										$absentPercentage = 0;
									}
								?>
                        <div class="progress">
                            <div class="progress-bar" style="width: <?php echo $absentPercentage; ?>%"></div>
                        </div>
                  <span class="progress-description">
                  </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-yellow">
                    <span class="info-box-icon"><i class="fa fa-clock-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Late Clock in</span>
                        <span class="info-box-number"><?php echo (isset($usersdetails['late_checkin_users'])) ? $usersdetails['late_checkin_users'] :'0'; ?></span>
								<?php 
									if(isset($total_Users) && isset($usersdetails['late_checkin_users']) ) 
									{
										$lateClockPercentage = round((($usersdetails['late_checkin_users']/$total_Users)*100));
									}
									else 
									{
										$lateClockPercentage = 0;
									}
								?>
                        <div class="progress">
                            <div class="progress-bar" style="width: <?php echo $lateClockPercentage; ?>%"></div>
                        </div>
					  <span class="progress-description">
					  </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-green">
                    <span class="info-box-icon"><i class="fa fa-circle-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Early Clock Out</span>
                        <span class="info-box-number"><?php echo (isset($usersdetails['early_checkout_users'])) ? $usersdetails['early_checkout_users'] :'0'; ?></span>
								<?php 
									if(isset($total_Users) && isset($usersdetails['early_checkout_users']) ) 
									{
										$earlyOutPercentage = round((($usersdetails['early_checkout_users']/$total_Users)*100));
									}
									else 
									{
										$earlyOutPercentage = 0;
									}
								?>
                        <div class="progress">
                            <div class="progress-bar" style="width: <?php echo $earlyOutPercentage; ?>%"></div>
                        </div>
                  <span class="progress-description">
                  </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

        </div>
        <!-- /.row -->    
        

        <!--========================================================================================================-->

        <!-- ANNOUNCEMENTS-->
        <div class="row">
            <div class="col-md-4">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Announcement</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <p>
                            <a href="<?php echo base_url();?>ccannouncements/announcements">
                                <button class="btn btn-block btn-danger btn-lg" type="button"><span class="pull-left">Create Announcements</span> <span
                                        class="fa fa-plus-circle pull-right"></span></button>
                            </a>
                        </p>

                        <p>Recent Posts</p>

                        <ul class="products-list product-list-in-box">
                        <?php
                           $i=0;
                           $labelArray= array('label-warning','label-info','label-danger','label-success');
                       		foreach($listAnnouncements as $announcement)
                       		{
                        ?>
                            <li class="item">
                                <div class="product-img">
                                    <img src="<?php echo base_url();?>assets/cc/theme/img/default-50x50.gif" alt="Recent Post">
                                </div>
                                <div class="product-info">
                                    <a href="javascript:void(0)" class="product-title latestAnnouncementClass" 
                                        data-title="<?php echo $announcement->title;?>" data-description="<?php echo $announcement->msg;?>" data-postedDate="<?php echo date('j F Y h:i a', strtotime($announcement->date)); ?>"
                                        data-toggle="modal" >
                                        <?php echo $announcement->title; ?>
                                        <span class="label <?php echo $labelArray[$i]; ?> pull-right">new</span>
                                    </a>
				                        <span class="product-description">
				                          <?php echo date("j F Y h:i a", strtotime($announcement->date)); ?>
				                        </span>
                                </div>
                            </li>

                        <?php
                             $i++;
                             }
                        ?>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-center">
                        <a href="<?php echo base_url();?>ccannouncements/announcements" class="uppercase">View All</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->

            </div>
            <!-- /.col-md-4 -->

            <!--=======================================================================================================-->
            <div class="col-md-4">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Company Profile</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- Widget: user widget style 1 -->
                        <div class="box box-widget widget-user-2">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-gray-light">
                                <div class="widget-user-image">
                                		<?php if($company_details->company_logo!='') {?>
                     						<img class="img-circle" src="<?php echo base_url();?>images/company/<?php echo  $company_details->company_logo; ?>">
                     					<?php }else{ ?>
                     						<img class="img-circle" src="<?php echo base_url();?>assets/cc/images/voffice128x128.png" alt="User Avatar">
                     					<?php }?>
                                </div>
                                <!-- /.widget-user-image -->
                                <h4 class="widget-user-username"><?php echo $company_details->company_name;?></h4>
                                <h5 class="widget-user-desc"><?php echo $company_details->company_address;?> </h5>
                            </div>
                            <div class="box-footer no-padding">
                                <ul class="nav nav-stacked">
                                    <li><a href="#">Contact Person : <?php echo $company_details->contact_person;?></a></li>
                                    <li><a href="#">Phone Number : <?php echo $company_details->contact_number;?></a></li>
                                    <li><a href="#">Email : <?php echo $company_details->contact_email;?></a>
                                    </li>
                                    <li>
                                    	 <a href="<?php echo base_url();?>ccadministration/administration/contactsupport">
                                    	 	<button type="button" class="btn btn-block btn-default">Contact Support</button>
                                    	 </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.widget-user -->

                    </div>
                    <!-- /.box-body -->

                </div>

            </div>
            <!-- /.col-md-4 -->

            <!--=======================================================================================================-->
            <div class="col-md-4">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Account Management</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <p>
                            <a href="<?php echo base_url();?>ccshifts/shifts">
                                <button class="btn btn-block btn-success btn-lg" type="button"><span class="pull-left">Add New Department</span> <span
                                        class="fa fa-plus-circle pull-right"></span></button>
                            </a>
                        </p>
                        <p>
                            <a href="<?php echo base_url();?>ccshifts/shifts/shifts">
                                <button class="btn btn-block btn-success btn-lg" type="button"><span class="pull-left">Add New Shift</span> <span
                                        class="fa fa-plus-circle pull-right"></span></button>
                            </a>
                        </p>
                        <p>
                            <a href="<?php echo base_url();?>ccshifts/shifts/users">
                                <button class="btn btn-block btn-success btn-lg" type="button"><span class="pull-left">Add New User</span> <span
                                        class="fa fa-plus-circle pull-right"></span></button>
                            </a>
                        </p>
                        <p>
                            <a href="<?php echo base_url();?>ccshifts/shifts/whitelistips">
                                <button class="btn btn-block btn-success btn-lg" type="button"><span class="pull-left">Add White List IPs</span> <span
                                        class="fa fa-plus-circle pull-right"></span></button>
                            </a>
                        </p>
                    </div>
                    <!-- /.box-body -->

                </div>

            </div>
            <!-- /.col-md-4 -->

        </div>
        <!-- /.row -->


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!--kevin@mynotepedia.com-->
<!--kevinmaulana1991@gmail.com-->

<!-- footer here -->


<!--=======================================Latest Announcement Details popup========================================-->
<div class="modal fade" id="latestAnnouncementInfo" tabindex="-1" role="dialog"
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
                <h4 class="modal-title" id="latestAnnouncementTitle">
                    
                </h4>
                <p id="latestAnnouncementPostedDate"></p>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">

                <p id="latestAnnouncementMsg"></p>

            </div>

        </div>
    </div>
</div>
<!--=======================================End Of Modal Form========================================-->
