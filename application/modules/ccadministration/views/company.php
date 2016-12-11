<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            View / Edit Company
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-lock"></i> Administrative</a></li>
            <li class="active"><a href="<?php echo base_url();?>ccadministration/administration"> View / Edit Company</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-danger">
                    <div class="box-header">

                        <div class="user-block">
                        		<?php if($company_details->company_logo!=''){?>
                     						<img class="img-circle" src="<?php echo base_url();?>images/company/<?php echo  $company_details->company_logo; ?>">
                     			<?php }else{ ?>
                     						<img class="img-circle" src="<?php echo base_url();?>assets/cc/images/voffice128x128.png" alt="Company Avatar">
                     			<?php }?>
                     					
                            <button class="btn btn-warning pull-right" id="editCompanyInfoBtn" name="editCompanyInfoBtn" href="javascript:void(0)">Edit Company</button>
                                <span class="username">
                                <a href="#"> <?php echo (isset($company_details->company_name)) ? $company_details->company_name :set_value(''); ?> </a>
                                </span>
                            <span class="description"><?php echo (isset($company_details->company_city)) ? $company_details->company_city :set_value('City'); ?>, <?php echo (isset($company_details->company_country)) ? $company_details->company_country :set_value('Country'); ?></span>
                        </div>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form class="form-horizontal" role="form" id="editCompanyInfoForm" name="editCompanyInfoForm" action="<?php echo base_url();?>ccadministration/administration/updateCompanyInfo" method="post" >
                            <div class="box-body">

											<input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash()?>" />
                                <div class="form-group">
                                    <label for="companyName" class="col-sm-3 control-label">Company Name</label>

                                    <div class="col-sm-7">
                                        <input type="text" class="form-control readOnlyApplied" placeholder="Company Name" id="companyName" name="companyName" value="<?php echo (isset($company_details->company_name)) ? $company_details->company_name :set_value(''); ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="companyLoginName" class="col-sm-3 control-label">Login Name</label>

                                    <div class="col-sm-7">
                                        <input type="text" class="form-control readOnlyApplied" placeholder="Login Name" id="companyLoginName" name="companyLoginName" value="<?php echo (isset($company_details->company_login)) ? $company_details->company_login :set_value(''); ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="companyAddress" class="col-sm-3 control-label">Address</label>

                                    <div class="col-sm-7">
                                        <input type="text" class="form-control readOnlyApplied" placeholder="Address" id="companyAddress" name="companyAddress" value="<?php echo (isset($company_details->company_address)) ? $company_details->company_address :set_value(''); ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="companyContactPerson" class="col-sm-3 control-label">Contact Person</label>

                                    <div class="col-sm-7">
                                        <input type="text" class="form-control readOnlyApplied" placeholder="Contact Person" id="companyContactPerson" name="companyContactPerson" value="<?php echo (isset($company_details->contact_person)) ? $company_details->contact_person :set_value(''); ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="companyEmail" class="col-sm-3 control-label">Email</label>

                                    <div class="col-sm-7">
                                        <input type="email" class="form-control readOnlyApplied" placeholder="Email" id="companyEmail" name="companyEmail" value="<?php echo (isset($company_details->contact_email)) ? $company_details->contact_email :set_value(''); ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="companyContactNumber" class="col-sm-3 control-label">Contact Number</label>

                                    <div class="col-sm-7">
                                        <input type="text" class="form-control readOnlyApplied" placeholder="Contact Number" id="companyContactNumber" name="companyContactNumber" value="<?php echo (isset($company_details->contact_number)) ? $company_details->contact_number :set_value(''); ?>" readonly>
                                    </div>
                                </div>

                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">

                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="reset" class="btn btn-danger disabledApplied" href="javascript:void(0)" disabled >Cancel</button>
                                        <button type="submit" class="btn btn-success disabledApplied" href="javascript:void(0)" disabled>Submit</button>
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

