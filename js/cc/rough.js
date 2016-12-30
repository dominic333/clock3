// JavaScript Document
$(document).ready(function(){
	
	 //Lissy 
   //Function to confirm message for delete
   $(document).on("click",".message_confirm",function(e){
   	e.preventDefault();
		var msg 	= 'Will Be Delete';
		var url 	= $(this).attr('data-url');
		var unit_name 	= $(this).attr('data-name');
		msg=unit_name+' '+msg;
		swal({
                title: "Are you sure?",
                text: msg,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, I am sure!',
                cancelButtonText: "No, cancel it!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    swal({
                        title: 'Deleted!',
                        text: unit_name+ ' is successfully Deleted!',
                        type: 'success'
                    }, function() {
                        window.location.href = url;
                    });
                    
                } else {
                    swal("Cancelled", "", "error");
                }
            });
   });
   //Farveen
    // check all checkboxes in table
    //modified by lijiya 
	$('.checkall').click(function(){
	   var parentTable = jQuery(this).parents('table');										   
	   var ch = parentTable.find('tbody input[type=checkbox]');
	   if(jQuery(this).is(':checked')) {
	   	//check all rows in table
	   	$('.jchecker').prop( "checked", true );
		  ch.each(function(){ 
			 jQuery(this).attr('checked',true);
			 jQuery(this).parent().addClass('checked');	//used for the custom checkbox style
			 jQuery(this).parents('tr').addClass('selected'); // to highlight row as selected
		  });			
	   } else {	
	   $('.jchecker').prop( "checked", false );	
		  //uncheck all rows in table
		  ch.each(function(){ 
			jQuery(this).attr('checked',false); 
			 jQuery(this).parent().removeClass('checked');	//used for the custom checkbox style
			 jQuery(this).parents('tr').removeClass('selected');
		  });	
	   }
	});
	 //Function click to show single checkbox checked in list
    //@farveen
     $('#uniform-undefined > span').click(function () {
	     if($(this).hasClass('checked'))
	      {
		     $(this).removeClass('checked');
	      }else{
		     $(this).addClass('checked');
	      }
     });
   
    //Function to Check All CheckBox on New Datatables(ichecker)
    //@farveen
  
  
   $('input').on('ifChanged', function(event){

        if($('#checkall').is(':checked')){
        	$('.dt_checkbox').prop('checked', true);
        }else{
        	$('.dt_checkbox').prop('checked', false);
        }
   });
   
   
   $('input').on('ifChanged', function(event){
          //alert('hi');
        /*if($('#checkall').is(':checked')){
        	$('.dt_checkbox').prop('checked', true);
        }else{
        	$('.dt_checkbox').prop('checked', false);
        }*/
   });
   
   //display event calendar in admin dashboard
   //author lijiya babu
   //Modified by Radhu :Implementing color and tooltip
 	$('#event').datepicker();
   var date = new Date();
   /*var tooltip = $('<div/>').qtip({
		id: 'calendar',
		prerender: true,
		content: {
			text: ' ',
			title: {
				button: true
			}
		},
		position: {
			//my: 'bottom center',
			//at: 'top center',
			target: 'mouse',
			//viewport: $('#calendar'),
			adjust: {
				mouse: false,
				scroll: false
			}
		},
		show: 'mouseover',
		hide: false,
		style: 'qtip-light'
	}).qtip('api');*/
	
                $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    buttonText: {
                        today: 'today',
                        month: 'month',
                        week: 'week',
                        day: 'day'
                    },
                   
						eventRender: function(event, element) {
                       $(element).tooltip({title: event.loc ,placement:'bottom' });
                                  
                  },	
                 events: function(start, end, timezone, callback) {
                 	       var post_url = base_url+"admin/home/get_calendar_meetings";
						            $.ajax({
						            url: post_url,
						            type: "POST",
						            dataType: 'json',
						            
						            data: {
						                // our hypothetical feed requires UNIX timestamps
						                //start: start.unix(),
						                //end: end.unix(),
						                csrf_test_name : csrf_token
						            },
						            success: function(meetg) {
						            	 var events = [];
						                $.each(meetg,function(index,meeting) //here we're doing a foeach loop round each city with id as the key and city as the value
						                   {
						                   	var date = (meeting.date).split('-'); //To get date,month  and year separately
						                   	var time_from = (meeting.time_from).split(':'); //To get hr,min and sec
						                   	var time_to = (meeting.time_to).split(':'); //To get hr,min and sec
						                   	hrs_from= time_from[0];
						                   	hrs_to= time_to[0];
						                   	meridian_from=meeting.meridian_from;
						                   	meridian_to=meeting.meridian_to;
						                   	if(meridian_from == "PM" && hrs_from < 12) hrs_from = parseInt(hrs_from) + parseInt(12);
						                   	if(meridian_from == "AM" && hrs_from == 12) hrs_from = parseInt(hrs_from)-parseInt(12);
						                   	//if(meridian_from == "AM" && hrs_to == 12) hrs_to = parseInt(hrs_to)-parseInt(12);
						                   	//if(meridian_to == "PM" && hrs_to < 12) hrs_to = parseInt(hrs_to) + parseInt(12);

						                   	events.push({
						                   		
						                    	   title:  meeting.heading.substring(0,8),
						                    	   loc: meeting.heading + ' at ' + meeting.location,
						                        start: new Date(date[0],date[1] -1, date[2], hrs_from , time_from[1] ), // will be parsed //date[1] -1 is used becz march is 2 as default bt march is 3 in our database
						                        end:   new Date(date[0],date[1] -1, date[2] , hrs_to, time_to[1] ),
						                        allDay: false,
						                        url: base_url+'admin/meetings/view/'+meeting.id,
						                        color: '#257e4a'					                    
						                        });
						                   });
						                
						                callback(events);
						             }
						          });
						         },
						         disableDragging:true,
						     eventAfterRender: function(event, $el, view ) {
						        var formattedTime = $.fullCalendar.formatDates(event.start, event.end, "hh:mm a");
						        // If FullCalendar has removed the title div, then add the title to the time div like FullCalendar would do
						        if($el.find(".fc-event-title").length === 0) {
						            $el.find(".fc-event-time").text(formattedTime + " - " + event.title);
						        }
						        else {
						            $el.find(".fc-event-time").text(formattedTime);
						        }
						        },
                    selectable: true,
						  selectHelper: true,
                    eventStartEditable: false,
                    droppable: true, // this allows things to be dropped onto the calendar !!!
                    drop: function(date, allDay) { // this function is called when something is dropped

                        // retrieve the dropped element's stored Event Object
                        var originalEventObject = $(this).data('eventObject');

                        // we need to copy it, so that multiple events don't have a reference to the same object
                        var copiedEventObject = $.extend({}, originalEventObject);

                        // assign it the date that was reported
                        copiedEventObject.start = date;
                        copiedEventObject.allDay = allDay;
                        copiedEventObject.backgroundColor = $(this).css("background-color");
                        copiedEventObject.borderColor = $(this).css("border-color");

                        // render the event on the calendar
                        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                        // is the "remove after drop" checkbox checked?
                        if ($('#drop-remove').is(':checked')) {
                            // if so, remove the element from the "Draggable Events" list
                            $(this).remove();
                        }

                    }
                });

			//Function to Check All CheckBox on New Datatables(ichecker)
        //By Farveen

        $('.checkall').on('ifChecked', function(event){
       // 	alert('hi');
			 $('.ichecker').prop('checked', true);
			 $('input').iCheck('update');
			});
			
			$('.checkall').on('ifUnchecked', function(event){
			  $('.ichecker').prop('checked', false);
			  $('input').iCheck('update');
			});
			


       
       /*// To Check/Uncheck Meeting Invitees(For SMS)
		  // By Radhu
        $('#checkall_sms').on('ifChecked', function(event){
			 $('.ichecker').prop('checked', true);
			 $('input').iCheck('update');
			});
			
			$('#checkall').on('ifUnchecked', function(event){
			  $('.ichecker').prop('checked', false);
			  $('input').iCheck('update');
			});*/
			
	 // To count remaining characters allowed in a text-area (bulk sms modal)
	 // By Sajeev
    var totalChars      = 306; //Total characters allowed in text-area
    var countTextBox    = $('#sms_message') // Text-area input box
    var charsCountEl    = $('#sms_count'); // Remaining chars count will be displayed here
   
    charsCountEl.text(totalChars); //initial value of sms_count element
    countTextBox.keyup(function() { 
        var thisChars = this.value.replace(/{.*}/g, '').length; //get chars count in text-area
        if(thisChars > totalChars) //if we have more chars than it should be
        {
            var CharsToDel = (thisChars-totalChars); // total extra chars to delete
            this.value = this.value.substring(0,this.value.length-CharsToDel); //remove excess chars from text-area
        }else{
            charsCountEl.text( totalChars - thisChars ); //count remaining chars
        }
    });			
			
	
			
  //Lijiya babu
  //to clean the data in the fields in pop up
/*$('.modal').on('hidden.bs.modal', function (e) {

       $('.error').remove();		
		 $(this)
		.find("input,textarea,select")
		.val('')
		.end()
		.find("input[type=checkbox], input[type=radio]")
		.prop("checked", "")
		.end();
	});*/ 
	
	//lijiya
  //to close the close button and X
$('.for_modal').click(function () {
     if($('.modal').hasClass('in'))
      {
	       var add= $(this).attr('data-val'); //val of cancel
	       if(add==1){
             $('.modal').hide();
             
             window.history.back()
	       }
      }else{
	   }
    }); 	
    
    
   //function to hide crop and zoom in/out button
   //lijiya babu 
      $("#btnCrop").hide();
      $("#btnZoomIn").hide();
      $("#btnZoomOut").hide();
      $("#crp").hide();
		$('#file').change(function () {
    	    var val=$('#file').val();
    	    if(val!=''){
    	         $("#btnCrop").css("display","block");
               $("#btnZoomIn").css("display","block");
               $("#btnZoomOut").css("display","block");
               $("#crp").css("display","block");
    	    }
    	     
    	});
    	
    	
    	
			
}); // End Ready Function


