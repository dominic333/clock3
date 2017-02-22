/**
 * Created by Dell on 23-Feb-17.
 */

$(function() {

    var dateArray =[]
    $('#wrapper .version strong').text('v' + pignoseCalendar.VERSION);
    // Toggle type Calendar
    $('.toggle-calendar').pignoseCalendar({
        toggle: true,
        select: function(date, obj) {
            var selDate= date[0].format('YYYY-MM-DD');
            if(jQuery.inArray(selDate, dateArray) != -1) {
                dateArray = jQuery.grep(dateArray, function(value) {
                    return value != selDate;
                });
                //console.log(dateArray);
            } else {
                dateArray.push(selDate);
                //console.log(dateArray);
            }
            var $target = obj.calendar.parent().next().show().html('You selected ' +
                (date[0] === null? 'null':date[0].format('YYYY-MM-DD')) +
                '.' +
                '<br /><br />' +
                '<strong>Active dates</strong><br /><br />' +
                '<div class="active-dates"></div>');

            for(var idx in obj.storage.activeDates) {

                var date = obj.storage.activeDates[idx];
                //console.log(date);
                //dateArray.push(date);
                if(typeof date !== 'string') {
                    continue;
                }
                $target.find('.active-dates').append('<span class="ui label default">' + date + '</span>');
            }

        }

    });


    //Form to validate leave management and place leave request
    //Dominic, Feb 21,2017
    $('#formLeaveRequest2').validate(
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
                var leaveType = $.trim($("#formLeaveRequest2 #leavetype").val());
                var leaveNote = $.trim($("#formLeaveRequest2 #leaveNote").val());
                var leaveDates = dateArray;

                //alert(dateArray);

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

                        $('#formLeaveRequest2')[0].reset();
                    }
                });//end of ajax
            }
        });


});
