$(document).ready(function(){
	
	
     $("#attendance_shift_table").DataTable();
     $("#attendance_user_table").DataTable();
     $('#example3').DataTable({
         "paging": true,
         "lengthChange": false,
         "searching": false,
         "ordering": true,
         "info": true,
         "autoWidth": false
     });
        
     $('#date_to').datepicker();
     $('#date_from').datepicker();

     $('#udate_to').datepicker();
     $('#udate_from').datepicker();
        
	   $(".select2").select2();
	     
	   //@Farveen
		//Add Custom Rule For Choosen Plugin
		$.validator.addMethod(     //adding a method to validate select box//
		"chosen",
		function(value, element) {
		    return (value == null ? false : (value.length == 0 ? false : true))
		},
		"please select an option"//custom message
		);
		
		//@Farveen
		//Add Custom Rule For Multi Select
		$.validator.addMethod("needsSelection", function (value, element) {
		    var count = $(element).find('option:selected').length;
		    return count > 0;
		});
		
		//Form Validations for shift attendance report form
		//Dominic; Dec 20,2016
		$('#frm_department_attendance').validate(
		 {
		  rules: {
		     date_from: {
			     required: true,
			  }, 
			  date_to: {
			     required: true,
			  }, 
			  multiSelect: {
			     needsSelection: true,
			     required: true,
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
			  
		     	 
			 	 var count = $('#multiSelect').find('option:selected').length;
			 	 if (count === 0) {
				    $.alert({
					    title: 'Select Shifts!',
					    content: 'Please Select Shifts To view Report',
					    confirm: function(){
					        
					    }
					});
				 }else{
				 	form.submit();
				 }
			 	 //form.submit();
		    }
		});
		
		//Form Validations for user attendance report form
		//Dominic; Dec 20,2016
		$('#frm_user_attendance').validate(
		 {
		  rules: {
		     udate_from: {
			     required: true,
			  }, 
			  udate_to: {
			     required: true,
			  }, 
			  umultiSelect: {
			     needsSelection: true,
			     required: true,
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

			 	 var count = $('#umultiSelect').find('option:selected').length;
			 	 if (count === 0) {
				    $.alert({
					    title: 'Select Shifts!',
					    content: 'Please Select Users To view Report',
					    confirm: function(){
					        
					    }
					});
				 }else{
				 	form.submit();
				 }
			 	 //form.submit();
		    }
		});
		
		
		//Function to initiate attendance report downloading
		//Dominic; Dec 20,2016
		$(document).on('click','#download_user_attendance_link',function (e) {
			e.preventDefault();
			var post_url = base_url+"ccreports/reports/download_user_attendance";
			var date_from=$('#udate_from').val();
			var date_to=$('#udate_to').val();
			var count = $('#umultiSelect').find('option:selected').length;
			//alert(date_from+'   '+date_to);
			var msg_1 = msg_2 = msg_3 = '';
			if(date_from!=''&&date_to!=''&&count>0){
				$.ajax({
					 url: post_url,
					 data:$('#frm_user_attendance').serialize(),
					 type: "POST",
					 dataType: 'HTML',
					 beforeSend: function ( xhr ) {
				         //Add your image loader here
				         $('#contact-loader').show(); // Ajax Loader Show
				    },
					 success: function(result)
				    { 
				    	$('#contact-loader').hide(); // Ajax Loader hide
				      var result= result.trim();
				      window.location = result;
				    }
				 });//end of ajax 
			}else{
				if(date_from==''){
					msg_1 = 'From Date is required';
				}
				if(date_to==''){
					msg_2 = '<br>To Date is required';
				}
				if(count<=0){
					msg_3 = '<br>Users is required';
				}
				$.alert({
				    title: 'Validation Failed!',
				    content: msg_1+''+msg_2+''+msg_3,
				    confirm: function(){
				        
				    }
				 });
			}	
		});
		
		
});
    

