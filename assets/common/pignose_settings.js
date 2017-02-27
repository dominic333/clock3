/**
 * Created by Dell on 23-Feb-17.
 *Modified by gayatri - disable past days  and non-working days
 */

$(function () {

    var dateArray = [];
    $('#wrapper .version strong').text('v' + pignoseCalendar.VERSION);
    // Toggle type Calendar
    /*
     var post_url = base_url+"selfieattendance/attendance/getNonWorkingDays";
     var offDays = [] ;
     $.ajax({

     url:post_url,
     data:
     {
     csrf_test_name : csrf_token
     },
     type: "get",
     dataType: 'json' ,

     success: function (result) {

     $.each(result.days, function (i, d) {
     var date = new Date(d).toISOString().slice(0, 10);
     alert(date);
     offDays.push(date);
     });
     //a[0]= result.sunday

     //days.push(result);
     //console.log(result);
     }
     });

     */


    $('.toggle-calendar').pignoseCalendar({
        toggle: true,
        minDate: moment(),
        disabledWeekdays: [],
        select: function (date, obj) {
            var selDate = date[0].format('YYYY-MM-DD');
            if (jQuery.inArray(selDate, dateArray) != -1) {
                dateArray = jQuery.grep(dateArray, function (value) {
                    return value != selDate;
                });
                //console.log(dateArray);
            } else {
                dateArray.push(selDate);
                //console.log(dateArray);
            }
            var $target = obj.calendar.parent().next().show().html('<center><br>You selected<br><h3> ' +
                (date[0] === null ? 'null' : date[0].format('YYYY-MM-DD</h3></center>')) +
                '.' +
                '<br /><br />' +
                'Active dates<br /><br />' +
                '<div class="active-dates"></div><br />');

            for (var idx in obj.storage.activeDates) {

                var date = obj.storage.activeDates[idx];
                //console.log(date);
                //dateArray.push(date);
                if (typeof date !== 'string') {
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
            rules: {
                leaveNote: {
                    required: true
                },
                leavetype: {
                    required: true
                }
            },
            highlight: function (element) {
                $(element).closest('.control-group').removeClass('success').addClass('error');
            },
            success: function (element) {
                element
                    .text('').addClass('valid')
                    .closest('.control-group').removeClass('error').addClass('success');
            },
            submitHandler: function (form) {
                var post_url = base_url + "selfieattendance/attendance/applyForLeave";
                var leaveType = $.trim($("#formLeaveRequest2 #leavetype").val());
                var leaveNote = $.trim($("#formLeaveRequest2 #leaveNote").val());
                var leaveDates = dateArray;

                //alert(dateArray);

                $.ajax({
                    url: post_url,
                    data: {
                        leaveType: leaveType,
                        leaveNote: leaveNote,
                        leaveDates: leaveDates,
                        csrf_test_name: csrf_token
                    },
                    type: "POST",
                    dataType: 'HTML',
                    beforeSend: function (xhr) {
                        //Add your image loader here
                        showLoader();
                    },
                    success: function (result) {
                        hideLoader();
                        var result = result.trim();

                        if (result == "success") {
                            $.alert({
                                title: 'Leaves Applied!',
                                content: 'Your leave request has been placed.',
                                confirm: function () {

                                }
                            });
//                            alert("Leave Applied");

                        }
                        else if (result == "failed") {
                            $.alert({
                                title: 'Sorry!',
                                content: 'Unable to process your leave request. Please try again',
                                confirm: function () {

                                }
                            });
                        }

                        $('#formLeaveRequest2')[0].reset();
                        location.reload();
                    }
                });//end of ajax
            }
        });


});
