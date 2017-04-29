<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php echo site_name();?> | Admin</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/cc/images/favicon.png">
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url();?>assets/cc/images/apple-icon-57x57.png"/>
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url();?>assets/cc/images/apple-icon-72x72.png"/>
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url();?>assets/cc/images/apple-icon-114x114.png"/>
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url();?>assets/cc/images/apple-icon-144x144.png"/>

    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/cc/plugins/bootstrap/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/cc/plugins/font-awesome-4.3.0/css/font-awesome.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/cc/plugins/ionicons-2.0.1/css/ionicons.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/cc/theme/css/mynotepedia.min.css">
    <!-- Mynotepedia Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/cc/theme/css/skins/_all-skins.min.css">
    
<!--    <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">-->

    <link rel="stylesheet" href="<?php echo base_url();?>assets/cc/plugins/datepicker/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/cc/plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/cc/plugins/daterangepicker/daterangepicker.css">


    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/cc/plugins/timepicker/bootstrap-timepicker.min.css">

    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/cc/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/cc/plugins/datatables/dataTables.bootstrap.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/cc/plugins/select2/select2.min.css">

    <link href="<?php echo base_url();?>assets/commoncss/jquery-confirm.css" rel="stylesheet"/>

    <!-- Full Calendar -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/commoncss/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/commoncss/fullcalendar.print.css" media="print">

    <!-- Loader -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/commoncss/loader/loader.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
     <script type="text/javascript">
      var base_url = '<?php echo base_url();?>';
      var csrf_token = '<?php echo $this->security->get_csrf_hash()?>';
    </script>
    <div id="loader" style="display:none;"></div>
    
    <!--Loader-->
    <script>
        function showLoader()
        {
            document.getElementById("loader").style.display = "block";
            document.getElementById("myDiv").style.display = "none";  
        }
        function hideLoader()
        {
            document.getElementById("loader").style.display = "none";
            document.getElementById("myDiv").style.display = "block";
        }
    </script>
    <style type="text/css">
		#listalist 
		{
			margin: 0px;
			padding: 0px;
		}
		#listalist li
		{
			list-style: none;
		}
		
		#listalist2 
		{
			margin: 0px;
			padding: 0px;
		}
		#listalist2 li
		{
			list-style: none;
		}
		
		.pagination li 
		{
		  display: inline-block;
		  padding: 5px;
		}
	 </style>
</head>

<body class="hold-transition skin-grey-light sidebar-mini fixed">

<div class="wrapper">

    <!--  HEADER  -->
    <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url();?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <img src="<?php echo base_url();?>assets/cc/images/ck.png" width="50" class="logo-mini">
            <!-- logo for regular state and mobile devices -->
            <img src="<?php echo base_url();?>assets/cc/images/Clock-In-Logo-01.png" width="135">

        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <!-- Notifications: -->
                    <?php
	                     $countNotif= count($mynotifications);
	                 ?>
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span id="countNotification1" class="label label-warning"><?php if($countNotif > 0){ echo $countNotif;} ?></span>
                        </a>
                        <ul class="dropdown-menu">
	                         
                            <li id="countNotification2" class="header">You have <?php echo $countNotif; ?> notifications</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
			                           <?php
				                           $i=0;
				                           $labelArray= array('fa-users text-aqua','fa-warning text-yellow','fa-users text-red','fa-shopping-cart text-green','fa-user text-red','fa-user text-primary','fa-user text-primary');
				                       		foreach($mynotifications as $row)
				                       		{
				                       			$nUser= $row->actionBy;
				                       			if($row->nType==1) //clockin
				                       			{
				                       				$url= base_url().'ccattendance/attendance/staffattendance/'.$nUser;
				                       			}
				                       			else if($row->nType==6) //absent
				                       			{
				                       				$url= base_url().'ccattendance/attendance/leaveManagement';
				                       			}
				                       			else
				                       			{
				                       				$url ='#';
				                       			}
				                        ?>
                                    <li id="<?php echo 'row'.$row->id; ?>" class="activeNotifications">
                                        <a href="<?php echo $url; ?>" data-notification="<?php echo $row->id; ?>" class="" >
                                            <i class="fa <?php if($row->nType==1){ echo $labelArray[0]; }
                                            							else if($row->nType==2){ echo $labelArray[1]; } 
                                            							else if($row->nType==3){ echo $labelArray[2]; } 
                                            							else if($row->nType==4){ echo $labelArray[3]; } 
                                            							else if($row->nType==5){ echo $labelArray[4]; }
                                            							else if($row->nType==6){ echo $labelArray[6]; }
                                            					?>
                                            	 ">

                                            </i><span style="float: right; margin-top: -17px;" class="fa fa-eye"></span>
                                            <?php echo $row->nMsg; ?>
                                        </a>
                                    </li>

                                    <?php } ?>
                                </ul>
                            </li>
                            <li class="footer"><a id="clearAllNotificationsLink" >Clear all</a></li>
                        </ul>
                    </li>

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?php $mypic	= $this->site_settings->fetchMyPic();
                           // echo $mypic;
                             $url = base_url().'images/avatars/'.$mypic;	
                                 if($mypic != "")
                                 {
                                 	
                                    $url1=getimagesize($url);
												if(!is_array($url1))
												{
													$url = base_url().'images/avatars/admin-user.png';	
												} 
												
                            	  	
                            ?>
                                <img src="<?php echo $url?>"class="user-image" alt="User Image">
											<?php 
											} 
											else{
											?>
<!--                             			   <img src="<?php echo base_url();?>assets/snap/images/admin-user.png" class="user-image" alt="User Image">		-->
                             			   									
											<?php	} ?>
                            <span class="hidden-xs"><?php echo $this->session->userdata('staffname'); ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->

                            <li class="user-header">
                                <?php $mypic	= $this->site_settings->fetchMyPic(); 
                                		  $url = base_url().'images/avatars/'.$mypic;	
                                 if($mypic != "")
                                 {
                                 	
                                    $url1=getimagesize($url);
												if(!is_array($url1))
												{
													$url = base_url().'images/avatars/admin-user.png';	
												} 
												
												
												//$mypic='avatar.png';
                            	  	
                                 ?>
                                <img src="<?php echo $url?>"class="user-image" alt="User Image">
											<?php } else{?>
<!--                                <img src="<?php echo base_url();?>assets/snap/images/admin-user.png" class="user-image" alt="User Image">											-->
										<?php	} ?>
                                <p>
                                    <?php echo $this->session->userdata('staffname'); ?>
                                </p>
                            </li>
                            <!-- Menu Body -->

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="<?php echo base_url();?>selfiemyaccount/account" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?php echo base_url();?>home/logout" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>
    </header>
    <!--  ./HEADER  -->

    <?php $this->load->view('includes_cc/menu-admin'); ?>

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>assets/cc/plugins/jQuery/jquery-2.2.3.min.js"></script>

<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url();?>assets/cc/plugins/jQuery/jquery-ui.min.js"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
   $.widget.bridge('uibutton', $.ui.button);
</script>

<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url();?>assets/cc/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- Select2 for combo box -->
<script src="<?php echo base_url();?>assets/cc/plugins/select2/select2.full.min.js"></script>

<!-- Sparkline -->
<script src="<?php echo base_url();?>assets/cc/plugins/sparkline/jquery.sparkline.min.js"></script>

<!-- daterangepicker -->
<script src="<?php echo base_url();?>assets/cc/plugins/daterangepicker/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/cc/plugins/daterangepicker/daterangepicker.js"></script>

<!-- datepicker -->
<script src="<?php echo base_url();?>assets/cc/plugins/datepicker/bootstrap-datepicker.js"></script>

<!-- bootstrap time picker -->
<script src="<?php echo base_url();?>assets/cc/plugins/timepicker/bootstrap-timepicker.min.js"></script>

<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url();?>assets/cc/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<!-- Slimscroll -->
<script src="<?php echo base_url();?>assets/cc/plugins/slimScroll/jquery.slimscroll.min.js"></script>

<!-- FastClick -->
<script src="<?php echo base_url();?>assets/cc/plugins/fastclick/fastclick.js"></script>

<!-- DataTables -->
<script src="<?php echo base_url();?>assets/cc/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/cc/plugins/datatables/dataTables.bootstrap.min.js"></script>

<!-- Mynotepedia App -->
<script src="<?php echo base_url();?>assets/cc/theme/js/app.min.js"></script>

<!--kevin@mynotepedia.com-->
<!--kevinmaulana1991@gmail.com-->


<div style="display:block;" id="myDiv" class="animate-bottom">