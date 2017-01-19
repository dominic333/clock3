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

		$('#shifts').on('change', function() 
		{
  			var selectedShift= this.value;
			//$("input:checkbox").prop('checked', false);
			$('input:checkbox').removeAttr('checked');
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
				 showLoader();
          },
			 success: function(result)
		    {
				hideLoader();

		    	var result = $.parseJSON(result);
		      	$.each(result,function(index,res)
				 {
		  			//console.log(res.shift_id);
		  			$("#shiftUsers"+res.staff_id).prop('checked','checked');
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
				 showLoader();
          },
			 success: function(result)
		    {
				hideLoader();
		      //console.log(result.toString());
				//$("input:checkbox").prop('checked', false);
		      var result = $.parseJSON(result); 
		      $.each(result,function(index,res) 
				{
		  			//console.log(res.shift_id);
		  			$("#monitorUsers"+res.staff_id).prop('checked','checked');
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

		//Assign staffs to shift
		$("#assignStafftoShiftBtn").click(function (e) {
			var allVals = [];
			$('#users_in_shifts :checked').each(function() {
				allVals.push($(this).val());
			});
			if(allVals.length >0)
			{
				var selShift= $('#shifts').val();
				if(selShift)
				{
					var post_url = base_url+"ccshifts/shifts/assignUsersToShift";
					$.ajax({
						type: "POST",
						data: {users:allVals,shift:selShift,csrf_test_name : csrf_token},
						url:  post_url,
						beforeSend: function ( xhr ) 
						 {
					         //Add your image loader here
				             showLoader();
					    },
						success: function(msg)
						{
							hideLoader();
							if(msg='updated')
							{alert('updated');}
							else 
							{alert('rejected');}
						}
					});
				}
			}
		});
	
		//Remove Monitors
		$("#removeMonitor").click(function (e) {
			var allVals = [];
			$('#attendance_monitoring_staff :checked').each(function() {
				allVals.push($(this).val());
			});
			if(allVals.length >0)
			{
				var selShift= $('#shifts').val();
				if(selShift)
				{
					var post_url = base_url+"ccshifts/shifts/removeMonitorForShift";
					$.ajax({
						type: "POST",
						data: {users:allVals,shift:selShift,csrf_test_name : csrf_token},
						url:  post_url,
						beforeSend: function ( xhr ) 
						 {
					         //Add your image loader here
				             showLoader();
					    },
						success: function(msg)
						{
							hideLoader();
							if(msg='updated')
							{alert('Removed'); window.location.reload(); }
							else
							{alert('Unable to process the request.'); window.location.reload(); }
						}
					});
				}
			}
		});
	
		//Assign Monitors
		$("#assignMonitor").click(function (e) {
			var allVals = [];
			$('#attendance_monitoring_staff :checked').each(function() {
				allVals.push($(this).val());
			});
			if(allVals.length >0)
			{
				var selShift= $('#shifts').val();
				if(selShift)
				{
					var post_url = base_url+"ccshifts/shifts/assignMonitorForShift";
					$.ajax({
						type: "POST",
						data: {users:allVals,shift:selShift,csrf_test_name : csrf_token},
						url:  post_url,
						beforeSend: function ( xhr ) 
						 {
					         //Add your image loader here
				             showLoader();
					    },
						success: function(msg)
						{
							hideLoader();
							if(msg='updated')
							{alert('Assigned');}
							else
							{alert('Unable to process the request.');}
						}
					});
				}
			}
		});
		
	 $('.monitorUsersClass').click(function() {
	 	
	 	 //$('#attendance_monitoring_staff input[type="checkbox"]').click(function(){
			    
		//	});
       if(this.checked)
       {
       	var countchecked = $('#attendance_monitoring_staff input[type="checkbox"]').filter(":checked").length;
       	var selShift= $('#shifts').val();
       	var selMid= $(this).attr('id')
       	var selMVal= $('#'+selMid).val();
       	if(selShift && selMVal)
       	{
       		var post_url = base_url+"ccshifts/shifts/checkWatcherAssignableOrNot";
				$.ajax({
					type: "POST",
					data: {watcher:selMVal,shift:selShift,selectedWatchers:countchecked,csrf_test_name : csrf_token},
					url:  post_url,
					beforeSend: function ( xhr ) 
					 {
				         //Add your image loader here
			            //showLoader();
				    },
					success: function(msg)
					{
						//console.log(msg);
						//hideLoader();
						
						if(msg=='limitExceeded')
						{
							$('#'+selMid).prop('checked', false); // Unchecks it
							alert('Watcher Limit Exceeded.');
						}
						else if(msg=='alreadyAssigned')
						{
							alert('This user is already assigned.');
						}
						else if(msg=='overSelected')
						{
						   alert('You have selected more than the limit. Please try again.');
						}
						else if(msg=='assignable')
						{
						 
						}
						else
						{
							$('#'+selMid).prop('checked', false); // Unchecks it
							alert('Unable to process the request.');
						}
						
					}
				});
       	}

      }
      });
});