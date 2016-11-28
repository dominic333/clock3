<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Contact Support
            <small>Lorem Ipsum...</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-lock"></i> Administrative</a></li>
            <li class="active"><a href="<?php echo base_url();?>ccadministration/administration/contactsupport"> Contact Support</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <div class="user-block">
                            <img class="img-circle" src="<?php echo base_url();?>assets/cc/images/voffice128x128.png" alt="User Image">
                                <span class="username">
                                <a href="#">vOffice Philippines Inc</a>
                                </span>
                            <span class="description">Manila, Philippines</span>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form class="form-horizontal" role="form" id="contactSupportForm" name="contactSupportForm" action="<?php echo base_url();?>ccadministration/administration/contactsupport" method="post">
                            <div class="box-body">

											<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Name</label>

                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" placeholder="Name" id="senderName" name="senderName">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Email</label>

                                    <div class="col-sm-7">
                                        <input type="email" class="form-control" placeholder="Email" id="senderEmail" name="senderEmail">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Message</label>

                                    <div class="col-sm-7">
                                        <textarea class="form-control" rows="3" placeholder="Message..." id="senderMessage" name="senderMessage"></textarea>
                                    </div>
                                </div>

                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">

                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="reset" class="btn btn-danger" href="javascript:void(0)">Cancel</button>
                                        <button type="submit" class="btn btn-success" href="javascript:void(0)">Submit</button>
                                    </div>
                                </div>

                            </div>
                            <!-- /.box-footer -->
                        </form>

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
