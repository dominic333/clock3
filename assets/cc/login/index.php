<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" href="../images/favicon.png">
    <link rel="apple-touch-icon" sizes="57x57" href="../images/apple-icon-57x57.png"/>
    <link rel="apple-touch-icon" sizes="72x72" href="../images/apple-icon-72x72.png"/>
    <link rel="apple-touch-icon" sizes="114x114" href="../images/apple-icon-114x114.png"/>
    <link rel="apple-touch-icon" sizes="144x144" href="../images/apple-icon-144x144.png"/>

    <title>Login</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../plugins/login/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/login/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../plugins/login/css/form-elements.css">
    <link rel="stylesheet" href="../plugins/login/css/style.css">
    <link rel="stylesheet" href="../plugins/login/css/custom.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>


<body>
<div class="inner-bg">
    <div class="container">

        <div class="row">
            <div class="col-sm-6 logo">
                <img class="log" src="../images/clockin-logo.png" alt="">
                <p>
                <h3 class="size"><strong>Attendance & Payroll on the Cloud</strong></h3></p>
            </div>
            <div class="col-sm-5 form-box">
                <div class="form-top">
                    <div class="form-top-left">
                        <h3>Login Form</h3>
                    </div>
                    <div class="form-top-right">
                        <i class="fa fa-lock"></i>
                    </div>
                </div>
                <div class="form-bottom">
                    <form role="form" action="../admin/" method="post" class="login-form">
                        <div class="form-group">
                            <input type="text" name="company-name" placeholder="Company Name..." class="form-control"
                                   autofocus required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Name..." class="form-control" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" placeholder="Password..." class="form-control"
                                   required>
                        </div>
                        <button type="submit" class="btn btn-lg">Login</button>

                        <p></p>

                        <div class="form-group">
                            <input id="remember" name="checkbox" type="checkbox">
                            <span class="remember">Remember Me</span>

                            <a href="#" class="pull-right remember">Forgot Password ? </a>
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
    <p>Realtime attendance tracking by <span class="bawah">Clock-in.me</span> | Powered by
        <span class="bawah">Google Cloud</span> and <span class="bawah">Webhosting.net.ph</span> | Proudly made in
        Melbourne, Australia |
        © 2016 Clock-in.me or its affiliates. All rights reserved</p>
</footer>


<!-- Javascript -->
<script src="../plugins/login/js/jquery-1.11.1.min.js"></script>
<script src="../plugins/login/bootstrap/js/bootstrap.min.js"></script>
<script src="../plugins/login/js/jquery.backstretch.min.js"></script>

<script src="../plugins/login/js/scripts.js"></script>

<!--[if lt IE 10]>
<script src="../plugins/login/js/placeholder.js"></script>
<![endif]-->

</body>

</html>