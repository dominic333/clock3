$(document).ready(function(){
						   
		//Initialize Select2 Elements
        $(".select2").select2();

		//Custom rule to check valid IP
		// By Sajeev (Nov 17,2015)
		$.validator.addMethod('validIP', function(value) {
		    var split = value.split('.');
		    if (split.length != 4) 
		        return false;
		            
		    for (var i=0; i<split.length; i++) {
		        var s = split[i];
		        if (s.length==0 || isNaN(s) || s<0 || s>255)
		            return false;
		    }
		    return true;
		}, ' Invalid IP Address');


     $("#example1").DataTable();
     $('#example2').DataTable({
         "paging": true,
         "lengthChange": false,
         "searching": false,
         "ordering": true,
         "info": true,
         "autoWidth": false
     });
     
     
//Member add ip address to white-list form validation
//Dominic, December 13  ,2016
$('#frm_add_department_ip').validate(
 {
  rules: {
  	/*
     department: 
     {
	     required: true,
	  },
	  */
	  department_ip:
	  {
	  	/*
	  	  remote: 
    	  {
				url: base_url+"admin/departments/check_department_ip_exist",
				type: "post",
				data: 
				{
					 department_ip: function(){ return $("#department_ip").val(); },
					 department: function(){ return $("#department").val(); },
					 csrf_test_name : csrf_token
				}
		  },
		  */
		  required: true,
	  	  validIP: true
	  }     
   },  
   /*   
   messages: 
   {
		department_ip: 
		 {
				remote: 'IP address already added'
		 }
   },  
   */         
	highlight: function(element) {
		  $(element).closest('.control-group').removeClass('success').addClass('error');
	 },
	 success: function(element) {
	  element
	 .text('').addClass('valid')
	 .closest('.control-group').removeClass('error').addClass('success');
	}
});     
     
//On Edit Whitelisted IP link click    
//Dominic, December 13  ,2016
$(document).on('click','.modify_whitelisted_ip',function (e) {
	e.preventDefault();
	$('#frm_edit_whitelisted_ip #whitelist_id').val($(this).data('whitelist_id'));
	$('#frm_edit_whitelisted_ip #department_ip').val($(this).data('whitelist_ip'));
	$('#modify_whitelisted_ip_modal').modal('show');
	
}); 
     
     
//Edit ip address to white-list form validation
//Dominic, December 13  ,2016
$('#frm_edit_whitelisted_ip').validate(
 {
  rules: {
  	/*
     department: 
     {
	     required: true,
	  },
	  */
	  department_ip:
	  {
	  	/*
	  	  remote: 
    	  {
				url: base_url+"admin/departments/check_department_ip_exist",
				type: "post",
				data: 
				{
					 department_ip: function(){ return $("#department_ip").val(); },
					 department: function(){ return $("#department").val(); },
					 csrf_test_name : csrf_token
				}
		  },
		  */
		  required: true,
	  	  validIP: true
	  }     
   },  
   /*   
   messages: 
   {
		department_ip: 
		 {
				remote: 'IP address already added'
		 }
   },  
   */         
	highlight: function(element) {
		  $(element).closest('.control-group').removeClass('success').addClass('error');
	 },
	 success: function(element) {
	  element
	 .text('').addClass('valid')
	 .closest('.control-group').removeClass('error').addClass('success');
	}
});     
     
  
  
		//Function to delete an announcement
		//By Dominic; Dec 05,2016
		$(document).on('click','.delete_whitelisted_ip',function (e) 
		{
			e.preventDefault();
			var wId		=		$(this).attr("data-whitelist_id");
			var wIP		=		$(this).attr("data-whitelist_ip");
			if(wId)
			{
				$.confirm({
			    title: 'Confirm!',
			    content: 'Are you sure you wanna delete this?',
			    confirm: function()
			    {
			     	//alert(announcementId); 
			     	var post_url = base_url+"ccshifts/shifts/deleteWhiteListedIP";
				 	$.ajax({
					   url: post_url,
					   data: {id :wId,ip:wIP,csrf_test_name : csrf_token},
					   type: "POST",
					   dataType: 'HTML',
					   beforeSend: function ( xhr ) 
					   {  
			            $('#loading').show(); 
			         },
					   success: function(result)
					   { 
					   	$('#loading').hide(); // Ajax Loader Show		
					   	$('#row'+wId).remove();
					   				   	
					   }	
					});//end of ajax
  
			    },
			    cancel: function()
			    {
			        
			    }
			  });
			}

		}); 
		   
     
});
