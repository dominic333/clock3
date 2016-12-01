
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
			
			console.log(announcementId);
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
        
});