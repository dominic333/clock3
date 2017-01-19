<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add White List Ips
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-cogs"></i> Setup Attendance</a></li>
            <li class="active"><a href="<?php echo base_url();?>ccshifts/shifts/whitelistips"> Add White List Ips</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">Manage List IPs</h3>
                        <a href="#" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#myModalHorizontal">Add Department IP <span
                                class="fa fa-plus-circle"
                                aria-hidden="true"></span></a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="10px">No</th>
                                  <?php /*  <th>Department Name</th> */ ?>
                                    <th>IP Address</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                 $i=1;
                                	foreach($whitelistedIps as $row){
                                ?>
                                <tr id="<?php echo 'row'.$row->id; ?>">
                                    <td><?php echo $i; ?></td>
                                 <?php /*   <td> echo $row->department_name; </td> */ ?>
                                    <td><?php echo $row->ip_address; ?></td>
                                    <td>  
                                    		<a class="btn btn-success btn-sm modify_whitelisted_ip" href="#" data-whitelist_id="<?php echo $row->id; ?>" data-whitelist_ip="<?php echo $row->ip_address; ?>" ><span class="fa fa-edit"></span>
                                          <a class="btn btn-danger btn-sm delete_whitelisted_ip" href="#" data-whitelist_id="<?php echo $row->id; ?>" data-whitelist_ip="<?php echo $row->ip_address; ?>" ><span class="fa fa-trash"></span>
                                    </td>
                                </tr>
                                <?php $i++; } ?>

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

<!--=======================================Add Whitelisted IP Modal Form========================================-->
<div class="modal fade" id="myModalHorizontal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Add Department IP
                </h4>
            </div>

            <!-- Modal Body -->
            <form class="form-horizontal" role="form" id="frm_add_department_ip" name="frm_add_department_ip" action="<?php echo base_url();?>ccshifts/shifts/add_department_ips" method="post">
            <div class="modal-body">
                 <!--
                    <div class="form-group">
                        <label  class="col-sm-4 control-label">Select a Department</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" style="width: 100%;">
                                <option selected="selected">-- Select a Department --</option>
                                <option>All Departments</option>
                                <option>Finance Department</option>
                                <option>IT Department</option>
                                <option>GA Department</option>
                                <option>HR Department</option>
                            </select>
                        </div>
                    </div>
                    -->
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
                    <div class="form-group">
                        <label class="col-sm-4 control-label">IP Address</label>
                        <div class="col-sm-8">
                            <input id="department_ip" name="department_ip" type="text" class="form-control" placeholder="IP Address"/>
                        </div>
                    </div>

            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger"
                        data-dismiss="modal">
                    Cancel
                </button>
                <button type="submit" class="btn btn-success">
                    Add
                </button>               
            </div>
            </form>
        </div>
    </div>
</div>
<!--=======================================End Of Add Whitelisted IP Modal Form========================================-->

<!--=======================================Edit Whitelisted IP Modal Form========================================-->
<div class="modal fade" id="modify_whitelisted_ip_modal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Add Department IP
                </h4>
            </div>

            <!-- Modal Body -->
            <form class="form-horizontal" role="form" id="frm_edit_whitelisted_ip" name="frm_edit_whitelisted_ip" action="<?php echo base_url();?>ccshifts/shifts/modify_department_ips" method="post">
            <div class="modal-body">
                 <!--
                    <div class="form-group">
                        <label  class="col-sm-4 control-label">Select a Department</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" style="width: 100%;">
                                <option selected="selected">-- Select a Department --</option>
                                <option>All Departments</option>
                                <option>Finance Department</option>
                                <option>IT Department</option>
                                <option>GA Department</option>
                                <option>HR Department</option>
                            </select>
                        </div>
                    </div>
                    -->
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
                    <input id="whitelist_id" name="whitelist_id" type="hidden" class="form-control" placeholder="ID"/>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">IP Address</label>
                        <div class="col-sm-8">
                            <input id="department_ip" name="department_ip" type="text" class="form-control" placeholder="IP Address"/>
                        </div>
                    </div>

            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger"
                        data-dismiss="modal">
                    Cancel
                </button>
                <button type="submit" class="btn btn-success">
                    Add
                </button>               
            </div>
            </form>
        </div>
    </div>
</div>
<!--=======================================End Of Edit Whitelisted IP Modal Form========================================-->
