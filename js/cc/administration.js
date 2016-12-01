$(document).ready(function(){

	//Custom rule; letters only
	$.validator.addMethod("lettersonly", function(value, element) {
	return this.optional(element) || /^[a-z\s]+$/i.test(value);
	}, "Please enter only letters"); 


	 //To remove readonly and disabled attributes from edit company info form on edit button click
	 $("#editCompanyInfoBtn").click(function (e) {
			$("#editCompanyInfoForm .readOnlyApplied").prop("readonly", false); 
			$("#editCompanyInfoForm .disabledApplied").prop("disabled", false); 
	 });


	//Form validation: Edit company info
	//By Dominic; Dec 01,2016 
	$('#editCompanyInfoForm').validate(
	 {
	  rules: 
	  {
	     companyName: 
	     {
		     required: true,
		     lettersonly: true
		  }, 
		  companyLoginName: 
		  {
		     required: true
		  },  
		  companyAddress:
		  {
	    	 required: true
	     },
		  companyContactPerson:
		  {
	    	 required:true
	     },
	     companyEmail:
		  {
	    	 email: true,
	    	 required: true
	     },
	     companyContactNumber:
		  {
	    	 number: true,
	    	 required:true,
			 maxlength:12
	     }
	    
	  },            
	  highlight: function(element) 
	  {
			  $(element).closest('.form-control').removeClass('success').addClass('error');
	  },
	  success: function(element) 
	  {
	
		  $(element).closest('.form-control').removeClass('error').addClass('success');
	  }
	});

	//Form validation: contact support form
	//By Dominic; Dec 01,2016 
	$('#contactSupportForm').validate(
	 {
	  rules: 
	  {
	     senderName: 
	     {
		     required: true,
		     lettersonly: true
		  }, 
	     senderEmail:
		  {
	    	 email: true,
	    	 required: true
	     },
	     senderMessage:
		  {
	    	 required:true
	     }
	    
	  },            
	  highlight: function(element) 
	  {
			  $(element).closest('.form-control').removeClass('success').addClass('error');
	  },
	  success: function(element) 
	  {
	
		  $(element).closest('.form-control').removeClass('error').addClass('success');
	  }
	});

});