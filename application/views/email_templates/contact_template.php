<html>
<head>
<title></title>
</head>

<body style="background:#f7f7f7;padding: 20px 0;"> <!--background-image:url(images/blur-bg.jpg); background-color:#E4C9C3;
-->

<div style="width: 605px; margin: auto; background:#E8E8E8; padding:0.1px 0px;border:10px dotted #fff;margin-top:20px;margin-bottom:20px;"><!--#ED4861--><!--/.main-->

	<div style="border:3px solid  #DADADA;margin:20px;">
        <div style="border:3px solid #f7f7f7;margin:5px;">
    
    <div style="width:150px; margin:auto; padding: 10px 0;margin-top:15px;">
        <img src="<?php echo base_url();?>images/logo.png" style="" alt="clock-in.me">
    </div>
    
    
    <div style="">
        <p style="margin: 10px;padding: 20px 15px;font-family:Arial,sans-serif;font-size: 17px;
              line-height: 25px;"><b style="font-size:18px;color:#484043;">Hi,</b> <br>
        		<span style="margin-top:5px;display: block;color: #D33A27;">The Following is a Support Request From <?php echo (isset($user))?$user:'';?>.</span></p>
    </div>
    
    
    
    
        <div style="background:#E8E8E8;padding:15px;text-align:center;padding-top: 5px;">
        
        	<!--<h3 style="margin: 10px 5px;color:#C4161C;font-family:Arial,sans-serif;font-size: 23px;line-height: 25px; font-weight:100;padding-bottom: 15px;">Your new Password is as shown below</h3>-->
        			
          <div style="font-family: Arial,sans-serif;font-size: 15px;line-height: 25px;position:relative;">
          
          	<h4 style="margin: 0;color:#fff;background:#ce2e2d; padding:15px;  font-family:Arial,sans-serif;font-size: 18px; font-weight:100; text-align:left;">Message</h4>
          	
            	<p style="margin:0px;padding:20px 18px; color:#FFFFFF; font-family:Arial,sans-serif; font-size:15px; text-align:left; background: #484043; line-height: 25px; letter-spacing: 0.1px;">
            		<?php echo (isset($message))?$message:'';?>
            	</p>
          

          </div>
          
        </div>
        
        
	   
        
        
        
        
        
        
        <div style="background:#ce2e2d;padding: 20px 15px;margin-top:10px!important;text-align: center;font-family:Arial,sans-serif;margin:15px;">	
            
            <h2 style="color: #f7f7f7;border-bottom: 1px dashed;padding-bottom: 20px;margin-top: 10px;font-size: 24px;">clock-in.me Contact Center</h2>
                <p style="color:#E8E8E8;font-family:Arial,sans-serif;font-size: 16px;margin-top:9px;line-height: 25px;margin-bottom:3px;"> Phone: <img src="<?php echo base_url();?>images/call-1.png" style="height:15px;" alt="clock-in.me"> <?php echo (isset($phone))?$phone:'';?> (Mon - Fri: 8.30am to 7.30pm)<br>
			Email: <img src="<?php echo base_url();?>images/email.png" style="height:15px;margin-bottom:-3px;" alt="clock-in.me">  <a style="color:#FFFFFF;" href="mailto:cs@clock-in.me"> cs@clock-in.me</a>  </p>
           
            
      </div>
        
    </div>
    </div>

</div><!--/.main-->



</body>
</html>