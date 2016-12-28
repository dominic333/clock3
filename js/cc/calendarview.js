    $(function () {

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
        //fetchCalenderAttendance(dateofMonth);
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
            //Random default events
            events: [
                {
                    title: 'Absent',
                    start: new Date(y, m, 1),
                    backgroundColor: "#f56954", //red
                    borderColor: "#f56954" //red
                },
                {
                    title: 'Holiday',
                    start: new Date(y, m, d - 5),
                    end: new Date(y, m, d - 2),
                    backgroundColor: "#00c0ef", //Info (aqua)
                    borderColor: "#00c0ef" //Info (aqua)
                },
                {
                    title: 'Late by : 00:10:41',
                    start: new Date(y, m, 2),
                    backgroundColor: "#f39c12", //yellow
                    borderColor: "#f39c12" //yellow
                },
                {
                    title: 'On Time',
                    start: new Date(y, m, d + 2, 19, 0),
                    end: new Date(y, m, d + 1, 22, 30),
                    allDay: false,
                    backgroundColor: "#00a65a", //Success (green)
                    borderColor: "#00a65a" //Success (green)
                }
            ],
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
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
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
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
    });
    
    
    function fetchCalenderAttendance(dateofMonth)
    {
    	 var date	=	dateofMonth;
		 var post_url = base_url+"ccattendance/attendance/fetchMonthlyAttendance";
		 
	 	 $.ajax({
		 url: post_url,
		 data:{dateofMonth:date,csrf_test_name:csrf_token},
		 type: "POST",
		 dataType: 'JSON',
		 beforeSend: function ( xhr ) 
		 {
	         //Add your image loader here
	         $('#loading').show(); 
	    },
		 success: function(result)
	    { 
	    	$('#loading').hide(); 
	      var event= result;
	      $('#calendar').fullCalendar( 'renderEvent', event, true);
	       //$('#calendar').fullCalendar( 'updateEvent', event );
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