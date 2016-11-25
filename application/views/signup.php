<!DOCTYPE html>
<html class="log_bg">

<head>
    <meta charset="UTF-8">
    <title><?php echo site_name();?> | Login</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
   <!-- <link rel="shortcut icon" href="<?php echo base_url();?>images/site/favicon1.jpg">-->
    <link rel="shortcut icon" href="<?php echo base_url();?>images/site/favicon1.ico"> 
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500,100,900,300' rel='stylesheet' type='text/css'>
    <link href="http://code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>css/admin.min.css" rel="stylesheet" type="text/css" />
    <style>
        .login-page{background: url(<?php echo base_url();?>images/site/login_bg.png); }
        .text-white{color: #fff;}
        .text-uppercase{text-transform: uppercase;}
        .text-bold{font-weight: bold;}
        .login-box-message{font-size: 30px; font-weight: 400;}
        .forgot-password-text{font-size: 13px;display: inline-block; margin-top: 13px; color: #333;}
        .login-box-body,.register-box-body{background:#f5f5f5; padding-bottom:45px; box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3); border-top: 1px solid #e0e0e0;}
        label.error {color: #F00!important;font-size: 13px!important;}
        label.error:empty, span.error:empty { display: none!important; }
        .login-title {
            color: #C4183A;
            font-size: 24px;
            font-weight: 900;
            display: block;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .sub-tittle {
            font-size: 15px;
            text-align: center;
            margin-top: 17px;
            font-weight: 600;
        }
        .profile-img {
            width: 100%;
        }
        .m-b-1 { margin-bottom: 1px!important; }
        .b-b-0 { border-bottom: 0px!important; }
        #signup_form .form-control {
            height: auto!important;
            padding: 10px;
            background: #FAFFC2;
            border-radius: 4px;
            font-size: 15px;
        }
        #signup_form input[type="text"] {
            margin-bottom: -1px;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }
        #signup_form input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
        #signup_form input[type="submit"] {
                background: #C4183A !important;
                border-color: #C4183A !important;
                border-radius: 6px;
                font-size: 21px;
        }
        .version_txt {
            color: #999999;
            font-size: 11px;
            text-align: center;
            margin-top: 12px;
        }
        .bottom-logo {
            text-align: right;
            margin-right: -14px;
        }
        .bottom-logo img { width: 220px; }
    </style>
    <script>
        window.history.forward();
        var base_url = '<?php echo base_url();?>';
        /* code to prevent back button view to this page Starts*/
        function preventBack() {
            window.history.forward();
        }
        setTimeout("preventBack()", 0);
        window.onunload = function() {
            null
        };
        /* code to prevent back button view to this page Ends*/
        function max() {
            var obj = new ActiveXObject("Wscript.shell");
            obj.SendKeys("{f11}");
        }
    </script>
</head>
    
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <h1 class="text-center login-title">WELCOME TO <?php echo site_name(); ?></h1>
            <h5 class="sub-tittle">Bureau Veritas Brunei Inspection Portal Service</h5>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg login-box-message">
               <img src="<?php echo base_url();?>images/site/signIn.png" alt="" class="profile-img">
            </p>
            <label class="col-md-12 error text-center text-uppercase">
                <?php	echo	(isset($alert)	?	$alert	:	''	);	?>       
            </label>
            <form action="<?php echo base_url().'home/signup'; ?>" method="post" name="signup_form" id="signup_form">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
                <div class="form-group has-feedback m-b-1">
                			<label for="fname">
                				<?php echo $this->lang->line('signup_fname'); ?> 
                				</label>
                        <input type="text" name="fname" class="form-control log_ctrl" value="<?php echo set_value('fname'); ?>" placeholder="<?php echo $this->lang->line('signup_fname');?>" id="fname" />
                        <label class="error"><?php echo form_error('fname'); ?></label>
                </div>
                
                <div class="form-group has-feedback m-b-1">
                			<label for="lname">
                				<?php echo $this->lang->line('signup_lname'); ?> 
                				</label>
                        <input type="text" name="lname" class="form-control log_ctrl" value="<?php echo set_value('lname'); ?>" placeholder="<?php echo $this->lang->line('signup_lname');?>" id="lname" />
                        <label class="error"><?php echo form_error('lname'); ?></label>
                </div>
                
                <div class="form-group has-feedback m-b-1">
                			<label for="email">
                				<?php echo $this->lang->line('signup_email'); ?> 
                				</label>
                        <input type="text" name="signup_email" class="form-control log_ctrl" value="<?php echo set_value('signup_email'); ?>" placeholder="<?php echo $this->lang->line('email');?>" id="email" />
                        <label class="error"><?php echo form_error('signup_email'); ?></label>
                </div>
                <div class="form-group has-feedback">
                			<label for="password">
                				<?php echo $this->lang->line('signup_password'); ?> 
                				</label>
                        <input type="password" name="password" class="form-control log_ctrl" value="<?php echo set_value('password'); ?>" placeholder="<?php echo $this->lang->line('password');?>" id="pass"  />
                        <label class="error"><?php echo form_error('password'); ?></label>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <input class="btn btn-lg btn-primary btn-block log_but" type="submit" name="Login" id="login_sub" value="<?php echo $this->lang->line('sign_in');?>">
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <a href="" class="forgot-password-text" data-toggle="modal" data-target="#forgot_pass">Forgot my password</a>
            <span class="clearfix"></span>
            <div class="version_txt" align="center">Version 1.0</div>
           
        </div>
        <div class="bottom-logo"><img src="<?php echo base_url();?>images/site/bottom-logo.png" alt="bottom-logo"></div>
        <?php echo form_close(); ?>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>  
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
     <script src="//code.jquery.com/jquery-2.1.4.js"></script>
   <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<!-- jQuery 2.0.2 -->


<!-- Bootstrap -->
<script src="<?php echo base_url();?>js/plugins/bootstrap.min.js" type="text/javascript"></script>
<!-- iCheck -->
<script src="<?php echo base_url();?>js/plugins/icheck.min.js"></script>
<script src="<?php echo base_url();?>js/plugins/jquery.validate.min.js" type="text/javascript"></script>

<script src="<?php echo base_url();?>js/login.js"></script>

<script>
    $(function() {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>