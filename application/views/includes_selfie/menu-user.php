<!--Menu User-->

<div class="well">
    <!--<h4>Clock-In Logo</h4>-->
    <div class="nav-side-menu">
        <div class="brand"><img src="<?php echo base_url();?>assets/snap/images/clockin-logo.png" width="135"></div>
        <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

        <div class="menu-list">

            <ul id="menu-content" class="menu-content collapse out">
                <li>
                    <a href="<?php echo base_url();?>selfiedashboard/dashboard">
                        <i class="fa fa-home fa-lg"></i> Dashboard
                    </a>
                </li>
               <?php $isadmin=$this->session->userdata('isadmin'); if($isadmin==1) { ?>
					<li>
	                <a href="<?php echo base_url();?>ccdashboard/dashboard">
	                    <i class="fa fa-home"></i> <span>Go to Admin Dashboard</span>
	                </a>
	            </li>
					<?php } ?>
                <li data-toggle="collapse" data-target="#products" class="collapsed">
                    <a href="#"><i class="fa fa-user fa-lg"></i> Account <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="products">
                    <li><a href="<?php echo base_url();?>selfiemyaccount/account">View Profile</a></li>
                    <!--
                    <li><a href="<?php echo base_url();?>selfieattendance/attendance">My Attendance</a></li>
                    -->
                    <li><a href="<?php echo base_url();?>selfieattendance/attendance/whosaroundtoday">Who's Around Today</a></li>
                </ul>
                <?php $calendarView= $this->authentication->checkCalendarViewAccess(); if($calendarView==1){ ?>
                <li>
                    <a href="<?php echo base_url();?>selfieattendance/attendance/monthiview">
                        <i class="fa fa-picture-o fa-lg"></i> Monthly Attendance
                    </a>
                </li>
					 <?php } ?>
                <li>
                    <a href="<?php echo base_url();?>selfiemarking/selfie">
                        <i class="fa fa-picture-o fa-lg"></i> Selfie Attendance
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url();?>home/logout">
                        <i class="fa fa-power-off fa-lg"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>

</div>