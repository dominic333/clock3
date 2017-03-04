<?php
		//require_once dirname(__FILE__) . '/../../include/config.php';
		//require_once dirname(__FILE__) . '/../include/config.php';
		
		$dbhost= 'localhost';
		//$dbuser= 'clockin_admin';
		//$dbpass= 'wzF7#W4]xOyT';
		//$dbname= 'clockin_maindb';
		
		
		$dbuser= 'clock2';
		$dbpass= 'd3fault';
		$dbname= 'clock2';
		
                $vdbm = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
                if (mysqli_connect_errno())
                {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }
?>
