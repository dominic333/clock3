<html>
<head>
<title></title>
    <style>
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body style="background:#f7f7f7;">

 <div style="width: 605px; margin: 0 auto; padding:10px;"><!--/.main-->
        <div style="padding:0 12px;">
    	  <div style="width:240px; margin:auto;"><img src="http://clock-in.me/webapp/images/logo_login2.png" style="width:100%;" alt="vRush"></div>
        <div style="clear:both;"></div>
        </div>
    <!--/.header-->

        <div>
    	     <p style="background:#C4171F;padding: 20px 15px;font-family:Arial,sans-serif;color:#fff;font-size: 30px;text-align: center;
   			 margin: 10px;margin-bottom:0;"><?php echo (isset($company_name))?$company_name:'';?></p>
        </div>

        <div style="margin:0 10px;;font-family: Arial,sans-serif;border: 1px solid #C8C5C4;line-height: 23px;">
             <h2 style="padding: 10px;color: #2E4483;margin-bottom:0;font-size: 21px;line-height: 35px;text-align: center;">
              <?php echo (isset($name))?$name:'';?>
             </h2>
             <div style="padding: 10px;color: #2E4483;margin-bottom:0;font-size: 15px;line-height: 35px;text-align: center;">
                  Department: <?php echo (isset($department_name))?$department_name:'';?> <br>
                  Shift: <?php echo (isset($shift_name))?$shift_name:'';?> <br>
                  Clockin@: <?php echo (isset($clockintime))?$clockintime:'';?>
             </div>
				<div style="padding: 10px;color: #2E4483;margin-bottom:0;font-size: 15px;line-height: 35px;text-align: center;">
					<img id="my_selfie" src="<?php echo (isset($clockinpic))?$clockinpic:'';?>" alt="my_selfie">
				</div>

        </div>

   		<div style="margin:0 10px;;font-family: Arial,sans-serif;border: 1px solid #C8C5C4;line-height: 23px;  border-top: 1px solid #f7f7f7;">
    		<h2 style="padding: 10px;color: #2E4483;margin-bottom:0;font-size: 23px;text-align: center;">Clock-in.me Customer Care Center</h2>
    		<p style="color: #585753;padding: 10px; margin-top:0;font-size:15px;text-align: center;">
      		Do contact us at <a style="color:#0069a6;" href="mailto:ask@clock-in.me">ask@clock-in.me</a> if you require any assistance.<br>
      		<span style="color: #C4171F;font-weight: 600;">Clock-in.me Support Team :). </span>
    		</p>
  	   </div>

</div>
<!--/.main-->
</body>
</html>
