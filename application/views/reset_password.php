<?php
if (!isset($en_user_id))
$en_user_id='';
?>
<head>
<title><?php echo site_name();?> | Reset Password</title>
<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>css/admin.min.css" rel="stylesheet" type="text/css" />
<style>
.login-page{background: url(../images/site/login_bg.png); background-color:#F5F5F5;}
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
.m-b-0 { margin-bottom: 0!important; }
.b-b-0 { border-bottom: 0!important; }
#reset_password .form-control {
    height: auto!important;
    padding: 10px;
    background: #FAFFC2;
    border-radius: 4px;
    font-size: 15px;
}
#reset_password input[type="text"] {
    margin-bottom: -1px;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
}
#reset_password input[type="password"] {
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}
#reset_password input[type="submit"] {
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
.rp_form{   display: block !important; width: 100% !important;}
.bottom-logo img { width: 220px; }
.login-box.reserpw-lbox{
    margin-top:25px !important;
}
h3.forgt {
    font-size: 24px;
    margin-top: 0px;
    font-weight: 300;
}
.resetpw img {
    width:80px;
}
.resetpw-msg{
    text-align:center;
    padding-bottom:20px;
}
.resetpw-msg strong{
    text-align:center;
    font-weight:400;
}
</style>
</head>
<body class="hold-transition login-page">
	<div class="login-box reserpw-lbox">
        <div class="login-logo">
            <p class="login-box-msg login-box-message">
               <img src="<?php echo base_url();?>images/site/signIn.png" alt="" class="profile-img">
            </p>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
        	
            <p class="login-box-msg login-box-message resetpw">
               <img src="<?php echo base_url();?>images/site/resetpw.png" alt="" class="profile-img">
            </p>
            <h3 class="text-center forgt">
            <?php echo (isset($admin_page_title) ? $admin_page_title :''); ?>
            <small></small>
          </h3>
           <div class="resetpw-msg"><strong>Create a new, strong password</strong></div>
            <label class="col-md-12 error text-center text-uppercase">
                <?php	echo	(isset($alert)	?	$alert	:	''	);	?>       
            </label>
            <form action="<?php echo base_url().'home/reset_password/'.$en_user_id; ?>" method="post" name="reset_password" id="reset_password">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
                <div class="form-group has-feedback m-b-0">
                  <label for="password"><?php echo $this->lang->line('new_password'); ?> <span class="mandatory">*</span></label>
	              	<input type="password" name="password" class="form-control log_ctrl rp_form" placeholder="<?php echo $this->lang->line('password');?>" id="pass"  />
                        <label class="error"><?php echo form_error('password'); ?></label>
                </div>
                <div class="form-group has-feedback">
               	<label for="cnfm_password"><?php echo $this->lang->line('cnfm_password'); ?> <span class="mandatory">*</span></label>
	              	<input type="password" name="cnfm_password" class="form-control log_ctrl .rp_form" placeholder="<?php echo $this->lang->line('cnfm_password');?>" id="pass"  />
                        <label class="error"><?php echo form_error('cnfm_password'); ?></label>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <input class="btn btn-lg btn-primary btn-block log_but" type="submit" name="reset_password" id="reset_password_sub" value="<?php echo $this->lang->line('submit');?>">
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <span class="clearfix"></span>
            <div class="version_txt" align="center">Version 1.0</div>
           
        </div>
        <div class="bottom-logo"><img src="<?php echo base_url();?>images/site/bottom-logo.png" alt="bottom-logo"></div>
        <?php echo form_close(); ?>
        <!-- /.login-box-body -->
    </div>
    </body>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>  
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
     <script src="//code.jquery.com/jquery-2.1.4.js"></script>
   <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<!-- jQuery 2.0.2 -->


<!-- Bootstrap -->
<script src="<?php echo base_url();?>js/plugins/bootstrap.min.js" type="text/javascript"></script>