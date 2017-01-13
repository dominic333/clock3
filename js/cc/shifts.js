$(document).ready(function(){
	
  $("#example1").DataTable();
  
  $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
  });
  
  //Initialize Select2 Elements
  $(".select2").select2();

  //Timepicker
  $(".timepicker").timepicker({
      showInputs: false,
      showMeridian:false
  });

    //Function to open add a shift modal popup
    //By Dominic; Dec 13,2016
    $(document).on('click','#addNewShiftBtn',function (e)
    {
        e.preventDefault();
        //$('#editAnnouncementForm')[0].reset();
        $(".starttimes").val('');
        $(".endtimes").val('');
        document.getElementById('all_day_same').checked=false;
        $('#addNewShift').modal('show');
    });
    //Function to get day any start or end time and use it for all fields
    //@Author Farveen
    $(document).on('click','#all_day_same',function () {
        if(document.getElementById('all_day_same').checked) {
            var start_length 	= $(".starttimes").length;
            var start_bool 	= false;
            var end_length 	= $(".endtimes").length;
            var end_bool 		= false;
            for(var i=0;i<start_length;i++){
                if($(".starttimes").eq(i).val()!=''&&!start_bool){
                    $(".starttimes").val($(".starttimes").eq(i).val());
                    start_bool 	= true;
                }
            }
            for(var j=0;j<end_length;j++){
                if($(".endtimes").eq(j).val()!=''&&!end_bool){
                    $(".endtimes").val($(".endtimes").eq(j).val());
                    end_bool 	= true;
                }
            }
            //alert($(".starttimes").eq(2).val());
        } else {

        }
    });

    //function to reset all timers
    //@Authro Farveen
    $(document).on('click','#reset_times',function (e) {
        e.preventDefault();
        $(".starttimes").val('');
        $(".endtimes").val('');
        document.getElementById('all_day_same').checked=false;
    });

    //Function to edit a shift
    //By Dominic; Dec 13,2016
    $(document).on('click','.editShiftTime',function (e)
    {
        e.preventDefault();
        $('#frm_edit_shifts')[0].reset();
        var shift_name		=		$(this).attr("data-shift_name");
        var comp_id	        =		$(this).attr("data-comp_id");
        var shift_id	    =		$(this).attr("data-shift_id");
        var time_zone	    =		$(this).attr("data-time_zone");


        $('#frm_edit_shifts #shift_name').val(shift_name);
        $('#frm_edit_shifts #comp_id').val(comp_id);
        $('#frm_edit_shifts #shift_id').val(shift_id);

        $('#frm_edit_shifts [name=timezone] option').filter(function() {
            return ($(this).text() == time_zone); //To select Blue
        }).prop('selected', true);

        var starttime_mon	=		$(this).attr("data-monday_starttime");
        var endtime_mon	=		$(this).attr("data-monday_endtime");
        $('#frm_edit_shifts #starttime_mon').val(starttime_mon);
        $('#frm_edit_shifts #endtime_mon').val(endtime_mon);

        var starttime_tues	=		$(this).attr("data-tuesday_starttime");
        var endtime_tues	=		$(this).attr("data-tuesday_endtime");
        $('#frm_edit_shifts #starttime_tues').val(starttime_tues);
        $('#frm_edit_shifts #endtime_tues').val(endtime_tues);

        var starttime_wed	=		$(this).attr("data-wednesday_starttime");
        var endtime_wed	=		$(this).attr("data-wednesday_endtime");
        $('#frm_edit_shifts #starttime_wed').val(starttime_wed);
        $('#frm_edit_shifts #endtime_wed').val(endtime_wed);

        var starttime_thurs	=		$(this).attr("data-thursday_starttime");
        var endtime_thurs	=		$(this).attr("data-thursday_endtime");
        $('#frm_edit_shifts #starttime_thurs').val(starttime_thurs);
        $('#frm_edit_shifts #endtime_thurs').val(endtime_thurs);


        var starttime_fri	=		$(this).attr("data-friday_starttime");
        var endtime_fri	=		$(this).attr("data-friday_endtime");
        $('#frm_edit_shifts #starttime_fri').val(starttime_fri);
        $('#frm_edit_shifts #endtime_fri').val(endtime_fri);

        var starttime_sat	=		$(this).attr("data-saturday_starttime");
        var endtime_sat	=		$(this).attr("data-saturday_endtime");
        $('#frm_edit_shifts #starttime_sat').val(starttime_sat);
        $('#frm_edit_shifts #endtime_sat').val(endtime_sat);

        var starttime_sun	=		$(this).attr("data-sunday_starttime");
        var endtime_sun	=		$(this).attr("data-sunday_endtime");
        $('#frm_edit_shifts #starttime_sun').val(starttime_sun);
        $('#frm_edit_shifts #endtime_sun').val(endtime_sun);


        var mon_off	    =		$(this).attr("data-monday");
        if (mon_off==0)
        { $( "#frm_edit_shifts #mon_off").prop('checked', true); }
        else
        { $( "#frm_edit_shifts #mon_off").prop('checked', false); }

        var tues_off	    =		$(this).attr("data-tuesday");
        if (tues_off==0)
        { $( "#frm_edit_shifts #tues_off").prop('checked', true); }
        else
        { $( "#frm_edit_shifts #tues_off").prop('checked', false); }

        var wed_off	    =		$(this).attr("data-wednesday");
        if (wed_off==0)
        { $( "#frm_edit_shifts #wed_off").prop('checked', true); }
        else
        { $( "#frm_edit_shifts #wed_off").prop('checked', false); }

        var thurs_off	    =		$(this).attr("data-thursday");
        if (thurs_off==0)
        { $( "#frm_edit_shifts #thurs_off").prop('checked', true); }
        else
        { $( "#frm_edit_shifts #thurs_off").prop('checked', false); }

        var fri_off	    =		$(this).attr("data-friday");
        if (fri_off==0)
        { $( "#frm_edit_shifts #fri_off").prop('checked', true); }
        else
        { $( "#frm_edit_shifts #fri_off").prop('checked', false); }

        var sat_off	    =		$(this).attr("data-saturday");
        if (sat_off==0)
        { $( "#frm_edit_shifts #sat_off").prop('checked', true); }
        else
        { $( "#frm_edit_shifts #sat_off").prop('checked', false); }

        var sun_off	    =		$(this).attr("data-sunday");
        if (sun_off==0)
        { $( "#frm_edit_shifts #sun_off").prop('checked', true); }
        else
        { $( "#frm_edit_shifts #sun_off").prop('checked', false); }

        $('#editNewShift').modal('show');
    });

    //Function to validate add shift form
    //By Dominic; Dec 13,2016
    $('#frm_add_shifts').validate(
    {
        rules: {
            shift_name: {
                required: true
            },
            timezone: {
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

    //Function to validate add shift form
    //By Dominic; Dec 13,2016
    $('#frm_add_shifts').validate(
    {
        rules: {
            shift_name: {
                required: true
            },
            timezone: {
                required: true
            },
            shift_id:{
                required: true
            },
            comp_id:{
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

    //Function to open update notification time modal popup
    //By Dominic; Dec 13,2016
    $(document).on('click','.updateNotificationTime',function (e)
    {
        e.preventDefault();
        $('#formUpdateNotificationTime')[0].reset();
        var shift_name		=		$.trim($(this).attr("data-shift_name"));
        var comp_id	      =		$.trim($(this).attr("data-comp_id"));
        var shift_id	      =		$.trim($(this).attr("data-shift_id"));
        var notify_time	   =		$.trim($(this).attr("data-notify_time"));


        $('#formUpdateNotificationTime #shift_name').val(shift_name);
        $('#formUpdateNotificationTime #comp_id').val(comp_id);
        $('#formUpdateNotificationTime #shift_id').val(shift_id);
        $('#formUpdateNotificationTime #notify_time').val(notify_time);

        $('#updateNotificationTime').modal('show');
    });

    //Function to validate update notification time form
    //By Dominic; Dec 13,2016
    $('#formUpdateNotificationTime').validate(
        {
            rules: {
                shift_name: {
                    required: true
                },
                notify_time: {
                    required: true
                },
                shift_id:{
                    required: true
                },
                comp_id:{
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
        
    //Function to open edit shift name modal popup
    //By Dominic; Jan 11,2017
    $(document).on('click','.editThisShiftName',function (e)
    {
        e.preventDefault();
        $('.error').remove();
        $('#formEditShiftName')[0].reset();
        var shift_name		=		$.trim($(this).attr("data-shift_name"));
        var comp_id	      =		$.trim($(this).attr("data-comp_id"));
        var shift_id	      =		$.trim($(this).attr("data-shift_id"));


        $('#formEditShiftName #shift_name').val(shift_name);
        $('#formEditShiftName #comp_id').val(comp_id);
        $('#formEditShiftName #shift_id').val(shift_id);

        $('#editThisShiftName').modal('show');
    });
    
    //Function to validate edit shift name form
    //By Dominic; Jan 11,2017
    $('#formEditShiftName').validate(
    {
         rules: {
             shift_name: {
                 required: true,
                 remote: 
			    	  {
							url: base_url+"ccshifts/shifts/check_shift_exists",
							type: "post",
							data: 
							{
								shiftName : function(){ return $.trim($("#formEditShiftName #shift_name").val()); },
								shiftId   : function()  { return $.trim($("#formEditShiftName #shift_id").val()); },
								compId    : function()   { return $.trim($("#formEditShiftName #comp_id").val()); },
								csrf_test_name : csrf_token
							}
					  }
             },
             shift_id:{
                 required: true
             },
             comp_id:{
                 required: true
             }
         },
         messages: 
		   {
				shift_name: 
				 {
						remote: 'Shift name already exist.'
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

    
});

