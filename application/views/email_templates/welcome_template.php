<html>
<head>
<title></title>
</head>
<body style="background:#f7f7f7;">
<div style="width: 605px; margin: 0 auto; padding:20px;"><!--/.main-->
  <div style="padding:0 12px;">
    <div style="width:240px; margin:auto;"><img src="<?php echo $baseurl;?>assets/cc/images/logo.png" style="width:100%;" alt="clock-in.me"></div>
    <div style="margin-top:-15px;">
      <p style="text-align:center; color:#585753; font-size: 20px;font-family: cursive;">
      	Hello <?php echo (isset($name))?$name:'';?> !
      	<br><span style="color:#109653;">Welcome to Clock-in.me!</span>
      </p>
    </div>
    <div style="clear:both;"></div>
  </div>
  
  
  <!--/.header-->
  
  <div>
    <p style="background:#C4171F;padding: 20px 15px;font-family:Arial,sans-serif;color:#fff;font-size: 20px;text-align: center;
    margin: 10px;margin-bottom:0;">Your new account for Cloud Attendance is now created.</p>
  </div>
  <div style="margin:0 10px;;font-family: Arial,sans-serif;border: 1px solid #C8C5C4;line-height: 23px;">
    <h2 style="padding: 10px;color: #2E4483;margin-bottom:0;font-size: 21px;">Below is the login information to log your attendance</h2>
    <p style="color: #585753;padding: 10px; margin-top:0;font-size:15px;border-bottom: 1px solid #EEEEEE;">
      Go to <a style="color:#0069a6;" href="https://clock-in.me/selfies/">https://clock-in.me/selfies/</a> <br>
      Login Company Name : <?php echo (isset($company_login))?$company_login:'';?> <br>
      Login Username : <?php echo (isset($login))?$login:'';?> <br>
      Login Password: <?php echo (isset($password))?$password:'';?><br> 
      <span style="color:#009933;font-size:13px;display:block; margin-top:10px; margin-bottom:10px;">
          ** Please allow app to make use of camera when prompted.<br>
          ** Please select the correct Attendance Option (i.e Clock in or Clock Out). <br>
          ** SMILE :) and Click Log Your Attendance! <br>
      </span>
		<span style="font-size:19px;color:#A50E13;display:block;margin-bottom:10px;">Go to <a style="color:#0069a6;font-size:15px;" href="https://clock-in.me/webapp">https://clock-in.me/webapp</a> </span>
       </p>
       
       
       
       
       
       <div style="font-family: Arial,sans-serif;line-height: 23px;">
       
       <h2 style="padding: 10px;color: #2E4483;margin:0;font-size: 21px;">Login using the same credential above to</h2>
       
    <p style="color: #585753;padding: 10px; margin-top:0;font-size:15px;padding-top: 15px;"> 
    	- View your attendance for the week. <br>
		- Add Explanation notes on any discrepancies for your attendance.  <br>
		- Update your personal profile.<br>
		- View Who is Around Today in your department.   <br>
		- and much more!<br>
    </p>
  </div>
       
       
       
  </div>
  

  
  <div style="margin:0 10px;;font-family: Arial,sans-serif;border: 1px solid #C8C5C4;line-height: 23px;  border-top: 1px solid #f7f7f7;">
    <h2 style="padding: 10px;color: #2E4483;margin-bottom:0;font-size: 23px;">Clock-in.me Customer Care Center</h2>
    <p style="color: #585753;padding: 10px; margin-top:0;font-size:15px;"> 
      Do contact us at <a style="color:#0069a6;" href="mailto:ask@clock-in.me">ask@clock-in.me</a> if you require any assistance.<br>
      <span style="color: #C4171F;font-weight: 600;">Clock-in.me Support Team :). </span>
    </p>
  </div>
  
</div>
<!--/.main-->
</body>
</html>
