<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/cc/images/favicon.png">
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url();?>assets/cc/images/apple-icon-57x57.png"/>
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url();?>assets/cc/images/apple-icon-72x72.png"/>
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url();?>assets/cc/images/apple-icon-114x114.png"/>
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url();?>assets/cc/images/apple-icon-144x144.png"/>

    <title><?php echo site_name();?> | Login</title>

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/cc/plugins/login/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/cc/plugins/login/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/cc/plugins/login/css/form-elements.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/cc/plugins/login/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/cc/plugins/login/css/custom.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <script type="text/javascript">
      var base_url = '<?php echo base_url();?>';
      var csrf_token = '<?php echo $this->security->get_csrf_hash()?>';
    </script>
    <style type="text/css">
      .white{ color: #FFFFFF; }
    </style>

</head>


<body>
<div class="inner-bg">
    <div class="container">

        <div class="row">
            <div class="col-sm-6 logo">
                <img class="log" src="<?php echo base_url();?>assets/cc/images/Clock-In-Logo-01.png" alt="">
                <p>
                <h3 class="size"><strong>Attendance & Payroll on the Cloud</strong></h3></p>
            </div>
            <div class="col-sm-5 form-box">
                <div class="form-top">
                    <div class="form-top-left">
                        <h3>Forgot Password Form</h3>
                    </div>
                    <div class="form-top-right">
                        <i class="fa fa-lock"></i>
                    </div>
                </div>
                <div class="form-bottom">
                    <form role="form" id="forgotPassResForm" name="forgotPassResForm" action="<?php echo base_url();?>home/forgotpassword" method="post" class="login-form">
                    		<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
                        <div class="form-group">
                            <input type="text" id="companyName" name="companyName" placeholder="<?php echo $this->lang->line('companyName');?>" class="form-control" autofocus required>
                            <label class="white"><?php echo form_error('companyName'); ?></label>
                        </div>
                        <div class="form-group">
                            <input type="text" id="email" name="email" placeholder="<?php echo $this->lang->line('email');?>" class="form-control" required>
                            <label class="white"><?php echo form_error('email'); ?></label>
                        </div>
                        <button type="submit" class="btn btn-lg">Reset Password</button>

                        <p></p>

                        <div class="form-group">

                            <a href="<?php echo base_url();?>home/login" class="pull-right remember">Go to Login Page </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<footer class="foot">
    <p><span class="bawah">TROUBLE LOGING IN ?</span> Please contact your HR or Payroll Manager first. For support
        escalation, you can email
        <a class="email" href="mailto:support@clock-in.me">support@clock-in.me</a></p>
    <p>Realtime attendance tracking by <span class="bawah"><?php echo site_name();?></span> | Powered by
        <span class="bawah">Google Cloud</span> and <span class="bawah">Webhosting.net.ph</span> | Proudly made in
        Melbourne, Australia |
        © <?php echo copyright_year();?> <?php echo site_name();?> or its affiliates. All rights reserved</p>
</footer>


<!-- Javascript -->
<script src="<?php echo base_url();?>assets/cc/plugins/login/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url();?>assets/cc/plugins/login/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/cc/plugins/login/js/jquery.backstretch.min.js"></script>
<script  src="<?php echo base_url();?>assets/common/jquery.validate.min.js"  ></script> 
<script src="<?php echo base_url();?>assets/cc/plugins/login/js/scripts.js"></script>

<script type="text/javascript">

$(document).ready(function(){

	//Custom rule; letters only
	$.validator.addMethod("lettersonly", function(value, element) {
	return this.optional(element) || /^[a-z\s]+$/i.test(value);
	}, "Please enter only letters"); 


	//Form Validations for Monitor Attendance Form
	//By Dominic; Dec 12,2016 
	$('#forgotPassResForm').validate(
	 {
	  rules: {
	     companyName: 
	     {
		     required: true,
		  },
	     email:
	     {
	     	 required: true,
	     	 email :true
	     }
	   },                 
		highlight: function(element) {
			  $(element).closest('.control-group').removeClass('success').addClass('white');
		 },
		 success: function(element) {
		  element
		 .closest('.control-group').removeClass('white').addClass('success');
		}
	});
		
});


</script>

</body>

</html>