$(document).ready(function(){

    //Custom rule; letters only
    $.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z\s]+$/i.test(value);
    }, "Please enter only letters");


    //To remove readonly and disabled attributes from edit company info form on edit button click
    $("#editProfileBtn").click(function (e) {
        $("#editProfileForm .readOnlyApplied").prop("readonly", false);
        $("#editProfileForm .disabledApplied").prop("disabled", false);
    });


    //Form validation: Edit User Profile info
    //By Dominic; Dec 11,2016
    $('#editProfileForm').validate(
        {
            rules:
            {
                fullName:
                {
                    required: true,
                    lettersonly: true
                },
                loginName:
                {
                    required: true
                },
                email:
                {
                    email: true,
                    required: true
                },
                contactNumber:
                {
                    number: true,
                    required:true,
                    maxlength:12
                }

            },
            highlight: function(element)
            {
                $(element).closest('.form-control').removeClass('success').addClass('error');
            },
            success: function(element)
            {

                $(element).closest('.form-control').removeClass('error').addClass('success');
            }
        });

});