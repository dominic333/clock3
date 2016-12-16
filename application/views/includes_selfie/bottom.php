
</div>
<!--col-lg-8-->

</div>
<!-- /.row -->

<?php $this->load->view('includes_selfie/footer'); ?>


</div>
<!-- /.container -->

<!--kevin@mynotepedia.com-->
<!--kevinmaulana1991@gmail.com-->

<!--=====================ALL JS in here======================-->

<!-- jQuery -->
<script src="<?php echo base_url();?>assets/snap/theme/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url();?>assets/snap/theme/js/bootstrap.min.js"></script>

<script src="<?php echo base_url();?>assets/snap/theme/js/app.min.js"></script>

<!-- DataTables -->
<script src="<?php echo base_url();?>assets/snap/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/snap/plugins/datatables/dataTables.bootstrap.min.js"></script>

<!-- datepicker -->
<script src="<?php echo base_url();?>assets/snap/plugins/datepicker/bootstrap-datepicker.js"></script>

<!-- bootstrap time picker -->
<script src="<?php echo base_url();?>assets/snap/plugins/timepicker/bootstrap-timepicker.min.js"></script>

<script  src="<?php echo base_url();?>assets/common/jquery.validate.min.js"  ></script>
<script src="<?php echo base_url();?>assets/common/jquery-confirm.min.js" type="text/javascript"></script>
<script>

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