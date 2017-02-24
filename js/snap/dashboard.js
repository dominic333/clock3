$(document).ready(function(){

  		$("#announcementsTable").DataTable();

});

$(document).on('click','.markAnnouncement',function (e) 
{
		e.preventDefault();
		var announcementId		=		$(this).attr("data-announcementId");
		//alert(announcementId);
		
		var url = base_url+"selfiedashboard/dashboard/readAnnouncement";
		$.ajax({
		   url: url,
		   data: {announcementId :announcementId,csrf_test_name : csrf_token},
		   type: "POST",
		   dataType: 'HTML',
			success : function (result) 
			{
				if(result == 'OK')
				{
	   		  //$('#row'+announcementId).remove();
					location.reload();
				}
				else {
				
				}					
			}
		});
			
});