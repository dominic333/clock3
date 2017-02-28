
<!-- Content Wrapper. Contains page content -->

<div class="contentfirst">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Announcements
            <small>...</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>ccannouncements/announcements"><i class="fa fa-bullhorn"></i> Announcements</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">Posted Announcements</h3>
                        <!--<a href="#" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#addAnnouncementModal">Create Announcement <span
                                class="fa fa-plus-circle"
                                aria-hidden="true"></span></a>-->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="announcementsTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Date</th>
                                    <th>Title</th>
                                    <th>Snipet</th>
                                    <th width="70px">Read</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $i=1;
                                		foreach($listAnnouncement as $announcement)
                                		{
                                ?>
                                <tr id="<?php echo 'row'.$announcement->id; ?>">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $announcement->date; ?></td>
                                    <td><?php echo $announcement->title; ?></td>
                                    <td><?php echo $announcement->msg; ?></td>
                                    <td>
                                          <?php if($announcement->status!=1){  ?>
                                    		<a class="btn btn-primary btn-sm markAnnouncement" href="#" data-toggle="modal" id="markAnnouncement"
                                    		   data-announcementId="<?php echo $announcement->id; ?>" >
                                    	   <span class="fa fa-eye"></span>
                                    	   </a>
                                    	   <?php } else{ ?>
                                    	   <span class="label label-success">Marked as Read</span>
                                    	   <?php } ?>
                                    </td>
                                </tr>
                                <?php
                                		$i++;
                                		}
                                ?>

                                </tbody>

                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>
            <!-- /.col-md-12 -->

        </div>
        <!-- /.row -->


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!--<script type="text/javascript">
$(document).ready(function(){    	
    	
   $("#announcementsTable").DataTable();
});
</script>-->
