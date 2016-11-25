<!--===================ALL CSS==================-->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Clock-in | User</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/snap/images/favicon.png">
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url();?>assets/snap/images/apple-icon-57x57.png"/>
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url();?>assets/snap/images/apple-icon-72x72.png"/>
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url();?>assets/snap/images/apple-icon-114x114.png"/>
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url();?>assets/snap/images/apple-icon-144x144.png"/>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/snap/theme/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo base_url();?>assets/snap/theme/css/mynotepedia.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>assets/snap/theme/css/custom.css" rel="stylesheet">

    <!--Menu-->
    <link href="<?php echo base_url();?>assets/snap/plugins/menu/menu.css" rel="stylesheet">

    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/snap/plugins/datatables/dataTables.bootstrap.css">

    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/snap/plugins/datepicker/datepicker3.css">

    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/snap/plugins/timepicker/bootstrap-timepicker.min.css">

    <!--Font Awesome-->
    <link href="<?php echo base_url();?>assets/snap/plugins/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body style="background-color: #e6e6e6">


<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Sidebar Left Column -->
        <div class="col-md-4">
				
            <?php
            
             $this->load->view('includes_selfie/menu-user'); 
             
            ?>

            <!-- Announcements -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Announcement</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">


                    <p>Recent Posts</p>

                    <ul class="products-list product-list-in-box">
                        <li class="item">
                            <div class="product-img">
                                <img src="<?php echo base_url();?>assets/snap/theme/img/default-50x50.gif" alt="Recent Post">
                            </div>
                            <div class="product-info">
                                <a href="#" class="product-title" data-toggle="modal" data-target="#myModalHorizontal">VIP
                                    Test Announcement
                                    <span class="label label-warning pull-right">new</span></a>
                        <span class="product-description">
                          14 Jan 2015 4:38 PM
                        </span>
                            </div>
                        </li>
                        <!-- /.item -->
                        <li class="item">
                            <div class="product-img">
                                <img src="<?php echo base_url();?>assets/snap/theme/img/default-50x50.gif" alt="Product Image">
                            </div>
                            <div class="product-info">
                                <a href="#" class="product-title" data-toggle="modal" data-target="#myModalHorizontal">VIP Test Announcement
                                    <span class="label label-info pull-right">new</span></a>
                        <span class="product-description">
                          14 Jan 2015 4:38 PM
                        </span>
                            </div>
                        </li>
                        <!-- /.item -->
                        <li class="item">
                            <div class="product-img">
                                <img src="<?php echo base_url();?>assets/snap/theme/img/default-50x50.gif" alt="Product Image">
                            </div>
                            <div class="product-info">
                                <a href="#" class="product-title" data-toggle="modal" data-target="#myModalHorizontal">VIP Test Announcement <span
                                        class="label label-danger pull-right">new</span></a>
                        <span class="product-description">
                          14 Jan 2015 4:38 PM
                        </span>
                            </div>
                        </li>
                        <!-- /.item -->
                        <li class="item">
                            <div class="product-img">
                                <img src="<?php echo base_url();?>assets/snap/theme/img/default-50x50.gif" alt="Product Image">
                            </div>
                            <div class="product-info">
                                <a href="#" class="product-title" data-toggle="modal" data-target="#myModalHorizontal">VIP Test Announcement
                                    <span class="label label-success pull-right">new</span></a>
                        <span class="product-description">
                          14 Jan 2015 4:38 PM
                        </span>
                            </div>
                        </li>
                        <!-- /.item -->
                    </ul>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="#" class="uppercase">View All</a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->

        </div>
        <!-- /.col-md-4 -->


        <!--=======================================Modal Form========================================-->
        <div class="modal fade" id="myModalHorizontal" tabindex="-1" role="dialog"
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
                        <h4 class="modal-title" id="myModalLabel">
                            VPI Test Announcement
                        </h4>
                        <p>11 October 2016 9.00 AM</p>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">

                        <p>Some text in the modal.</p>

                    </div>

                </div>
            </div>
        </div>
        <!--=======================================End Of Modal Form========================================-->


        <!--  ================================Content Column========================================== -->
        <div class="col-md-8">