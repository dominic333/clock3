
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
</script>
</body>

</html>