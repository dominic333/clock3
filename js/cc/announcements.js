
$(document).ready(function(){    	
    	
        $("#announcementsTable").DataTable();
        /*
        $('#announcementsTable').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
        */
     
		//Function to edit an announcement
		//By Dominic; Dec 01,2016
		$(document).on('click','.editThisAnnouncement',function (e) 
		{
			e.preventDefault();
			$('#editAnnouncementForm')[0].reset();
			var announcementId		=		$(this).attr("data-announcementId");
			var announcementTitle	=		$(this).attr("data-announcementTitle");
			var announcementMsg		=		$(this).attr("data-announcementMsg");
			
		   $('#editAnnouncementForm #ancId').val(announcementId);
		   $('#editAnnouncementForm #title').val(announcementTitle);
		   $('#editAnnouncementForm #message').val(announcementMsg);
		   $('#editAnnouncementModal').modal('show');  
		});     
		     
      //Form validation: edit an announcement
		//By Dominic; Dec 01,2016 
		$('#editAnnouncementForm').validate(
		 {
		  rules: 
		  {
		     ancId: 
		     {
			     required: true
			  }, 
		     title:
			  {
		    	 required: true
		     },
		     message:
			  {
		    	 required:true
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
		
		//Form validation: add an announcement
		//By Dominic; Dec 01,2016 
		$('#addAnnouncementForm').validate(
		 {
		  rules: 
		  {
		     title:
			  {
		    	 required: true
		     },
		     message:
			  {
		    	 required:true
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
		
		//Function to delete an announcement
		//By Dominic; Dec 05,2016
		$(document).on('click','.deleteThisAnnouncement',function (e) 
		{
			e.preventDefault();
			var announcementId		=		$(this).attr("data-announcementId");
			if(announcementId)
			{
				$.confirm({
			    title: 'Confirm!',
			    content: 'Are you sure you wanna delete this?',
			    confirm: function()
			    {
			     	//alert(announcementId); 
			     	var post_url = base_url+"ccannouncements/announcements/deleteAnnouncement";
				 	$.ajax({
					   url: post_url,
					   data: {announcementId :announcementId,csrf_test_name : csrf_token},
					   type: "POST",
					   dataType: 'HTML',
					   beforeSend: function ( xhr ) 
					   {  
			            $('#loading').show(); 
			         },
					   success: function(result)
					   { 
					   	$('#loading').hide(); // Ajax Loader Show		
					   	$('#row'+announcementId).remove();
					   				   	
					   }	
					});//end of ajax
  
			    },
			    cancel: function()
			    {
			        
			    }
			  });
			}

		}); 
		
		
		
		//Function to show latest announcement details on a modal popup (in dashboard)
		//By Dominic; Dec 05,2016
		$(document).on('click','.latestAnnouncementClass',function (e) 
		{
			e.preventDefault();
			var description		=		$(this).attr("data-description");
			var postedDate			=		$(this).attr("data-postedDate");
			var title				=		$(this).attr("data-title");
			
		   $('#latestAnnouncementTitle').html(title);
		   $('#latestAnnouncementPostedDate').html(postedDate);
		   $('#latestAnnouncementMsg').html(description);
		   $('#latestAnnouncementInfo').modal('show');  
		}); 
        
});