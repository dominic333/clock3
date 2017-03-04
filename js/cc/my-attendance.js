
 $(function () {
     $("#myattendance").DataTable();
     $('#example2').DataTable({
         "paging": true,
         "lengthChange": false,
         "searching": false,
         "ordering": true,
         "info": true,
         "autoWidth": false
     });

$('#timepicker1').timepicker({showMeridian:false   ,   showInputs: false,});
$('.time').hide();


	$('#attendance_frm').validate({
		 rules:
            {
                notes:
                {
                    required: true,

                },
					 clock:
                {
                    required: true
                },
            },
            submitHandler: function (form) {
            	
            	 var post_url = base_url+"ccattendance/attendance/add_notes";
            	 var clock 	= 		$('#clock').val();
    				 var date = $('#logdate').val();
    				 var notes = $('#notes').val();
    				 var user = $('#userid').val();
    				 var clocktime = $('#timepicker1').val();
    				 var set = $('input[name=set_time]:checked', '#attendance_frm').val();

//					 console.log(set);
            	 $.ajax({
            	 
            	 	url: post_url,
            	 	data : {
            	 				clock 	:  clock , 
            	 				date 		:  date,
            	 				notes 	:  notes,
            	 				clocktime:	clocktime,
            	 				set		:  set,
            	 				user		:  user,
            	 				csrf_test_name : csrf_token
            	 				},
            	 	type: "POST",
						dataType: 'HTML',
            	 	success: function(result){
								 $('#logdate').attr("value", "");  
								 if (result == "true")
								 {
								 		$('#attendance_modal').modal('hide');
								 	   fetchCalenderAttendance(date,user);
								 }

            	 	}
            	 
            	 
            	 });
            }	
	
	
	});
     //The Calender
     //$("#calendar").datepicker();
     //$(element_or_selector).multiDatesPicker(options_to_initialize_datepicker_and_multidatepicker);
     
     $('#calendar').multiDatesPicker({
			maxPicks: 2,
			altField: '#altField',
			minDate: '-12M',
			maxDate: new Date(),			
			onSelect: function (date) {
		       //alert(date); 
		      var altField= $('#frm_attendance_search #altField').val();
		      if (altField.indexOf(',') > -1)
				{
					var fields = altField.split(',');
					var fromDate = fields[0];
					var toDate   = fields[1];  
					//console.log('from '+fromDate);
					//console.log('to '+toDate);
					$('#frm_attendance_search #dateRanges').html(fromDate+' to '+toDate);
					$('#frm_attendance_search #date_from').val(fromDate);
					$('#frm_attendance_search #date_to').val(toDate); 
					$('#submitThis').prop("disabled", false);
				}
		    }
		});
		

	  $('#date_from').datepicker({dateFormat: 'dd/mm/yy'});
     $('#date_to').datepicker({dateFormat: 'dd/mm/yy'});
     
     $("#leaveApplicationList").DataTable();
     
   //Function for bulk action in leave requests
   //Dominic, Feb 21,2017

	$(document).on('change','#leaveAction',function(e){
		var leaveType=$(this).val();
		if ($("#leaveApplicationList input:checkbox:checked").length > 0)
		{	
			 e.preventDefault();
			 var selectedLeaves = [];
			 $('input[name^="checked_item"]:checked').each(function() {
	   	     selectedLeaves.push($(this).val()); 
		 		});		 	
			 //alert(selectedLeaves);
			
		    var post_url = base_url+"ccattendance/attendance/bulkActionLeaves";
		 	 $.ajax({
				 url: post_url,
				 data:{	selectedLeaves:selectedLeaves,leaveType:leaveType,csrf_test_name:csrf_token	},
				 type: "POST",
				 dataType: 'JSON',
				 beforeSend: function ( xhr ) 
				 {
			        showLoader();
			    },
				 success: function(result)
			    { 
			      hideLoader(); 	
			      console.log(result);

			    }
		   });//end of ajax 

		}
		else
		{
		   alert("Please check at least one box");
		   $('#leaveAction').val('');
		   return false;	
		}	
	});

   //Function to approve leave
	//By Dominic;  Jan 13,2017
	$(document).on('click','.approve_leave_link',function (e) 
	{
		 e.preventDefault();
		 var id			=	$.trim($(this).data('id'));
		 var staffid	=	$.trim($(this).data('staffid'));
		 var post_url = base_url+"ccattendance/attendance/aproveLeaveApplication";
		 
	 	 $.ajax({
		 url: post_url,
		 data:{	id:id,staffid:staffid,csrf_test_name:csrf_token	},
		 type: "POST",
		 dataType: 'HTML',
		 beforeSend: function ( xhr ) 
		 {
	        showLoader();
	    },
		 success: function(result)
	    { 
	      hideLoader(); 	
	      var result= result.trim();
	      if(result=="approved")
	      {	
				window.location.reload();
	      }
	      else
	      {
	      	alert ('Something went wrong. Please Try Again');
	      	window.location.reload();
	      }
	    }
	   });//end of ajax 
	 });
	  
   //Function to reject leave
	//By Dominic;  Jan 13,2017
	$(document).on('click','.reject_leave_link',function (e) 
	{
		 e.preventDefault();
		 var id			=	$.trim($(this).data('id'));
		 var staffid	=	$.trim($(this).data('staffid'));
		 
		 var post_url = base_url+"ccattendance/attendance/rejectLeaveApplication";
		 
	 	 $.ajax({
		 url: post_url,
		 data:{	id:id,staffid:staffid,csrf_test_name:csrf_token	},
		 type: "POST",
		 dataType: 'HTML',
		 beforeSend: function ( xhr ) 
		 {
	        showLoader();
	    },
		 success: function(result)
	    { 
	    	hideLoader(); 	
	      var result= result.trim();
	      if(result=="rejected")
	      {	
				$('#row'+id).remove();
	      }
	      else
	      {
				window.location.reload();
	      }
	    }
	  });//end of ajax 	  
	 });
	  
	  
 });

$("input[type='radio']").change(function () {
		var selection=$(this).val();
//		alert("Radio button selection changed. Selected: "+selection);
		if(selection == "yes")
			{
				$('.time').show();
			
			}
		else {
			$('.time').hide();	
		
		}
});

/* $('.set_time').click(function(){

	var set = $('.set_time').val();
	if(set == "yes")
	{
		$('.time').show();
	
	}
	else {
		$('.time').hide();	
	
	}

});
*/