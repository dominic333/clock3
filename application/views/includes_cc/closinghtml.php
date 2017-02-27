
<script type="text/javascript">
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
		
		$(document).ready(function(){
	
			$(document).on('click','#clearAllNotificationsLink',function (e) 
			{
				e.preventDefault();
				//alert('hi');
				  var post_url = base_url+"ccdashboard/dashboard/markAllNotificationsAsRead";
			 	  $.ajax({
					 url: post_url,
					 data:
					 {
						 csrf_test_name : csrf_token
					 },
					 type: "POST",
					 dataType: 'HTML',
					 success: function(result)
				    {
						if(result == 'true')
						{
							$('.activeNotifications').remove();
							$('#countNotification1').html('0');
							$('#countNotification2').html('You have 0 notifications');
						}
						else 
						{
						 alert('Sorry try again');
						}
					  	
				    }
			    });//end of ajax 
			}); 	
		
		});
</script>
</body>

</html>