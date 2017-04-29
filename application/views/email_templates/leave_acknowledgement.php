<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no;">
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE"/>
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="date=no">
    <meta name="format-detection" content="address=no">
    <meta name="format-detection" content="email=no">
    <title></title>

    <style>
        body {
            margin: 0;
            padding: 0;
            min-width: 100%;
            width: 100% !important;
            height: 100% !important;
            background-color: #EEEEEE;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        body, table, td, div, p, a {
            -webkit-font-smoothing: antialiased;
            text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
            line-height: 100%;
        }

        table, td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
            border-collapse: collapse !important;
            border-spacing: 0;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        #outlook a {
            padding: 0;
        }

        @media all and (min-width: 560px) {
            .container {
                border-radius: 8px;
                -webkit-border-radius: 8px;
                -moz-border-radius: 8px;
                -khtml-border-radius: 8px;
            }
        }

        a, a:hover {
            color: #127DB3;
        }

        .footer a, .footer a:hover {
            color: #999999;
        }

        .table-main {
            border-collapse: collapse;
            border-spacing: 0;
            padding: 0;
            width: inherit;
            max-width: 660px;
        }

        .label {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .label-default {
            background-color: #777;
        }

        .label-warning {
            background-color: #f0ad4e;
        }

        .label-success {
            background-color: #5cb85c;
        }

        .label-primary {
            background-color: #337ab7;
        }

        .label-danger {
            background-color: #d9534f;
        }

        /*.label {*/
        /*display: inline;*/
        /*padding: .2em .6em .3em;*/
        /*font-size: 95%;*/
        /*font-weight: 700;*/
        /*line-height: 1;*/
        /*color: #fff;*/
        /*text-align: center;*/
        /*white-space: nowrap;*/
        /*vertical-align: baseline;*/
        /*border-radius: .25em;*/
        /*}*/
    </style>

</head>


<body>

<table border="0" cellpadding="0" cellspacing="0" align="center"
       bgcolor="#FFFFFF"
       width="660" class="container table-main">

    <tr>
        <td align="left" style="width: 30%; padding-left: 10px;  padding-top: 10px; padding-bottom: 10px;">
<!--            <img src="https://clock-in.me/webapp/images/logo_login2.png" alt="clock-in.me"/>-->
            <img src="<?php echo $baseurl;?>assets/cc/images/logo_login3.png" alt="clock-in.me"/>
        </td>
        <td align="right"
            style="width: 100%; padding-left: 10px;  padding-right: 10px; padding-top: 10px; padding-bottom: 10px;">
            <span>www.clock-in.me</span> &nbsp; &nbsp; &nbsp; &nbsp; <span class="label"
                                                                           style="font-size: 12px;">(US) +1 (206) 2587269</span>&nbsp;
            <span class="label" style="font-size: 12px;">(AUS) +61 (39) 0216940</span>
        </td>
    </tr>

    <tr>
        <td colspan="3" align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
			padding-top: 0px;" class="line">
            <hr
                color="#E0E0E0" align="center" width="100%" size="1" noshade
                style="margin: 0; padding: 0;"/>
        </td>
    </tr>

    <tr>
        <td colspan="3" align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 17px; font-weight: 400; line-height: 160%;
			padding-top: 25px;
			color: #000000;
			font-family: sans-serif;" class="paragraph">

            <h1 style="font-size: 25px;">Hi <span
                    style="color: #1376a7;"><strong><?php echo (isset($staffName)) ? $staffName : ' there!'; ?></strong></span>
            </h1>
             <p style="font-size: 20px">Your leave(s) has been <span
                    style="color: #1376a7;"><strong><?php echo (isset($leaveActionMessage)) ? $leaveActionMessage : ''; ?> for the following date(s): </strong>
                      <?php foreach($leavedate as $row){ echo $row."  "; } ?>
            		
                    </span>
                <br>
                <?php echo (isset($shiftName)) ? 'Shift: ' . $shiftName : ''; ?>
                
                
               
                
                
                
            </p>
        </td>
    </tr>


    <tr>
        <td colspan="3" align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
			padding-top: 25px;" class="line">
            <hr
                color="#E0E0E0" align="center" width="100%" size="1" noshade
                style="margin: 0; padding: 0;"/>
        </td>
    </tr>

    <tr>
        <td colspan="3" align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 17px; font-weight: 400; line-height: 160%;
			padding-top: 20px;
			padding-bottom: 25px;
			color: #000000;
			font-family: sans-serif;" class="paragraph">
            <p>Clock-in.me Customer Care Center</p>
            <p style="font-size: 13px;">
                Do contact us at <a href="mailto:cs@entreprenity.co" target="_blank"
                                    style="color: #127DB3; font-family: sans-serif; font-weight: 400; line-height: 160%;">ask@clock-in.me</a>
                if you require any assistance.
            </p>
            <p style="font-size: 13px;">
                Clock-in.me Support Team :)
            </p>
        </td>
    </tr>
</table>

</body>
</html>