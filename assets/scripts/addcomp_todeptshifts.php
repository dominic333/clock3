<?php


require_once ('Query.php'); 


$qry="SELECT shift_id,dept_id FROM department_shifts";

$res=getData($qry);
$count_res=mysqli_num_rows($res);
$i=0;
if($count_res>0)
{	
	while($row=mysqli_fetch_array($res))
	{
		$data[$i]["shift"] 		= $row['shift_id']; 
		$data[$i]["dept"] 		= $row['dept_id']; 
		
		$i++; 
	}
	
	for($i=0;$i<count($data);$i++)
	{
		if($data[$i]['dept']>0)
		{
			$compID= getCompanyIDFromDeptID($data[$i]['dept']);
			$qry2="UPDATE department_shifts SET comp_id=".$compID." WHERE shift_id=".$data[$i]['shift']." ";
			setData($qry2);
		}
	}
}
else
{
	echo 'no data to export';
} 

function getCompanyIDFromDeptID($deptID)
{
	$qry="SELECT company_id FROM departments WHERE dept_id=".$deptID." ";
	$res=getData($qry);
   $count_res=mysqli_num_rows($res);
	if($count_res>0)
	{
		while($row=mysqli_fetch_array($res))
		{
			$company_id		=	$row['company_id'];  					
		}
		return $company_id;
	}
	else
	{
		return 0;
	} 
}

?>