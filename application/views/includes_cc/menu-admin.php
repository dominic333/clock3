<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li>
                <a href="<?php echo base_url();?>ccdashboard/dashboard">
                    <i class="fa fa-home"></i> <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a href="<?php echo base_url();?>ccattendance/attendance">
                    <i class="fa fa-calendar"></i> <span>My Attendance</span>
                </a>
            </li>

            <li>
                <a href="<?php echo base_url();?>ccattendance/attendance/whosaroundtoday">
                    <i class="fa fa-users"></i> <span>Who's Around Today</span>
                </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-lock"></i> <span>Administrative</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url();?>ccadministration/administration"><i class="fa fa-angle-double-right"></i> View / Edit Company</a></li>
                    <li><a href="<?php echo base_url();?>ccadministration/administration/contactsupport"><i class="fa fa-angle-double-right"></i> Contact Support</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cogs"></i> <span>Setup Attendance</span>
                    <span class="pull-right-container">
                         <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url();?>ccshifts/shifts"><i class="fa fa-angle-double-right"></i> Add / Edit Department</a></li>
                    <li><a href="<?php echo base_url();?>ccshifts/shifts/shifts"><i class="fa fa-angle-double-right"></i> Add / Edit Shift</a></li>
                    <li><a href="<?php echo base_url();?>ccshifts/shifts/users"><i class="fa fa-angle-double-right"></i> Add / Edit User</a></li>
                    <li><a href="<?php echo base_url();?>ccshifts/shifts/whitelistips"><i class="fa fa-angle-double-right"></i> Add White List IPs</a></li>
                </ul>
            </li>

            <li>
                <a href="<?php echo base_url();?>ccshifts/shifts/assignmonitor">
                    <i class="fa fa-file-text-o"></i> <span>Assignment</span>
                </a>
            </li>


            <li>
                <a href="<?php echo base_url();?>ccannouncements/announcements">
                    <i class="fa fa-bullhorn"></i> <span>Announcements</span>
                </a>
            </li>

            <li class="treeview">
                <a href="<?php echo base_url();?>ccreports/reports">
                    <i class="fa fa-leanpub"></i> <span>Reports</span>
                </a>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>