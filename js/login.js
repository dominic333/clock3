$(document).ready(function(){ 
   
   /**
   //@Author: Lissy SR
   //@Desc  : For validating the login form
   //@Date  : 24-02-2016
   */
   
	$('#login_form').validate(
 		{ 	
  			rules: {
  	        email:{
		  		  required: true,
		  		  email: true,
		  		 },
		  		 password:{
		  		  required: true,
		  		 },
		},  		 
		errorElement: "label"
		,	
		highlight: function(element) {
			$(element).closest('.control-group').removeClass('success').addClass('error');
		},
	   messages: {
        email: 'Valid Email Field is required',
        password: 'Valid Password is required',
    } 	 
	  });
	  
	/**
   //@Author: Lissy SR
   //@Desc  : For validating the forgot password form
   //@Date  : 24-02-2016
   */
   
	  	$('#frm_pass').validate(
 		{ 	
  			rules: {
  	        email_forgot:{
		  		  required: true,
		  		  email: true,
		  		 },
		  		 
		},  		 
		errorElement: "label"
		,	
		highlight: function(element) {
			$(element).closest('.control-group').removeClass('success').addClass('error');
		},
	   messages: {
         email_forgot: 'Valid Email Field is required',
        
      } 	 	 	 
	  });
	  
	$('.for_modal').click(function () {
     if($('.modal').hasClass('in'))
      {
	     $('.modal').removeClass('in');
	     window.location.href = base_url;
      }else{
	   }
    });   
		
 }); 
 	  	 