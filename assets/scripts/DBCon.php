<?php
	//DB Connection
	class DBCon
	{	
		private function getConnection()
		{	
			                   // hostname,   username,     password,   database
			$con=mysqli_connect("localhost","clock2","d3fault","clock2")OR die('Could not Connect the Database');		
			return $con;
		}
		
		public function closeCon()
		{
			mysqli_close($con);
		}
		
		public function submitQuery($qry)
		{
			$result=0;
			$con=$this->getConnection();
			$result=mysqli_query($con,$qry);
			return $result;
		}
		
		public function selectQuery($qry)
		{
			$con=$this->getConnection();
			$res=mysqli_query($con,$qry);
			return $res;
		}
	}
?>
