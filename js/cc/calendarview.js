    $(function () {
$('#timepicker1').timepicker({
	showMeridian:false,      showInputs: false,
	});

        /* initialize the external events
         -----------------------------------------------------------------*/
        function ini_events(ele) {
            ele.each(function () {

                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                };

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 1070,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });

            });
        }

        ini_events($('#external-events div.external-event'));

        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date();
        var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear();
        var dateofMonth=y+'-'+m+'-'+d;
        var date	=	dateofMonth;
        var events = [];
        var eventsCache = {};
		  var clickedCalendarDate= '';
   	  var today = moment();
		  var todayDate = today.format("YYYY-MM-DD");
		  var tomorrow = today.add(1, 'days').format("YYYY-MM-DD");
		  var haystack = [ "Medical Leave", "Casual Leave", "Annual Leave" ];
		  
		 //console.log(today);
		 //console.log(tomorrow);
        //fetchCalenderAttendance(dateofMonth);
        
//-------------------------------------------------------------------------------------------------------------------------- // 
        //My Calendar
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next',
                center: 'title',
                right: 'month'
            },
            buttonText: {
                today: 'today',
                month: 'month'
            },
            /*
            eventRender: function(event, element) {
                 //$(element).tooltip({title: event.loc ,placement:'bottom' });  
                 $(element).tooltip({title: event.loc,container: "body"});                   
            },	 
            */
        eventMouseover: function (data, event, view) {
				//if(data.intime)
				//if (typeof data.intime != 'undefined')
				if(data.intime.toLowerCase()!='undefined')
				 {
				 	var inVar = data.intime;
				 }
				 else
				 {
				 	var inVar = 'NA';
				 }
				 
				 //if(data.outtime)
				 //if (typeof data.outtime != 'undefined')
				 if(data.outtime.toLowerCase()!='undefined')
				 {
				 	var outVar = data.outtime;
				 }
				 else
				 {
				 	var outVar = 'NA';
				 }
            tooltip = '<div class="tooltiptopicevent" style="width:auto;height:auto;background:#feb811;position:absolute;z-index:10001;padding:10px 10px 10px 10px ;  line-height: 200%;">' 
            				+ 'In ' + ': ' + data.intime + '</br>' + 'Out ' + ': ' + data.outtime + '</div>';


            $("body").append(tooltip);
            $(this).mouseover(function (e) {
                $(this).css('z-index', 10000);
                $('.tooltiptopicevent').fadeIn('500');
                $('.tooltiptopicevent').fadeTo('10', 1.9);
            }).mousemove(function (e) {
                $('.tooltiptopicevent').css('top', e.pageY + 10);
                $('.tooltiptopicevent').css('left', e.pageX + 20);
            });


        },
        eventMouseout: function (data, event, view) {
            $(this).css('z-index', 8);

            $('.tooltiptopicevent').remove();

        },
        dayClick: function () {
            //tooltip.hide()
        },
        eventResizeStart: function () {
            //tooltip.hide()
        },
        eventDragStart: function (calEvent, jsEvent, view) {
            //tooltip.hide()
 
        },
        viewDisplay: function () {
            //tooltip.hide()
        },  	
            events: function(start, end, timezone, callback) {
            	
             //have we already cached this time?
		        if (events.eventsCache 
		            && events.eventsCache[start.toString + "-" + end.toString]){
		
		                    //if we already have this data, pass it to callback()
		            callback(eventsCache[start.toString + "-" + end.toString]);
		            return;
		        }
		        
             var date = $('#calendar').fullCalendar('getDate');			    
			    obtanied	= date._d;
			    obtaniedDate	= obtanied.toString();
			    //console.log(obtaniedDate);
			    dateofMonth	= convert(obtaniedDate);
     	       var post_url = base_url+"ccattendance/attendance/fetchMonthlyAttendance";
		            $.ajax({
		            url: post_url,
		            type: "POST",
		            dataType: 'json',
		            cache: true,
		            data: {
		                dateofMonth:dateofMonth,
		                csrf_test_name : csrf_token
		            }, 
                        beforeSend: function ( xhr )
                        {
                            //Add your image loader here
                            showLoader();
                        },
		            success: function(result) {
                        hideLoader();
		            	 var events = [];
		            	//if (!events.eventsCache)
                      //events.eventsCache = {};

            			//store your data
            			//eventsCache[start.toString + "-" + end.toString] = result;
            
		                $.each(result.attendance,function(index,res) 
		                   {
		                   	var date = (res.start).split('-'); //To get date,month  and year separately
		                   	events.push({
		                   		
		                    	   title:  res.title,
		                    	   loc: res.title,
		                    	   start:res.start,
		                    	   end:res.end,
		                    	   intime:res.intime,
		                    	   outtime:res.outtime,
		                        allDay: true,
		                        //url: base_url+'admin/meetings/view/'+meeting.id,
		                        color: res.borderColor					                    
		                        });
		                   });
		                   
		                 $.each(result.leaves,function(index,res) 
		                   {
		                   	var date = (res.start).split('-'); //To get date,month  and year separately
		                   	events.push({
		                   		
		                    	   title:  res.title,
		                    	   loc: res.title,
		                    	   start:res.start,
		                    	   end:res.end,
		                    	   intime:res.intime,
		                    	   outtime:res.outtime,
		                        allDay: true,
		                        //url: base_url+'admin/meetings/view/'+meeting.id,
		                        color: res.borderColor					                    
		                        });
		                   });
		                callback(events);
		             }
		          });
		        },
            editable: false,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            
            drop: function (date, allDay) { // this function is called when something is dropped

                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');
                var leave					 =	$(this).attr("data-leave");
                var leaveType				 =	$(this).attr("data-leavetype");
                var droppedDate			 = date.format();
					 //console.log("Dropped on " + date.format()); //2017-01-02
					 if((leave=="leave") && (droppedDate > todayDate))
					 {
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
	                
						 requestLeave(droppedDate,leaveType);
	                
	                // is the "remove after drop" checkbox checked?
	                if ($('#drop-remove').is(':checked')) {
	                    // if so, remove the element from the "Draggable Events" list
	                    $(this).remove();
	                }					 					 
					 }
            },
            /* This constrains it to today or later */
            eventConstraint: {
                start: tomorrow,
                end: '2100-01-01' // hard coded goodness unfortunately
            },
            eventRender: function(event, element) {
		        if (event.clock == 'attendance') {
		              element.draggable = false;
		              element.editable = false;
		        } 
		     },
	        eventClick: function(calEvent, jsEvent, view)
	        {
	        	  
	        	  var needle   = calEvent.title;
              var found = $.inArray(needle, haystack);
				  
				  var dt = calEvent.start;
      		  var droppedDate= (dt.format()); 
      		  if((droppedDate > todayDate)){
				  if(found != -1)
				  {
				    var r=confirm("Cancel " + calEvent.title);
              	 if (r===true)
              	 {
              	 	 var post_url = base_url+"selfieattendance/attendance/removeRequestedLeave";
		 
					 	 $.ajax({
						 url: post_url,
						 data:{dateofMonth:droppedDate,leaveType:needle,csrf_test_name:csrf_token},
						 type: "POST",
						 dataType: 'JSON',
						 beforeSend: function ( xhr ) 
						 {
					         //Add your image loader here
				            // showLoader();
					    },
						 success: function(result)
					    {
				            //hideLoader();
				            if(result=='deleted')
				            {
				            	$('#calendar').fullCalendar('removeEvents', calEvent._id);
								}
								else
								{
									alert('Unable to discard leave request. Try again');
								}
					    }
					   });//end of ajax 
                  
              	 }
				  } //found if
				 }
	        }
        });

        /* ADDING EVENTS */
        var currColor = "#3c8dbc"; //Red by default
        //Color chooser button
        var colorChooser = $("#color-chooser-btn");
        $("#color-chooser > li > a").click(function (e) {
            e.preventDefault();
            //Save color
            currColor = $(this).css("color");
            //Add color effect to button
            $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
        });
        $("#add-new-event").click(function (e) {
            e.preventDefault();
            //Get value and make sure it is not null
            var val = $("#new-event").val();
            if (val.length == 0) {
                return;
            }

            //Create events
            var event = $("<div />");
            event.css({
                "background-color": currColor,
                "border-color": currColor,
                "color": "#fff"
            }).addClass("external-event");
            event.html(val);
            $('#external-events').prepend(event);

            //Add draggable funtionality
            ini_events(event);

            //Remove event from text input
            $("#new-event").val("");
        });
        
         /*
          $('.fc-corner-left').click(function() {
			    //$('#calendar').fullCalendar('prev');
			    var date = $('#calendar').fullCalendar('getDate');			    
			    obtanied	= date._d;
			    obtaniedDate	= obtanied.toString();
			    //console.log(obtaniedDate);
			    //tempString1	= removeBefore(obtaniedDate);
			    //tempString2	= removeAfter(tempString1);
			    dateofMonth	= convert(obtaniedDate);
			    if(dateofMonth)
			    {
			    	fetchCalenderAttendance(dateofMonth);
			    }
			    //console.log(dateofMonth);
			  });
			
			  $('.fc-corner-right').click(function() {
			    var date = $('#calendar').fullCalendar('getDate');
			    obtanied	= date._d;
			    obtaniedDate	= obtanied.toString();
			    //console.log(obtaniedDate);
			    //tempString1	= removeBefore(obtaniedDate);
			    //tempString2	= removeAfter(tempString1);
			    dateofMonth	= convert(obtaniedDate);
			    if(dateofMonth)
			    {
			    	fetchCalenderAttendance(dateofMonth);
			    }
			    //console.log(dateofMonth);
			  });
			  */


//-------------------------------------------------------------------------------------------------------------------------- // 
        //Staff Calendar Attendance Starts
        $('#staffCalendar').fullCalendar({

            header: {
                left: 'prev,next',
                center: 'title',
                right: 'month'
            },
            buttonText: {
                today: 'today',
                month: 'month'
            },
            eventClick: function(calEvent, jsEvent, view)
	        	{
//	        	  console.log(calEvent);
	        	  var needle   = 	calEvent.title;
	        	  var user 		= 	$('#users').val();
	        	  var clock		= 	'Late by';
				  var found		=  needle.indexOf(clock);
				  var intime	= 	calEvent.intime;
				  var outtime	=	calEvent.outtime;
				
					
				 /* $.each(clock, function(index, value){
					    	   var found1 =  needle.indexOf(value);
					        if (found1 !== -1){
					            console.log('found in array '+index, value);
					            found = 1;
					            }
					});              
              
              */
              
              
				  var date		= calEvent.start;
				  var  obtained	= date._d;

			     var logdate	= obtained.toString();
			     
			     

			     var dateofMonth	= convert(logdate);
				$('#attendance_frm')[0].reset();

				 if(found !== -1)
				  {

						$('#logdate').val(dateofMonth);
						$('#intime').val(intime);
						$('#outtime').val(outtime);
				  		$('#userid').val(user);
				  		$('#attendance_modal').modal('show');
						
				  }
				  
//				  fetchCalenderAttendance(dateofMonth,user);
//found if
				 },
            /*
             eventRender: function(event, element) {
             //$(element).tooltip({title: event.loc ,placement:'bottom' });
             $(element).tooltip({title: event.loc,container: "body"});
             },
             */
            eventMouseover: function (data, event, view) {
					 
					 //console.log(data);
					 //if (typeof data.intime != 'undefined')
					 if(data.intime.toLowerCase()!='undefined')
					 {
					 	var inVar = data.intime;
					 }
					 else
					 {
					 	var inVar = 'NA';
					 }
					 
					 if(data.outtime.toLowerCase()!='undefined')
					 {
					 	var outVar = data.outtime;
					 }
					 else
					 {
					 	var outVar = 'NA';
					 }
					 
                tooltip = '<div class="tooltiptopicevent" style="width:auto;height:auto;background:#feb811;position:absolute;z-index:10001;padding:10px 10px 10px 10px ;  line-height: 200%;">'
                    + 'In ' + ': ' + inVar + '</br>' + 'Out ' + ': ' + outVar + '</div>';


                $("body").append(tooltip);
                $(this).mouseover(function (e) {
                    $(this).css('z-index', 10000);
                    $('.tooltiptopicevent').fadeIn('500');
                    $('.tooltiptopicevent').fadeTo('10', 1.9);
                }).mousemove(function (e) {
                    $('.tooltiptopicevent').css('top', e.pageY + 10);
                    $('.tooltiptopicevent').css('left', e.pageX + 20);
                });


            },
            eventMouseout: function (data, event, view) {
                $(this).css('z-index', 8);

                $('.tooltiptopicevent').remove();

            },
            dayClick: function () {
                tooltip.hide()
            },
            eventResizeStart: function () {
                tooltip.hide()
            },
            eventDragStart: function () {
                tooltip.hide()
            },
            viewDisplay: function () {
                tooltip.hide()
            },
            events: function(start, end, timezone, callback) {

                //have we already cached this time?
                if (events.eventsCache
                    && events.eventsCache[start.toString + "-" + end.toString]){

                    //if we already have this data, pass it to callback()
                    callback(eventsCache[start.toString + "-" + end.toString]);
                    return;
                }

                var selectedStaff = $('#users').val();
                //console.log(selectedStaff);
                var date = $('#staffCalendar').fullCalendar('getDate');
                obtanied	= date._d;
                obtaniedDate	= obtanied.toString();
                //console.log(obtaniedDate);
                dateofMonth	= convert(obtaniedDate);
                var post_url = base_url+"ccattendance/attendance/fetchStaffMonthlyAttendance";
                $.ajax({
                    url: post_url,
                    type: "POST",
                    dataType: 'json',
                    cache: true,
                    data: {
                        user: selectedStaff,
                        dateofMonth:dateofMonth,
                        csrf_test_name : csrf_token
                    },
                    beforeSend: function ( xhr )
                    {
                        //Add your image loader here
                        showLoader();
                    },
                    success: function(result) {
                        hideLoader();
                        var events = [];
                        if (!events.eventsCache)
                            events.eventsCache = {};

                        //store your data
                        eventsCache[start.toString + "-" + end.toString] = result;

                        $.each(result,function(index,res) 
                        {
                            var date = (res.start).split('-'); //To get date,month  and year separately
                            events.push({

                                title:  res.title,
                                loc: res.title,
                                start:res.start,
                                end:res.end,
                                intime:res.intime,
                                outtime:res.outtime,
                                allDay: true,
                                //url: base_url+'admin/meetings/view/'+meeting.id,
                                color: res.borderColor
                            });
                        });

                        callback(events);
                    }
                });
            },
            editable: false,
            droppable: false, // this allows things to be dropped onto the calendar !!!
            drop: function (date, allDay) { // this function is called when something is dropped

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
                $('#staffCalendar').fullCalendar('renderEvent', copiedEventObject, true);

                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
            }
        });

        $('#users').change(function() {

            var date = $('#staffCalendar').fullCalendar('getDate');
            obtanied	= date._d;
            obtaniedDate	= obtanied.toString();
            //console.log(obtaniedDate);
            //tempString1	= removeBefore(obtaniedDate);
            //tempString2	= removeAfter(tempString1);
            dateofMonth	= convert(obtaniedDate);

            var selectedStaff = $('#users').val();
            //console.log(selectedStaff);
            //console.log(dateofMonth);
            if(dateofMonth && selectedStaff)
            {
               fetchCalenderAttendance(dateofMonth,selectedStaff);
            }
            //console.log(dateofMonth);
        });
       //Staff Calendar Attebdance Ends
       
    });
 
//-------------------------------------------------------------------------------------------------------------------------- //    
    // New leave management begins
    var events = [];
    var eventsCache = {};

    var today = moment();
    var todayDate = today.format("YYYY-MM-DD");
    var tomorrow = today.add(1, 'days').format("YYYY-MM-DD");
    var haystack = [ "Medical Leave", "Casual Leave", "Annual Leave" ];
		  
    //Function for leave calendar
    var currentDateL = $('#leaveCalendar').fullCalendar('getDate');
    var leaveArray =[]; //array to store leaves
    $('#leaveCalendar').fullCalendar({
    defaultDate: currentDateL,
    header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month'
    },
    defaultView: 'month',
    //events: [],
    
            events: function(start, end, timezone, callback) {
            	
             //have we already cached this time?
		        if (events.eventsCache 
		            && events.eventsCache[start.toString + "-" + end.toString]){
		
		                    //if we already have this data, pass it to callback()
		            callback(eventsCache[start.toString + "-" + end.toString]);
		            return;
		        }
		        
             var date = $('#leaveCalendar').fullCalendar('getDate');			    
			    obtanied	= date._d;
			    obtaniedDate	= obtanied.toString();
			    //console.log(obtaniedDate);
			    dateofMonth	= convert(obtaniedDate);
     	       var post_url = base_url+"ccattendance/attendance/fetchMonthlyLeaveAttendance";
		            $.ajax({
		            url: post_url,
		            type: "POST",
		            dataType: 'json',
		            cache: true,
		            data: {
		                // our hypothetical feed requires UNIX timestamps
		                //start: start.unix(),
		                //end: end.unix(),
		                dateofMonth:dateofMonth,
		                csrf_test_name : csrf_token
		            }, 
                        beforeSend: function ( xhr )
                        {
                            //Add your image loader here
                            showLoader();
                        },
		            success: function(result) {
                        hideLoader();
		            	 var events = [];
		            	//if (!events.eventsCache)
                      //events.eventsCache = {};

            			//store your data
            			//eventsCache[start.toString + "-" + end.toString] = result;
            
		                $.each(result.attendance,function(index,res) 
		                   {
		                   	var date = (res.start).split('-'); //To get date,month  and year separately
		                   	events.push({
		                   		
		                    	   title:  res.title,
		                    	   loc: res.title,
		                    	   start:res.start,
		                    	   end:res.end,
		                    	   intime:res.intime,
		                    	   outtime:res.outtime,
		                        allDay: true,
		                        //url: base_url+'admin/meetings/view/'+meeting.id,
		                        color: res.borderColor					                    
		                        });
		                   });
		                   
		                 $.each(result.leaves,function(index,res) 
		                   {
		                   	var date = (res.start).split('-'); //To get date,month  and year separately
		                   	events.push({
		                   		
		                    	   title:  res.title,
		                    	   loc: res.title,
		                    	   start:res.start,
		                    	   end:res.end,
		                    	   intime:res.intime,
		                    	   outtime:res.outtime,
		                        allDay: true,
		                        //url: base_url+'admin/meetings/view/'+meeting.id,
		                        color: res.borderColor					                    
		                        });
		                   });
		                callback(events);
		             }
		          });
		        },    
    
    selectable: true,
    select: function (start, end, jsEvent, view) {

	    if (moment().diff(start, 'days') > 0) {
	      $('#leaveCalendar').fullCalendar('unselect');
	      return false;
	    }
	
	    var dateL = $('#leaveCalendar').fullCalendar('getDate');
	    obtaniedL = dateL._d;
	    obtaniedDateL = obtaniedL.toString();
	    
	    dateofMonthL = convert(obtaniedDateL);
	    var date = start.format();
	    
	    if (date > dateofMonthL) {
	    	
	      $("#leaveCalendar").fullCalendar('addEventSource', [{
	        start: start,
	        end: end,
	        rendering: 'background',
	        block: true,
	      }, ]);
	     leaveArray.push(date);
	     //console.log(leaveArray);
	    }
	    else
	    {
	      $("#leaveCalendar").fullCalendar("unselect");
	    }        
        
    },
    selectOverlap: function(event) {
        return ! event.block;
    }
   });
   
      //Form to validate leave management and place leave request
      //Dominic, Feb 21,2017
      $('#formLeaveRequest').validate(
		 {
		  rules: 
		  {		    
		     leaveNote: 
		     {
			     required: true
			  }, 
		     leavetype: 
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
			},
			 submitHandler: function(form) 
			 {
			 	  var post_url = base_url+"selfieattendance/attendance/applyForLeave";
			 	  var leaveType = $.trim($("#formLeaveRequest #leavetype").val()); 
			 	  var leaveNote = $.trim($("#formLeaveRequest #leaveNote").val()); 
			 	  var leaveDates = leaveArray; 
			 	  $.ajax({
					 url: post_url,
					 data: 
					 {
						leaveType : leaveType,
						leaveNote : leaveNote,
						leaveDates : leaveDates,
						csrf_test_name : csrf_token
					 },
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
				      
				      if(result=="success")
				      {
				      	$.alert({
							    title: 'Leaves Applied!',
							    content: 'Your leave request has been placed.',
							    confirm: function(){
							        
							    }
							});
				      }
				      else if(result=="failed")
				      {
				      	$.alert({
							    title: 'Sorry!',
							    content: 'Unable to process your leave request. Please try again',
							    confirm: function(){
							        
							    }
							});
				      }
				      
					  	$('#formLeaveRequest')[0].reset();					  	
				    }
			    });//end of ajax 
			 }
		});
   
   // New leave management ends
//-------------------------------------------------------------------------------------------------------------------------- //  


    //Function to request a leave (not in use)
    function requestLeave(droppedDate,leaveType)
    {
		 var post_url = base_url+"selfieattendance/attendance/requestLeave";
		 
	 	 $.ajax({
		 url: post_url,
		 data:{dateofMonth:droppedDate,leaveType:leaveType,csrf_test_name:csrf_token},
		 type: "POST",
		 dataType: 'JSON',
		 beforeSend: function ( xhr ) 
		 {
	         //Add your image loader here
            // showLoader();
	    },
		 success: function(result)
	    {
            //hideLoader();
            if(result=='success')
            {
            	alert('Leave Request Placed');
				}
				else
				{
					alert('Unable to place leave request. Try again');
				}
	    }
	   });//end of ajax     
    }
    
    
    function fetchCalenderAttendance(dateofMonth,selectedStaff)
    {
       var events = [];
       var eventsCache = {};
    	 var date	=	dateofMonth;
		 var post_url = base_url+"ccattendance/attendance/fetchStaffMonthlyAttendance";
		 
	 	 $.ajax({
		 url: post_url,
		 data:{dateofMonth:date,csrf_test_name:csrf_token,user:selectedStaff},
		 type: "POST",
		 dataType: 'JSON',
		 beforeSend: function ( xhr ) 
		 {
	         //Add your image loader here
             showLoader();
	    },
		 success: function(result)
	    {
            hideLoader();
            $.each(result,function(index,res) 
            {
                var date = (res.start).split('-'); //To get date,month  and year separately
                events.push({

                    title:  res.title,
                    loc: res.title,
                    start:res.start,
                    end:res.end,
                    intime:res.intime,
                    outtime:res.outtime,
                    allDay: true,
                    //url: base_url+'admin/meetings/view/'+meeting.id,
                    color: res.borderColor
                });
            });
            $('#staffCalendar').fullCalendar('removeEvents');
            $('#staffCalendar').fullCalendar('removeEventSource', events);
            $('#staffCalendar').fullCalendar('addEventSource', events);
	       //var event= result;
	       //$('#staffCalendar').fullCalendar( 'renderEvent', events, true);
	       //$('#staffCalendar').fullCalendar( 'updateEvent', events );
	    }
	   });//end of ajax 
    }
    
    
    function removeBefore(str)
    {
		s = str.substring(str.indexOf("{") + 1);
   	return s;
    }
    
    
    function removeAfter(str)
    {
    	s = str.substring(0, str.indexOf('}')); 
    	return s;
    }
    
    function convert(str) 
    {
	    var mnths = { 
	        Jan:"01", Feb:"02", Mar:"03", Apr:"04", May:"05", Jun:"06",
	        Jul:"07", Aug:"08", Sep:"09", Oct:"10", Nov:"11", Dec:"12"
	    },
	    date = str.split(" ");
	
	    return [ date[3], mnths[date[1]], date[2] ].join("-");
	 }