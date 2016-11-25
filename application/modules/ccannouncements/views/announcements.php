
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Announcements
            <small>Lorem Ipsum...</small>
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
                        <a href="#" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#myModalHorizontal">Create Announcement <span
                                class="fa fa-plus-circle"
                                aria-hidden="true"></span></a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
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
                                <tr>
                                    <td>1</td>
                                    <td>01-01-2016</td>
                                    <td>Lorem Ipsum</td>
                                    <td>Lorem Ipsum</td>
                                    <td><a class="btn btn-success btn-sm" href="#"><span class="fa fa-edit"></span>
                                            <a class="btn btn-danger btn-sm" href="#"><span class="fa fa-trash"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>01-01-2016</td>
                                    <td>Lorem Ipsum</td>
                                    <td>Lorem Ipsum</td>
                                    <td><a class="btn btn-success btn-sm" href="#"><span class="fa fa-edit"></span>
                                            <a class="btn btn-danger btn-sm" href="#"><span class="fa fa-trash"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>01-01-2016</td>
                                    <td>Lorem Ipsum</td>
                                    <td>Lorem Ipsum</td>
                                    <td><a class="btn btn-success btn-sm" href="#"><span class="fa fa-edit"></span>
                                            <a class="btn btn-danger btn-sm" href="#"><span class="fa fa-trash"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>01-01-2016</td>
                                    <td>Lorem Ipsum</td>
                                    <td>Lorem Ipsum</td>
                                    <td><a class="btn btn-success btn-sm" href="#"><span class="fa fa-edit"></span>
                                            <a class="btn btn-danger btn-sm" href="#"><span class="fa fa-trash"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>01-01-2016</td>
                                    <td>Lorem Ipsum</td>
                                    <td>Lorem Ipsum</td>
                                    <td><a class="btn btn-success btn-sm" href="#"><span class="fa fa-edit"></span>
                                            <a class="btn btn-danger btn-sm" href="#"><span class="fa fa-trash"></span>
                                    </td>
                                </tr>

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


<!--=======================================Modal Form========================================-->
<div class="modal fade" id="myModalHorizontal" tabindex="-1" role="dialog"
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

                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label  class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control"
                                   placeholder="Title" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Body</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="3" placeholder="Message..." required></textarea>
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
<!--=======================================End Of Modal Form========================================-->

