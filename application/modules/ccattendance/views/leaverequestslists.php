
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Leave Management
            <small>User Leaves Management</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-cogs"></i> Setup Attendance</a></li>
            <li class="active"><a href="<?php echo base_url();?>ccshifts/shifts"> Add / Edit Department</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">Leave Requests</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    
                        <div class="table-responsive">
                            <table id="leaveApplicationList" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="10px">No</th>
                                    <th>Date</th>
                                    <th>User</th>
                                    <th>Leave Type</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                 $i=1;
                                	foreach($allLeaves as $row){
                                ?>
                                <tr id="<?php echo 'row'.$row->id; ?>" >
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row->leave_date; ?></td>
                                    <td><?php echo $row->staff_name; ?></td>
                                    
                                    <td>
                                        <?php if($row->leaveType=='medical') { ?>
                                        <label class=" bg-green" data-leavetype="medical" data-leave="leave" style="position: relative;">Medical</label>
                                         <?php } else if($row->leaveType=='casual') { ?>
                            				 <label class="bg-yellow" data-leavetype="casual" data-leave="leave" style="position: relative;">Casual</label>
                            				  <?php } else{  ?>
                            				 <label class="bg-aqua" data-leavetype="annual" data-leave="leave" style="position: relative;">Annual</label>  
                            				  <?php } ?>                                 
                                    </td>
                                    <td>
                                       <?php if($row->status==0) {?>
                                        <a class="btn btn-success btn-sm approve_leave_link" href="#" data-id="<?php echo $row->id; ?>" data-staffid="<?php echo $row->staff_id; ?>" onclick="return confirm('Approve this?')" data-toggle="tooltip" data-placement="bottom" title="Approve This"   ><span class="fa fa-check"></span></a>
                                        <a class="btn btn-danger btn-sm reject_leave_link" href="#" data-id="<?php echo $row->id; ?>" data-staffid="<?php echo $row->staff_id; ?>" onclick="return confirm('Reject this?')" data-toggle="tooltip" data-placement="bottom" title="Reject This"  ><span class="fa fa-times"></span></a>
													<?php } else if($row->status==1) { ?>   
													<label class="label label-success">Approved</label>   
													<?php } ?>                             
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