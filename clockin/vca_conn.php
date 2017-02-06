<?php
		//require_once dirname(__FILE__) . '/../../include/config.php';
		//require_once dirname(__FILE__) . '/../include/config.php';
		
		$dbhost= 'localhost';
		//$dbuser= 'clockin_admin';
		//$dbpass= 'wzF7#W4]xOyT';
		//$dbname= 'clockin_maindb';
		
		
		$dbuser= 'clockin_test';
		$dbpass= 'oc1FRCHXUXaEo';
		$dbname= 'clockin_testdb';
		
                $vdbm = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
                if (mysqli_connect_errno())
                {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }
?>
