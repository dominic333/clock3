
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
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
                        <a href="#" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#addAnnouncementModal">Create Announcement <span
                                class="fa fa-plus-circle"
                                aria-hidden="true"></span></a>
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
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $i=1;
                                		foreach($listAnnouncements as $announcement)
                                		{
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $announcement->date; ?></td>
                                    <td><?php echo $announcement->title; ?></td>
                                    <td><?php echo $announcement->msg; ?></td>
                                    <td>
                                    		<a class="btn btn-success btn-sm editThisAnnouncement" href="#" data-toggle="modal" 
                                    		   data-announcementId="<?php echo $announcement->id; ?>" data-announcementTitle="<?php echo $announcement->title; ?>" data-announcementMsg="<?php echo $announcement->msg; ?>" >
                                    	   <span class="fa fa-edit"></span>
                                    	   </a>
                                    	   
                                          <a class="btn btn-danger btn-sm deleteThisAnnouncement" href="#" data-announcementId="<?php echo $announcement->id; ?>">
                                          <span class="fa fa-trash"></span>
                                          </a>
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


<!--=======================================Add announcement Modal Form========================================-->
<div class="modal fade" id="addAnnouncementModal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Create Announcement
                </h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">

                <form iid="addAnnouncementForm" name="addAnnouncementForm" class="form-horizontal" role="form" action="<?php echo base_url();?>ccannouncements/announcements/addAnnouncement" method="post">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-10">
                            <input id="title" name="title" type="text" class="form-control"
                                   placeholder="Title" required/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Body</label>
                        <div class="col-sm-10">
                            <textarea id="message" name="message" class="form-control" rows="3" placeholder="Message..." required></textarea>
                        </div>
                    </div>

            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="reset" class="btn btn-danger"
                        data-dismiss="modal">
                    Cancel
                </button>
                <button type="submit" class="btn btn-success">
                    Post
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--=======================================End Of Add announcement Modal Form========================================-->

<!--=======================================Edit announcement Modal Form========================================-->
<div class="modal fade" id="editAnnouncementModal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Edit Announcement
                </h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">

                <form id="editAnnouncementForm" name="editAnnouncementForm" class="form-horizontal" role="form" action="<?php echo base_url();?>ccannouncements/announcements/editAnnouncement" method="post">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
                    <input type="hidden" id="ancId" name="ancId"  />
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-10">
                            <input id="title" name="title" type="text" class="form-control"
                                   placeholder="Title" required/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Body</label>
                        <div class="col-sm-10">
                            <textarea id="message" name="message" class="form-control" rows="3" placeholder="Message..." required></textarea>
                        </div>
                    </div>

            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="reset" class="btn btn-danger"
                        data-dismiss="modal">
                    Cancel
                </button>
                <button type="submit" class="btn btn-success">
                    Post
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--=======================================End Of Edit announcement Modal Form========================================-->

