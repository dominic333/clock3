
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
 });

 $(function () {
     $('#date_from').datepicker({dateFormat: 'dd/mm/yy'});
     $('#date_to').datepicker({dateFormat: 'dd/mm/yy'});
 })
