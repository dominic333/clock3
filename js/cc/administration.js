$(document).ready(function(){


 //To remove readonly and disabled attributes from edit company info form on edit button click
 $("#editCompanyInfoBtn").click(function (e) {
		$("#editCompanyInfoForm .readOnlyApplied").prop("readonly", false); 
		$("#editCompanyInfoForm .disabledApplied").prop("disabled", false); 
 });




});