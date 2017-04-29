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
	
  		//Initialize department Elements
  		$(".selectdept").select2();

  		//Initialize Shift Elements
  		$(".selectshift").select2();
  
  
  		//To filter based on shift class
  		/*
  		$('#allshiftsusers').on('change', function() {
  			 var selected= this.value;  					    
		    if (selected) {
			  var selClass = 's' + selected;
			  $('#listUserGrid span').show();
			  $('#listUserGrid :not(.'+selClass+')').hide();
			} else {
			  $('#listUserGrid span').show();
			}
		});
		*/
		
 
  
	  //On Delete Button Click (users)
	  //By Dominic; Dec 12,2016 
	  $(document).on('click','.delete_user_link',function (e) {
		e.preventDefault();
		var staff_id 		= $(this).data('staff_id');
		var staff_name 		= $(this).data('staff_name');
		if(staff_id!='')
		{
			$.confirm({
			    title: 'confirm To Delete ',
			    content: 'Deleting '+staff_name+' will delete the user and also will delete user from thier shifts, Are you sure to continue with this action',
			    confirm: function(){
			      window.location = base_url+"ccshifts/shifts/delete_users/"+staff_id +"/"+staff_name;
			    },
			    cancel:  function(){
			       
			    },
			});
		}
		else
		{
			$.alert({
			    title: 'Invalid Data\'s ',
			    content: 'Invalid Data,Please Try Other User To Edit',
			    confirm: function(){
			    },
			    cancel:  function(){
			    },
			});
		}
		
	});

	//Implement Forget Password For Users
	//By Dominic; Dec 12,2016 
	$(document).on('click','.forgot_user_link',function (e) {
		e.preventDefault();
		var staff_id 			= $(this).data('staff_id');
		var staff_name 		= $(this).data('staff_name');
		var login_name 		= $(this).data('login_name');
		var email 				= $(this).data('email');
		
		if(staff_id!=''&&email!=''){
			document.getElementById("user_id").value=staff_id;
			document.getElementById("user_name").value=staff_name;
			document.getElementById("user_login").value=login_name;
			document.getElementById("user_email").value=email;
			$('#forgot_user_modal').modal('show');
			
		}else{
			$.alert({
			    title: 'Invalid Data\'s ',
			    content: 'Invalid Data,Please Try Other User To Edit',
			    confirm: function(){
			      
			    },
			    cancel:  function(){
			       
			    },
			});
		}
		
	});
	
	
		//Remote Login Feature
		//By Dominic; Dec 12,2016 
		$(document).on('click','.rremote_login_link',function (e) 
		{
			e.preventDefault();
			var staff_id 			= $(this).data('staff_id');
			var staff_name 		= $(this).data('staff_name');
			var staff_photo 		= $(this).data('staff_photo');
			var remotelogin 			= $(this).data('remotelogin');
		
			if(staff_id!='')
			{
				document.getElementById("rstaff_id").value=staff_id;
				document.getElementById("rstaff_name").value=staff_name;
				document.getElementById("rstaff_photo_src").setAttribute("src", staff_photo);
				document.getElementById("rremotelogin").value=remotelogin;
				document.getElementById('rstaff_name').readOnly = true;
				$('#remote_login_modal').modal('show');		
			}
			else
			{
				$.alert({
				    title: 'Invalid Data\'s ',
				    content: 'Invalid Data,Please Try Other User To Edit',
				    confirm: function(){
				      
				    },
				    cancel:  function(){
				       
				    },
				});
			}	
		});
			
	
	
		//Monitor Attendance Feature
		//By Dominic; Dec 12,2016 
		$(document).on('click','.mmonitor_attendance_link',function (e) 
		{
			e.preventDefault();
			var staff_id 			= $(this).data('staff_id');
			var staff_name 		= $(this).data('staff_name');
			var staff_photo 		= $(this).data('staff_photo');
			var monitor 			= $(this).data('monitor');
		
			if(staff_id!='')
			{
				document.getElementById("mstaff_id").value=staff_id;
				document.getElementById("mstaff_name").value=staff_name;
				document.getElementById("mstaff_photo_src").setAttribute("src", staff_photo);
				document.getElementById("mmonitor").value=monitor;
				document.getElementById('mstaff_name').readOnly = true;
				$('#monitor_attendance_modal').modal('show');		
			}
			else
			{
				$.alert({
				    title: 'Invalid Data\'s ',
				    content: 'Invalid Data,Please Try Other User To Edit',
				    confirm: function(){
				      
				    },
				    cancel:  function(){
				       
				    },
				});
			}	
		});
	
		//On Edit user link click
		//By Dominic; Dec 12,2016
		$(document).on('click','.edit_user_link',function (e) {
			e.preventDefault();
			var staff_id 			= $(this).data('staff_id');
			var staff_name 		= $(this).data('staff_name');
			var login_name 		= $(this).data('login_name');
			var staff_photo 		= $(this).data('staff_photo');
			var contact_number 	= $(this).data('contact_number');
			var email 				= $(this).data('email');
			//console.log(staff_name);
			if(staff_id!=''){
				//document.getElementById("staff_id").value=staff_id;
				//document.getElementById("staff_name").value=staff_name;
				//document.getElementById("login_name").value=login_name;
				//document.getElementById("staff_photo_src").setAttribute("src", staff_photo);
				//document.getElementById("contact_number").value=contact_number;
				//document.getElementById("email").value=email;
				$('#edit_user_frm #staff_id').val(staff_id);
				$('#edit_user_frm #staff_name').val(staff_name);
				$('#edit_user_frm #login_name').val(login_name);
				$('#edit_user_frm #contact_number').val(contact_number);
				$('#edit_user_frm #email').val(email);
				$('#edit_user_frm #staff_photo_src').attr("src",staff_photo);
				$('#edit_user_modal').modal('show');
				
				
			}else{
				$.alert({
				    title: 'Invalid Data\'s ',
				    content: 'Invalid Data,Please Try Other User To Edit',
				    confirm: function(){
				      
				    },
				    cancel:  function(){
				       
				    },
				});
			}	
		});
		
		
	// change admin
	//by annie , April 17,2017
	
	$(document).on('click','.isadmin_attendance_link',function (e) {
			
			e.preventDefault();
			var staff_id 			= $(this).data('staff_id');
			var staff_name 		= $(this).data('staff_name');
			var staff_photo 		= $(this).data('staff_photo');
			var isadmin 			= $(this).data('isadmin');
			console.log(staff_name);
			if(staff_id!='')
			{
				document.getElementById("istaff_id").value=staff_id;
				document.getElementById("istaff_name").value=staff_name;
				document.getElementById("istaff_photo_src").setAttribute("src", staff_photo);
				document.getElementById("isadmin").value=isadmin;
				document.getElementById('istaff_name').readOnly = true;
				$('#isadmin_attendance_modal').modal('show');		
			}
			else
			{
				$.alert({
				    title: 'Invalid Data\'s ',
				    content: 'Invalid Data,Please Try Other User To Edit',
				    confirm: function(){
				      
				    },
				    cancel:  function(){
				       
				    },
				});
			}	
		});
		
		
		
		
		
		
		//Change Staff Type- Flexible/Normal
		//By Dominic; Dec 13,2016 
		$(document).on('click','.change_user_shiftType',function (e) 
		{
			e.preventDefault();
			var staff_id 			= $(this).data('staff_id');
			var staff_name 		= $(this).data('staff_name');
			var staff_photo 		= $(this).data('staff_photo');
			var login_name 		= $(this).data('login_name');
			var staff_type 		= $(this).data('staff_type');
		
			if(staff_id!='')
			{
				document.getElementById("ststaff_id").value=staff_id;
				document.getElementById("ststaff_name").value=staff_name;
				document.getElementById("ststaff_photo_src").setAttribute("src", staff_photo);
				document.getElementById("ststaffType").value=staff_type;
				document.getElementById('ststaff_name').readOnly = true;
				$('#user_shiftType_modal').modal('show');		
			}
			else
			{
				$.alert({
				    title: 'Invalid Data\'s ',
				    content: 'Invalid Data,Please Try Other User To Edit',
				    confirm: function(){
				      
				    },
				    cancel:  function(){
				       
				    },
				});
			}	
		});
		
		//Form Validations for Change Staff Type Form
		//By Dominic; Dec 13,2016 
		$('#user_shiftchange_frm').validate(
		 {
		  rules: {
		     ststaff_name: 
		     {
			     lettersonly: true,
			     required: true,
			  },
		     ststaffType: 
		     {
			     required: true
			  } 
		    
		   },                 
			highlight: function(element) {
				  $(element).closest('.control-group').removeClass('success').addClass('error');
			 },
			 success: function(element) {
			  element
			 .text('').addClass('valid')
			 .closest('.control-group').removeClass('error').addClass('success');
			}
		});
	
	
		//Form Validations for Monitor Attendance Form
		//By Dominic; Dec 12,2016 
		$('#monitor_attendance_frm').validate(
		 {
		  rules: {
		     mstaff_name: 
		     {
			     lettersonly: true,
			     required: true,
			  },
		     mmonitor:
		     {
		     	 required: true
		     }
		   },                 
			highlight: function(element) {
				  $(element).closest('.control-group').removeClass('success').addClass('error');
			 },
			 success: function(element) {
			  element
			 .text('').addClass('valid')
			 .closest('.control-group').removeClass('error').addClass('success');
			}
		});
		
		
		//Form Validations for Remote Login Feature Form
		//By Dominic; Dec 12,2016 
		$('#remote_login_frm').validate(
		 {
		  rules: {
		     rstaff_name: 
		     {
			     lettersonly: true,
			     required: true,
			  },
		     rremotelogin: 
		     {
			     required: true
			  } 
		    
		   },                 
			highlight: function(element) {
				  $(element).closest('.control-group').removeClass('success').addClass('error');
			 },
			 success: function(element) {
			  element
			 .text('').addClass('valid')
			 .closest('.control-group').removeClass('error').addClass('success');
			}
		});
		
		//Reset Password Form Validations
		//By Dominic; Dec 12,2016 
		$('#forgot_user_frm').validate(
		 {
		  rules: {
		    
		     password: {
			     required: true
			  }, 
		     confrim_password: {
		      equalTo: "#forgot_user_frm #password",
		      required: true
		     }, 
		    
		    
		   },     
		         
			highlight: function(element) {
				  $(element).closest('.control-group').removeClass('success').addClass('error');
			 },
			 success: function(element) {
			  element
			 .text('').addClass('valid')
			 .closest('.control-group').removeClass('error').addClass('success');
			},
			 submitHandler: function(form) {
			 	  var post_url = base_url+"ccshifts/shifts/forgot_user";
			 	  $.ajax({
					 url: post_url,
					 data:$('#forgot_user_frm').serialize(),
					 type: "POST",
					 dataType: 'HTML',
					 beforeSend: function ( xhr ) {
		               //Add your image loader here
		               showLoader();
		          },
					 success: function(result)
				    {
				    	hideLoader(); 
				      var result= result.trim();
				      if(result=="password"){
				      	$.alert({
							    title: 'Reset Alert!',
							    content: 'Password Has Been Reset And Mail Has Been Send',
							    confirm: function(){
							        
							    }
							});
				      }else if(result=="failed"){
				      	$.alert({
							    title: 'Reset Alert!',
							    content: 'Reset Failed ,Please Try Again Later',
							    confirm: function(){
							        
							    }
							});
				      }
					  	$('#forgot_user_frm')[0].reset();
					  	$('#forgot_user_modal').modal('hide');
					  	
				    }
			    });//end of ajax 
						
					
			 }
		});
		
		//Form Validations for Edit user Form
		//By Dominic; Dec 12,2016 
		$('#edit_user_frm').validate(
		 {
		  rules: {
		     staff_name: {
			     lettersonly: true,
			     required: true,
			  }, 
			  email:{
		    	email: true,
		    	required: true
		     },
			  contact_number:{
		    	number: true,
		    	required:true,
		    	minlength: 7,
				maxlength:12
		     }
		    
		   }, 

			highlight: function(element) {
				  $(element).closest('.control-group').removeClass('success').addClass('error');
			 },
			 success: function(element) {
			  element
			 .text('').addClass('valid')
			 .closest('.control-group').removeClass('error').addClass('success');
			}
		});

		//Function to validate add user form
		//By Dominic; Dec 15,2016
		$('#frm_add_users').validate(
		{
			rules: {
				staff_name: {
					required: true,
					lettersonly:true
				},
				login_name: {
					required: true,
					lettersonly:true,
					minlength:4,
					remote: 
			    	  {
							url: base_url+"ccshifts/shifts/check_login_exists",
							type: "post",
							data: 
							{
								loginName : function(){ return $.trim($("#frm_add_users #login_name").val()); },
								csrf_test_name : csrf_token
							}
					  }
				},
				password:{
					required: true,
					minlength:6
				},
				cpassword:{
					equalTo: "#frm_add_users #password",
					required: true,
					minlength:6
				},
				email:{
					required: true,
					email:true
				},
				contact_number:{
					required: true,
					number:true,
					maxlength:12
				},
				shifts:{
					required: true
				},
				monitor:{
					required: true
				},
				remotelogin:{
					required: true
				},
				is_admin:{
					required: true
				}
			},
			messages: 
		   {
				login_name: 
				 {
						remote: 'Login name already assigned.'
				 }
		   },
			highlight: function(element) {
				$(element).closest('.control-group').removeClass('success').addClass('error');
			},
			success: function(element) {
				element
					.closest('.control-group').removeClass('error').addClass('success');
			}
		});
});