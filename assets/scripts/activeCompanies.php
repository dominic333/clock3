<?php

header('Content-Type: text/csv; charset=utf-8');
$filename="Clockin_Companies_" . date("Y-m-d");
header('Content-Disposition: attachment; filename='.$filename.'.csv');

require_once ('Query.php'); 


$qry="SELECT company_info.company_login,company_info.company_name,company_info.contact_person,company_info.contact_number,
				 company_info.contact_email,company_info.company_address,company_info.company_city,company_info.company_country 
		FROM company_info WHERE company_info.company_status=1 AND company_info.id IN(SELECT department_shifts.comp_id FROM department_shifts WHERE department_shifts.shift_status=1)";

$res=getData($qry);
$count_res=mysqli_num_rows($res);
if($count_res>0)
{
	$output = fopen('php://output', 'w');
	// output the column headings
	fputcsv($output, array('Name', 'Contact Person','Number','Email','Address','City','Country'));
		
	while($row=mysqli_fetch_array($res))
	{
		fputcsv($output, array($row["company_name"],$row["contact_person"],$row["contact_number"],$row["contact_email"],$row["company_address"],$row["company_city"],$row["company_country"]));	
	}
}
else
{
	echo 'no data to export';
} 
?>