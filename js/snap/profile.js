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
        

		  $('#resetPassword1').validate({

				 	rules: {
				         	newPassword: { 
				           			required: true,
				           			min: 6

				        		 } , 
				
				             confirmPassword: { 

				                   	equalTo: "#resetPassword1 #newPassword"
	
				               }
				     },
				     messages:{
				     		      confirmPassword :" Enter Confirm Password Same as Password"
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

/**************************Reset Password*****************************/



$(document).on('click','#resetPassword',function (e) {
	e.preventDefault();
	$('#resetPasswordModal').modal('show');
	
});
$(document).on('click','#pswdSubmt',function (e) {
		e.preventDefault();
		var staff_id	= $(this).data('staff_id');
		var newPassword	=	$('#newPassword').val();
		//alert(newPassword);
		var url = base_url+"selfiemyaccount/account/resetPassword";
		$.ajax({
		
				   url: url,
				   data: {staff_id :staff_id,newPassword : newPassword,csrf_test_name : csrf_token},
				   type: "POST",
				   dataType: 'HTML',
				  
					success : function (result) {
					
								$('#resetPasswordModal').modal('hide');
								if(result == 'true')
								{
									
									alert('Successfully reset password');
									
								}
								else {
								
									//alert('Sorry try again');
								}					
					
					}
		
		
		});
	
	
	
		
});


/**********************************End of reset Password*****************************************/


$(document).on('click','#editPic',function (e) {
	e.preventDefault();
	$('#take_selfie_modal').modal('show');
	
});
$(document).on('click','#take_selfie_subt',function (e) {
	e.preventDefault();
	var staff_id	= $(this).data('staff_id');
	take_snapshot(staff_id);
	
});
	
Webcam.set({
	  width: 500,
     height: 400,
     dest_width: 500,
     dest_height: 400,
     image_format: 'jpeg',
     jpeg_quality: 90,
     force_flash: false
	});
	Webcam.attach( '#my_camera' );
	

 function take_snapshot(staff_id) {
	
		//http://stackoverflow.com/a/28309845/4119740
      var data_uri = Webcam.snap();
      var staffid  = staff_id;
      var image_fmt = 'jpeg';
      //var ctype = $("#vclocktype").val();
      if(data_uri!=true){
			var url = base_url+'selfiemyaccount/account/save_selfie';
			//document.getElementById('selfie-loader').style.display = 'block';
			var file =  data_uri;
	    	var formdata = new FormData();
	    	formdata.append("base64image", file);
	    	formdata.append('csrf_test_name',csrf_token);
	    	formdata.append('staffid',staffid);
	    	formdata.append('image_fmt',image_fmt);
	    	var ajax = new XMLHttpRequest();
	    	ajax.addEventListener("load", function(event) { uploadcomplete(event);}, false);
	    	ajax.open("POST", url);
	    	ajax.send(formdata);
	    }else{
	    	 $('#take_selfie_modal').modal('hide');
	    }

  }
  
  function uploadcomplete(event){
    var response	=	event.target.responseText.trim();
    //console.log(response);
    //document.getElementById('selfie-loader').style.display = 'none';
    if(response=='Failed'){
    	$('#take_selfie_modal').modal('hide');
    	alert('The Snap Shot Failed Please Contact your Administrator');
    	/*
    	$.alert({
	    title: 'Snap Shot Failed',
	    content: 'The Snap Shot Failed Please Contact your Administrator',
	    confirm: function(){
	       $('#take_selfie_modal').modal('hide');
	    },
	    cancel: function(){
	       $('#take_selfie_modal').modal('hide');
	    },
		});
		*/
    }else{
    	document.getElementById('my_selfie').src=base_url+'images/avatars/'+response;
    	$('#take_selfie_modal').modal('hide');
    	alert('The Snap Shot Updated Successfully');
    	/*
    	$.alert({
	    title: 'Snap Shot Success',
	    content: 'The Snap Shot Updated Successfully',
	    confirm: function(){
	    	  //document.getElementById('my_selfie').src=base_url+'images/avatars/'+response;
	       $('#take_selfie_modal').modal('hide');
	    },
	    cancel: function(){
	       $('#take_selfie_modal').modal('hide');
	    },
		});
		*/
    }
  }
