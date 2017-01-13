
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

     //The Calender
     //$("#calendar").datepicker();
     //$(element_or_selector).multiDatesPicker(options_to_initialize_datepicker_and_multidatepicker);
     $('#calendar').multiDatesPicker({
			maxPicks: 2,
			altField: '#altField',
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
