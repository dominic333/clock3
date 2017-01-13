
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add / Edit Department
            <small>Department List</small>
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
                        <h3 class="box-title">Manage Departments</h3>
                        <?php if(isset($total_Depts) && isset($companyPlanDetails->userLimit) ) {
				            		if($total_Depts<$companyPlanDetails->deptLimit)
				            		{
				             ?>
                        <a href="#" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#addDepartmentModal">Add Department <span
                                class="fa fa-plus-circle"
                                aria-hidden="true"></span>
                        </a>
                        <?php }} ?>
                        <label class="pull-right" style="padding-right:10px; padding-top:5px;">
                        <?php echo (isset($total_Depts)) ? $total_Depts :set_value('NA'); ?>/<?php echo (isset($companyPlanDetails->deptLimit)) ? $companyPlanDetails->deptLimit :set_value('NA'); ?>
                        </label>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    
                        <div class="table-responsive">
                            <table id="departmentsList" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="10px">No</th>
                                    <th>Department Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                 $i=1;
                                	foreach($company_departments as $row){
                                ?>
                                <tr id="<?php echo 'row'.$row->dept_id; ?>" >
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row->department_name; ?></td>
                                    <td>
                                        <a class="btn btn-success btn-sm modify_department_link" href="#" data-dept_id="<?php echo $row->dept_id; ?>" data-department_name="<?php echo $row->department_name; ?>" data-company_id="<?php echo $row->company_id; ?>" ><span class="fa fa-edit"></span></a>
                                        <a class="btn btn-danger btn-sm delete_department_link" href="#" data-dept_id="<?php echo $row->dept_id; ?>" data-company_id="<?php echo $row->company_id; ?>" onclick="return confirm('Are you sure?')" ><span class="fa fa-trash"></span></a>
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

<!--=======================================Add Department Modal Form========================================-->
<div class="modal fade" id="addDepartmentModal" tabindex="-1" role="dialog"
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
                    Add Department
                </h4>
            </div>
				<form id="addDepartmentForm" name="addDepartmentForm" class="form-horizontal" role="form" action="<?php echo base_url();?>ccshifts/shifts/addDepartments" method="post">
            <!-- Modal Body -->
            <div class="modal-body">                
                    <div class="form-group">
                    		<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
                        <label class="col-sm-4 control-label">Department Name</label>
                        <div class="col-sm-8">
                            <input type="text" id="department" name="department" required class="form-control" placeholder="Department Name"/>
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
                    Add
                </button>
               
            </div>
             </form>
        </div>
    </div>
</div>
<!--=======================================End Of Add Department Modal Form========================================-->

<!--=======================================Edit Department Modal Form========================================-->
<div class="modal fade" id="editDepartmentModal" tabindex="-1" role="dialog"
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
                    Add Department
                </h4>
            </div>
				<form id="editDepartmentForm" name="editDepartmentForm" class="form-horizontal" role="form" action="<?php echo base_url();?>ccshifts/shifts/editDepartment" method="post">
            <!-- Modal Body -->
            <div class="modal-body">                
                    <div class="form-group">
                    		<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
                    		<input type="hidden" id="dept_id" name="dept_id"  />
                    		<input type="hidden" id="company_id" name="company_id"  />
                    		
                        <label class="col-sm-4 control-label">Department Name</label>
                        <div class="col-sm-8">
                            <input type="text" id="department" name="department" required class="form-control" placeholder="Department Name"/>
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
                    Update
                </button>
            </div>
             </form>
        </div>
    </div>
</div>
<!--=======================================End Of Edit Department Modal Form========================================-->


