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

  	 //Initialize department Elements
  	 $(".selectdept").select2();

  	 //Initialize Shift Elements
  	 $(".selectshift").select2();
  
  
  		//To filter based on shift class
  		/*
  		$('#shifts').on('change', function() {
  			var selected= this.value;
  			var selClass='s'+selected;
  			console.log(selClass);
  			$('#listUserGrid :not(.selClass)').addClass('hide');
		});
		*/
		
		$('#shifts').on('change', function() 
		{
  			var selectedShift= this.value;
			//$('input:checkbox').attr('checked',false);
  			//fetch users under shift
  			fetchUsersUnderThisShift(selectedShift);
  			
  			//fetch attendance monitors
  			fetchUsersMonitoringAttendanceForShift(selectedShift);
       
		});
		
		function fetchUsersUnderThisShift(selectedShift)
		{
			var post_url = base_url+"ccshifts/shifts/fetchUsersUnderThisShift";
	 	   $.ajax({
			 url: post_url,
			 data:{shiftId :selectedShift,csrf_test_name : csrf_token},
			 type: "POST",
			 dataType: 'HTML',
			 beforeSend: function ( xhr ) 
			 {
             //Add your image loader here
             $('#loading').show(); // Ajax Loader Show
          },
			 success: function(result)
		    { 
		      
		    	$('#loading').hide(); // Ajax Loader hide
		    	//$(".shiftUsersClass").attr('checked', false);
		    	var result = $.parseJSON(result);
		      $.each(result,function(index,res) 
				 {
		  			//console.log(res.shift_id);
		  			$("#shiftUsers"+res.staff_id).attr('checked','checked');
			  	 });
		    }
	     });//end of ajax 	
		
		}
		
		function fetchUsersMonitoringAttendanceForShift(selectedShift)
		{
			var post_url = base_url+"ccshifts/shifts/fetchUsersMonitoringAttendanceForShift";
	 	   $.ajax({
			 url: post_url,
			 data:{shiftId :selectedShift,csrf_test_name : csrf_token},
			 type: "POST",
			 dataType: 'HTML',
			 beforeSend: function ( xhr ) 
			 {
             //Add your image loader here
             $('#loading').show(); // Ajax Loader Show
          },
			 success: function(result)
		    { 
		    	$('#loading').hide(); // Ajax Loader hide
		      //console.log(result.toString());	
				//$(".monitorUsersClass").attr('checked', false);
		      var result = $.parseJSON(result); 
		      $.each(result,function(index,res) 
				{
		  			//console.log(res.shift_id);
		  			$("#monitorUsers"+res.staff_id).attr('checked','checked');
			  	}); 	
		    }
	     });//end of ajax 	
		
		}
		
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


		
});